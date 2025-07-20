@extends('template.admin')

@section('title')
    Pesan Promosi
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
                    <h4 class="page-title mb-0">Kirim Pesan Promosi</h4>
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

        <div class="row mb-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row-reverse mb-4 gap-2">
                            <button type="button" class="btn btn-primary" id="send-button">Kirim Pesan</button>
                        </div>
                        <div class="">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="simpleinput">Tipe Penerima</label>
                                <div class="col-md-10">
                                    <select class="form-select" id="type" required>
                                        <option hidden disabled selected>Pilih Tipe Penerima</option>
                                        <option value="all">Semua</option>
                                        <option value="choosen">Pilihan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="simpleinput">Tipe Pesan</label>
                                <div class="col-md-10">
                                    <select class="form-select" id="message_type" required>
                                        <option hidden disabled selected>Pilih Tipe Pesan</option>
                                        <option value="all">Semua</option>
                                        <option value="wa">Whatsapp</option>
                                        <option value="email">Email</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row" id="choosen-receiver-container">
                                <label class="m-0 col-md-2 col-form-label">Penerima</label>
                                <div class="col-md-10">
                                    <div class="p-2 border border-gray rounded-2" id="choosen-receiver"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

        <div class="row" id="receiverList-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="pt-3 pb-2 px-4">
                            <h4 class="m-0">Pilih Penerima</h4>
                        </div>
                        <ul class="list-group list-group-flush px-0 py-2">
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

        function loadReceiver(page, isNew){
            if (isLoading) return;

            isLoading = true;
            if(isNew){
                $('.list-group').html('');
            }
            $('#loader').show();

            $.ajax({
                url: "{{route('companyContact.fetch')}}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'datatable': 0,
                    'paginated': 1,
                    'page': page
                },
                success: function(response){
                    if(response.data.length == 0){
                        $('#loader').hide();
                        return;
                    }

                    let receivers = response.data.map(receiver => {
                        return `<div class="receiver list-group-item py-3 d-flex flex-row gap-2 justify-content-between" data-id="${receiver.id}" data-name="${receiver.name}" data-email="${receiver.email}" data-phone-number="${receiver.phone_number}">
                                    <div class="d-flex flex-column gap-2 justify-content-between">
                                        <h5 class="ps-4 m-0">${receiver.name}</h5>
                                        <div class="ps-4 d-flex flex-row gap-1">
                                            <div>
                                                <p class="m-0">Email</p>
                                                <p class="m-0">Nomer Telepon / WA</p>
                                            </div>
                                            <div>
                                                <p class="m-0">: ${receiver.email}</p>
                                                <p class="m-0">: ${receiver.phone_number}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    }).join('');

                    $('.list-group').append(receivers);
                    $('#loader').hide();

                    isLoading = false;
                },
                error: function(error){
                    console.error(error);
                    $('#loader').hide();
                    isLoading = false;
                }
            })
        }

        function reset(){
            const type = $('#type').val();
            if(type == 'all'){
                $('#choosen-receiver-container').hide();
                $('#receiverList-row').hide();
            } else {
                page = 1;
                receivers = [];
                $('#choosen-receiver').html('');
                loadReceiver(page, true);
                $('#choosen-receiver-container').show();
                $('#receiverList-row').show();
            }
        }

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                page++; // Increment the page
                loadReceiver(page, false); // Load next page
            }
        });

        $(document).ready(function () {
            $('#choosen-receiver-container').hide();
            $('#receiverList-row').hide();

            $('#type').on('change', function() {
                reset();
            })
            $(document).on('click', '.receiver', function () {
                const receiver = $(this);

                // Check if receiver is already selected
                if (receiver.hasClass('bg-gray')) {
                    console.log('Receiver already selected!');
                    return;
                }

                // Add receiver to the array
                receivers.push({
                    id: receiver.data('id'),
                    name: receiver.data('name'),
                    email: receiver.data('email'),
                    phone_number: '62'+receiver.data('phone-number').substring(1),
                });

                // Update UI
                receiver.addClass('bg-gray').append('<button class="btn btn-cancel btn-danger btn-sm fixed-height-btn my-auto">Batal Pilih</button>');
                $('#choosen-receiver').append(`
                    <button class="btn-receiver rounded-pill btn btn-outline-primary btn-sm" data-id="${receiver.data('id')}">${receiver.data('name')} <i class="fa-solid fa-x ms-2" style="font-size:0.5rem"></i></button>
                `)

                console.log(receivers); // Debug output
            });

            $(document).on('click', '.btn-cancel', function(e) {
                e.stopPropagation();
                const btn = $(this);
                const receiverId = btn.closest('.receiver').data('id');

                // Remove receiver from the array
                receivers = receivers.filter(r => r.id!== receiverId);

                // Update UI
                btn.closest('.receiver').removeClass('bg-gray').find('.btn-cancel').remove();
                $(`.btn-receiver[data-id="${receiverId}"]`).remove();

                console.log(receivers); // Debug output
            })

            $('#send-button').click(function() {
                if(!$('#type').val()){
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Tipe penerima belum dipilih',
                        allowOutsideClick: false,
                    });
                    return;
                }
                if(!$('#message_type').val()){
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Tipe pesan belum dipilih',
                        allowOutsideClick: false,
                    });
                    return;
                }
                Swal.fire({
                    title: 'Loading',
                    text: 'Mengirimkan pesan promosi',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const formData = new FormData();
                formData.append('receiver-type',  $('#type').val());
                formData.append('message_type', $('#message_type').val());
                if($('#type').val() == 'choosen'){
                    if(receivers.length == 0){
                        Swal.hideLoading();
                        Swal.close();
                        setTimeout(() => {
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                text: 'Penerima belum dipilih',
                                allowOutsideClick: false,
                            });
                        }, 200);
                        return;
                    } else {
                        receivers.forEach(function (receiver) {
                            formData.append('receivers[]', JSON.stringify(receiver));
                        });
                    }
                }

                $.ajax({
                    url: "{{route('promotionMessage.send')}}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        Swal.close();
                        toastr.success(response.message);
                        reset();
                    },
                    error: function(error){
                        Swal.close();
                        toastr.error(error.responseJSON?.message);
                    }
                });
            })

            // $(document).
        });

    </script>
@endpush
