<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.booth.index');
    }

    public function fetch(Request $request){
        $columns = ['id', 'name', 'type', 'description', 'color', 'default_price'];

        $data = Booth::select($columns);

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

        $count = Booth::count();
        $data = $data->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach($data as $key => $value){
            $row = [];
            $row[] = $no++;
            $row[] = $value->name;
            $row[] = $value->type;
            $row[] = '<button class="btn" style="background-color:'.$value->color.' !important;"></button>';
            $row[] = 'Rp'.$value->default_price;
            $row[] = '<a href="'.route('booth.show', [$value->id]).'" class="btn btn-warning me-2">Edit</a><button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>';
            $processedData[] = $row;
        }

        $output = [
            "draw" => $request->draw,
            "recordsTotal" => $count,
            "recordsFiltered" =>  $count,
            "data" => $processedData,
        ];

        // $output = [
        //     "draw" => $request->draw,
        //     "recordsTotal" => 0,
        //     "recordsFiltered" =>  0,
        //     "data" => [],
        // ];

        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:booths,name',
            'type' => 'required|string',
            'color' => 'required|string',
            'description' => 'required|string',
            'default_price' => 'required',
            'length_in_m' => 'required|numeric',
            'width_in_m' => 'required|numeric',
            'height_in_m' => 'required|numeric',
            'facilities' => 'required',
            'branding_facilities' => 'required',
            'lo_count' => 'required|numeric',
            'lo_performance' => 'required',
            'is_buyable' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->all();

        $booth = Booth::create($payload);
        if($booth){
            return response()->json(['message' => 'Jenis booth berhasil ditambahkan'], 201);
        } else {
            return response()->json(['message' => 'Jenis booth Gagal ditambahkan'], 201);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booth = Booth::where('id', $id)->first();
        return view('admin.booth.edit', compact('booth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'color' => 'required|string',
            'description' => 'required|string',
            'default_price' => 'required',
            'length_in_m' => 'required|numeric',
            'width_in_m' => 'required|numeric',
            'height_in_m' => 'required|numeric',
            'facilities' => 'required',
            'branding_facilities' => 'required',
            'lo_count' => 'required|numeric',
            'lo_performance' => 'required',
            'is_buyable' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->except(['_method','_token']);
        $fixedPrice = str_replace('.','',$payload['default_price']);

        $booth = Booth::where('id', $id)->update($payload);
        $updatePrice = DB::table('registered_booths')->join('booth_layouts', 'registered_booths.booth_layout_id', '=', 'booth_layouts.id')
                                                            ->join('booths', 'booth_layouts.booth_id', '=', 'booths.id')
                                                            ->where('booths.id', $id)
                                                            ->where('is_booked', 0)
                                                            ->update([
                                                                'fixed_price' => $fixedPrice
                                                            ]);

        toastr()->success('Jenis booth berhasil diubah');
        return redirect()->route('booth.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booth = Booth::where('id', $id)->delete();
        if($booth){
            return response()->json([
                'message' => "Berhasil menghapus jenis booth"
            ], 200);
        } else {
            return response()->json([
                'message' => "Gagal menghapus jenis booth, silakan coba lagi"
            ], 500);
        }
    }


    public function getBoothDescription($id){
        $booth = Booth::where('id', $id)->select('description')->first();
        if($booth){
            return response()->json([
                'message' => 'Berhasil mendapatkan deskripsi booth',
                'data' => $booth->description
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data booth tidak ditemukan'
            ], 404);
        }
    }
}
