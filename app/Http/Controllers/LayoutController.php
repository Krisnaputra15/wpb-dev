<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layout.index');
    }

    public function fetch(Request $request){
        $columns = ['l.id', 'l.name', DB::raw('COUNT(bl.id) as `booth_count`')];

        $data = Layout::from('layouts as l')->select($columns)
                      ->leftJoin('booth_layouts as bl', 'bl.layout_id', 'l.id');

        if($request->search['value'] != ''){
            $searchValue = $request->search['value'];
            $data = $data->where(function ($query) use ($searchValue) {
                $query->where('l.name', 'like', "%$searchValue%")
                    ->orHaving('booth_count', '=', $searchValue);
            });
        }
        if($request->order[0]){
            $data = $data->orderBy($columns[$request->order[0]['column']-1], $request->order[0]['dir']);
        }
        if($request->length != -1){
            $data = $data->offset($request->start)->limit($request->length);
        }

        $count = Layout::count();
        $data = $data->groupBy(['l.id','l.name'])->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach($data as $key => $value){
            $processedData[] = [
                $no++,
                $value->name,
                $value->booth_count,
                '<a href="'.route('layout.booth.index', [$value->id]).'" class="btn btn-secondary me-2">Lihat Booth</a><a href="'.route('layout.show', [$value->id]).'" class="btn btn-warning me-2">Edit</a><button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>'
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
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->only(['name']);
        $payload['x_length'] = 11;
        $payload['y_length'] = 13;

        $layout = Layout::create($payload);
        return response()->json(['message' => 'Layout berhasil ditambahkan'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $layout = Layout::find($id);
        return view('admin.layout.edit', compact('layout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

         if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->only(['name']);

        $layout = Layout::where('id', $id)->update($payload);
        toastr()->success('Layout berhasil diubah');
        return redirect()->route('layout.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layout = Layout::find($id);
        $layout->booth_layout()->delete();

        if($layout->delete()){
            return response()->json(['message' => 'Berhasil menghapus layout'], 200);
        } else {
            return response()->json(['message' => 'Gagal menghapus layout, silakan coba lagi'], 500);
        }
    }
}
