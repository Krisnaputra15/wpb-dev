@extends('template.admin')

@section('title')
    Detail Transaksi
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
                    <h3 class="page-title mb-0">Detail Transaksi</h3>
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
            <div class="col-md-7 mb-4">
                <div class="card h-100">
                    <div class="card-body px-4">
                        <h4>Rincian Harga Transaksi</h4>
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center row bg-secondary-subtle py-3">
                                <h4 class="text-center col-3 m-0">Nama Booth</h4>
                                <h4 class="text-center col-3 m-0">Jumlah</h4>
                                <h4 class="text-center col-3 m-0">Harga</h4>
                                <h4 class="text-center col-3 m-0">Total Harga</h4>
                            </div>
                        </div>
                        @php
                            $totalAdditionalPrice = 0;
                        @endphp
                        <div class="list-group" id="selected-booth-list">
                            @foreach ($bookedBooth as $booth)
                                <div class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4"
                                    data-booth="${databooth}">
                                    <div class="col-3 d-flex flex-column gap-1">
                                        <h4 class="m-0">Booth {{ $booth->type . $booth->label }}</h4>
                                        <span class="text-primary fs-5" data-bs-toggle="tooltip" data-bs-placement="right"
                                            data-bs-html="true" data-bs-title="{{ $booth->description }}">Informasi
                                            booth</span>
                                    </div>
                                    <h4 class="col-3 m-0 text-center">1 unit</h4>
                                    <h4 class="col-3 m-0 text-end">Rp{{ $booth->default_price }}</h4>
                                    <h4 class="col-3 m-0 text-end">Rp{{ $booth->default_price }}</h4>
                                </div>
                            @endforeach
                            @if ($transaction->additional_transaction_items != null)
                                @php
                                    $items = (array) json_decode($transaction->additional_transaction_items);
                                @endphp
                                @for ($i = 0; $i < count($items['name']); $i++)
                                    <div
                                        class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4">
                                        <div class="col-3 d-flex flex-column gap-1">
                                            <h4 class="m-0">{{ $items['name'][$i] }}</h4>
                                            @if ($items['description'][$i] != '' || $items['description'][$i] != null)
                                                <span class="text-primary fs-5" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" data-bs-html="true"
                                                    data-bs-title="{{ $items['description'][$i] }}">Detail</span>
                                            @endif
                                        </div>
                                        <h4 class="col-3 m-0 text-center">{{ $items['quantity'][$i] }}
                                            {{ $items['unit'][$i] }}</h4>
                                        <h4 class="col-3 m-0 text-end">
                                            Rp{{ number_format((int) $items['price'][$i], 0, ',', '.') }}</h4>
                                        <h4 class="col-3 m-0 text-end">
                                            Rp{{ number_format((int) $items['total_price'][$i], 0, ',', '.') }}</h4>
                                    </div>
                                    @php
                                        $totalAdditionalPrice += (int) $items['total_price'][$i];
                                    @endphp
                                @endfor
                            @endif
                            @php
                                $additionalFee = (array) json_decode($transaction->additional_fee_price, true);
                                $grandTotal = $transaction->total_price;
                            @endphp
                            @foreach ($additionalFee as $key => $value)
                                <div
                                    class="border-bottom d-flex justify-content-between align-items-center row py-3 ps-3 pe-4">
                                    <h4 class="col-3 m-0 fw-bold">{{ $value['name'] }}</h4>
                                    <h4 class="col-3 m-0 fw-bold text-end">
                                        Rp{{ number_format((int) $value['amount'], 0, ',', '.') }}</h4>
                                </div>
                                @php $grandTotal += (int)$value['amount'] @endphp
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center row py-3 ps-3 pe-4">
                                <h4 class="col-3 m-0 fw-bold">Total Keseluruhan</h4>
                                <h4 class="col-3 m-0 fw-bold text-end">Rp{{ number_format($grandTotal, 0, ',', '.') }}</h4>
                            </div>

                            <p class="mt-2 mb-1">* Total harga booth bisa berubah sesuai dengan permintaan yang dilakukan
                            </p>
                        </div>
                        {{-- <form action="{{route('boothOrder.boothSelectionStore', [$agenda->id])}}" method="POST" id="checkout-form">
                            @csrf
                            <button type="submit" id="submit-btn" class="btn btn-primary btn-block w-100 mt-4 mb-2 d-none">Lanjutkan Transaksi</button>
                        </form> --}}
                    </div>
                </div> <!-- end card -->
            </div><!-- end col-->
            <div class="col-md-5">
                <div class="d-flex flex-column gap-2">
                    <div class="card h-50">
                        <div class="card-body">
                            <h4>Detail Transaksi Booth</h4>
                            @if (auth()->user()->role == 'humas')
                                <div class="mb-3">
                                    <label class="form-label fs-5">Identitas Penyewa</label>
                                    <a href="{{ route('profile.index', ['id' => $transaction->user_id]) }}"
                                        target="_blank">
                                        <h5 class="m-0 my-auto text-primary text-decoration-underline">
                                            {{ $transaction->name }} - {{ $transaction->fullname ?? 'Nama user kosong' }}
                                            ({{ $transaction->phone_number }}) <i
                                                class="fa-solid fa-up-right-from-square"></i></h5>
                                    </a>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label fs-5">Tanggal Transaksi</label>
                                <h5 class="m-0 my-auto">
                                    {{ $transaction->created_at->locale('id_ID')->isoFormat('D MMMM Y H:mm:ss') }}</h5>
                            </div>
                            <div class="mb-3">
                                <label for="feature_request" class="form-label fs-5">Permintaan Fitur</label>
                                <textarea readonly name="feature_request" id="feature_request" class="form-control"
                                    placeholder="Tulis permintaan fitur untuk booth">{{ $transaction->feature_request }}</textarea>
                                @error('feature_request')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="additional_request" class="form-label fs-5">Permintaan Tambahan</label>
                                <textarea readonly name="additional_request" id="additional_request" class="form-control"
                                    placeholder="Tulis permintaan tambahan untuk booth">{{ $transaction->additional_request }}</textarea>
                                @error('additional_request')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-5">Status Transaksi</label>
                                <div class="d-flex flex-row justify-content-between">
                                    <h5 class="m-0 my-auto text-{{ $statusColor[$transaction->status][0] }}">
                                        {{ ucwords($transaction->status) }}</h5>
                                    <button class="ms-2 text-light bg-dark px-2 py-1" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-html="true"
                                        data-bs-title="{{ $statusColor[$transaction->status][1] }} {{ $transaction->status == 'ditolak' ? $transaction->rejection_reason : '' }}">Informasi
                                        Status</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-5">File Surat Permohonan</label>
                                <div class="d-flex justify-content-between">
                                    <h5 class="m-0 my-auto">
                                        @if ($transaction->surat_permohonan_file != null)
                                            <a href="{{ asset($transaction->surat_permohonan_file) }}" target="_blank"><i
                                                    class="fa-solid fa-link me-2"></i>Lihat Surat Permohonan</a>
                                        @else
                                            Belum ada file surat permohonan
                                        @endif
                                    </h5>
                                    @if (auth()->user()->role == 'perwakilan-perusahaan')
                                        @if ($transaction->status != 'selesai')
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#upload-surat-modal">Unggah surat</button>
                                            <div id="upload-surat-modal" class="modal fade" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="standard-modalLabel">Unggah Surat
                                                                Permohonan</h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="px-3" id="upload-surat-form" method="POST"
                                                                action="{{ route('boothTransaction.uploadSuratPermohonan', [$transaction->id]) }}"
                                                                enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="mb-3 mt-3">
                                                                    <label for="surat_permohonan_file"
                                                                        class="form-label">File Surat Permohonan <small
                                                                            class="text-danger">*</small></label>
                                                                    <input type="file" name="surat_permohonan_file"
                                                                        id="surat_permohonan_file" class="form-control"
                                                                        accept=".pdf,.doc,.docx" required>
                                                                </div>
                                                                <div class="mb-3 text-center">
                                                                    <button class="btn btn-primary"
                                                                        type="submit">Simpan</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-5">File Bukti Pembayaran</label>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column gap-2">
                                        <h5 class="m-0 my-auto">
                                            @if ($transaction->payment_proof_file != null)
                                                <a href="{{ asset($transaction->payment_proof_file) }}"
                                                    target="_blank"><i class="fa-solid fa-link mb-2 me-2"></i>Bukti
                                                    pembayaran booth</a>
                                            @else
                                                Belum ada file bukti pembayaran booth
                                            @endif
                                        </h5>
                                        <h5 class="m-0 my-auto">
                                            @if ($transaction->tax_payment_proof_file != null)
                                                <a href="{{ asset($transaction->tax_payment_proof_file) }}"
                                                    target="_blank"><i class="fa-solid fa-link me-2"></i>Bukti pembayaran
                                                    pajak</a>
                                            @else
                                                Belum ada file bukti pembayaran pajak
                                            @endif
                                        </h5>
                                    </div>
                                    @if (auth()->user()->role == 'perwakilan-perusahaan')
                                        @if ($transaction->status != 'selesai')
                                            @if ($transaction->is_verified && $transaction->surat_permohonan_file != null && $transaction->status != 'selesai')
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#upload-bukti-modal">Unggah bukti</button>
                                                <div id="upload-bukti-modal" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="standard-modalLabel">Unggah
                                                                    Bukti Pembayaran</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="px-3" id="upload-bukti-form"
                                                                    method="POST"
                                                                    action="{{ route('boothTransaction.uploadPaymentProof', [$transaction->id]) }}"
                                                                    enctype="multipart/form-data">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="mb-3 mt-3">
                                                                        <label for="payment_proof_file"
                                                                            class="form-label">File Bukti Pembayaran Booth
                                                                            <small class="text-danger">*</small></label>
                                                                        <input type="file" name="payment_proof_file"
                                                                            id="payment_proof_file" class="form-control"
                                                                            accept=".jpg,.jpeg,.png,.pdf" required>
                                                                    </div>
                                                                    <div class="mb-3 mt-3">
                                                                        <label for="tax_payment_proof_file"
                                                                            class="form-label">File Bukti Pembayaran Pajak
                                                                            <small class="text-danger">*</small></label>
                                                                        <input type="file"
                                                                            name="tax_payment_proof_file"
                                                                            id="tax_payment_proof_file"
                                                                            class="form-control"
                                                                            accept=".jpg,.jpeg,.png,.pdf" required>
                                                                    </div>
                                                                    <div class="mb-3 text-center">
                                                                        <button class="btn btn-primary"
                                                                            type="submit">Simpan</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
                                            @else
                                                <button class="btn btn-secondary btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="left"
                                                    data-bs-title="Unggah bukti pembayaran hanya bisa dilakukan setelah transaksi diverifikasi oleh admin dan sudah mengunggah surat permohonan">Unggah
                                                    bukti</button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @if (auth()->user()->role == 'humas' && $transaction->status == 'selesai')
                                <div class="mb-3">
                                    <label class="form-label fs-5">File Faktur Transaksi</label>
                                    <h5 class="m-0 my-auto">
                                        @if ($transaction->faktur_file != null)
                                            <a href="{{ asset($transaction->faktur_file) }}" target="_blank"><i
                                                    class="fa-solid fa-link me-2"></i>Lihat faktur transaksi</a>
                                        @else
                                            Belum ada file faktur
                                        @endif
                                    </h5>
                                </div>
                            @endif
                            <div class="mb-3 mt-3 d-flex justify-content-center gap-2">
                                @if (auth()->user()->role == 'humas')
                                    @if (!$transaction->is_verified && !$transaction->is_payment_verified)
                                        <a href={{ route('boothTransaction.editBooth', [$transaction->id]) }}
                                            class="btn btn-primary">Edit Pilihan Booth</a>
                                        <a href="{{ route('boothTransaction.editTransactionItem', [$transaction->id]) }}"
                                            class="btn btn-primary">Ubah Item Transaksi</a>
                                    @else
                                        <buton class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-html="true"
                                            data-bs-title="Edit pilihan booth tidak bisa dilakukan karena transaksi sudah diverifikasi">
                                            Edit Pilihan Booth</buton>
                                        <buton class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-html="true"
                                            data-bs-title="Edit item transaksi tidak bisa dilakukan karena transaksi sudah diverifikasi">
                                            Edit Item Transaksi</buton>
                                    @endif
                                    @if (!$transaction->is_verified)
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#verifikasi-transaksi-modal">Verifikasi Transaksi</button>
                                        <div id="verifikasi-transaksi-modal" class="modal fade" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel">Verifikasi
                                                            Transaksi</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="px-3" id="verifikasi-transaksi-form"
                                                            method="POST"
                                                            action="{{ route('boothTransaction.verifyTransaction', [$transaction->id]) }}">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="mb-3 mt-3">
                                                                <label for="is_verified" class="form-label">Status <small
                                                                        class="text-danger">*</small></label>
                                                                <select name="is_verified" id="is_verified"
                                                                    class="form-select" required>
                                                                    <option selected hidden disabled value="">Pilih Status Verifikasi</option>
                                                                    <option value="1">Diterima</option>
                                                                    <option value="0">Ditolak</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 mt-3 d-none">
                                                                <label for="rejection_reason" class="form-label">Alasan
                                                                    Penolakan <small class="text-danger">*</small></label>
                                                                <textarea name="rejection_reason" id="rejection_reason" class="form-control" placeholder="Alasan Penolakan"></textarea>
                                                            </div>

                                                            <div class="mb-3 text-center">
                                                                <button class="btn btn-primary"
                                                                    id="verifikasi-transaksi-submit"
                                                                    type="submit">Simpan</button>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    @endif
                                    @if (
                                        !$transaction->is_payment_verified &&
                                            $transaction->payment_proof_file != null &&
                                            $transaction->tax_payment_proof_file != null)
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#verifikasi-pembayaran-modal">Verifikasi Pembayaran</button>
                                        <div id="verifikasi-pembayaran-modal" class="modal fade" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel">Verifikasi
                                                            Pembayaran</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="px-3" id="verifikasi-transaksi-form"
                                                            method="POST"
                                                            action="{{ route('boothTransaction.verifyPayment', [$transaction->id]) }}">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="mb-3 mt-3">
                                                                <label for="is_payment_verified" class="form-label">Status
                                                                    <small class="text-danger">*</small></label>
                                                                <select name="is_payment_verified"
                                                                    id="is_payment_verified" class="form-select" required>
                                                                    <option selected hidden disabled value="">Pilih Status Verifikasi
                                                                    </option>
                                                                    <option value="1">Diterima</option>
                                                                    <option value="0">Ditolak</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 mt-3 d-none">
                                                                <label for="rejection_reason" class="form-label">Alasan
                                                                    Penolakan <small class="text-danger">*</small></label>
                                                                <textarea name="rejection_reason" id="rejection_reason" class="form-control" placeholder="Alasan Penolakan"></textarea>
                                                            </div>

                                                            <div class="mb-3 text-center">
                                                                <button class="btn btn-primary"
                                                                    type="submit">Simpan</button>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    @endif
                                    @if ($transaction->status == 'selesai')
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#upload-faktur-modal">Unggah faktur</button>
                                        <div id="upload-faktur-modal" class="modal fade" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel">Unggah Faktur
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="px-3" id="upload-faktur-form" method="POST"
                                                            action="{{ route('boothTransaction.uploadFakturFile', [$transaction->id]) }}"
                                                            enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="mb-3 mt-3">
                                                                <label for="faktur_file" class="form-label">File Faktur
                                                                    <small class="text-danger">*</small></label>
                                                                <input type="file" name="faktur_file" id="faktur_file"
                                                                    class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 text-center">
                                                                <button class="btn btn-primary"
                                                                    type="submit">Simpan</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    @endif
                                @elseif(auth()->user()->role == 'perwakilan-perusahaan')
                                    @if($setting->surat_permohonan_template_file)
                                    <a href="{{ asset($setting->surat_permohonan_template_file) }}"
                                        class="btn btn-primary">Download Template Surat Permohonan</a>
                                    @else
                                        <button class="btn btn-secondary" disabled>Download Template Surat Permohonan</button>
                                    @endif
                                    @if ($transaction->status == 'selesai')
                                        @if ($transaction->faktur_file != null)
                                            <a href="{{ asset($transaction->faktur_file) }}" class="btn btn-primary">Download faktur transaksi</a>
                                        @else
                                            <button disabled class="btn btn-secondary">Faktur belum tersedia</button>
                                        @endif
                                    @endif
                                @endif
                                @if ($transaction->is_verified)
                                    <a href="{{ route('boothTransaction.generateInvoice', [$transaction->id]) }}"
                                        target="_blank" class="btn btn-primary">Download Invoice Transaksi</a>
                                @endif
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div>
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection


