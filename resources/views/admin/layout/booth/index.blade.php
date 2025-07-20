@extends('template.admin')

@section('title')
    Daftar Booth
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
                    <h4 class="page-title mb-0">Daftar Booth di {{ $layout->name }}</h4>
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
            <div class="d-flex flex-row justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-4" id="button-container">
                                <button type="button" class="btn btn-primary" id="add-button">Tambah Booth</button>
                                <button type="button" class="btn btn-secondary ms-2 d-none"
                                    id="back-to-form-button">Kembali ke form</button>
                            </div>
                            <div class="mx-auto mb-3">
                                <div class="mb-2" id="booth-container">
                                    <img src="{{ asset('images/master/layoutBg.png') }}" class="responsive-img"
                                        alt="" width="550" height="730">
                                    <div class="centered-element">
                                        @for ($i = 1; $i <= 33; $i++)
                                            <div class="d-flex flex-row justify-content-center mx-auto">
                                                @for ($j = 1; $j <= 33; $j++)
                                                    <div class="booth-cell booth-selection d-flex justify-content-center align-items-center booth-padding bg-secondary border border-black"
                                                        id="{{ $i . '_' . $j }}" data-booth="">
                                                    </div>
                                                @endfor
                                            </div>
                                        @endfor
                                        {{-- @for ($i = 1; $i <= 33; $i++)
                                            @for ($j = 1; $j <= 33; $j++)
                                                <div class="booth-cell bg-secondary border border-black"
                                                    id="{{ $i . '_' . $j }}" data-booth="">
                                                </div>
                                            @endfor
                                        @endfor --}}
                                    </div>
                                </div>
                                <div class="w-100 px-2 py-1 row row-cols-5 mt-3">
                                    <div class="col d-flex gap-2 m-0">
                                        <div class="color-legenda bg-secondary my-auto"></div>
                                        <p class="my-auto">Kosong</p>
                                    </div>
                                    <div class="col d-flex gap-2 m-0">
                                        <div class="color-legenda bg-success my-auto"></div>
                                        <p class="my-auto">Dipilih</p>
                                    </div>
                                    @foreach ($boothColors as $booth)
                                        <div class="col d-flex gap-2 m-0">
                                            <div class="color-legenda my-auto"
                                                style="background-color: {{ $booth->color }} !important"></div>
                                            <p class="my-auto">Booth {{ $booth->type }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tipe Booth</th>
                                    <th>Label</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="add-form-container">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="page-title mb-0" id="form-title">Tambah Booth</h4>
                        <form id="add-form" data-mode="add" enctype="multipart/form-data">
                            <small>* silakan klik petak yang tersedia pada pemetaan</small>
                            <div class="form-check mt-3 mb-3">
                                <input class="form-check-input" type="checkbox" id="need_label" name="need_label" checked>
                                <label class="form-check-label">Memakai Label</label>
                            </div>
                            <div class="mb-3" id="label-container">
                                <label for="label" class="form-label">Label <small class="text-danger">*</small></label>
                                <input class="form-control" type="text" id="label" name="label" required
                                    placeholder="Label penomoran booth">
                                <small class="text-danger error" id="labelError"></small>
                            </div>
                            <div class="mb-3">
                                <label for="booth_id" class="form-label">Tipe Booth <small
                                        class="text-danger">*</small></label>
                                <select name="booth_id" id="booth_id" class="form-select" required>
                                    <option selected disabled hidden>Pilih tipe booth</option>
                                    @foreach ($boothColors as $booth)
                                        <option value="{{ $booth->id }}" data-color="{{ $booth->color }}">
                                            Booth {{ $booth->type }} ({{ $booth->name }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger error" id="booth_idError"></small>
                                <small class="text-danger error" id="positionsError"></small>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="orientation" class="form-label">Arah Hadap Booth <small class="text-danger">*</small></label>
                                <select name="orientation" id="orientation" class="form-select" required>
                                    <option selected disabled hidden>Pilih arah hadap</option>
                                    <option value="north">Utara</option>
                                    <option value="south">Selatan</option>
                                    <option value="east">Timur</option>
                                    <option value="west">Barat</option>
                                </select>
                                <small class="text-danger error" id="orientationError"></small>
                            </div> --}}
                            <div class="mb-3 d-flex flex-column">
                                <label for="booth_pov_file" class="form-label">Gambar 360 Posisi Booth <small
                                        class="text-danger">*</small></label>
                                <small class="mb-3">* Gambar harus berupa gambar 360, kosongi untuk set default atau
                                    tidak
                                    ingin mengubah</small>
                                <div id="booth_pov_button_container">

                                </div>
                                <input class="form-control" type="file" id="booth_pov_file" name="booth_pov_file"
                                    accept="image/*">
                                <small class="text-danger error" id="booth_pov_fileError"></small>
                            </div>
                            <div class="mb-3 mt-3">
                                <button type="button" class="btn btn-secondary"
                                    onclick="$('#booth-container')[0].scrollIntoView({ behavior: 'smooth' });">Pilih posisi
                                    booth</button>
                            </div>

                            <div class="mb-3 text-center">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                        <div id="pov-modal" class="modal modal-xl fade" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Sudut Pandang Booth</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="aframe-container">
                                            <a-scene embedded>
                                                <a-sky id="sky" src=""></a-sky>
                                                <a-entity light="type: ambient; intensity: 1"></a-entity>
                                            </a-scene>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Exif js -->
    <script src="{{ asset('vendor/exifreader/exif-reader.js') }}"></script>

    <script>
        const layoutId = @json($layout->id);
        let addMode = 0;
        let editMode = 0;
        let selectedBooth = {
            positions: [],
            label: "",
            booth_pov_file: null,
            booth_id: "",
            need_label: 1,
            orientation: ""
        };
        let previousEditedPosition = [];
        let editedBoothId = "";
        let groupedBooths = {};

        function showAddForm() {
            $('#add-form').attr('data-mode', 'add');
            $('#add-form-container').removeClass('d-none');
            $('html, body').animate({
                scrollTop: $('#add-form').offset().top
            }, 300);
        }

        async function check360Image(file) {
            const metadata = await file.arrayBuffer();
            const dataView = new DataView(metadata);
            const str = new TextDecoder("utf-8").decode(dataView);
            console.log(str);
            return str.includes("ProjectionType=equirectangular");
        };

        function resetSelectedBooth() {
            previousEditedPosition = [];
            return {
                positions: [],
                label: "",
                booth_pov_file: null,
                booth_id: "",
                need_label: 1,
                orientation: ""
            };
        }

        function mergeBooth() {
            $(".booth-selection").each(function() {
                const boothId = $(this).data("booth");

                // Skip divs with empty data-booth
                if (!boothId) return;

                if (!groupedBooths[boothId]) {
                    groupedBooths[boothId] = [];
                }
                groupedBooths[boothId].push($(this));
            });

            // Merge the divs for each group
            for (const boothId in groupedBooths) {
                const booths = groupedBooths[boothId];

                if (booths.length > 1) {
                    // Determine the parent container
                    const parent = booths[0].closest(".d-flex.flex-row.justify-content-center.mx-auto");

                    // Calculate merged dimensions and position
                    const firstBooth = booths[0];
                    let minLeft = Infinity,
                        minTop = Infinity,
                        maxRight = -Infinity,
                        maxBottom = -Infinity;

                    booths.forEach((booth) => {
                        const offset = booth.offset();
                        const width = booth.outerWidth();
                        const height = booth.outerHeight();

                        minLeft = Math.min(minLeft, offset.left);
                        minTop = Math.min(minTop, offset.top);
                        maxRight = Math.max(maxRight, offset.left + width);
                        maxBottom = Math.max(maxBottom, offset.top + height);
                    });

                    const mergedWidth = maxRight - minLeft;
                    const mergedHeight = maxBottom - minTop;

                    // Create a new merged div
                    const mergedDiv = $("<div>")
                        .addClass("booth-selection bg-secondary border border-black")
                        .css({
                            position: "absolute",
                            left: minLeft,
                            top: minTop,
                            width: mergedWidth,
                            height: mergedHeight,
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                            zIndex: 1, // Ensure the merged div is above other elements
                        })
                        .text(boothId);

                    // Remove the original divs
                    booths.forEach((booth) => booth.remove());

                    // Append the merged div to the same parent
                    parent.append(mergedDiv);
                }
            }

        }

        function getRowColFromId(id) {
            const [row, col] = id.split('_').map(Number);
            return {
                row,
                col
            };
        }

        function fetchBoothLayout(layoutId) {
            $('#booth-container').find('.bg-success').removeClass('bg-success').html("");

            Swal.fire({
                title: 'Loading',
                text: 'Mendapatkan pemetaan booth',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('layout.booth.boothMapping', ':id') }}".replace(':id', layoutId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.booth-cell').html('').removeAttr('style').removeAttr('data-booth').removeClass(
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

                        if (!positionIds.includes(labelCellId)) {
                            labelCellId = `${minRow}_${minCol}`;
                        }

                        const boothLabel = booth.type + (booth.need_label ? booth.label : '');

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
                            const center = !isTop & !isBottom & !isLeft & !isRight;

                            $cell.removeClass('border');

                            if (isTop) $cell.addClass('border-black')
                                .addClass('border-top');
                            if (isBottom) $cell.addClass('border-black')
                                .addClass('border-bottom');
                            if (isLeft) $cell.addClass('border-black')
                                .addClass('border-start');
                            if (isRight) $cell.addClass('border-black')
                                .addClass('border-end');

                        });

                        // Masukkan label hanya di cell pojok kiri atas
                        $(`#${labelCellId}`).html(
                            ` <div class="label-wrapper">
                            <p class="label ${isHexColorLight(booth.color) ? 'text-dark' : 'text-light'} fw-semibold text-center my-auto">${boothLabel}</p>
                        </div>`
                        );
                    });

                    Swal.close();
                },
                error: function() {
                    Swal.close();
                    toastr.error("Terjadi kesalahan pada server");
                }
            });

            $('.booth-selection').each(function() {
                if ($(this).data('booth') == '') {
                    $(this).addClass('border-black border bg-secondary');
                }
            })
        }


        // function fetchBoothLayout(layoutId) {
        //     $('#booth-container').find('.bg-success').removeClass('bg-success').html("");
        //     Swal.fire({
        //         title: 'Loading',
        //         text: 'Mendapatkan pemetaan booth',
        //         allowOutsideClick: false,
        //         showConfirmButton: false,
        //         didOpen: () => {
        //             Swal.showLoading();
        //         }
        //     });
        //     $.ajax({
        //         url: "{{ route('layout.booth.boothMapping', ':id') }}".replace(':id', layoutId),
        //         method: 'GET',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             'isTransaction': 0
        //         },
        //         success: function(response) {

        //             response.data.forEach(function(value) {
        //                 const positions = JSON.parse(value.positions);
        //                 positions.forEach(function(positionId) {
        //                     labelElement =
        //                         `<p class="label text-black fw-semibold text-center my-auto">${value.type+value.label}</p>`
        //                     $(`#${positionId}`)
        //                         .removeClass('bg-secondary')
        //                         .addClass('border')
        //                         // .addClass(`orientation-${value.orientation}`)
        //                         .addClass('border-black')
        //                         .addClass('mergeable')
        //                         .attr('style', `background-color:${value.color} !important`)
        //                         .attr('data-booth', value.id)
        //                         .html(labelElement);
        //                 });
        //             });
        //             // mergeBooth();
        //             Swal.close();
        //         },
        //         error: function(error) {
        //             Swal.close();
        //             toastr.error("Terjadi kesalahan pada server");
        //         }
        //     })
        // }

        function editSelectedBooth(boothLayoutId) {
            fetchBoothLayout(layoutId);
            const editButton = $(this);
            editButton.html('<div class="spinner-border text-light m-2" role="status"></div>');
            editButton.prop('disabled', true);
            $.ajax({
                url: "{{ route('layout.booth.show', [':id', ':secondId']) }}".replace(':id', layoutId).replace(
                    ':secondId', boothLayoutId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    selectedBooth = {
                        id: response.data.id,
                        positions: JSON.parse(response.data.positions),
                        label: response.data.label,
                        booth_id: response.data.booth_id,
                        need_label: response.data.need_label
                    };
                    console.log(selectedBooth);
                    previousEditedPosition = JSON.parse(response.data.positions);
                    editedBoothId = response.data.id;
                    editMode = 1;
                    addMode = 0;
                    selectedBooth.positions.forEach(function(value) {
                        $(`#${value}`)
                            .attr('style', ``)
                            .addClass('bg-success')
                            .removeClass('border-top border-bottom border-start border-end')
                    });
                    $('#back-to-form-button').removeClass('d-none');
                    $('#label').val(selectedBooth.label)
                    $('#booth_id').val(selectedBooth.booth_id);
                    $('#orientation').val(selectedBooth.orientation);
                    $('#need_label').prop('checked', selectedBooth.need_label == 1);
                    if (selectedBooth.need_label) {
                        $('#label-container').show();
                        $('#label').attr('disabled', false).attr('required', true);
                    } else {
                        $('#label-container').hide();
                        $('#label').attr('disabled', true).attr('required', false);
                    }

                    if (response.data.booth_pov_file) {
                        $('#sky').attr('src', `{{ asset('storage/${response.data.booth_pov_file}') }}`);
                        $('#booth_pov_button_container').html('').append(`
                            <button type="button" class="btn btn-info pov btn-sm my-auto" data-bs-toggle="modal" data-bs-target="#pov-modal">Lihat File POV Booth</button>
                        `)
                        $('#booth_pov_button_container').show();
                    }
                    showAddForm();
                },
                error: function(error) {
                    editButton.html('Edit');
                    editButton.prop('disabled', false);
                    toastr.error("Terjadi kesalahan pada server");
                    editMode = addMode = 0;
                    selectedBooth = resetSelectedBooth();
                    fetchBoothLayout(layoutId);
                }
            })
            $('#form-title').text('Edit Booth');
        }

        function checkValidGap(positions) {
            let xSet = new Set();
            let grouped = {};

            positions.forEach(position => {
                const [x, y] = position.split('_').map(Number);
                xSet.add(x);
                if (!grouped[x]) grouped[x] = [];
                grouped[x].push(y);
            });

            const xList = Array.from(xSet).sort((a, b) => a - b);
            for (let i = 1; i < xList.length; i++) {
                if (xList[i] - xList[i - 1] > 1) {
                    return true;
                }
            }

            for (const yList of Object.values(grouped)) {
                yList.sort((a, b) => a - b);
                for (let i = 1; i < yList.length; i++) {
                    if (yList[i] - yList[i - 1] > 1) {
                        return true;
                    }
                }
            }

            return false;
        }

        function showDeleteConfirmation(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data booth yang telah disewa di booth ini akan hilang dan tidak akan bisa dikembalikan!",
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
                        url: "{{ route('layout.booth.destroy', [':id', ':secondId']) }}".replace(':id',
                            layoutId).replace(':secondId', id),
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.close();
                            toastr.success(response.message);
                            $('[data-booth="' + id + '"]').attr("data-id", "").attr("style", "")
                                .addClass('bg-secondary').html("");
                            $('#alternative-page-datatable').DataTable().draw();
                            fetchBoothLayout(layoutId);
                        },
                        error: function(error) {
                            Swal.close();
                            toastr.error('Terjadi kesalahan pada server');
                        }
                    })
                }
            });
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
                pageLength: 11,
                autoWidth: true,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                order: [
                    [1, "desc"]
                ],
                ajax: {
                    url: "{{ route('layout.booth.fetch', ':id') }}".replace(':id', layoutId),
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataSrc: function(json) {
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
                    emptyTable: "Tidak ada data booth tersimpan" // Text to display when no data is present
                }
            });

            var searchInput = $('[type="search"]');

            searchInput.off().on('input', debounce(function() {
                table.search(this.value).draw();
            }, 300));

            fetchBoothLayout(layoutId);

            $('#add-button').click(function() {
                addMode = 1;
                if (editMode == 1) {
                    selectedBooth = resetSelectedBooth();
                    fetchBoothLayout(layoutId);
                    editMode = 0;
                }
                $('#add-form').trigger('reset');
                $('#numberError').text('');
                $('#booth_idError').text('');
                $('#form-title').text('Tambah Booth');
                $('#back-to-form-button').removeClass('d-none');
                $('#label-container').show();
                $('#label').attr('disabled', false).attr('required', true).val('');
                $('#booth_pov_button_container').html('').hide();
                showAddForm();
            });

            $('#button-container').on('click', '#back-to-form-button', function() {
                showAddForm();
            });

            $('#pov-modal').on('shown.bs.modal', function() {
                let scene = document.querySelector('a-scene');
                scene.style.display = 'block';
                scene.resize();
            });

            $('.booth-selection').on('click', function() {
                let position = $(this).attr('id');
                let boothId = $(this).attr('data-booth');
                console.log(boothId);
                console.log(boothId, editedBoothId);
                console.log('add mode : ' + addMode, 'edit mode:' + editMode);

                let index = selectedBooth.positions.indexOf(position);
                let isSelected = index !== -1;

                if (addMode == 1) {
                    // ADD MODE: hanya bisa pilih booth yang data-booth nya KOSONG
                    if (!boothId) {
                        if (isSelected) {
                            selectedBooth.positions.splice(index, 1);
                            $(this).addClass('border-black bg-secondary').removeClass(
                                'border-success bg-success');
                        } else {
                            selectedBooth.positions.push(position);
                            $(this).removeClass('border-black').addClass('border-success bg-success');
                        }
                    } else {
                        alert('Hanya bisa memilih posisi yang kosong');
                    }
                } else if (editMode == 1) {
                    // EDIT MODE: bisa pilih booth yang data-booth nya KOSONG atau milik booth yang sedang diedit
                    if (!boothId || boothId == editedBoothId) {
                        if (isSelected) {
                            selectedBooth.positions.splice(index, 1);
                            $(this).addClass('border-black bg-secondary').removeClass(
                                'border-success bg-success');
                        } else {
                            selectedBooth.positions.push(position);
                            $(this).removeClass('border-black').addClass('border-success bg-success');
                        }
                    } else {
                        alert('Hanya bisa memilih posisi kosong atau milik booth yang sedang diedit');
                    }
                } else {
                    alert('Silakan klik tambah booth atau edit terlebih dahulu');
                }

                console.log(selectedBooth.positions);
            });


            // $('.booth-selection').on('click', function() {
            //     if (addMode == 1 || editMode == 1) {
            //         let position = $(this).attr('id');
            //         if (selectedBooth.positions.some(existPosition => position == existPosition) || $(this)
            //             .data('booth') !== "") {
            //             if ($(this).hasClass('bg-success')) {
            //                 selectedBooth.positions.splice(selectedBooth.positions.indexOf(position), 1);
            //                 $(this).addClass('border-black').removeClass('border-success bg-success');
            //             } else {
            //                 alert('Posisi booth sudah dipilih, silakan pilih posisi lain yang kosong');
            //             }
            //         } else {
            //             selectedBooth.positions.push(position);
            //             console.log(selectedBooth.positions)
            //             $(this).removeClass('border-black').addClass('border-success bg-success');
            //         }
            //     } else {
            //         alert('silakan klik tambah booth atau edit terlebih dahulu');
            //     }
            // });

            $('#orientation').change(function() {
                const previousOrientation = selectedBooth.orientation;
                selectedBooth.orientation = $(this).val();
                selectedBooth.positions.forEach(function(position) {
                    if (previousOrientation !== '') {
                        $(`#${position}`).removeClass(`orientation-${previousOrientation}`);
                    }
                    $(`#${position}`).addClass(`orientation-${selectedBooth.orientation}`);
                })
            })

            $('#label').on('input', debounce(function() {
                selectedBooth.label = $(this).val();
            }, 300));
            $('#booth_id').change(function() {
                selectedBooth.booth_id = $(this).val();
            });
            $('#need_label').change(function() {
                selectedBooth.need_label = $(this).is(':checked') ? 1 : 0;
                if (!$(this).is(':checked')) {
                    $('#label-container').hide();
                    $('#label').attr('disabled', true).attr('required', false);
                } else {
                    $('#label-container').show();
                    $('#label').attr('disabled', false).attr('required', true);
                }
            });
            $('#booth_pov_file').change(async function(e) {
                const povFile = e.target.files[0];
                const reader = new FileReader();

                const tags = await ExifReader.load(povFile)
                console.log(tags);
                if ((typeof tags['ProjectionType'] !== 'undefined' && tags['ProjectionType'] !==
                        null) && tags['ProjectionType'].value == 'equirectangular') {
                    selectedBooth.booth_pov_file = povFile;
                    console.log(selectedBooth);
                } else {
                    $('#booth_pov_file').val('');
                    alert('Gambar yang diunggah bukan berupa gambar 360, silakan gunakan file lain');
                }
            });


            $('#add-form').on('submit', function(e) {
                e.preventDefault();
                if (selectedBooth.positions.length == 0) {
                    Swal.fire({
                        icon: "error",
                        title: 'Gagal',
                        text: 'Posisi booth masih kosong, silakan pilih terlebih dahulu',
                        allowOutsideClick: false,
                    });
                } else {
                    let isPositionNotValid = checkValidGap(selectedBooth.positions);
                    console.log('posisi tidak valid', isPositionNotValid);
                    if (isPositionNotValid) {
                        Swal.fire({
                            icon: "error",
                            title: 'Gagal',
                            text: 'Tidak boleh ada gap kosong dalam pemilihan posisi booth',
                            allowOutsideClick: false,
                        });
                        return;
                    }
                    $('#numberError').text('');
                    $('#booth_idError').text('');
                    $('#positionError').text('');
                    var submitButton = $(this).find(':submit');

                    submitButton.html('<div class="spinner-border text-light m-2" role="status"></div>');
                    submitButton.prop('disabled', true);

                    const url = addMode == 1 ? '{{ route('layout.booth.store', ':id') }}'.replace(':id',
                            layoutId) :
                        '{{ route('layout.booth.update', [':id', ':secondId']) }}'.replace(':id', layoutId)
                        .replace(':secondId', selectedBooth.id);
                    // const method = addMode == 1 ? 'POST' : 'PUT';
                    const formData = new FormData();
                    for (const key in selectedBooth) {
                        if (key == "booth_pov_file" && selectedBooth[key] instanceof File) {
                            formData.append(key, selectedBooth[key]);
                        } else if (Array.isArray(selectedBooth[key])) {
                            selectedBooth[key].forEach((value) => {
                                formData.append(`${key}[]`, value);
                            });
                        } else {
                            formData.append(key, selectedBooth[key]);
                        }
                    }
                    if (editMode) {
                        formData.append('_method', 'PUT');
                    }
                    $.ajax({
                        url: url,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            addMode = editMode = 0;
                            console.log(response.data);
                            toastr.success(response.message);
                            submitButton.html('Simpan').prop('disabled', false);
                            $('#add-form').trigger('reset');
                            $('#add-form-container').addClass('d-none');
                            $('#back-to-form-button').addClass('d-none');
                            $('#booth_pov_file_link').hide();
                            $('#label-container').show();
                            $('#label').attr('disabled', false).attr('required', true);
                            addMode = !addMode;
                            selectedBooth = resetSelectedBooth();
                            table.draw();
                            groupedBooths = {};
                            $(`.border-success`).removeClass('border-success bg-success')
                                .addClass('border');
                            $('#booth_pov_button_container').html('').hide();
                            fetchBoothLayout(layoutId);
                        },
                        error: function(error) {
                            if (error.status == 422) {
                                var errors = error.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + 'Error').text(value[
                                        0]); // Show validation error
                                    if (key == 'positions') {
                                        showAddForm();
                                    }
                                });
                            } else {
                                toastr.error(
                                    'Terjadi kesalahan pada server'); // Show error message
                            }
                            submitButton.html('Simpan').prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
@endpush
