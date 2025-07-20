<?php

namespace App\Http\Controllers;

use App\Models\CompanyRegistrationInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class RegistrationInputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.registrationInput.index');
    }

    public function fetch(Request $request){
        $columns = ['id', 'column_name', 'column_label', 'column_type'];

        $data = CompanyRegistrationInput::select($columns);

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

        $count = CompanyRegistrationInput::count();
        $data = $data->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach($data as $key => $value){
            $row = [];
            $row[] = $no++;
            $row[] = $value->column_name;
            $row[] = $value->column_label;
            $row[] = $value->column_type;
            $row[] = '<a href="'.route('registrationInput.show', [$value->id]).'" class="btn btn-warning me-2">Edit</a><button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>';
            $processedData[] = $row;
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
            'column_name' => 'required|string|unique:company_registration_inputs,column_name',
            'column_label' => 'required|string',
            'column_type' => 'required|string|in:text,number,long_text,select,multiple_select',
            'is_nullable' => 'required|boolean',
            'default_value' => 'nullable|string',
            'list_value' => (in_array($request->column_type, ['select','multiple_select']) ? 'required' : 'nullable').'|string',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->only('column_name','column_label','column_type','is_nullable','default_value','list_value');

        try{
            $createColumn = CompanyRegistrationInput::create($payload);
            if (Schema::hasColumn('companies', $request->column_name)) {
                return response()->json(['error' => 'Column already exists'], 400);
            }

            Schema::table('companies', function($table) use ($payload) {
                $column = match ($payload['column_type']) {
                    'text', 'select', 'multiple_select' => $table->string($payload['column_name'], 500),
                    'long_text' => $table->text($payload['column_name']),
                    'number' => $table->integer($payload['column_name']),
                    default => throw new \InvalidArgumentException('Invalid column type: ' . $payload['column_type']),
                };

                $column = $column->nullable();

                if (!empty($payload['default_value'])) {
                    $column->default($payload['default_value']);
                }
            });

            return response()->json([
                'message' => 'Kolom berhasil ditambahkan'
            ], 201);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $input = CompanyRegistrationInput::find($id);
        return view('admin.registrationInput.edit', compact('input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'column_name' => 'required|string',
            'column_label' => 'required|string',
            'column_type' => 'required|string|in:text,number,long_text,select,multiple_select',
            'is_nullable' => 'required|boolean',
            'default_value' => 'nullable|string',
            'list_value' => (in_array($request->column_type, ['select','multiple_select']) ? 'required' : 'nullable').'|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->only('column_name','column_label','column_type','is_nullable','default_value','select_value');

        try{
            $createColumn = CompanyRegistrationInput::where('id', $id)->update($payload);
            if (Schema::hasColumn('companies', $request->column_name)) {
                Schema::table('companies', function($table) use ($payload) {
                    $column = match ($payload['column_type']) {
                        'text', 'select', 'multiple_select' => $table->string($payload['column_name'], 500),
                        'long_text' => $table->text($payload['column_name']),
                        'number' => $table->integer($payload['column_name']),
                        default => throw new \InvalidArgumentException('Invalid column type: ' . $payload['column_type']),
                    };

                    if (!empty($payload['default_value'])) {
                        $column = $column->default($payload['default_value']);
                    }

                    $column = $column->nullable();

                    $column->change();
                });
            } else {
                toastr()->error('Kolom tidak terdaftar');
                return redirect()->route('registrationInput.show', [$id]);
            }

            toastr()->success('Kolom berhasil diperbarui');
            return redirect()->route('registrationInput.index');
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $input = CompanyRegistrationInput::where('id', $id)->first();

        try{
            if (!Schema::hasColumn('companies', $input->column_name)) {
                return response()->json(['error' => 'Kolom tidak terdaftar'], 404);
            }
            Schema::dropColumns('companies', $input->column_name);

            $delete = CompanyRegistrationInput::where('id', $id)->delete();
            if($delete){
                return response()->json([
                    'message' => "Berhasil menghapus input"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Gagal menghapus input, silakan coba lagi"
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
