<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\Agenda;
use App\Models\Booth;
use App\Models\BoothLayout;
use App\Models\Layout;
use App\Models\RegisteredBooth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BoothLayoutController extends Controller
{
    public function index($layoutId){
        $booths = BoothLayout::select('label','positions')->where('layout_id', $layoutId)->get();
        $layout = Layout::find($layoutId);
        $boothColors = Booth::all();

        return view('admin.layout.booth.index', compact('booths', 'layout','boothColors'));
    }

    public function fetch(Request $request, $layoutId){
        $columns = ['bl.id', 'bl.label', 'b.type', 'bl.need_label'];

        $data = BoothLayout::from('booth_layouts as bl')->select($columns)
                           ->join('booths as b', 'b.id', 'bl.booth_id')
                           ->where('bl.layout_id', $layoutId);

        if($request->search['value'] != ''){
            foreach($columns as $key => $column){
                if($key == 0) continue;
                if($key == 1){
                    $data = $data->where($column, 'like', '%'.$request->search['value'].'%');
                } else {
                    $data = $data->orWhere($column, 'like', '%'.$request->search['value'].'%');
                }
            }
        }
        if($request->order[0]){
            $data = $data->orderBy($columns[$request->order[0]['column']-1], $request->order[0]['dir']);
        }
        if($request->length != -1){
            $data = $data->offset($request->start)->limit($request->length);
        }

        $count = $data->count();
        $data = $data->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach($data as $key => $value){
            $processedData[] = [
                $no++,
                $value->type,
                $value->need_label ? $value->label : '-',
                '<button class="edit-button btn btn-warning me-2" onclick="editSelectedBooth(\''.$value->id.'\')">Edit</button><button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>'
            ];
        }

        $output = [
            "draw" => $request->draw,
            "recordsTotal" => $count,
            "recordsFiltered" =>  $count,
            "data" => $processedData,
        ];

        return response()->json($output);
    }

    public function boothMapping(Request $request, $layoutId){
        $boothLayouts = null;
        $columns = [];

        if($request->query('isTransaction')){
            $columns = ['rb.id', 'rb.booth_transaction_id', 'positions', 'b.name as booth_name', 'type', 'color', 'need_label', 'label',
                        'is_booked','c.name', 'c.logo', 'booth_pov_file', 'default_price','length_in_m', 'width_in_m',
                        'height_in_m', 'facilities', 'branding_facilities', 'lo_count', 'lo_performance', 'is_buyable'];
        } else {
            $columns = ['booth_layouts.id', 'positions', 'type', 'color', 'label', 'need_label'];
        }

        $boothLayouts = BoothLayout::getBoothLayout($columns, $layoutId, $request->query('isTransaction'));

        $layout = Layout::find($layoutId);
        $boothColors = Booth::select('id','name','type','color')->get();

        return response()->json([
            'message' => 'Berhasil mendapatkan data booth layout',
            'data' => $boothLayouts,
            'additional_data' => [
                'layout' => $layout,
                'boothColors' => $boothColors
            ]
        ], 200);
    }

    public function store(Request $request, $layoutId){
        $rules = [
            'need_label' => 'required',
            'positions' => 'required',
            'booth_id' => 'required|exists:booths,id',
            'booth_pov_file' => 'required|image|mimes:jpeg,png,jpg'
        ];

        if($request->need_label){
            $rules['label'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->all();
        $payload['positions'] = json_encode($payload['positions']);
        $payload['layout_id'] = $layoutId;
        $payload['booth_pov_file'] = GeneralHelper::uploadFile(BoothLayout::class, $request->booth_pov_file, 'images/booth/pov', '', 'booth_pov_file');

        $boothLayout = BoothLayout::create($payload);
        $agendaUsingLayout = Agenda::where('layout_id', $layoutId)->select('id')->get();
        foreach($agendaUsingLayout as $agenda){
            GeneralHelper::insertRegisteredBooth('bl.id', $boothLayout->id, $agenda);
        }
        return response()->json(['message' => 'Booth berhasil ditambahkan'], 201);
    }

    public function show($layoutId, $boothLayoutId){
        $columns = ['booth_layouts.id', 'booth_id', 'positions', 'type', 'color', 'label', 'need_label', 'booth_pov_file'];

        $boothLayouts = BoothLayout::select($columns)->join('booths', 'booths.id', 'booth_layouts.booth_id')
                                    ->where('booth_layouts.layout_id', $layoutId)
                                    ->where('booth_layouts.id', $boothLayoutId)
                                    ->first();

        return response()->json([
            'message' => 'Berhasil mendapatkan data booth layout',
            'data' => $boothLayouts
        ], 200);
    }

    public function update(Request $request, $layoutId, $boothLayoutId){
        $rules = [
            'positions' => 'required',
            'label' => 'required|string',
            'booth_id' => 'required|exists:booths,id',
        ];

        if($request->booth_pov_file != "null"){
            $rules['booth_pov_file'] = 'nullable|image|mimes:jpeg,png,jpg';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->only(['positions','label','booth_id']);
        $payload['positions'] = json_encode($payload['positions']);
        $payload['layout_id'] = $layoutId;
        if($request->has('booth_pov_file') && $request->booth_pov_file != "null"){
            $payload['booth_pov_file'] = GeneralHelper::uploadFile(BoothLayout::class, $request->booth_pov_file, 'images/booth/pov', $boothLayoutId, 'booth_pov_file');
        }

        $boothLayout = BoothLayout::where('id',$boothLayoutId)->update($payload);
        return response()->json(['message' => 'Booth berhasil diubah'], 201);
    }

    public function destroy($layoutId, $boothLayoutId){
        $data = BoothLayout::where('id', $boothLayoutId)->first();
        if($data){
            $data->registered_booths()->delete();
            if($data->booth_pov_file != 'null'){
                Storage::disk('public')->delete($data->booth_pov_file);
                // unlink(public_path($data->booth_pov_file));
            }
            $data->delete();
            return response()->json(['message' => 'Booth berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Gagal menghapus booth, silakan coba lagi'], 500);
        }
    }
}
