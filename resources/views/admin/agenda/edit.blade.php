@extends('template.admin')

@section('title')
    Agenda
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
                    <h4 class="page-title mb-0">Ubah Agenda</h4>
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
                        <form class="form-horizontal" id="update-form" method="POST" action="{{route('agenda.update', [$agenda->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div id="image-container">

                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="form-label col-md-2">Nama <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Nama agenda" value="{{$agenda->name}}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cover" class="form-label col-md-2">Cover</label>
                                <div class="col-md-10">
                                    <img src="{{asset( 'storage/'.$agenda->cover)}}" id="old-cover" alt="Cover Agenda" class="img-fluid mb-2" style="width: 35% !important">
                                    <input type="file" name="cover" id="cover" class="form-control" accept="image/*" value="{{$agenda->cover}}" placeholder="File cover agenda">
                                    @error('cover')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="form-label col-md-2">Deskripsi <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <textarea name="description" id="description" class="editor" placeholder="Deskripsi agenda">{!! $agenda->description !!}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="location" class="form-label col-md-2">Lokasi <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="location" name="location"
                                    placeholder="Lokasi agenda" value="{{$agenda->location}}" required>
                                    @error('location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="start_date" class="form-label col-md-2">Tanggal Mulai <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" id="start_date" name="start_date"
                                    placeholder="Tanggal mulai agenda" value="{{explode(' ',$agenda->start_date)[0]}}" required>
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="end_date" class="form-label col-md-2">Tanggal Berakhir <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" id="end_date" name="end_date"
                                    placeholder="Tanggal berakhir agenda" value="{{explode(' ',$agenda->end_date)[0]}}" required>
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="end_date" class="form-label col-md-2">Status Aktif <small class="text-danger">*</small></label>
                                <div class="col-md-10">
                                    <select name="is_active" id="is_active" class="form-select" required>
                                        <option value="1" @if($agenda->is_active) selected @endif>Aktif</option>
                                        <option value="0" @if(!$agenda->is_active) selected @endif>Tidak aktif</option>
                                    </select>
                                    @error('is_active')
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

                            if (isTop) $cell.removeClass('border').addClass('border-black').addClass('border-top');
                            if (isBottom) $cell.removeClass('border').addClass('border-black').addClass('border-bottom');
                            if (isLeft) $cell.removeClass('border').addClass('border-black').addClass('border-start');
                            if (isRight) $cell.removeClass('border').addClass('border-black').addClass('border-end');
                        });

                        // Masukkan label hanya di cell pojok kiri atas
                        $(`#${labelCellId}`).html(
                            ` <div class="label-wrapper">
                            <p class="label text-black fw-semibold text-center my-auto">${booth.type + booth.label}</p>
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

            $('#cover').on('change', function() {
                var file = $(this).get(0).files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#old-cover').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            })
        });
    </script>
@endpush
