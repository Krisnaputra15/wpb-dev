@extends('template.admin')

@section('title')
    Ringkasan Pemesanan
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
                    <h3 class="page-title mb-0">Ringkasan Pemesanan Booth</h3>
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

        <div class="row d-flex flex-row justify-content-between h-100">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body px-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center row bg-secondary-subtle py-3">
                                <h4 class="text-center col-3 m-0">Nama Booth</h4>
                                <h4 class="text-center col-3 m-0">Harga</h4>
                            </div>
                        </div>
                        <div class="list-group" id="selected-booth-list">
                            @foreach ($boothData as $booth)
                                <div class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4">
                                    <h4 class="col-3 m-0">Booth {{$booth->type.$booth->label}} <span class="text-primary fs-5" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" data-bs-title="{{$booth->description}}">Informasi booth</span></h4>
                                    <h4 class="col-3 m-0 text-end">Rp{{$booth->default_price}}</h4>
                                </div>
                            @endforeach
                            @php
                                $additionalFee = (array)json_decode($transaction['additional_fee_price'], true);
                                $grandTotal = $transaction['total_price'];
                            @endphp
                            @foreach($additionalFee as $key => $value)
                                <div class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4">
                                    <h4 class="col-5 m-0 fw-bold">{{$value['name']}}</h4>
                                    <h4 class="col-3 m-0 fw-bold text-end">Rp{{number_format((int)$value['amount'], 0, ',', '.')}}</h4>
                                </div>
                                @php $grandTotal += (int)$value['amount'] @endphp
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center row py-3 ps-3 pe-4">
                                <h4 class="col-3 m-0 fw-bold">Total Keseluruhan</h4>
                                <h4 class="col-3 m-0 fw-bold text-end">Rp{{number_format($grandTotal, 0, ',', '.')}}</h4>
                            </div>

                            <p>* Total harga keseluruhan sudah termasuk pajak</p>

                        </div>
                        {{-- <form action="{{route('boothOrder.boothSelectionStore', [$agenda->id])}}" method="POST" id="checkout-form">
                            @csrf
                            <button type="submit" id="submit-btn" class="btn btn-primary btn-block w-100 mt-4 mb-2 d-none">Lanjutkan Transaksi</button>
                        </form> --}}
                    </div>
                </div> <!-- end card -->
            </div><!-- end col-->
            <div class="col-md-6">
                <form action="{{route('boothOrder.checkoutSave', [$transaction['id']])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="payment_type" id="payment_type" value="">
                    <div class="d-flex flex-column gap-2">
                        <div class="card h-50">
                            <div class="card-body">
                                <h4>Permintaan Keperluan Booth</h4>
                                <p>* Tulis permintaan untuk booth anda di sini jika ada</p>
                                <div class="mb-3">
                                    <label for="feature_request" class="form-label">Permintaan Fitur</label>
                                    <textarea name="feature_request" id="feature_request" class="form-control" placeholder="Tulis permintaan fitur untuk booth">{{old('feature_request')}}</textarea>
                                    @error('feature_request')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="additional_request" class="form-label">Permintaan Tambahan</label>
                                    <textarea name="additional_request" id="additional_request" class="form-control" placeholder="Tulis permintaan tambahan untuk booth">{{old('additional_request')}}</textarea>
                                    @error('additional_request')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                        <div class="card h-50">
                            <div class="card-body">
                                <h4>Metode Pembayaran</h4>
                                <p>* Pilih metode pembayaran yang tersedia di bawah</p>
                                @error('payment_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="accordion accordion-flush d-flex flex-column gap-2 mb-3" id="accordionFlushExample">
                                    <div class="accordion-item border mb-2">
                                        <h2 class="accordion-header payment-method d-flex flex-row justify-content-between" id="flush-headingOne" data-value="transfer">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Transfer Bank
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                            data-bs-parent="#accordionFlushExample">
                                            {{-- <div class="accordion-body">
                                                Untuk pembayaran booth, bisa dilakukan ke bank <b>{{$setting->booth_bank_account_name}}</b> dengan nomor <b> ({{$setting->booth_bank_account_code}}) {{$setting->booth_bank_account_number}}</b>
                                                <br>
                                                Untuk pembayaran pajak, bisa dilakukan ke bank <b>{{$setting->tax_bank_account_name}}</b> dengan nomor <b> ({{$setting->tax_bank_account_code}}) {{$setting->tax_bank_account_number}}</b>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="accordion-item border">
                                        <h2 class="accordion-header payment-method d-flex flex-row justify-content-between" id="flush-headingTwo" data-value="direct">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Langsung di Kantor DPKA UB
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                            data-bs-parent="#accordionFlushExample">
                                            {{-- <div class="accordion-body">
                                                Pembayaran bisa dilakukan langsung ke kantor DPKA Universitas Brawijaya (Universitas Brawijaya, Gedung JPC/DPKA, Jl. Veteran, Ketawanggede, Lowokwaru, Kota Malang)
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block w-100">Selesaikan Transaksi</button>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div>
                </form>
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.payment-method').click(function() {
                $('#payment_type').val($(this).attr('data-value'));
                $('.payment-method').each(function(){
                    $(this).children().first().removeClass('bg-success selected').removeClass('text-dark')
                });
                $(this).children().first().addClass('bg-success text-dark');
            });
        })
    </script>
@endpush
