@extends('template.admin')

@section('title')
    Rekapitulasi
@endsection

@push('style')
@endpush

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="page-title mb-0">Daftar Rekapitulasi</h3>
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

        <div class="row" id="receiverList-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="search-form" class="d-flex flex-row mb-4 justify-content-between gap-2 w-100">
                            <input type="text" name="a.name" id="name" class="form-control" placeholder="Nama Agenda">
                            <input type="text" name="bt.start_date" id="start_date" placeholder="Tanggal Awal" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')">
                            <input type="text" name="bt.end_date" id="end_date" placeholder="Tanggal Akhir" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                        <ul class="list-group list-group-flush py-2">
                        </ul>
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-dark mx-2 mb-2" role="status" id="loader"></div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection

@push('script')
    <script>
        let page = 1;
        let isLoading = false;
        let receivers = [];

        function loadTransaction(page, isNew){
            if (isLoading) return;

            isLoading = true;
            if(isNew){
                $('.list-group').html('');
            }
            $('#loader').show();

            $.ajax({
                url: "{{route('boothTransaction.fetch')}}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'searches': $('#search-form').serializeArray(),
                    'isRecap': 1,
                    'paginated': 1,
                    'page': page
                },
                success: function(response){
                    if(response.data.data.length == 0){
                        $('#loader').hide();
                        $('.list-group').html(`<h4 class="text-center my-auto">Belum ada transaksi selesai</h4>`)
                        isLoading = false;
                        return;
                    }

                    let receivers = response.data.data.map((transaction, index) => {
                        let url = `{{route('recap.show', ":id")}}`.replace(':id', transaction.id);
                        return `<div class="receiver list-group-item py-3 d-flex flex-row gap-2 w-100">
                                    <h4 class="text-center my-auto" style="width: 3% !important">${index+1}</h4>
                                    <div class="d-flex flex-row justify-content-between align-items-center" style="width: 97% !important">
                                        <div class="d-flex flex-column gap-2 justify-content-between">
                                            <h5 class="ps-4 m-0">${transaction.company_name}</h5>
                                            <div class="ps-4 d-flex flex-row gap-1">
                                                <div>
                                                    <p class="m-0 fw-semibold">Nama Agenda</p>
                                                    <p class="m-0 fw-semibold">PIC</p>
                                                    <p class="m-0 fw-semibold">Status</p>
                                                </div>
                                                <div>
                                                    <p class="m-0">: ${transaction.agenda_name}</p>
                                                    <p class="m-0">: ${transaction.user_name}</p>
                                                    ${transaction.status}
                                                </div>
                                            </div>
                                        </div>
                                        <a href="${url}" class="btn btn-primary btn-sm my-auto">Lihat Rekapitulasi</a>
                                    </div>
                                </div>`;
                    }).join('');

                    $('.list-group').append(receivers);
                    $('#loader').hide();

                    isLoading = false;
                },
                error: function(error){
                    console.error(error);
                    toastr.error('Terjadi kesalahan pada server');
                    $('#loader').hide();
                    isLoading = false;
                }
            })
        }

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                page++; // Increment the page
                loadTransaction(page, false); // Load next page
            }
        });

        $(document).ready(function () {
            loadTransaction();
            $('#search-form').on('submit', function() {
                event.preventDefault();
                page = 1;
                loadTransaction(1, true);
            });
        });

    </script>
@endpush

