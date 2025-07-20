@extends('template.admin')

@section('title')
    Item Tambahan Transaksi
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
                    <h4 class="page-title mb-0">Ubah Item Tambahan Transaksi</h4>
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
                        <h5 class="fw-bold">* Item tambahan bisa berjumlah lebih dari satu</h5>
                        <form class="form-horizontal" id="add-form" method="POST" action="{{route('boothTransaction.updateTransactionItem', [$transaction->id])}}">
                            @csrf
                            @method('PUT')
                            <div id="item-container">
                                @if ($transaction->additional_transaction_items == null)
                                    <div class="mb-3 item-container row pt-2">
                                        <div class="col-10">
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <input type="text" class="form-control" placeholder="Nama item tambahan" name="additional_transaction_items[name][]" id="name-1" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control for-total" placeholder="Harga satuan item tambahan" name="additional_transaction_items[price][]" id="price-1" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control for-total" placeholder="Jumlah item tambahan" name="additional_transaction_items[quantity][]" id="quantity-1" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" placeholder="Satuan item tambahan" name="additional_transaction_items[unit][]" id="unit-1" required>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control mb-2" placeholder="Harga Total item tambahan (auto generated)" name="additional_transaction_items[total_price][]" id="total_price-1" required readonly>
                                            <textarea name="additional_transaction_items[description][]" id="description-1" class="form-control" placeholder="Deskripsi item tambahan (optional)" ></textarea>
                                        </div>
                                        <div class="col-2 d-flex flex-column justify-content-center h-full">
                                            <button type="button" class="btn w-100 btn-success fw-bold add-item-btn"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>
                                    </div>
                                @else
                                    @php
                                        $items = (array)json_decode($transaction->additional_transaction_items);
                                    @endphp
                                    @for($i = 0; $i < count($items['name']); $i++)
                                        <div class="mb-3 item-container {{$i > 0 ? 'generated border-top border-2 pt-2' : ''}} row">
                                            <div class="col-10">
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" placeholder="Nama item tambahan" name="additional_transaction_items[name][]" id="name-{{$i+1}}" value="{{$items['name'][$i]}}" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="number" class="form-control for-total" placeholder="Harga satuan item tambahan" name="additional_transaction_items[price][]" id="price-{{$i+1}}" value="{{$items['price'][$i]}}" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="number" class="form-control for-total" placeholder="Jumlah item tambahan" name="additional_transaction_items[quantity][]" id="quantity-{{$i+1}}" value="{{$items['quantity'][$i]}}" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" placeholder="Satuan item tambahan" name="additional_transaction_items[unit][]" id="unit-{{$i+1}}" value="{{$items['unit'][$i]}}" required>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control mb-2" placeholder="Harga Total item tambahan (auto generated)" name="additional_transaction_items[total_price][]" id="total_price-{{$i+1}}" value="{{$items['total_price'][$i]}}" required readonly>
                                                <textarea name="additional_transaction_items[description][]" id="description" placeholder="Deskripsi item tambahan (optional)"  class="form-control" >{{$items['description'][$i]}}</textarea>
                                            </div>
                                            <div class="col-2 d-flex flex-column justify-content-center gap-2 h-full">
                                                <button type="button" class="btn btn-success fw-bold h-45 add-item-btn"><i class="fa-solid fa-plus text-white"></i></button>
                                                @if($i > 0)
                                                    <button type="button" class="btn btn-danger fw-bold h-45 remove-item-btn"><i class="fa-solid fa-trash text-light"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>

                            <div class="my-3 text-center">
                                <button class="btn btn-primary" type="submit">Simpan</button>
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
        $(document).ready(function() {
            $(document).on('click','.add-item-btn',function() {
                let count = $('input[name="additional_transaction_items[name][]"]').length;
                $('#item-container').fadeIn(300, function() {
                    $(this).append(`
                                    <div class="mb-3 item-container generated row border-top border-2 pt-3">
                                        <div class="col-10">
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <input type="text" class="form-control" placeholder="Nama item tambahan" name="additional_transaction_items[name][]" id="name-${count+1}" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control for-total" placeholder="Harga satuan item tambahan" name="additional_transaction_items[price][]" id="price-${count+1}" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control for-total" placeholder="Jumlah item tambahan" name="additional_transaction_items[quantity][]" id="quantity-${count+1}" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" placeholder="Satuan item tambahan" name="additional_transaction_items[unit][]" id="unit-${count+1}" required>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control mb-2" placeholder="Harga Total item tambahan (auto generated)" name="additional_transaction_items[total_price][]" id="total_price-${count+1}" required readonly>
                                            <textarea name="additional_transaction_items[description][]" id="description-${count+1}" class="form-control" placeholder="Deskripsi item tambahan (optional)" ></textarea>
                                        </div>
                                        <div class="col-2 d-flex flex-column justify-content-center gap-2 h-full">
                                            <button type="button" class="btn w-100 btn-success fw-bold add-item-btn"><i class="fa-solid fa-plus text-white"></i></button>
                                            <button type="button" class="btn btn-danger fw-bold h-45 remove-item-btn"><i class="fa-solid fa-trash text-light"></i></button>
                                        </div>
                                    </div>
                                    `);
                });
            });
            $(document).on('click', '.remove-item-btn', function() {
                $(this).closest('.generated').fadeOut(200, function() {
                    $(this).remove();
                });
            });
            $(document).on('change', '.for-total', function(){
                const no = $(this).attr('id').split('-')[1];
                const price = $(`#price-${no}`).val();
                const quantity = $(`#quantity-${no}`).val();
                if(price && quantity){
                    $(`#total_price-${no}`).val(price * quantity);
                }
            })
            $('#preview-btn').click(function(e){
                e.preventDefault();
                console.log('form', $('#add-form').serializeArray());
            })
        })
    </script>
@endpush
