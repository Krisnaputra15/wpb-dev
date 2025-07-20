@extends('template.admin')

@section('title')
    Mapping Booth {{ $agenda->name }}
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
    <div class="container-fluid h-100">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="page-title mb-0">Mapping Booth di {{ $agenda->name }}</h3>
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

        <div class="row d-flex flex-row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="mx-auto mb-3">
                            <div class="d-flex flex-row-reverse mb-4 gap-2">
                                {{-- <a href="{{route('agenda.exportMapping', [$agenda->id])}}" class="btn btn-success" target="_blank">Download PDF Mapping</a> --}}
                                <button type="button" class="btn btn-primary" onclick="exportDiv()">Export Mapping</button>
                            </div>
                            <div class="d-flex justify-content-center booth-loading d-none">
                                <div class="spinner-border booth-loading d-none" role="status"></div>
                            </div>
                            <div id="mapping-booth">
                                <div class="mb-2" id="booth-container">
                                    <div class="d-flex justify-content-center booth-loading">
                                        <div class="spinner-border booth-loading" role="status"></div>
                                    </div>
                                    <img src="{{ asset('images/master/layoutBg.png') }}" class="responsive-img"
                                        style="margin-top: 5rem;" alt="" width="550" height="730">
                                    <div class="centered-element">

                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-5">Legenda</h4>
                            <div class="w-100 px-2 py-1 row row-cols-5 mt-3" id="booth-legend">
                            </div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="m-0">Detail Mapping</h3>
                    </div>
                    <div class="card-body py-2 px-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center row bg-secondary-subtle py-3">
                                <h4 class="text-center col-3 m-0">Nama Booth</h4>
                                <h4 class="col-3 m-0">Penyewa</h4>
                            </div>
                        </div>
                        <h4 class="text-center py-3 d-none" id="none">Belum ada booth yang disewa</h4>
                        <div class="list-group" id="selected-booth-list">

                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    </div> <!-- container -->
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        let currentBooth = null;
        let tooltipInstance = null;

        function exportDiv() {
            const $element = $('#mapping-booth');

            requestAnimationFrame(function() {
                html2canvas($element[0]).then(function(canvas) {
                    const link = document.createElement('a');
                    link.download = `Mapping ${@json($agenda->name)}.png`;
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                }).catch(function(err) {
                    console.error('html2canvas error:', err);
                });
            });
        }

        function getRowColFromId(id) {
            const [row, col] = id.split('_').map(Number);
            return {
                row,
                col
            };
        }

        function fetchBoothLayout(layoutId) {
            $('.centered-element').html('');
            $('.booth-loading').show();
            $('#booths').addClass('d-none');
            $.ajax({
                url: "{{ route('layout.booth.boothMapping', ':id') }}".replace(':id', layoutId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'isTransaction': 1
                },
                success: function(response) {
                    baseLayout = '';
                    for (var i = 0; i < 33; i++) {
                        baseLayout += `<div class="d-flex flex-row justify-content-center mx-auto">`;
                        for (var j = 0; j < 33; j++) {
                            baseLayout +=
                                `<div class="booth-cell booth-selection d-flex justify-content-center align-items-center booth-padding" id="${i+1}_${j+1}" style="--bs-border-opacity: .1;" data-booth="" data-pov=""></div>`;
                        }
                        baseLayout += `</div>`;
                    }
                    $('.centered-element').html(baseLayout);

                    boothLegends = '';
                    response.additional_data.boothColors.forEach(function(color) {
                        boothLegends += `<div class="col d-flex gap-2 m-0">
                                                <div class="color-legenda my-auto" style="background-color:${color.color};"></div>
                                                <p class="my-auto">Booth ${color.type}</p>
                                            </div>`;
                    })
                    $('#booth-legend').append(boothLegends);

                    let isEmpty = true;
                    let prevBooth = '';
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

                            if (isTop) $cell.addClass('border-black')
                                .addClass('border-top');
                            if (isBottom) $cell.addClass('border-black')
                                .addClass('border-bottom');
                            if (isLeft) $cell.addClass('border-black')
                                .addClass('border-start');
                            if (isRight) $cell.addClass('border-black')
                                .addClass('border-end');

                            if (booth.is_booked) {
                                isEmpty = false;
                                $cell.addClass('bg-secondary')
                                    .attr('data-bs-toggle', 'tooltip')
                                    .attr('data-bs-placement', 'left')
                                    .attr('data-bs-html', 'true')
                                    .attr('data-bs-title',
                                        `Penyewa : ${booth.name}<br><img src="{{ asset('${booth.logo}') }}" alt="Logo perusahaan ${booth.name}" width="200" height="200">`
                                    );

                                $cell.tooltip('dispose').tooltip();
                            }
                        });

                        // Masukkan label hanya di cell pojok kiri atas
                        $(`#${labelCellId}`).html(
                            ` <div class="label-wrapper">
                            <p class="label ${isHexColorLight(booth.color) ? 'text-dark' : 'text-light'} fw-semibold text-center my-auto">${boothLabel}</p>
                        </div>`
                        );
                    });
                    // response.data.forEach(function(value) {
                    //     const positions = JSON.parse(value.positions);
                    //     positions.forEach(function(positionId) {
                    //         labelElement = `<p class="label text-black fw-semibold text-center my-auto">${value.type+value.label}</p>`
                    //         const block = $(`#${positionId}`);

                    //         block.removeClass('bg-white')
                    //              .addClass('border')
                    //              // .addClass(`orientation-${value.orientation}`)
                    //              .addClass('mergeable')
                    //              .addClass('border-black');

                    //         if(value.is_booked){
                    //             isEmpty = false;
                    //             block.addClass('bg-secondary')
                    //                  .removeClass('border-white mergeable')
                    //                  .addClass('border-black')
                    //                  .attr('data-bs-toggle', 'tooltip')
                    //                  .attr('data-bs-placement', 'top')
                    //                  .attr('data-bs-html','true')
                    //                  .attr('data-bs-title', 'Penyewa : '+value.name);

                    //             block.tooltip('dispose').tooltip();
                    //             if(prevBooth != (value.type+value.label)){
                    //                 const list = `
                //                         <div class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4" >
                //                             <h5 class="col-3 m-0">Booth ${value.type+value.label}</h6>
                //                             <h5 class="col-3 m-0 text-center">${value.name}</h6>
                //                         </div>
                //                     `;
                    //                 $('#selected-booth-list').append(list);
                    //             }
                    //             prevBooth = value.type+value.label;
                    //         } else {
                    //             block.attr('style', `background-color:${value.color}`)
                    //                  .removeClass('unclickable');
                    //         }

                    //         block.html(labelElement);
                    //         if(!isEmpty){
                    //             $('#selected-booth-list').removeClass('d-none')
                    //             $('#none').addClass('d-none')
                    //         }
                    //     });
                    // });

                    $('.booth-loading').hide();
                    $('#booths').removeClass('d-none');
                },
                error: function(error) {
                    Swal.close();
                    toastr.error("Terjadi kesalahan pada server");
                    $('.booth-loading').hide()
                }
            })
            setTimeout(() => {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }, 100);
        }

        $(document).ready(function() {
            fetchBoothLayout(@json($agenda->layout_id));
        });
    </script>
@endpush