@push('script')
    @if (auth()->user()->role == 'humas')
        <script>
            $(document).ready(function() {
                $('#is_verified').change(function() {
                    console.log('aw');
                    if ($(this).val() == '0') {
                        $('#rejection_reason').parent().removeClass('d-none');
                    } else {
                        $('#rejection_reason').parent().addClass('d-none');
                    }
                });
                $('#is_payment_verified').change(function() {
                    if ($(this).val() == 0) {
                        $('#rejection_reason').parent().removeClass('d-none');
                    } else {
                        $('#rejection_reason').parent().addClass('d-none');
                    }
                });
                $('#verifikasi-transaksi-submit').on('click', function(e) {
                    const form = $('#verifikasi-transaksi-form')[0];

                    console.log(form.checkValidity())
                    if (!form.checkValidity()) {
                        console.log('aw');
                        e.preventDefault(); // Prevent if form is invalid
                        form.reportValidity(); // Show native browser message
                        return;
                    }

                    e.preventDefault(); // Still need to prevent default before Swal
                    if (parseInt($('#is_verified').val()) == 1) {
                        Swal.fire({
                            title: 'Apakah anda yakin?',
                            text: "Setelah transaksi diverifikasi, data transaksi beserta booth di dalamnya tidak akan bisa diedit.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Simpan'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    } else {
                        form.submit();
                    }
                });
            })
        </script>
    @elseif(auth()->user()->role == 'perwakilan-perusahaan')
        <script></script>
    @endif
@endpush
