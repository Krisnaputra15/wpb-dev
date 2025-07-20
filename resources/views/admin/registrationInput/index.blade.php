@extends('template.admin')

@section('title')
    Input Registrasi Perusahaan
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
                    <h4 class="page-title mb-0">Daftar Input Formulir Data Perusahaan</h4>
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
                        <div class="d-flex flex-row-reverse mb-4 gap-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add-modal">Tambah Input</button>
                        </div>
                        <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Tambah Input</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="px-3" id="add-form">
                                            <div class="mb-3">
                                                <label for="column_name" class="form-label">Nama Kolom <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="column_name" name="column_name"
                                                    placeholder="Masukkan label terlebih dahulu untuk generate nama kolom" readonly required>
                                                <small class="text-danger error" id="column_nameError"></small>
                                            </div>
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" role="switch" id="custom_column_name">
                                                <label class="form-check-label" for="custom_column_name">Nama Kolom Kustom</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="column_label" class="form-label">Label Kolom <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="column_label" name="column_label"
                                                    placeholder="Label Kolom" required>
                                                <small class="text-danger error" id="column_labelError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="column_type" class="form-label">Tipe Kolom <small class="text-danger">*</small></label>
                                                <select class="form-select" name="column_type" id="column_type" aria-label="Default select example" required>
                                                    <option selected hidden disabled>Tipe Kolom</option>
                                                    <option value="text">Text</option>
                                                    <option value="long_text">Long text</option>
                                                    <option value="number">Number</option>
                                                    <option value="select">Select</option>
                                                    <option value="multiple_select">Multiple select</option>
                                                </select>
                                                <small class="text-danger error" id="column_typeError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="is_nullable" class="form-label">Wajib Diisi</label>
                                                <select class="form-select" name="is_nullable" id="is_nullable" aria-label="Default select example" required>
                                                    <option selected hidden disabled>Pilih salah satu</option>
                                                    <option value="0">Wajib</option>
                                                    <option value="1">Tidak wajib</option>
                                                </select>
                                                <small class="text-danger error" id="is_nullableError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="default_value" class="form-label">Isian Default</label>
                                                <input class="form-control" type="text" id="default_value" name="default_value"
                                                    placeholder="Isian default jika input kosong (biarkan kosong jika tidak ada isian default)">
                                                <small class="text-danger error" id="default_valueError"></small>
                                            </div>
                                            <div class="mb-3 d-none" id="select_value-container">
                                                <div class="d-flex flex-column mb-1">
                                                    <label for="list_value" class="form-label">List Pilihan Input</label>
                                                    <small>* pisahkan tiap jawaban dengan tanda ; (eg: Jawaban 1; Jawaban 2).</small>
                                                </div>
                                                <textarea name="list_value" id="list_value" class="form-control" placeholder="Daftar pilihan jawaban untuk input jenis select dan multiple select"></textarea>
                                                <small class="text-danger error" id="list_valueError"></small>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>

                                        </form>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kolom</th>
                                    <th>Label Kolom</th>
                                    <th>Tipe Kolom</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>

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

    <script>
        $(document).ready(function() {
            $('#alternative-page-datatable').DataTable().destroy();
            var table = $('#alternative-page-datatable').DataTable({
                pageLength: 100,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ],
                paging: true,
                autoWidth: true,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                order: [
                    [1, "desc"]
                ],
                ajax: {
                    url: "{{ route('registrationInput.fetch') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataSrc: function(json){
                        console.log(json);
                        return json && json.data && json.data.length > 0 ? json.data : [];
                    }
                },
                columnDefs: [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        "targets": 4,
                        "orderable": false
                    }
                ],
                language: {
                    emptyTable: "Tidak ada data input tersimpan"
                }
            });

            var searchInput = $('[type="search"]');

            searchInput.off().on('input', debounce(function() {
                table.search(this.value).draw();
            }, 300));

            $('#column_name').on('input', debounce(function() {
                $(this).val($(this).val().toLowerCase().replace(/\s+/g, '_'));
            }, 300));

            $('#custom_column_name').change(function() {
                if($(this).is(':checked')){
                    $('#column_name').attr('readonly', false);
                } else {
                    $('#column_name').attr('readonly', true);
                }
            })

            $('#column_label').on('input', debounce(function() {
                const nameValue = $(this).val().toLowerCase().replace(/\s+/g, '_');
                console.log(nameValue);
                $('#column_name').val(nameValue);
            }, 300));

            $('#column_type').change(function() {
                const selectContainer = $('#select_value-container');
                if($(this).val() == 'select' || $(this).val() == 'multiple_select'){
                    selectContainer.removeClass('d-none');
                } else {
                    selectContainer.addClass('d-none');
                    selectContainer.find('#list_value').val('');
                }
            });

            $('#add-form').on('submit', function(e) {
                e.preventDefault();
                // $('.editor').each(function() {
                //     const formId = $(this).attr('id').split('-')[0];
                //     $(`#${formId}`).val($(this).find('.ql-editor').html());
                // });
                $('.error').text(''); // Clear previous errors
                var submitButton = $(this).find(':submit');

                // Change button text to loading spinner
                submitButton.html('<div class="spinner-border text-light" role="status"></div>');

                // Disable the button
                submitButton.prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: "{{ route('registrationInput.store') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(response.message);
                        submitButton.html('Simpan');
                        submitButton.prop('disabled', false);
                        $('#add-form').trigger('reset');
                        $('#add-modal').modal('hide');
                        table.draw();
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            var errors = error.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + 'Error').text(value[0]); // Show validation error
                            });
                        } else {
                            toastr.error('Terjadi kesalahan pada server'); // Show error message
                        }
                        submitButton.html('Simpan'); // Restore button text on error
                        submitButton.prop('disabled', false); // Enable button on error
                    }
                });
            });
        });

        function showDeleteConfirmation(id){
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data di tiap perusahaan untuk kolom ini akan hilang dan tidak akan bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Loading',
                        text: 'Data sedang diproses',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{route('registrationInput.destroy', ':id')}}".replace(':id', id),
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.close();
                            toastr.success(response.message);
                            $('#alternative-page-datatable').DataTable().draw();
                        },
                        error: function(error) {
                            Swal.close();
                            toastr.error('Terjadi kesalahan pada server');
                        }
                    })
                }
            });
        }
    </script>
@endpush
