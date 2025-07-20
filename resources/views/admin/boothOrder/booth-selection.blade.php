@extends('template.admin')

@section('title')
    Pemesanan Booth
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
                    <h3 class="page-title mb-0">Pemilihan Booth di {{$agenda->name}}</h3>
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
        <div class="card">
            <div class="card-header">
                <h3 class="m-0">Pilihan Booth</h3>
            </div>
            <div class="card-body py-2 px-4">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center row bg-secondary-subtle py-3">
                        <h4 class="text-center col-3 m-0">Nama Booth</h4>
                        <h4 class="text-center col-3 m-0">Aksi</h4>
                    </div>
                </div>
                <h4 class="text-center py-3 none">Pilihan booth masih kosong, silakan pilih booth terlebih dahulu</h4>
                <div class="list-group d-none" id="selected-booth-list">

                </div>
                <div id="pov-modal" class="modal modal-xl fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                </div><!-- /.modal -->
                <form action="{{route('boothOrder.boothSelectionStore', [$agenda->id])}}" method="POST" id="checkout-form">
                    @csrf
                    <button type="submit" id="submit-btn" class="btn btn-primary btn-block w-100 mt-4 mb-2 d-none">Lanjutkan Transaksi</button>
                </form>
            </div>
        </div>
        <div class="row d-flex flex-row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="mx-auto mb-3">
                            <div class="d-flex justify-content-center booth-loading d-none">
                                <div class="spinner-border booth-loading d-none" role="status"></div>
                            </div>
                            <div class="mb-2" id="booth-container">
                                <div class="d-flex justify-content-center booth-loading">
                                    <div class="spinner-border booth-loading" role="status"></div>
                                </div>
                                <img src="{{asset('images/master/layoutBg.png')}}" class="responsive-img" style="margin-top: 6.5rem;" alt="" width="550" height="730">
                                <div class="centered-element">

                                </div>
                            </div>
                            <h4 class="mt-5">Legenda</h4>
                            <div class="w-100 px-2 py-1 row row-cols-5 mt-3" id="booth-legend">
                                <div class="col d-flex gap-2 m-0">
                                    <div class="color-legenda bg-secondary my-auto"></div>
                                    <p class="my-auto">Tidak Tersedia</p>
                                </div>
                                <div class="col d-flex gap-2 m-0">
                                    <div class="color-legenda bg-success my-auto"></div>
                                    <p class="my-auto">Dipilih</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

        </div>

    </div> <!-- container -->
@endsection

