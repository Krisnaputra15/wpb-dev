<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content.index');
    }

    public function fetch(Request $request){
        $columns = ['id', 'title', 'type', 'is_active'];

        $data = Content::select($columns);

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

        $count = Content::count();
        $data = $data->get();
        $no = $request->start + 1;
        $processedData = [];

        foreach($data as $key => $value){
            $processedData[] = [
                $no++,
                $value->title,
                $value->type,
                $value->is_active ? '<p class="text-success">Aktif</p>' : '<p class="text-danger">Tidak aktif</p>',
                '<a href="'.route('content.show', [$value->id]).'" class="btn btn-warning me-2">Edit</a><button onclick="showDeleteConfirmation(\''.$value->id.'\')" class="btn btn-danger">Hapus</button>',
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
            'title' =>'required|string',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' =>'nullable|string',
            'type' => 'required|string|in:faq,article,gallery',
            'video_link.*' =>'nullable|string',
            'is_active' =>'required|boolean'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()],422);
        }

        $payload = $request->all();
        $payload['video_link'] = json_encode($request->video_link);
        $payload['description'] = $payload['description'] ?? '-';
        if($request->hasFile('cover')){
            $payload['cover'] = GeneralHelper::uploadFile(
                Content::class,
                $request->file('cover'),
                'images/content',
                '',
                'cover',
                ''
            );
            // $payload['cover'] = $this->uploadCover($request->file('cover'), 'images/content');
        }

        $content = Content::create($payload);

        return response()->json(['message' => 'Konten berhasil ditambahkan'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = Content::find($id);
        return view('admin.content.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' =>'required|string',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' =>'nullable|string',
            'video_link.*' =>'nullable|string',
            'is_active' =>'required|boolean'
        ]);

        if($validator->fails()){
            dd($validator);
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->only(['title','cover','description','video_link','is_active']);
        if($request->video_link){
            $payload['video_link'] = json_encode($request->video_link);
        }

        if($request->hasFile('cover')){
            $content = Content::find($id);
            $payload['cover'] = GeneralHelper::uploadFile(
                Content::class,
                $request->file('cover'),
                'images/content',
                $content->id,
                'cover',
                ''
            );
            // $payload['cover'] = $this->uploadCover($request->file('cover'), 'images/content', $content->id);
        }

        $content = Content::where('id', $id)->update($payload);

        if($content){
            toastr()->success('Konten berhasil diubah');
            return redirect()->route('content.index');
        } else {
            toastr()->error('Konten gagal diubah, silakan coba lagi');
            return redirect()->route('content.show', [$id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content = Content::find($id);
        if($content){
            if($content->cover){
                Storage::disk('public')->delete($content->cover);
                // unlink(public_path($content->cover));
            }
            $content->delete();
            return response()->json(['message' => 'Konten berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Konten gagal dihapus, silakan coba lagi'], 404);
        }
    }

    private function uploadCover($coverFile, $path, $contentId = ''){
        $coverName = Str::uuid().'.'.$coverFile->getClientOriginalExtension();
        if($contentId != ''){
            $content = Content::find($contentId);
            if($content->cover){
                unlink(public_path($content->cover));
            }
        }
        // Storage::put('images/agenda', $request->file('cover'));
        $coverFile->move(public_path($path), $coverName);
        return $path.'/'.$coverName;
    }
}
