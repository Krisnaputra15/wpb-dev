@extends('template.admin')

@section('title')
    Ubah Jenis Booth
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
                    <h4 class="page-title mb-0">Ubah Jenis Booth</h4>
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
                        <form class="form-horizontal" id="update-form" method="POST" action="{{route('booth.update', [$booth->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="name">Nama <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama booth" value="{{$booth->name}}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="type">Tipe <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="text" name="type" id="type" class="form-control" placeholder="Tipe booth" value="{{$booth->type}}">
                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="is_buyable" class="col-md-2 form-label">Bisa disewa? <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="is_buyable" id="is_buyable" class="form-select">
                                        <option value="" hidden selected disabled>Pilih status bisa disewa</option>
                                        <option value="1" @if($booth->is_buyable) selected @endif>Bisa</option>
                                        <option value="0" @if(!$booth->is_buyable) selected @endif>Tidak</option>
                                    </select>
                                    @error('is_buyable')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="default_price">Harga Awal <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="text" name="default_price" id="default_price" class="form-control money-input" placeholder="Harga awal booth" value="{{$booth->default_price}}" required>
                                    @error('default_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="color">Label Warna <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="color" name="color" id="color" class="form-control" placeholder="Label warna booth" value="{{$booth->color}}">
                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="length_in_m" class="form-label col-md-2">Panjang (m) <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" step="0.01" id="length_in_m" name="length_in_m"
                                    placeholder="Panjang booth" value="{{$booth->length_in_m}}" required>
                                    @error('length_in_m')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="width_in_m col-md-2" class="form-label col-md-2">Lebar (m) <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" step="0.01" id="width_in_m" name="width_in_m"
                                    placeholder="Lebar booth" value="{{$booth->width_in_m}}" required>
                                    @error('width_in_m')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="height_in_m" class="form-label col-md-2">Tinggi (m) <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" step="0.01" id="height_in_m" name="height_in_m"
                                    placeholder="Tinggi booth" value="{{$booth->height_in_m}}"  required>
                                    @error('height_in_m')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="facilities" class="form-label col-md-2">Fasilitas Utama <small class="text-danger">*</small></label>
                               <div class="col-md-10">
                                    <textarea name="facilities" id="facilities" class="form-control" placeholder="Fasilitas Utama booth">{{$booth->facilities}}</textarea>
                                    @error('facilities')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                               </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="branding_facilities" class="form-label col-md-2">Fasilitas Branding <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <textarea name="branding_facilities" id="branding_facilities" class="form-control" placeholder="Fasilitas booth">{{$booth->branding_facilities}}</textarea>
                                    @error('branding_facilities')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="lo_count" class="form-label col-md-2">Jumlah LO (Liaison Officer) <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" id="lo_count" name="lo_count"
                                    placeholder="Jumlah LO" value="{{$booth->lo_count}}" required>
                                    @error('lo_count')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="lo_performance" class="form-label col-md-2">Performa LO (Liaison Officer) <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="lo_performance" id="lo_performance" class="form-select">
                                        <option value="good" @if($booth->lo_performance == 'good') selected @endif>Good</option>
                                        <option value="standard" @if($booth->lo_performance == 'standard') selected @endif>Standar</option>
                                    </select>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2" for="description">Deskripsi <small class="text-danger">*</small></label>
                                <div class="col-md-10 h-100">
                                    <textarea name="description" id="description" class="editor">{!!$booth->description!!}</textarea>
                                    {{-- <div class="editor" name="description" id="description-editor">{!!$booth->description!!}</div> --}}
                                    @error('description')
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
