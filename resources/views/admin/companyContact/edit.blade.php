@extends('template.admin')

@section('title')
    Kontak Perusahaan
@endsection

@push('style')
    <link href="{{ asset('admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Ubah Kontak Perusahaan</h4>
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
                        <form class="form-horizontal" method="POST" action="{{route('companyContact.update', [$contact->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label" for="simpleinput">Nama <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama Perusahaan" value="{{$contact->name}}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label" for="simpleinput">Email <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Perusahaan" value="{{$contact->email}}" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label" for="simpleinput">Nomor Telepon / WA <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Nama Perusahaan" value="{{$contact->phone_number}}"  required>
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="my-3 text-center">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>

                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection
