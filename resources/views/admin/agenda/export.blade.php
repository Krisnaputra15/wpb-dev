<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" as="style">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://krisnaputra.biz.id/style.css">
</head>

<body>
    <div class="row mx-4">
        <div class="col-md-{{$withDetail ? '9' : '12'}}">
            <div class="card border-0">
                <div class="card-body border-0">
                    <div class="mx-auto mb-3">
                        <div class="d-flex justify-content-center booth-loading d-none">
                            <div class="spinner-border booth-loading d-none" role="status"></div>
                        </div>
                        <div class="mb-2" id="booth-container">
                            <div class="d-flex justify-content-center booth-loading">
                                <div class="spinner-border booth-loading" role="status"></div>
                            </div>
                            <div id="booths" class="d-flex justify-content-center">
                                <img src="https://krisnaputra.biz.id/layoutBg.png" class="responsive-img mt-5" alt="" width="550" height="730">
                                <div class="centered-element">

                                </div>
                            </div>
                        </div>
                        <div class="w-50 mx-auto px-2 py-1 row d-flex justify-content-center gap-3 row-cols-5 mt-5" id="booth-legend">

                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
        @if ($withDetail)
            <div class="col-md-3">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center row bg-secondary-subtle py-3">
                        <h4 class="text-center col-3 m-0">Nama Booth</h4>
                        <h4 class="col-3 m-0">Perusahaan</h4>
                    </div>
                </div>
                <h4 class="text-center py-3 d-none" id="none">Belum ada booth yang disewa</h4>
                <div class="list-group" id="selected-booth-list">

                </div>
            </div>
        @endif
    </div>
    <script>
        let selectedBooth = [];
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
                    for(var i = 0; i <= response.additional_data.layout.y_length+1; i++){
                        baseLayout += `<div class="d-flex flex-row justify-content-center mx-auto">`;
                        for(var j = 0; j < response.additional_data.layout.x_length; j++){
                            baseLayout += `<div class="booth-selection d-flex justify-content-center unclickable align-items-center px-4 border border-white    " id="${i+1}_${j+1}" style="--bs-border-opacity: .1;" data-booth="" data-pov=""></div>`;
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

                    let isEmpty = true;
                    let prevBooth = '';
                    response.data.forEach(function(value) {
                        const positions = JSON.parse(value.positions);
                        positions.forEach(function(positionId) {
                            labelElement = `<p class="label text-black fw-semibold text-center my-auto">${value.type+value.label}</p>`
                            const block = $(`#${positionId}`);

                            block.removeClass('bg-white')
                                 .addClass('border')
                                 // .addClass(`orientation-${value.orientation}`)
                                 .addClass('mergeable')
                                 .addClass('border-black');

                            if(value.is_booked){
                                isEmpty = false;
                                if(prevBooth != (value.type+value.label)){
                                    const list = `
                                            <div class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4" >
                                                <h5 class="col-3 m-0">Booth ${value.type+value.label}</h6>
                                                <h5 class="col-3 m-0 text-center">${value.name}</h6>
                                            </div>
                                        `;
                                    $('#selected-booth-list').append(list);
                                }
                                prevBooth = value.type+value.label;
                            }
                            block.attr('style', `background-color:${value.color}`)
                            .removeClass('unclickable');

                            block.html(labelElement);
                            if(!isEmpty){
                                $('#selected-booth-list').removeClass('d-none')
                                $('#none').addClass('d-none')
                            }
                        });
                    });

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
</body>

</html>
