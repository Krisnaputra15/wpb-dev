@extends('template.admin')

@section('title')
    Booth
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
                    <h4 class="page-title mb-0">Ubah Input Formulir Data Perusahaan</h4>
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
                        <form class="form-horizontal" id="update-form" method="POST" action="{{route('registrationInput.update', [$input->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="column_name" class="form-label col-md-2">Nama Kolom <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="column_name" name="column_name"
                                    placeholder="Masukkan label terlebih dahulu untuk generate nama kolom" value="{{$input->column_name}}" readonly required>
                                    @error('column_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="column_label" class="form-label col-md-2">Label Kolom <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="column_label" name="column_label"
                                    placeholder="Label Kolom" value="{{$input->column_label}}" required>
                                    @error('column_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="column_type" class="form-label col-md-2">Tipe Kolom <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input type="hidden" name="column_type" value="{{$input->column_type}}">
                                    <select class="form-select" name="column_type" id="column_type" aria-label="Default select example" required disabled>
                                        <option value="text"
                                            @if($input->column_type == "text")
                                                selected
                                            @endif
                                        >Text</option>
                                        <option value="long_text"
                                            @if($input->column_type == "long_text")
                                                selected
                                            @endif
                                        >Long text</option>
                                        <option value="number"
                                            @if($input->column_type == "number")
                                                selected
                                            @endif
                                        >Number</option>
                                        <option value="select"
                                            @if($input->column_type == "select")
                                                selected
                                            @endif
                                        >Select</option>
                                        <option value="multiple_select"
                                            @if($input->column_type == "multiple_select")
                                                selected
                                            @endif
                                        >Multiple select</option>
                                    </select>
                                    @error('column_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="is_nullable" class="form-label col-md-2">Wajib Diisi</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="is_nullable" id="is_nullable" aria-label="Default select example" required>
                                        <option selected hidden disabled>Pilih salah satu</option>
                                        <option value="0"
                                            @if($input->is_nullable == 0)
                                                selected
                                            @endif
                                        >Wajib</option>
                                        <option value="1"
                                            @if($input->is_nullable == 1)
                                                selected
                                            @endif
                                        >Tidak wajib</option>
                                    </select>
                                    @error('is_nullable')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="default_value" class="form-label col-md-2">Isian Default</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="default_value" name="default_value"
                                    placeholder="Isian default jika input kosong (biarkan kosong jika tidak ada isian default)"
                                    value="{{$input->default_value}}">
                                    @error('default_value')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row d-none" id="select_value-container">
                                <label for="list_value" class="form-label col-md-2">List Pilihan Input</label>
                                <div class="col-md-10">
                                    <small>* pisahkan tiap jawaban dengan tanda ; (eg: Jawaban 1; Jawaban 2).</small>
                                    <textarea name="list_value" id="list_value" class="form-control" placeholder="Daftar pilihan jawaban untuk input jenis select dan multiple select">{{ $input->list_value }}</textarea>
                                    @error('list_value')
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
            let initialColumnType = $('#column_type').val();
            const selectContainer = $('#select_value-container');
            if(initialColumnType == 'select' || initialColumnType == 'multiple_select'){
                selectContainer.removeClass('d-none');
            } else {
                selectContainer.addClass('d-none');
                selectContainer.find('#list_value').val('');
            }

            $('#column_type').change(function() {
                if($(this).val() == 'select' || $(this).val() == 'multiple_select'){
                    selectContainer.removeClass('d-none');
                } else {
                    selectContainer.addClass('d-none');
                    selectContainer.find('#list_value').val('');
                }
            });
        })
    </script>
@endpush
