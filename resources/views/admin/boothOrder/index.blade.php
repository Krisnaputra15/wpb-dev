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
<div class="container-fluid">

    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Agenda Tersedia</h4>
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
                <div class="card-body" style="max-width: 100vw !important;">
                    <h4 class="mb-3">Filter Agenda</h4>
                    <form id="search-form" class="d-flex flex-row mb-4 justify-content-between gap-2 w-100">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Agenda">
                        <input type="text" name="start_date" id="start_date" placeholder="Tanggal Mulai Agenda" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')">
                        <input type="text" name="end_date" id="end_date" placeholder="Tanggal Berakhir Agenda" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                    <div class="mb-3">
                        <div class="d-flex gap-2 justify-content-between align-items-center">
                            <h4>Agenda Tersedia</h4>
                            <hr class="my-auto" style="width: 80%">
                            <p class="text-center my-auto fs-3"><i class="fa-solid fa-caret-down"></i></p>
                        </div>
                        <div class="d-flex justify-content-center booth-loading d-none">
                            <div class="spinner-border booth-loading d-none" role="status"></div>
                        </div>
                        <div class="agenda-container ps-3 pe-5 py-2" id="available-agenda_container">
                            {{-- @foreach ($availableAgenda as $agenda)
                                <div class="agenda-card col-2 me-3" style="--bg-image: url({{asset($agenda->cover)}});">
                                    <div class="agenda-content">
                                        <h2 class="agenda-title text-light">{{$agenda->name}}</h2>
                                        <p class="agenda-copy">
                                            {{$agenda->start_date->locale('id_ID')->isoFormat('D MMMM Y')}}
                                            @if($agenda->end_date != null)
                                            - {{$agenda->end_date->locale('id_ID')->isoFormat('D MMMM Y')}}
                                            @endif
                                        </p>
                                        <a class="agenda-btn">Pilih Agenda</a>
                                    </div>
                                </div>
                            @endforeach --}}
                        </div>
                    </div>

                    {{-- <div>
                        <div class="d-flex gap-2 justify-content-between align-items-center">
                            <h4>Agenda Selesai</h4>
                            <hr class="my-auto" style="width: 80%">
                            <p class="text-center my-auto fs-3"><i class="fa-solid fa-caret-down"></i></p>
                        </div>
                        <div class="d-flex justify-content-center booth-loading d-none">
                            <div class="spinner-border booth-loading d-none" role="status"></div>
                        </div>
                        <div class="agenda-container row ps-3 pe-5 py-2" id="unavailable-agenda_container">
                        </div>
                    </div> --}}

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

    <script src="{{asset('vendor/moment/moment.js')}}"></script>

    <!-- Datatables js -->
    <script src="{{ asset('admin/js/pages/datatables.js') }}"></script>

    <script>
        function fetchAgenda(){
            $('.agenda-container').hide();
            $('.booth-loading').removeClass('d-none');
            $.ajax({
                url: "{{ route('boothOrder.fetchAgenda') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: $('#search-form').serialize(),
                success: function(response){
                    $('.agenda-container').html('');
                    let today = moment();
                    let availableAgenda = '';
                    let unavailableAgenda = '';
                    response.data.forEach(function(data){
                        console.log(data);
                        const cover = `{{asset('storage/${data.cover}')}}`;
                        const url = '{{route("boothOrder.boothSelection", ":id")}}'.replace(':id', data.id);
                        const startDate = moment(data.start_date);
                        const endDate = moment(data.end_date);
                        console.log('today', today, 'start_date', startDate, 'end_date', endDate);

                        const isUnavailable = startDate <= today || (startDate > today && endDate <= today);
                        console.log('is unavailable', isUnavailable);
                        let agendaCard = `
                            <div class="agenda-card col-2 me-3" style="--bg-image: ${isUnavailable ? 'linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),' : ''}url(${cover});">
                                <div class="agenda-content">
                                    <h2 class="agenda-title text-light">${data.name}</h2>
                                    <p class="agenda-copy">${startDate.locale('id').format('LL')} ${endDate == startDate ? '' : ' - '+endDate.locale('id').format('LL')}</p>
                                    ${!isUnavailable ? `<a href="${url}" class="agenda-btn">Pilih Agenda</a>` : ''}
                                </div>
                            </div>
                        `;

                        // Append to the respective agenda list
                        if (isUnavailable) {
                            unavailableAgenda += agendaCard;
                        } else {
                            availableAgenda += agendaCard;
                        }
                    });
                    $('#available-agenda_container').html(availableAgenda);
                    $('#unavailable-agenda_container').html(unavailableAgenda);
                    $('.booth-loading').addClass('d-none');
                    $('.agenda-container').show();
                },
                error: function(error){
                    toastr.error('Terjadi kesalahan pada server');
                    $('.agenda-container').show();
                    $('.booth-loading').addClass('d-none');
                }
            });
        }
        $(document).ready(function(){
            fetchAgenda();
            $('#search-form').submit(function(e){
                e.preventDefault();
                fetchAgenda();
            })
        })
    </script>
@endpush
