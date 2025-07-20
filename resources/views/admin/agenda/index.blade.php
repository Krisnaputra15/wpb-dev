@extends('template.admin')

@section('title')
    Agenda
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
                    <h4 class="page-title mb-0">Daftar Agenda</h4>
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
                                data-bs-target="#add-modal">Tambah Agenda</button>
                        </div>
                        <div id="add-modal" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Tambah Agenda</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="px-3" id="add-form" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    placeholder="Nama agenda" required>
                                                <small class="text-danger error" id="nameError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Deskripsi <small class="text-danger">*</small></label>
                                                <textarea name="description" id="description" class="editor" placeholder="Deskripsi agenda"></textarea>
                                                <small class="text-danger error" id="descriptionError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Lokasi <small class="text-danger">*</small></label>
                                                <input class="form-control" type="text" id="location" name="location"
                                                    placeholder="Lokasi Agenda" required>
                                                <small class="text-danger error" id="locationError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cover" class="form-label">Cover</label>
                                                <input type="file" name="cover" id="cover" class="form-control" accept="image/*" placeholder="File cover agenda">
                                                <small class="text-danger error" id="coverError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_date" class="form-label">Tanggal Mulai <small class="text-danger">*</small></label>
                                                <input class="form-control" type="date" id="start_date" name="start_date"
                                                    placeholder="Tanggal mulai agenda" required>
                                                <small class="text-danger error" id="colorError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_date" class="form-label">Tanggal Berakhir <small class="text-danger">*</small></label>
                                                <input class="form-control" type="date" id="end_date" name="end_date"
                                                    placeholder="Tanggal berakhir agenda" required>
                                                <small class="text-danger error" id="colorError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="is_active" class="form-label">Status Aktif <small class="text-danger">*</small></label>
                                                <select name="is_active" id="is_active" class="form-select" required>
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Tidak aktif</option>
                                                </select>
                                                <small class="text-danger error" id="is_activeError"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="layout_id" class="form-label">Layout Dipakai</label>
                                                <select name="layout_id" id="layout_id" class="form-select">
                                                    <option selected hidden disabled>Pilih layout</option>
                                                    @foreach ($layouts as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-success mt-2" id="show-layout">Tampilkan layout</button>
                                                <small class="text-danger error" id="layout_idError"></small>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>

                                        </form>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div id="layout-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 90%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Preview Layout</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mx-auto mb-3 col-9">
                                            <div class="mb-2" id="booth-container">
                                                <div class="d-flex justify-content-center booth-loading">
                                                    <div class="spinner-border booth-loading" role="status"></div>
                                                </div>
                                                <div id="booths" class="d-flex justify-content-center">
                                                    <img src="{{asset('images/master/layoutBg.png')}}" class="responsive-img" style="margin-top: 5.4rem;" alt="" width="550" height="730">
                                                    <div class="centered-element">

                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="mt-5">Legenda</h4>
                                            <div class="w-100 px-2 py-1 row row-cols-5 mt-3" id="booth-legend">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
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
        function getRowColFromId(id) {
            const [row, col] = id.split('_').map(Number);
            return {
                row,
                col
            };
        }

        function fetchBoothLayout(layoutId){
            $('.centered-element').html('');
            $('#booth-legend').html('');
            $('#booths').hide();
            $.ajax({
                url: "{{route('layout.booth.boothMapping', ':id')}}".replace(':id', layoutId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'isTransaction': 0
                },
                success: function(response) {
                    baseLayout = '';
                    for(var i = 0; i <= 33; i++){
                        baseLayout += `<div class="d-flex flex-row justify-content-center mx-auto">`;
                        for(var j = 0; j <= 33; j++){
                            baseLayout += `<div class="booth-cell booth-selection d-flex justify-content-center align-items-center booth-padding" id="${i+1}_${j+1}" data-booth=""></div>`;
                        }
                        baseLayout += `</div>`;
                    }
                    $('.centered-element').html(baseLayout);

                    boothLegends = '';
                    response.additional_data.boothColors.forEach(function(color){
                        boothLegends += `<div class="col d-flex gap-2 m-0">
                                                    <div class="color-legenda my-auto" style="background-color:${color.color};"></div>
                                                    <p class="my-auto">Booth ${color.type}</p>
                                                </div>`;
                    })
                    $('#booth-legend').html(boothLegends);

                    $('.booth-cell').html('').removeAttr('style').removeClass(
                        'merge-cell border-top border-bottom border-start border-end');

                    response.data.forEach(booth => {
                        const positions = JSON.parse(booth.positions);
                        const parsedPositions = positions.map(getRowColFromId);
                        const positionIds = parsedPositions.map(p => `${p.row}_${p.col}`);

                        const rows = parsedPositions.map(p => p.row);
                        const cols = parsedPositions.map(p => p.col);
                        const minRow = Math.min(...rows);
                        const minCol = Math.min(...cols);
                        const centerRow = Math.floor((Math.min(...rows) + Math.max(...rows)) / 2);
                        const centerCol = Math.floor((Math.min(...cols) + Math.max(...cols)) / 2);
                        let labelCellId = `${centerRow}_${centerCol}`;

                        const boothLabel = booth.type + (booth.need_label ? booth.label : '');

                        if (!positionIds.includes(labelCellId)) {
                            labelCellId = `${minRow}_${minCol}`;
                        }

                        // Apply background and edge borders
                        positionIds.forEach(posId => {
                            const $cell = $(`#${posId}`);
                            if (!$cell.length) return;

                            $cell.removeClass('bg-secondary')
                                .addClass('merge-cell')
                                .attr('data-booth', booth.id)
                                .attr('style', `background-color:${booth.color} !important`);

                            // Tambahkan border hanya di sisi luar
                            const [i, j] = posId.split('_').map(Number);
                            const isTop = !positionIds.includes(`${i - 1}_${j}`);
                            const isBottom = !positionIds.includes(`${i + 1}_${j}`);
                            const isLeft = !positionIds.includes(`${i}_${j - 1}`);
                            const isRight = !positionIds.includes(`${i}_${j + 1}`);

                            $cell.removeClass('border');
                            if (isTop) $cell.addClass('border-black').addClass('border-top');
                            if (isBottom) $cell.addClass('border-black').addClass('border-bottom');
                            if (isLeft) $cell.addClass('border-black').addClass('border-start');
                            if (isRight) $cell.addClass('border-black').addClass('border-end');
                        });

                        // Masukkan label hanya di cell pojok kiri atas
                        $(`#${labelCellId}`).html(
                            ` <div class="label-wrapper">
                            <p class="label ${isHexColorLight(booth.color) ? 'text-dark' : 'text-light'} fw-semibold text-center my-auto">${boothLabel}</p>
                        </div>`
                        );
                    });

                    $('.booth-loading').hide();
                    $('#booths').show();
                },
                error: function(error) {
                    Swal.close();
                    toastr.error("Terjadi kesalahan pada server");
                    $('.booth-loading').hide()
                    $('#layout-modal').modal('hide');
                }
            })
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
                    url: "{{ route('agenda.fetch') }}",
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
                    emptyTable: "Tidak ada data agenda tersimpan" // Text to display when no data is present
                }
            });

            var searchInput = $('[type="search"]');

            searchInput.off().on('input', debounce(function() {
                table.search(this.value).draw();
            }, 300));

            let choosenLayout = '';
            let currentLayoutValue = $('#layout_id').val();
            if(currentLayoutValue == '' || currentLayoutValue == null){
                $('#show-layout').hide();
            } else {
                $('#show-layout').show();
            }

            $('#layout_id').change(function() {
                $('#show-layout').show();
            })

            $('#show-layout').click(function() {
                $('#layout-modal').modal('show');
                console.log(choosenLayout == $('#layout_id').val());
                if(choosenLayout !== $('#layout_id').val()){
                    choosenLayout = $('#layout_id').val();
                    $('.booth-loading').show();
                    fetchBoothLayout(choosenLayout);
                }
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
                    url: "{{ route('agenda.store') }}",
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
                        url: "{{route('agenda.destroy', ':id')}}".replace(':id', id),
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
