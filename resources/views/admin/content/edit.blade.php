@extends('template.admin')

@section('title')
    Konten
@endsection

@push('style')
@endpush

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Ubah Konten</h4>
                </div>
                {{-- <div class="col-lg-6">
               <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Scoxe</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
               </div>
            </div> --}}
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" id="update-form" method="POST" action="{{route('content.update', [$content->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if($content->type == 'article')
                            <div class="mb-3 row">
                                <label for="location" class="form-label col-md-2">Tipe <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="type" id="type" class="form-select" required readonly="readonly" disabled>
                                        <option value="article" @if($content->type == 'article') selected @endif>Artikel</option>
                                    </select>
                                    <small class="text-danger error" id="typeError"></small>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="title" class="form-label col-md-2">Judul <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="title" name="title"
                                        placeholder="Judul Konten" value="{{$content->title}}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="form-label col-md-2">Deskripsi <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <textarea name="description" id="description-article" class="editor" placeholder="Deskripsi Konten">{!! $content->description !!}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row" data-type="article">
                                <label for="cover" class="form-label col-md-2">Cover</label>
                                <div class="col-md-10">
                                    <img src="{{asset( 'storage/'.$content->cover)}}" id="old-cover" alt="Cover Konten" class="img-fluid mb-2" style="width: 35% !important">
                                    <input type="file" name="cover" id="cover" class="form-control" accept="image/*" value="{{$content->cover}}" placeholder="File cover konten">
                                    @error('cover')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            @php
                                $links = json_decode($content->video_link);
                            @endphp

                            <div class="mb-3 row" data-type="article" >
                                <label for="video_link" class="form-label col-md-2">Link Video</label>
                                <div class="col-md-10" id="link_video-container">
                                    <div class="link-container row align-items-center mb-1">
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" id="video_link" name="video_link[]"
                                                   placeholder="Link video (opsional)" value="{{$links[0]}}">
                                        </div>
                                        <div class="col-md-2 text-start">
                                            <button type="button" class="btn btn-block w-100 add-link-btn btn-success fw-bold">+</button>
                                        </div>
                                    </div>
                                    @foreach($links as $index => $link)
                                        @if ($index == 0) @continue @endif
                                        <div class="link-container-generated mb-1 row align-items-center">
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="video_link" name="video_link[]"
                                                    placeholder="Link video (opsional)" value="{{$link}}">
                                            </div>
                                            <div class="col-md-2 text-start d-flex justify-content-between">
                                                <button type="button" class="btn btn-success fw-bold w-45 add-link-btn">+</button>
                                                <button type="button" class="btn btn-danger fw-bold w-45 remove-link-btn">-</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <small class="text-danger error" id="video_linkError"></small>
                                </div>
                            </div>
                            @elseif($content->type == 'faq')
                             <div class="mb-3 row">
                                <label for="location" class="form-label col-md-2">Tipe <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="type" id="type" class="form-select" required readonly="readonly" disabled>
                                        <option value="faq" @if($content->type == 'faq') selected @endif>FAQ</option>
                                    </select>
                                    <small class="text-danger error" id="typeError"></small>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="title" class="form-label col-md-2">Pertanyaan <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="title" name="title"
                                        placeholder="Judul Konten" value="{{$content->title}}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="form-label col-md-2">Jawaban <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="text" name="description" id="description" class="form-control" placeholder="Jawaban Pertanyaan" value="{{$content->description}}" required>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @elseif($content->type == 'gallery')
                            <div class="mb-3 row">
                                <label for="location" class="form-label col-md-2">Tipe <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="type" id="type" class="form-select" required readonly="readonly" disabled>
                                        <option value="gallery" @if($content->type == 'gallery') selected @endif>Galeri</option>
                                    </select>
                                    <small class="text-danger error" id="typeError"></small>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="title" class="form-label col-md-2">Judul <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="title" name="title"
                                        placeholder="Judul Konten" value="{{$content->title}}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row" data-type="article">
                                <label for="cover" class="form-label col-md-2">Cover</label>
                                <div class="col-md-10">
                                    <img src="{{asset( 'storage/'.$content->cover)}}" id="old-cover" alt="Cover Konten" class="img-fluid mb-2" style="width: 35% !important">
                                    <input type="file" name="cover" id="cover" class="form-control" accept="image/*" value="{{$content->cover}}" placeholder="File cover konten">
                                    @error('cover')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @else

                            @endif
                            <div class="mb-3 row">
                                <label for="end_date" class="form-label col-md-2">Status Aktif <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="is_active" id="is_active" class="form-select" required>
                                        <option value="1" @if($content->is_active) selected @endif>Aktif</option>
                                        <option value="0" @if(!$content->is_active) selected @endif>Tidak aktif</option>
                                    </select>
                                    @error('is_active')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-3 text-center">
                                <button class="btn btn-primary col-2" type="submit">Simpan</button>
                            </div>

                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#cover').on('change', function() {
                console.log('aw')
                var file = $(this).get(0).files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#old-cover').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                console.log('aw2');
            })

            $('#link_video-container').on('click','.add-link-btn',function() {
                $('#link_video-container').append(`<div class="link-container-generated mb-1 row align-items-center">
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" id="video_link" name="video_link[]"
                                                               placeholder="Link video (opsional)">
                                                    </div>
                                                    <div class="col-md-2 text-start d-flex justify-content-between">
                                                        <button type="button" class="btn btn-success fw-bold w-45 add-link-btn">+</button>
                                                        <button type="button" class="btn btn-danger fw-bold w-45 remove-link-btn">-</button>
                                                    </div>
                                                </div>`);
            });
            $('#link_video-container').on('click', '.remove-link-btn', function() {
                $(this).closest('.link-container-generated').remove();
            });
        });
    </script>
@endpush