@push('script')
<script>
    let selectedBooth = [];

    function getRowColFromId(id) {
        const [row, col] = id.split('_').map(Number);
        return {
            row,
            col
        };
    }

    function fetchBoothLayout(layoutId){
        $('.centered-element').html('');
        $('.booth-loading').show();
        $('#booths').addClass('d-none');
        $.ajax({
            url: "{{route('layout.booth.boothMapping', ':id')}}".replace(':id', layoutId),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'isTransaction': 1
            },
            success: function(response) {
                baseLayout = '';
                for(var i = 0; i < 33; i++){
                    baseLayout += `<div class="d-flex flex-row justify-content-center mx-auto">`;
                    for(var j = 0; j < 33; j++){
                        baseLayout += `<div class="booth-cell booth-selection d-flex justify-content-center align-items-center booth-padding unclickable" id="${i+1}_${j+1}" style="--bs-border-opacity: .1;" data-booth="" data-pov=""></div>`;
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
                $('#booth-legend').append(boothLegends);

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
                            .attr('data-label', boothLabel)
                            .attr('style', `background-color:${booth.color}`);

                        // Tambahkan border hanya di sisi luar
                        const [i, j] = posId.split('_').map(Number);
                        const isTop = !positionIds.includes(`${i - 1}_${j}`);
                        const isBottom = !positionIds.includes(`${i + 1}_${j}`);
                        const isLeft = !positionIds.includes(`${i}_${j - 1}`);
                        const isRight = !positionIds.includes(`${i}_${j + 1}`);

                        $cell.removeClass('border')
                        if (isTop) $cell.addClass('border-black').addClass('border-top');
                        if (isBottom) $cell.addClass('border-black').addClass('border-bottom');
                        if (isLeft) $cell.addClass('border-black').addClass('border-start');
                        if (isRight) $cell.addClass('border-black').addClass('border-end');

                        if(parseInt(booth.is_booked)){
                            $cell.addClass('bg-secondary')
                                 .removeClass('border-white mergeable')
                                 .addClass('border-black');
                        } else {
                            $cell.attr('style', `background-color:${booth.color}`)
                                 .attr('data-booth', booth.id)
                                 .attr('data-pov', booth.booth_pov_file == null || booth.booth_pov_file == '' ? '' : 'storage/'+booth.booth_pov_file)

                            if(booth.is_buyable){
                                $cell.removeClass('unclickable')
                                    .attr('data-bs-toggle', 'tooltip')
                                    .attr('data-bs-placement', 'left')
                                    .attr('data-bs-html', 'true')
                                    .attr('data-bs-title',`
                                        <div class="text-left">
                                            Booth ${booth.booth_name} (${boothLabel}) <br>
                                            Harga awal : Rp ${booth.default_price},00 <br>
                                            Dimensi : <br>
                                            <ul>
                                                <li>Panjang : ${booth.length_in_m} meter</li>
                                                <li>Lebar : ${booth.width_in_m} meter</li>
                                                <li>Tinggi : ${booth.height_in_m} meter</li>
                                            </ul> <br>
                                            Fasilitas utama : {booth.facilities} <br>
                                            Fasilitas branding : ${booth.branding_facilities} <br>
                                            Tenaga Liaiason Officer (LO) : ${booth.lo_count} staff ${booth.lo_performance == 'standard' ? '' : booth.lo_performance+' performance'} <br>
                                        </div>
                                    `
                                    );
                                    $cell.tooltip('dispose').tooltip();
                            }
                        }

                        if(!booth.need_label){
                            $cell.addClass('unclickable booth-margin-b');
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
                //             block.addClass('bg-secondary')
                //                  .removeClass('border-white mergeable')
                //                  .addClass('border-black');
                //         } else {
                //             block.attr('style', `background-color:${value.color}`)
                //                  .attr('data-booth', value.id)
                //                  .attr('data-pov', value.booth_pov_file == null || value.booth_pov_file == '' ? '' : value.booth_pov_file)
                //                  .removeClass('unclickable');
                //         }

                //         block.html(labelElement);
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
    }

    function cancelSelectedBooth(databooth){
        $(`.booth-selection[data-booth="${databooth}"]`).removeClass('selected').removeClass('bg-success');
        selectedBooth.splice(selectedBooth.indexOf($(this).data('booth')), 1);
        $(`#selected-booth-list [data-booth="${databooth}"]`).remove();
    }

    $(document).ready(function() {
        fetchBoothLayout(@json($agenda->layout_id));

        $(document).on('click', '.booth-selection', function() {
            const databooth = $(this).attr('data-booth');
            const boothPov = $(this).attr('data-pov');
            console.log('boothPov', boothPov == null || boothPov == '');
            const povButton = {
                buttonClass: 'btn-secondary',
                trait: 'disabled',
                modal: `data-bs-toggle="modal" data-bs-target="#pov-modal"`,
                text: 'Lihat POV Booth'
            }
            if($(this).data('booth') == ''){
                return;
            }
            if($(`.booth-selection[data-booth="${databooth}"]`).hasClass('unclickable')){
                return;
            }
            if($(`.booth-selection[data-booth="${databooth}"]`).hasClass('selected')){
                cancelSelectedBooth(databooth);
            } else {
                $(`.booth-selection[data-booth="${databooth}"]`).addClass('selected').addClass('bg-success');
                const list = `
                    <div class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4" data-booth="${databooth}">
                        <h4 class="col-3 m-0">Booth ${$(this).data('label')}</h4>\
                        <div class="d-flex flex-row-reverse gap-2 col-5">
                            <button class="btn btn-cancel btn-danger btn-sm my-auto">Batal Pilih</button>
                            <button class="btn ${boothPov !== null && boothPov !== '' ? 'btn-info pov' : povButton.buttonClass} btn-sm my-auto" data-pov="${boothPov}" ${boothPov !== null && boothPov !== '' ? povButton.modal : ''}>${boothPov !== null && boothPov !== '' ? povButton.text : 'POV Kosong'}</button>
                        </div>
                    </div>
                `
                $('#selected-booth-list').append(list);
                selectedBooth.push($(this).data('booth'));
            }
            if(selectedBooth.length > 0){
                $('a.btn-primary, #selected-booth-list').removeClass('d-none');
                $('.btn-primary').removeClass('d-none');
                $('.none').addClass('d-none');
            } else {
                $('a.btn-primary, #selected-booth-list').addClass('d-none');
                $('.btn-primary').addClass('d-none');
                $('.none').removeClass('d-none');
            }
            console.log(selectedBooth);
        });

        $(document).on('click', '.btn-cancel', function() {
            const databooth = $(this).parent().parent().attr('data-booth');
            cancelSelectedBooth(databooth);
        })

        $(document).on('click', '.pov', function(){
            const pov = $(this).data('pov');
            if(pov != null || pov != ''){
                $('#sky').attr('src', '{{asset(":asset")}}'.replace(":asset", $(this).attr('data-pov')));
                $('#pov-modal').modal('show');
            }
        });

        $('#pov-modal').on('shown.bs.modal', function () {
            let scene = document.querySelector('a-scene');
            scene.style.display = 'block';
            scene.resize();
        });

        $(document).on('click', 'btn-cancel', function() {
            const databooth = $(this).parent().data('booth');
            cancelSelectedBooth(databooth);
        })

        $('#submit-btn').click(function() {
            if(selectedBooth.length == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Pilihan Booth Kosong',
                    text: 'Anda belum memilih booth yang akan diproses',
                });
                return;
            }
            $('#checkout-form input[name="registered_booth_id[]"]').remove();

            // Append each value as a hidden input
            selectedBooth.forEach(value => {
                $('#checkout-form').append(`<input type="hidden" name="registered_booth_id[]" value="${value}">`);
            });

            // Submit the form
            $('#checkout-form').submit();
        })
    });
</script>
@endpush
