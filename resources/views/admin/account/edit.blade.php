@extends('template.admin')

@section('title')
    Akun
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
                    <h4 class="page-title mb-0">Ubah Akun</h4>
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
                        <form class="form-horizontal" method="POST" action="{{route('account.update', [$user->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="simpleinput">Nama Lengkap</label>
                                <div class="col-md-10">
                                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nama lengkap" value="{{$user->fullname}}">
                                    @error('fullname')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="simpleinput">Nomor Telepon</label>
                                <div class="col-md-10">
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Nomor Telepon" value="{{$user->phone_number}}">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="simpleinput">Role <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select class="form-select" name="role" id="role" data-select-type="select2" data-placeholder="Pilih role" required>
                                        <option
                                            value="administrator"
                                            @if ($user->role == 'administrator')
                                                selected
                                            @endif
                                        >Administrator</option>
                                        <option
                                            value="humas"
                                            @if ($user->role == 'humas')
                                                selected
                                            @endif
                                        >Humas</option>
                                        <option
                                            value="perwakilan-perusahaan"
                                            @if ($user->role == 'perwakilan-perusahaan')
                                                selected
                                            @endif
                                        >Perwakilan Perusahaan</option>
                                    </select>
                                    @error('role')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="example-email">Username <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{$user->username}}" required>
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="example-password">Password</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongi jika tidak ingin memperbarui password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="example-placeholder">Status Aktif <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="is_active" id="is_active" class="form-select" required>
                                        <option
                                            value="1"
                                            @if ($user->is_active)
                                                selected
                                            @endif
                                        >Aktif</option>
                                        <option
                                            value="0"
                                            @if (!$user->is_active)
                                                selected
                                            @endif
                                        >Tidak aktif</option>
                                    </select>
                                    @error('is_active')
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

@push('script')
    <!-- third party js for datatables -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables js -->
    <script src="{{ asset('admin/js/pages/datatables.js') }}"></script>
@endpush
