<?php

namespace App\Http\Controllers;

use App\Models\CompanyContact;
use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.companyContact.index');
    }

    public function fetch(Request $request){
        $columns = ['id', 'name', 'email', 'phone_number'];
        $data = CompanyContact::select($columns);

        if($request->query('datatable')){
            if($request->search['value'] != ''){
                foreach($columns as $key => $column){
                    if($key == 0) continue;
                    $data = $key == 1
                        ? $data->where($column, 'like', '%'.$request->search['value'].'%')
                        : $data->orWhere($column, 'like', '%'.$request->search['value'].'%');
                }
            }
            if($request->order[0]){
                $data = $data->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
            }
            if($request->length != -1){
                $data = $data->offset($request->start)->limit($request->length);
            }

            $count = CompanyContact::count();
            $no = $request->start + 1;
            $processedData = [];
            $output = [];

            $data = $data->get();
            foreach($data as $key => $value){
                $processedData[] = [
                    $no++,
                    $value->name,
                    $value->email,
                    $value->phone_number,
                    '<a href="'.route('companyContact.show', [$value->id]).'" class="btn btn-warning me-2">Edit</a><button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>'
                ];
            }

            $output = [
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" =>  $count,
                "data" => $processedData,
            ];
        } else {
            if($request->query('paginated')){
                $data = $data->paginate(10);
            } else {
                $data = $data->get();
            }
            $output = $data;
        }

        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string|max:15',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->all();

        $contact = CompanyContact::create($payload);
        return response()->json(['message' => 'Kontak perusahaan berhasil ditambahkan'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = CompanyContact::find($id);
        return view('admin.companyContact.edit', compact('contact',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string|max:15',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->only(['name', 'email', 'phone_number']);

        $contact = CompanyContact::where('id',$id)->update($payload);
        if($contact){
            toastr()->success('Kontak perusahaan berhasil diubah');
            return redirect()->route('companyContact.index');
        } else {
            toastr()->error('Kontak perusahaan gagal diubah, silakan coba lagi');
            return redirect()->route('companyContact.show', [$id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = CompanyContact::where('id',$id)->delete();
        if($contact){
            return response()->json(['message' => 'Kontak perusahaan berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Gagal menghapus kontak perusahaan, silakan coba lagi'], 500);
        }
    }
}
