<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\Agenda;
use App\Models\AgendaParticipant;
use App\Models\BoothLayout;
use App\Models\BoothTransaction;
use App\Models\Layout;
use App\Models\RegisteredBooth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layouts = Layout::select('id', 'name')->get();
        return view('admin.agenda.index', compact('layouts'));
    }

    public function fetch(Request $request)
    {
        $columns = ['id', 'name', 'start_date', 'end_date', 'is_active', 'layout_id'];
        $columnSearch = ['name', 'start_date', 'end_date', 'is_active'];

        $data = Agenda::select($columns);

        if ($request->search['value'] != '') {
            foreach ($columnSearch as $key => $column) {
                if ($key == 0) continue;
                if ($key == 1) {
                    $data = $data->where($column, 'like', '%' . $request->search['value'] . '%');
                } else {
                    $data = $data->orWhere($column, 'like', '%' . $request->search['value'] . '%');
                }
            }
        }
        if ($request->order[0]) {
            $data = $data->orderBy($columnSearch[$request->order[0]['column'] - 1], $request->order[0]['dir']);
        }
        if ($request->length != -1) {
            $data = $data->offset($request->start)->limit($request->length);
        }

        $count = Agenda::count();
        $data = $data->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach ($data as $key => $value) {
            $mappingButton = $value->layout_id  == null ? '' : '<a href="' . route('agenda.mapping', [$value->id]) . '" class="btn btn-secondary me-2">Mapping Booth</a>';
            $processedData[] = [
                $no++,
                $value->name,
                $value->start_date->locale('id_ID')->isoFormat('D MMMM Y'),
                $value->end_date->locale('id_ID')->isoFormat('D MMMM Y') ?? '-',
                $value->is_active ? '<p class="text-success">Aktif</p>' : '<p class="text-danger">Tidak aktif</p>',
                $mappingButton.'<a href="' . route('agenda.show', [$value->id]) . '" class="btn btn-warning me-2">Edit</a><button onclick="showDeleteConfirmation(\'' . $value->id . '\')" class="btn btn-danger">Hapus</button>',
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_active' => 'required|boolean',
            'layout_id' => 'nullable|exists:layouts,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->all();
        $coverName = '';

        if ($request->hasFile('cover')) {
            $payload['cover'] = GeneralHelper::uploadFile(
                Agenda::class,
                $request->file('cover'),
                'images/agenda',
                '',
                'cover',
                ''
            );
            // $payload['cover'] = $this->uploadCover($request->file('cover'), 'images/agenda');
        }

        $agenda = Agenda::create($payload);

        if ($payload['layout_id'] != null || $payload['layout_id'] != '') {
            $checkBoothExist = RegisteredBooth::from('registered_booths as rb')->join('booth_layouts as bl', 'bl.id', '=', 'rb.booth_layout_id')
                                                                               ->join('layouts as l', 'l.id', '=', 'bl.layout_id')
                                                                               ->where('agenda_id', $agenda->id)
                                                                               ->where('layout_id', $payload['layout_id'])
                                                                               ->count();
            if ($checkBoothExist == 0) {
                GeneralHelper::insertRegisteredBooth('bl.layout_id', $payload['layout_id'], $agenda);
            }
        }

        return response()->json(['message' => 'Agenda berhasil ditambahkan'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agenda = Agenda::find($id);
        $layouts = Layout::select('id', 'name')->get();
        return view('admin.agenda.edit', compact('agenda', 'layouts'));
    }

    public function mapping(string $id)
    {
        $agenda = Agenda::find($id);
        return view('admin.agenda.mapping', compact('agenda'));
    }

    public function exportMapping(Request $request, string $id)
    {
        $withDetail = $request->query('no-detail') == 1 ? false : true;
        $agenda = Agenda::find($id);

        $pdf = Browsershot::html(view('admin.agenda.export', compact('agenda', 'withDetail'))->render())
            ->noSandbox()
            ->waitUntilNetworkIdle()
            ->debug(true)
            ->setDelay(2000)
            ->timeout(60)
            ->setOption('args', ['--disable-gpu', '--disable-software-rasterizer'])
            ->pdf();
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'mapping_' . $agenda->name . '.pdf');
        // return view('admin.agenda.export', compact('agenda', 'withDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_active' => 'required|boolean',
            'layout_id' => 'nullable|exists:layouts,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->only(['name', 'cover', 'description', 'location', 'start_date', 'end_date', 'is_active', 'layout_id']);

        $agenda = Agenda::find($id);

        if ($request->hasFile('cover')) {
            $payload['cover'] = GeneralHelper::uploadFile(
                Agenda::class,
                $request->file('cover'),
                'images/agenda',
                $agenda->id,
                'cover',
                ''
            );
            // $payload['cover'] = $this->uploadCover($request->file('cover'), 'images/agenda', $agenda->id);
        } else {
            $payload['cover'] = $agenda->cover;
        }

        $agenda = Agenda::where('id', $id)->update($payload);

        if ($agenda) {
            toastr()->success('Agenda berhasil diubah');
            return redirect()->route('agenda.index');
        } else {
            toastr()->error('Agenda gagal diubah, silakan coba lagi');
            return redirect()->route('agenda.show', [$id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agenda = Agenda::find($id);
        if ($agenda) {
            if ($agenda->cover) {
                Storage::disk('public')->delete($agenda->cover);
                // unlink(public_path($agenda->cover));
            }
            BoothTransaction::whereIn('id', RegisteredBooth::where('agenda_id', $id)->select(['booth_transaction_id'])->get()->pluck('booth_transaction_id'))->delete();
            RegisteredBooth::where('agenda_id', $id)->delete();
            AgendaParticipant::where('agenda_id', $id)->delete();
            $agenda->delete();
            return response()->json(['message' => 'Agenda berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Agenda gagal dihapus, silakan coba lagi'], 404);
        }
    }

    private function uploadCover($coverFile, $path, $agendaId = '')
    {
        $coverName = Str::uuid() . '.' . $coverFile->getClientOriginalExtension();
        if ($agendaId != '') {
            $agenda = Agenda::find($agendaId);
            if ($agenda->cover) {
                unlink(public_path($agenda->cover));
            }
        }
        // Storage::put('images/agenda', $request->file('cover'));
        $coverFile->move(public_path($path), $coverName);
        return $path . '/' . $coverName;
    }
}
