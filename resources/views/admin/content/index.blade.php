@extends('template.admin')

@section('title')
    Konten
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
                    <h4 class="page-title mb-0">Daftar Konten</h4>
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
                                data-bs-target="#add-modal">Tambah Konten</button>
                        </div>
                        <div id="add-modal" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Tambah Konten</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="px-3" id="add-form" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Tipe <small class="text-danger">*</small></label>
                                                <select name="type" id="type" class="form-select" required>
                                                    <option selected hidden disabled>Pilih tipe</option>
                                                    <option value="article">Artikel</option>
                                                    <option value="faq">FAQ</option>
                                                    <option value="gallery">Galeri</option>
                                                </select>
                                                <small class="text-danger error" id="typeError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label" id="title-label">Judul <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="title" name="title"
                                                    placeholder="Judul Konten" required>
                                                <small class="text-danger error" id="titleError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label" id="description-label">Deskripsi <small class="text-danger">*</small></label>
                                                <textarea name="description" id="description-article" class="editor" placeholder="Deskripsi Konten"></textarea>
                                                <input type="text" name="description" id="description-faq" class="form-control" placeholder="Jawaban Pertanyaan" disabled hidden>
                                                <small class="text-danger error" id="descriptionError"></small>
                                            </div>
                                            <div class="mb-3" data-type="article">
                                                <label for="cover" class="form-label">Cover</label>
                                                <input type="file" name="cover" id="cover" class="form-control" accept="image/*" placeholder="File cover konten">
                                                <small class="text-danger error" id="coverError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_date" class="form-label">Status Aktif <small class="text-danger">*</small></label>
                                                <select name="is_active" id="is_active" class="form-select" required>
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Tidak aktif</option>
                                                </select>
                                                <small class="text-danger error" id="is_activeError"></small>
                                            </div>
                                            <div class="mb-3" data-type="article" id="link_video-container">
                                                <label for="video_link" class="form-label">Link Video</label>
                                                <div class="link-container row align-items-center mb-1">
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" id="video_link" name="video_link[]"
                                                               placeholder="Link video (opsional)">
                                                    </div>
                                                    <div class="col-md-2 text-start">
                                                        <button type="button" class="btn btn-block w-100 add-link-btn btn-success fw-bold">+</button>
                                                    </div>
                                                </div>
                                                <small class="text-danger error" id="video_linkError"></small>
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
                                    <th>Judul</th>
                                    <th>Tipe</th>
                                    <th>Status Aktif</th>
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
        function typeChange(value){
            if(value == 'article'){
                $('[data-type="article"]').show();
                $('[for="title"]').text('Judul');
                $('[for="description"]').text('Deskripsi');
                $('#title').attr('placeholder', 'Judul Konten');
                $('input, textarea').not('#description-article').parent().removeClass('d-none').attr('required', false);
                $('input, textarea').not('#description-faq').parent().removeClass('d-none').attr('required', true);
                $(`#description-faq`).attr('disabled', true).attr('hidden', true).attr('required', false);
                $('#description-article').attr('disabled', false).attr('hidden', false).attr('required', true);
                $('[role="application"]').removeClass('d-none');
                $('#link_video-container').show();
            } else if(value == 'faq') {
                $('[data-type="article"]').hide();
                $('[for="title"]').text('Pertanyaan');
                $('[for="description"]').text('Jawaban');
                $('#title').attr('placeholder', 'Pertanyaan');
                $('input, textarea').not('#description-faq').parent().addClass('d-none').attr('required', false);
                $('input, textarea').not('#description-article').parent().removeClass('d-none').attr('required', true);
                $(`#description-faq`).attr('disabled', false).attr('hidden', false).attr('required', true);
                $('#description-article').attr('disabled', true).attr('hidden', true).attr('required', false);
                $('[role="application"]').addClass('d-none');
                $('#link_video-container').hide();
            } else if(value == 'gallery'){
                $('[data-type="article"]').not('input[type="file"]').parent().show();
                $('[for="title"]').text('Judul');
                $('#title').attr('placeholder', 'Judul untuk Gambar');
                $('[for="cover"]').text('Gambar');
                $('input, textarea, #description-faq, #description-article')
                    .not('#cover, #title')
                    .parent()
                    .addClass('d-none')
                    .attr('required', false);
                $(`#description-faq`).attr('disabled', true).attr('hidden', true).attr('required', false);
                $('#description-article').attr('disabled', true).attr('hidden', true).attr('required', false);
                $('#link_video-container').hide();
            }
        }
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
                    url: "{{ route('content.fetch') }}",
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
                        "targets": 4,
                        "orderable": false
                    }
                ],
                language: {
                    emptyTable: "Tidak ada data konten tersimpan" // Text to display when no data is present
                }
            });

            var searchInput = $('[type="search"]');

            searchInput.off().on('input', debounce(function() {
                table.search(this.value).draw();
            }, 300));

            typeChange($('#type').val());

            $('#type').change(function() {
                const value = $(this).val();
                typeChange(value);
            });

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

            $('#add-form').on('submit', function(e) {
                e.preventDefault();
                $('.error').text(''); // Clear previous errors
                var submitButton = $(this).find(':submit');

                // Change button text to loading spinner
                submitButton.html('<div class="spinner-border text-light" role="status"></div>');

                // Disable the button
                submitButton.prop('disabled', true);

                let formData = new FormData($('#add-form')[0]);

                // Send AJAX request
                $.ajax({
                    url: "{{ route('content.store') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message);
                        submitButton.html('Simpan');
                        submitButton.prop('disabled', false);
                        $('#add-modal').modal('hide');
                        $('#type').val();
                        $('#add-form').trigger('reset');
                        $('.link-container-generated').remove();
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
                        url: "{{route('content.destroy', ':id')}}".replace(':id', id),
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
