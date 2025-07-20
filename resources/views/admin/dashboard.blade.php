@extends('template.admin')

@section('title')
Dashboard
@endsection

@section('content')
 <!-- Start Content-->
 <div class="container-fluid">

    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Dashboard</h4>
            </div>
            <div class="col-lg-6">
               <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Scoxe</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
               </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5>Selamat Datang, {{auth()->user()->fullname ?? auth()->user()->username}}</h5>
                </div>
            </div>
        </div> <!-- end col-->

    </div> <!-- end row-->

    @if (auth()->user()->role == 'humas')
    <div class="row">
        <div class="col-xl-3">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="card-title">Total Transaksi</h4>

                    <div class="text-center">
                        <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#31cb72" value="{{$totalTransaction}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                        <div class="clearfix"></div>
                        <a href="{{route('boothTransaction.index')}}" class="btn btn-sm btn-light mt-2">View All Data</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="card-title">Transaksi Belum Diverifikasi</h4>

                    <div class="text-center">
                        <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#ff5b5b" value="{{$unverifiedTransaction}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                        <div class="clearfix"></div>
                        <a href="{{route('boothTransaction.index')}}" class="btn btn-sm btn-light mt-2">View All Data</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="card-title">Transaksi Selesai</h4>

                    <div class="text-center">
                        <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#f1c31c" value="{{$completedTransaction}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                        <div class="clearfix"></div>
                        <a href="{{route('boothTransaction.index')}}" class="btn btn-sm btn-light mt-2">View All Data</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="card-title">Transaksi Ditolak</h4>

                    <div class="text-center">
                        <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#19c0ea" value="{{$canceledTransaction}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                        <div class="clearfix"></div>
                        <a href="{{route('boothTransaction.index')}}" class="btn btn-sm btn-light mt-2">View All Data</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif
    <!-- end row -->

    @if (in_array(auth()->user()->role, ['humas','perwakilan-perusahaan']))
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Transaksi Terbaru</h4>

                    <div class="table-responsive">
                        <table class="table table-centered table-striped table-nowrap">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Agenda</th>
                                    @if (auth()->user()->role == 'humas')
                                    <th>User</th>
                                    @endif
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (auth()->user()->role == 'humas')
                                    @foreach ($latestTransactions as $transaction)
                                    <tr>
                                        <td class="table-user">
                                            {{$transaction->created_at}}
                                        </td>
                                        <td>
                                            {{$transaction->agenda_name}}
                                        </td>
                                        <td>
                                            {{$transaction->fullname}} ({{$transaction->company_name}})
                                        </td>
                                        <td>
                                            Rp{{$transaction->total_amount}}
                                        </td>
                                        <td>
                                            {{ucwords($transaction->status)}}
                                        </td>
                                        <td>
                                            <a href="{{route('boothTransaction.show',[$transaction->id])}}" class="btn btn-primary btn-sm text-center">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                @foreach ($latestTransactions as $transaction)
                                    <tr>
                                        <td class="table-user">
                                            {{$transaction->created_at}}
                                        </td>
                                        <td>
                                            {{$transaction->agenda_name}}
                                        </td>
                                        <td>
                                            Rp{{$transaction->total_amount}}
                                        </td>
                                        <td>
                                            {{ucwords($transaction->status)}}
                                        </td>
                                        <td>
                                            @if($transaction->status == 'belum checkout')
                                            <a href="{{route('boothOrder.checkout',[$transaction->id])}}" class="btn btn-primary btn-sm text-center">Lanjutkan Pemesanan</a>
                                            @else
                                            <a href="{{route('boothTransaction.show',[$transaction->id])}}" class="btn btn-primary btn-sm text-center">Lihat Detail</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
    @endif

</div> <!-- container -->
@endsection
