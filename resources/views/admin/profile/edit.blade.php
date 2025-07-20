@extends('template.admin')

@section('title')
    Profil
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
                    <h4 class="page-title mb-0">Detail Profil</h4>
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
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active show mb-1" id="v-pills-home-tab2" data-bs-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account"
                                        aria-selected="true">
                                        Data Akun</a>
                                    @if (auth()->user()->role == 'perwakilan-perusahaan' || $readOnly)
                                    <a class="nav-link mb-1" id="v-pills-profile-tab2" data-bs-toggle="pill" href="#v-pills-company" role="tab" aria-controls="v-pills-company"
                                        aria-selected="false">
                                        Data Perusahaan</a>
                                    <a class="nav-link mb-1" id="v-pills-profile-tab3" data-bs-toggle="pill" href="#v-pills-promotion" role="tab" aria-controls="v-pills-promotion"
                                        aria-selected="false">
                                        Data Promosi</a>
                                    @endif
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-9">
                                <form method="POST" id="edit-form" @if(!$readOnly) action="{{route('profile.update')}}" @endif enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="id" value="{{$user->id}}" hidden>
                                    <div class="tab-content pt-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade active show" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-home-tab2">
                                            <h4 class="mb-3 w-100 border-bottom border-secondary py-3">Data Akun</h4>
                                            <div class="mb-3">
                                                <label class="form-label" for="simpleinput">Nama Lengkap</label>
                                                <div>
                                                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nama lengkap" value="{{$user->fullname ?? old('fullname')}}" @if($readOnly) readonly @endif>
                                                    @error('fullname')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="simpleinput">Nomor Telepon</label>
                                                <div>
                                                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Nomor Telepon" value="{{$user->phone_number ?? old('phone_number')}}" @if($readOnly) readonly @endif>
                                                    @error('phone_number')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="simpleinput">Role <small class="text-danger">*</small></label>
                                                <div>
                                                    <select class="form-select" name="role" id="role" data-select-type="select2" data-placeholder="Pilih role" required readonly>
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
                                            <div class="mb-3">
                                                <label class="form-label" for="example-email">Username <small class="text-danger">*</small></label>
                                                <div>
                                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{$user->username ?? old('username')}}" required @if($readOnly) readonly @endif>
                                                    @error('username')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if(!$readOnly)
                                                <div class="mb-3">
                                                    <label class="form-label" for="example-password">Password</label>
                                                    <div>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongi jika tidak ingin memperbarui password">
                                                        @error('password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="example-password">Konfirmasi Password</label>
                                                    <div>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Kosongi jika tidak ingin memperbarui password">
                                                        @error('password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label class="form-label" for="example-placeholder">Status Aktif <small class="text-danger">*</small></label>
                                                <div>
                                                    <select name="is_active" id="is_active" class="form-select" required @if($readOnly) readonly @endif>
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
                                        </div>
                                        @if (auth()->user()->role == 'perwakilan-perusahaan' || $readOnly)
                                            <div class="tab-pane fade" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-profile-tab2">
                                                <h4 class="mb-3 w-100 border-bottom border-secondary py-3">Data Perusahaan</h4>
                                                <div class="mb-3">
                                                    <label for="companies-name" class="form-label">Nama Perusahaan</label>
                                                    <input class="form-control" type="text" id="companies-name" name="companies-name"
                                                            placeholder="Nama perusahaan" value="{{ $user->name ?? old('companies-name') }}" required  @if($readOnly) readonly @endif>
                                                </div>
                                                @foreach ($companyInputs as $input)
                                                    <div class="mb-3">
                                                        <label for="{{'companies-'.$input->column_name}}" class="form-label">{{$input->column_label}}</label>
                                                        @if($input->column_type == 'text')
                                                            <input class="form-control" type="text" id="{{'companies-'.$input->column_name}}" name="{{'companies-'.$input->column_name}}"
                                                            placeholder="{{$input->column_label}}" value="{{ $user->{$input->column_name} ?? old('companies'.$input->column_name) }}" @if(!$input->is_nullable) required @endif @if($readOnly) readonly @endif>
                                                        @endif
                                                        @if($input->column_type == 'long_text')
                                                            <textarea name="{{'companies-'.$input->column_name}}" id="{{'companies-'.$input->column_name}}" class="form-control" placeholder="{{$input->column_label}}" @if(!$input->is_nullable) required @endif @if($readOnly) readonly @endif>{{ $user->{$input->column_name} ?? old('companies'.$input->column_name)}}</textarea>
                                                        @endif
                                                        @if($input->column_type == 'number')
                                                            <input class="form-control" type="number" id="{{'companies-'.$input->column_name}}" name="{{'companies-'.$input->column_name}}"
                                                            placeholder="{{$input->column_label}}" value="{{ $user->{$input->column_name} ?? old('companies'.$input->column_name) }}" @if(!$input->is_nullable) required @endif @if($readOnly) readonly @endif>
                                                        @endif
                                                        @if($input->column_type == 'select')
                                                            <select name="{{'companies-'.$input->column_name}}" id="{{'companies-'.$input->column_name}}" class="form-select" @if(!$input->is_nullable) required @endif @if($readOnly) readonly @endif>
                                                                @php
                                                                    $options = explode(';', $input->list_value)
                                                                @endphp
                                                                @foreach ($options as $option)
                                                                    <option value="{{$option}}"
                                                                        @if($user->{$input->column_name} == $option) selected @endif
                                                                    >{{ucwords($option)}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        @if($input->column_type =='multiple_select')
                                                            <select name="{{'companies-'.$input->column_name}}" id="{{'companies-'.$input->column_name}}" class="form-select" @if(!$input->is_nullable) required @endif @if($readOnly) readonly @endif>
                                                                @php
                                                                    $options = explode(';', $input->list_value)
                                                                @endphp
                                                                @foreach ($options as $option)
                                                                    <option value="{{$option}}"
                                                                        @if($user->{$input->column_name} == $option) selected @endif
                                                                    >{{ucwords($option)}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        @error('companies-'.$input->column_name)
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-promotion" role="tabpanel" aria-labelledby="v-pills-promotion">
                                                <h4 class="mb-3 w-100 border-bottom border-secondary py-3">Data Promosi Perusahaan</h4>
                                                <div class="mb-3" data-type="article">
                                                    <label for="companies-logo" class="form-label">Logo Perusahaan</label>
                                                    <div>
                                                        <img src="{{asset('storage/'. $user->logo)}}" id="old-companies-logo" alt="logo perusahaan" class="img-fluid mb-2 {{$user->logo == null ? 'd-none' : ''}}" style="width: 35% !important">
                                                        <input type="file" name="companies-logo" id="companies-logo" class="form-control" accept="image/*" value="{{$user->logo ?? old('companies-logo')}}" placeholder="File logo perusahaan" required @if($readOnly) readonly @endif>
                                                        @error('companies-logo')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex flex-column gap-2">
                                                    <label class="form-label m-0" for="companies-job_vacancies_link">Link GDrive Informasi Lowongan Kerja</label>
                                                    @if($user->job_vacancies_link != null)
                                                        <a href="{{$user->job_vacancies_link}}" class="text-primary" target="_blank"><i class="fa-solid fa-link me-2"></i>Cek link GDrive</a>
                                                    @endif
                                                    <div>
                                                        <input type="text" name="companies-job_vacancies_link" id="companies-job_vacancies_link" class="form-control" placeholder="Link GDrive Informasi Lowongan Kerja" value="{{$user->job_vacancies_link ?? old('job_vacancies_link')}}" required @if($readOnly) readonly @endif>
                                                        <small class="text-danger error" id="companies-job_vacancies_linkError"></small>
                                                        @error('companies-job_vacancies_link')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @csrf
                                    @method('PUT')

                                    @if(!$readOnly)
                                        <div class="my-3 text-center">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    @endif

                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#role').prop('disabled', true);

            $('#edit-form').on('submit', function(e) {
                Swal.fire({
                    title: 'Loading',
                    text: 'Data sedang diproses',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                e.preventDefault();

                $('#role').prop('disabled', false);
                this.submit();
            });

            $('#companies-logo').on('change', function() {
                var file = $(this).get(0).files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#old-companies-logo').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                $('#old-companies-logo').removeClass('d-none');
            });
            $('#companies-job_vacancies_link').on('input', debounce(function() {
                const driveLink = $(this).val();
                const driveRegex = /^https:\/\/drive\.google\.com\/.+$/;
                if (driveRegex.test(driveLink)) {
                    $('#companies-job_vacancies_linkError').hide();
                } else {
                    $('#companies-job_vacancies_linkError').text('Link Google Drive Tidak Valid (eg: https://drive.google.com)').show();
                }
            }, 500));
        });
    </script>
@endpush
