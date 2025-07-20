@extends('template.admin')

@section('title')
    Pengaturan
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
                    <h4 class="page-title mb-0">Ubah Pengaturan</h4>
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
                        <form class="form-horizontal" method="POST" action="{{route('setting.update')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="default_wa_number" class="form-label col-md-3">Nomor WA Pengirim Default <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="default_wa_number" name="default_wa_number" placeholder="Nomor Wa Default" value="{{ $setting->default_wa_number ?? old('default_wa_number') }}" required>
                                    @error('default_wa_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="booth_bank_account_code" class="form-label col-md-3">Nama Bank untuk Booth <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <select class="form-select bank" id="booth_bank_account_code" name="booth_bank_account_code" required>
                                        <option value=""></option>
                                        @php
                                            $booth_bank_account_code = $setting->booth_bank_account_code ?? '';
                                        @endphp
                                        @foreach($bankList as $bank)
                                            <option value="{{$bank['code']}}" {{old('booth_bank_account_code') == $bank['code'] || $booth_bank_account_code == $bank['code'] ? 'selected' : ''}}>{{$bank['name']}}</option>
                                        @endforeach
                                    </select>
                                    @error('booth_bank_account_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <input type="text" name="booth_bank_account_name" id="booth_bank_account_name" hidden value="{{ $setting->booth_bank_account_name ?? old('booth_bank_account_name') }}">
                            <div class="mb-3 row">
                                <label for="booth_bank_account_number" class="form-label col-md-3">Nomor Rekening Bank untuk Booth <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="booth_bank_account_number" name="booth_bank_account_number" placeholder="Nomor Rekening Bank Booth" value="{{ $setting->booth_bank_account_number ?? old('booth_bank_account_number') }}" required>
                                    @error('booth_bank_account_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="booth_bank_account_owner" class="form-label col-md-3">Atas Nama Bank untuk Booth <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control mb-2" type="text" id="booth_bank_account_owner" name="booth_bank_account_owner" value="{{ $setting->booth_bank_account_owner ?? old('booth_bank_account_owner') }}" required>
                                    @error('booth_bank_account_owner')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tax_bank_account_code" class="form-label col-md-3">Nama Bank untuk Pajak <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <select class="form-select bank" id="tax_bank_account_code" name="tax_bank_account_code" required>
                                        <option value=""></option>
                                        @php
                                            $tax_bank_account_code = $setting->tax_bank_account_code ?? '';
                                        @endphp
                                        @foreach($bankList as $bank)
                                            <option value="{{$bank['code']}}" {{old('tax_bank_account_code') == $bank['code'] || $tax_bank_account_code == $bank['code'] ? 'selected' : ''}}>{{$bank['name']}}</option>
                                        @endforeach
                                    </select>

                                    @error('tax_bank_account_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <input type="text" name="tax_bank_account_name" id="tax_bank_account_name" hidden value="{{ $setting->tax_bank_account_name ?? old('tax_bank_account_name') }}">
                            <div class="mb-3 row">
                                <label for="tax_bank_account_number" class="form-label col-md-3">Nomor Rekening Bank Pajak <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="tax_bank_account_number" name="tax_bank_account_number" placeholder="Nomor Rekening Bank Pajak" value="{{ $setting->tax_bank_account_number ?? old('tax_bank_account_number') }}" required>
                                    @error('tax_bank_account_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tax_bank_account_owner" class="form-label col-md-3">Atas Nama Bank untuk Pajak <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control mb-2" type="text" id="tax_bank_account_owner" name="tax_bank_account_owner" value="{{ $setting->tax_bank_account_owner ?? old('tax_bank_account_owner') }}" required>
                                    @error('tax_bank_account_owner')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="surat_permohonan_template_file" class="form-label col-md-3">Berkas Template Surat Permohonan <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control mb-2" type="file" id="surat_permohonan_template_file" name="surat_permohonan_template_file" accept=".pdf,.doc,.docx">
                                    @if($setting->surat_permohonan_template_file)
                                        <a href="{{asset($setting->surat_permohonan_template_file)}}" target="_blank" id="surat_permohonan_template_file_link"><i class="fa-solid fa-link me-2"></i>Lihat template</a>
                                    @endif
                                    <div id="document-message"></div>
                                    @error('surat_permohonan_template_file')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tax_percentage" class="form-label col-md-3">Biaya Tambahan</label>
                                <div class="col-md-9" id="item-container">
                                    <p class="m-0">Khusus rumus, beri tanda {} untuk bagian rumus yang akan diganti dengan total nilai transaksi</p>
                                    <p class="m-0">* untuk kali, / untuk bagi, + untuk tambah, - untuk kurang, dan ^ untuk pangkat</p>
                                    <p class="m-0">contoh : <b>11/100 * (100/111 x {})</b> </p>
                                    @if ($setting->additional_fee_settings == null)
                                        <div class="mb-3 item-container row pt-2">
                                            <div class="col-11">
                                                <input type="text" name="additional_fee_settings[fee_name][]" id="fee_name-1" class="form-control mb-2" placeholder="Nama biaya tambahan">
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <select name="additional_fee_settings[fee_type][]" id="fee_type-1" class="form-control additional-fee-type">
                                                            <option selected hidden disabled>Pilih tipe biaya tambahan</option>
                                                            <option value="percentage">Persentase</option>
                                                            <option value="exact">Nominal Pasti</option>
                                                            <option value="formula">Rumus</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <select name="additional_fee_settings[fee_tax_type][]" id="fee_tax_type-1" class="form-control">
                                                            <option selected hidden disabled>Pilih tipe golongan biaya</option>
                                                            <option value="tax">Pajak</option>
                                                            <option value="non-tax">Non Pajak</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="number" class="form-control" step="0.01" placeholder="Jumlah / nominal / rumus biaya tambahan" name="additional_fee_settings[fee_value][]" id="fee_value-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1 d-flex flex-column justify-content-center h-full">
                                                <button type="button" class="btn w-100 btn-success fw-bold add-item-btn"><i class="fa-solid fa-plus text-white"></i></button>
                                            </div>
                                        </div>
                                    @else
                                        @php
                                            $items = (array)json_decode($setting->additional_fee_settings);
                                        @endphp
                                        @for($i = 0; $i < count($items['fee_name']); $i++)
                                            <div class="mb-3 item-container {{$i > 0 ? 'generated border-top border-2 pt-2' : ''}} row">
                                                <div class="col-10">
                                                    <input type="text" name="additional_fee_settings[fee_name][]" id="fee_name-{{$i+1}}" class="form-control mb-2" placeholder="Nama biaya tambahan" value="{{$items['fee_name'][$i]}}" required>
                                                    <div class="row mb-2">
                                                        <div class="col-4">
                                                            <select name="additional_fee_settings[fee_type][]" id="fee_type-{{$i+1}}" class="form-control additional-fee-type">
                                                                <option hidden disabled>Pilih tipe biaya tambahan</option>
                                                                <option value="percentage" @if($items['fee_type'][$i] == 'persentase') selected @endif>Persentase</option>
                                                                <option value="exact" @if($items['fee_type'][$i] == 'exact') selected @endif>Nominal Pasti</option>
                                                                <option value="formula" @if($items['fee_type'][$i] == 'formula') selected @endif>Rumus</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <select name="additional_fee_settings[fee_tax_type][]" id="fee_tax_type-{{$i+1}}" class="form-control">
                                                                <option value="tax" @if($items['fee_tax_type'][$i] == 'tax') selected @endif>Pajak</option>
                                                                <option value="non-tax" @if($items['fee_tax_type'][$i] == 'non-tax') selected @endif>Non Pajak</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="{{$items['fee_type'][$i] == 'formula' ? 'text' : 'number'}}" class="form-control" step="0.01" placeholder="Jumlah / nominal / rumus biaya tambahan" name="additional_fee_settings[fee_value][]" id="fee_value-{{$i+1}}" value="{{$items['fee_value'][$i]}}">
                                                        </div>
                                                    </div>
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
                            </div>
                            <div class="mb-3 row">
                                <label for="invoice_number_format" class="form-label col-md-3">Format Penomoran Invoice <small class="text-danger">*</small></label>
                                <div class="col-md-9">
                                    <p class="m-0">* beri tanda {} untuk bagian yang akan digenerate otomatis oleh sistem berdasarkan nomor transaksi</p>
                                    <p class="m-0">contoh : <b>{}/BCE-I/DPKA/II/</b> (hilangkan tahun di akhir format karena auto generate)</p>
                                    <input class="form-control mb-2" type="text" id="invoice_number_format" name="invoice_number_format" value="{{ $setting->invoice_number_format ?? old('invoice_number_format') }}" required>
                                    @error('invoice_number_format')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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
        $(document).ready(function(){
            $('#booth_bank_account_code').select2({
                theme: 'bootstrap-5',
                placeholder: 'Pilih nama bank',
                allowClear: true
            });
            $('#tax_bank_account_code').select2({
                theme: 'bootstrap-5',
                placeholder: 'Pilih nama bank',
                allowClear: true
            });

            $('.bank').change(function(){
                const id = $(this).attr('id').split('_')[0];
                const bankName = $(this).find('option:selected').text();
                $(`#${id}_bank_account_name`).val(bankName);
                console.log($(`#${id}_bank_account_name`).val(), bankName, id)
            });

            $('#surat_permohonan_template_file').on('change', function() {
                var file = $(this).get(0).files[0];
                var reader = new FileReader();

                if (file) {
                    var fileType = file.type;
                    var validDocumentTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

                    if (validDocumentTypes.includes(fileType)) {
                        console.log('aw');
                        var fileURL = URL.createObjectURL(file);
                        $('#document-message').html(`<a href="${fileURL}" target="_blank" class="text-primary"><i class="fa-solid fa-link me-2"></i>Lihat template dipilih</a>`).removeClass('d-none');
                        // $('#surat_permohonan_template_file_link').hide();

                    } else {
                        $('#document-message').html('<p>Unsupported file type. Please upload an image or a document.</p>').removeClass('d-none');
                    }
                }
            });

            $(document).on('click','.add-item-btn',function() {
                let count = $('input[name="additional_fee_settings[fee_name][]"]').length;
                $('#item-container').fadeIn(300, function() {
                    $(this).append(`
                                    <div class="mb-3 item-container generated row pt-2">
                                        <div class="col-11">
                                            <input type="text" name="additional_fee_settings[fee_name][]" id="fee_name-${count+1}" class="form-control mb-2" placeholder="Nama biaya tambahan">
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <select name="additional_fee_settings[fee_type][]" id="fee_type-${count+1}" class="form-control additional-fee-type">
                                                        <option selected hidden disabled>Pilih tipe biaya tambahan</option>
                                                        <option value="percentage">Persentase</option>
                                                        <option value="exact">Nominal Pasti</option>
                                                        <option value="formula">Rumus</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <select name="additional_fee_settings[fee_tax_type][]" id="fee_tax_type-${count+1}" class="form-control">
                                                        <option selected hidden disabled>Pilih tipe golongan biaya</option>
                                                        <option value="tax">Pajak</option>
                                                        <option value="non-tax">Non Pajak</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <input type="number" class="form-control" step="0.01" placeholder="Jumlah / nominal / rumus biaya tambahan" name="additional_fee_settings[fee_value][]" id="fee_value-${count+1}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 d-flex flex-column justify-content-center h-full">
                                            <button type="button" class="btn w-100 btn-success fw-bold add-item-btn"><i class="fa-solid fa-plus text-white"></i></button>
                                            <button type="button" class="btn btn-danger fw-bold h-45 remove-item-btn"><i class="fa-solid fa-trash text-light"></i></button>
                                        </div>
                                    </div>
                                    `);
                });
            });

            $(document).on('change', '.additional-fee-type', function() {
                let number = $(this).attr('id').split('-');
                console.log(number);
                if($(this).val() == 'formula'){
                    $('#fee_value-'+number[1]).attr('type', 'text');
                } else {
                    $('#fee_value-'+number[1]).attr('type', 'number');
                }
            });

            $(document).on('click', '.remove-item-btn', function() {
                $(this).closest('.generated').fadeOut(200, function() {
                    $(this).remove();
                });
            });
        })
    </script>
@endpush
