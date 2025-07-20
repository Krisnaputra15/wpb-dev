<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.account.index');
    }

    public function fetch(Request $request){
        $columns = ['id', 'username', 'role', 'is_active'];
        $data = User::select($columns);

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

        $count = User::count();
        $data = $data->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach($data as $key => $value){
            $deleteButton = Auth::user()->id == $value->id ? "" : '<button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>';
            $editButton = '<a href="'.route('account.show', [$value->id]).'" class="btn btn-warning me-2">Edit</a>';
            $row = [];
            $row[] = $no++;
            $row[] = $value->username;
            $row[] = $value->role;
            $row[] = $value->is_active ? '<p class="text-success">Aktif</p>' : '<p class="text-danger">Tidak aktif</p>';
            $row[] = $editButton.$deleteButton;
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

    public function generate(Request $request){
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1|max:50',
            'role' => 'required|string|in:administrator,humas,perwakilan-perusahaan,random',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $faker = Faker::create();

        $currentTimestamp = Carbon::now()->toDateTimeString();
        $password = Hash::make('password');
        $usernames = collect(range(0, $request->quantity-1))->map(fn() => $faker->unique()->userName)->toArray();
        $generatedRoles = [];
        if($request->role == 'random'){
            $roles = ['administrator','humas','perwakilan-perusahaan'];
            $generatedRoles = collect(range(0, $request->quantity - 1)) // Correct index range
            ->map(fn() => $roles[array_rand($roles)]) // Use $roles directly
            ->toArray();
        }
        $data = [];

        foreach ($usernames as $key => $username) {
            $data[] = [
                'id' => (string) Str::uuid(),
                'username' => $username,
                'password' => $password,
                'role' => $request->role == 'random' ? $generatedRoles[$key] : $request->role,
                'is_active' => 1,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ];
        }
        $user = User::insert($data);
        if($user){
            return response()->json(['message' => 'Akun berhasil dibuat'], 201);
        } else {
            return response()->json(['message' => 'Akun gagal dibuat'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.account.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'nullable|string',
            'phone_number' => 'nullable|string|min:10|max:15',
            'is_active' => 'required|boolean',
            'company_id' => 'nullable|uuid|exists:companies,id',
            'password' => 'nullable|string',
            'username' => 'required|string',
            'role' => 'required|string|in:administrator,humas,perwakilan-perusahaan',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $columns = ['fullname','phone_number','is_active','company_id','password','username','role'];

        $user = User::find($id);
        foreach($columns as $column){
            if(isset($request->$column)){
                if($column == 'password'){
                    $user->$column = Hash::make($request->$column);
                    continue;
                }
                $user->$column = $request->$column;
            }
        }
        $user->save();

        toastr()->success('Berhasil menyimpan data akun');
        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->delete();
        if($user){
            return response()->json([
                'message' => "Berhasil menghapus akun"
            ], 200);
        } else {
            return response()->json([
                'message' => "Gagal menghapus akun, silakan coba lagi"
            ], 500);
        }
    }
}
