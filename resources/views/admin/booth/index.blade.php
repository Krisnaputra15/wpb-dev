@extends('template.admin')

@section('title')
    Jenis Booth
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
                    <h4 class="page-title mb-0">Daftar Jenis Booth</h4>
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
                        <div class="d-flex flex-row-reverse mb-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add-modal">Tambah Jenis Booth</button>
                        </div>
                        <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Tambah Jenis Booth</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="px-3" id="add-form">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    placeholder="Nama booth" required>
                                                <small class="text-danger error" id="nameError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Tipe <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="type" name="type"
                                                    placeholder="Tipe booth" required>
                                                <small class="text-danger error" id="typeError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="is_buyable" class="form-label">Bisa disewa? <small class="text-danger">*</small></label>
                                                <select name="is_buyable" id="is_buyable" class="form-select">
                                                    <option value="" hidden selected disabled>Pilih status bisa disewa</option>
                                                    <option value="1">Bisa</option>
                                                    <option value="0">Tidak</option>
                                                </select>
                                                <small class="text-danger error" id="is_buyableError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="default_price" class="form-label">Harga Awal <small class="text-danger">*</small></label>
                                                <input type="text" name="default_price" id="default_price" min="0" placeholder="Harga awal booth" class="form-control money-input" required>
                                                <small class="text-danger error" id="default_priceError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="color" class="form-label">Label Warna <small class="text-danger">*</small></label>
                                                <input class="form-control" type="color" id="color" name="color"
                                                    placeholder="Label warna booth" required>
                                                <small class="text-danger error" id="colorError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="length_in_m" class="form-label">Panjang (m) <small class="text-danger">*</small></label>
                                                <input class="form-control" type="number" step="0.01" id="length_in_m" name="length_in_m"
                                                    placeholder="Panjang booth" required>
                                                <small class="text-danger error" id="length_in_mError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="width_in_m" class="form-label">Lebar (m) <small class="text-danger">*</small></label>
                                                <input class="form-control" type="number" step="0.01" id="width_in_m" name="width_in_m"
                                                    placeholder="Lebar booth" required>
                                                <small class="text-danger error" id="width_in_mError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="height_in_m" class="form-label">Tinggi (m) <small class="text-danger">*</small></label>
                                                <input class="form-control" type="number" step="0.01" id="height_in_m" name="height_in_m"
                                                    placeholder="Tinggi booth" required>
                                                <small class="text-danger error" id="height_in_mError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="facilities" class="form-label">Fasilitas Utama <small class="text-danger">*</small></label>
                                                <textarea name="facilities" id="facilities" class="form-control" placeholder="Fasilitas Utama booth"></textarea>
                                                <small class="text-danger error" id="facilitiesError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="branding_facilities" class="form-label">Fasilitas Branding <small class="text-danger">*</small></label>
                                                <textarea name="branding_facilities" id="branding_facilities" class="form-control" placeholder="Fasilitas booth"></textarea>
                                                <small class="text-danger error" id="branding_facilitiesError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lo_count" class="form-label">Jumlah LO (Liaison Officer) <small class="text-danger">*</small></label>
                                                <input class="form-control" type="number" id="lo_count" name="lo_count"
                                                    placeholder="Jumlah LO" required>
                                                <small class="text-danger error" id="lo_countError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lo_performance" class="form-label">Performa LO (Liaison Officer) <small class="text-danger">*</small></label>
                                                <select name="lo_performance" id="lo_performance" class="form-select">
                                                    <option value="" hidden selected disabled>Pilih performa LO</option>
                                                    <option value="good">Good</option>
                                                    <option value="standard">Standar</option>
                                                </select>
                                                <small class="text-danger error" id="lo_performanceError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="description">Deskripsi <small class="text-danger">*</small></label>
                                                <textarea name="description" id="description" class="editor"></textarea>
                                                <small class="text-danger error" id="lo_countError"></small>
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
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                    <th>Warna</th>
                                    <th>Harga Awal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>

                        <div id="description-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Deskripsi Booth</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

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
                    url: "{{ route('booth.fetch') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataSrc: function(json){
                        return json && json.data && json.data.length > 0 ? json.data : [];
                    }
                },
                columnDefs: [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        "targets": 5,
                        "orderable": false
                    }
                ],
                language: {
                    emptyTable: "Tidak ada data jenis booth tersimpan" // Text to display when no data is present
                }
            });

            var searchInput = $('[type="search"]');

            searchInput.off().on('input', debounce(function() {
                table.search(this.value).draw();
            }, 300));

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
                    url: "{{ route('booth.store') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(response.message);
                        submitButton.html('Simpan');
                        submitButton.prop('disabled', false);
                        // $('.editor').each(function() {
                        //     const formId = $(this).attr('id');
                        //     const placeholder = $(this).attr('placeholder');
                        //     $(`#${formId}`).val('');
                        //     $(this).html(`<p>${placeholder}</p>`); // Reset editor content and placeholder
                        // });
                        $('#add-modal').modal('hide');
                        $('#add-form').trigger('reset');
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
        function showDescription(boothId){
            const descriptionModal = $('#description-modal');
            const descriptionButton = $(`#descriptionButton-${boothId}`);
            descriptionButton.html('<div class="spinner-border text-light" role="status"></div>');
            $.ajax({
                url: "{{ route('booth.getBoothDescription', ':id') }}".replace(':id',boothId),
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    descriptionModal.find('.modal-body').html(response.data);
                    descriptionModal.modal('show');
                    descriptionButton.html('Lihat Deskripsi');
                },
                error: function(error) {
                    if(error.status == 404){
                        toastr.error(error.data.message);
                    } else {
                        toastr.error('Terjadi kesalahan pada server');
                    }
                    descriptionButton.html('Lihat Deskripsi');
                }
            });
        }

        function showDeleteConfirmation(id){
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data tidak akan bisa dikembalikan!",
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
                        url: "{{route('booth.destroy', ':id')}}".replace(':id', id),
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
