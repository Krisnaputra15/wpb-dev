@extends('template.admin')

@section('title')
    Layout
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
                    <h4 class="page-title mb-0">Daftar Layout</h4>
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
                                data-bs-target="#add-modal">Tambah Layout</button>
                        </div>
                        <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Tambah Layout</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="px-3" id="add-form">
                                            <div class="mb-3 mt-3">
                                                <label for="username" class="form-label">Nama <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="name" name="name" required
                                                    placeholder="Nama Layout">
                                                <small class="text-danger error" id="nameError"></small>
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
                                    <th>Nama Layout</th>
                                    <th>Jumlah Booth Terdaftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                    url: "{{ route('layout.fetch') }}",
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
                        "targets": 3,
                        "orderable": false
                    }
                ],
                language: {
                    emptyTable: "Tidak ada data layout tersimpan"
                }
            });

            // $('[data-select-type="select2"]').each(function() {
            //     console.log($(this).data('placeholder'));
            //     $(`#${$(this).attr('id')}`).select2({
            //         placeholder: $(this).data('placeholder'),
            //         width: '100%'
            //     });
            // });

            var searchInput = $('[type="search"]');

            searchInput.off().on('input', debounce(function() {
                table.search(this.value).draw();
            }, 300));

            $('#add-form').on('submit', function(e) {
                e.preventDefault();
                $('.error').text(''); // Clear previous errors
                var submitButton = $(this).find(':submit');

                // Change button text to loading spinner
                submitButton.html('<div class="spinner-border text-light m-2" role="status"></div>');

                // Disable the button
                submitButton.prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: "{{ route('layout.store') }}",
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
        function showDeleteConfirmation(userId){
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data layout beserta booth di dalamnya tidak akan bisa dikembalikan!",
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
                        url: "{{route('layout.destroy', ':id')}}".replace(':id', userId),
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
