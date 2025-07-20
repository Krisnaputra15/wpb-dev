<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
            max-width: 770px;
        }

        .invoice-container {
            width: 770px;
            padding: 20px;
            /* border: 1px solid black; */
        }

        .content-container {
            width: 770px;
            border: 1px solid black;
        }

        .alamat-font {
            font-size: 12px;
        }

        .header-font {
            font-size: 18.62px;
        }

        .top {
            vertical-align: top;
            text-align: left;
        }

        .table-content-font {
            font-size: 13.33px;
        }

        .paralellogram {
            width: fit-content;
            padding: 10px 30px;
            transform: skew(-30deg);
            border: 1px solid black;
            box-shadow: 2px 2px 5px rgb(46, 46, 46);
        }

        .paralellogram-text {
            transform: skew(30deg);
            font-size: 15.96px;
        }

        .total-price-font {
            font-size: 15.96px;
        }

        .button-success {
            background-color: #28a745;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .button-success:hover {
            background-color: #218838;
        }

        .button-primary {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .button-primary:hover {
            background-color: #0069d9;
        }
    </style>

</head>

<body>
    <div id="invoice-container" class="invoice-container" style="width: fit-content">
            <table class="header">
                @php
                    $path = public_path('images/ub-logo-small.png'); // adjust path
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <tr>
                    <td rowspan="3"><img src="{{ $base64 }}" alt="Logo" width="100" height="100"></td>
                    <td><b>
                            <p class="header-font m-0">DIREKTORAT PENGEMBANGAN</p>
                        </b></td>
                </tr>
                <tr>
                    <td><b>
                            <p class="header-font m-0">KARIR DAN ALUMNI</p>
                        </b></td>
                </tr>
                <tr>
                    <td>
                        <p class="header-font m-0"
                            style="color: white; background-color: black; -webkit-print-color-adjust: exact; padding-left: 2px; width: 120%;">
                            <strong>UNIVERSITAS BRAWIJAYA</strong>
                        </p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                @php
                    $path = public_path('images/invoice-word.png'); // adjust path
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <tr>
                    <td>
                        <p class="alamat-font" style="margin-bottom: 0;">Office:</p>
                    </td>
                    <td rowspan="4" style="padding: 0;">
                        <div style="display: flex; flex-direction: column; justify-content: flex-end; height: 100%;">
                            <div style="display: flex; justify-content: flex-end;">
                                <img src="{{ $base64 }}" alt="" width="150">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="alamat-font" style="margin-bottom: 0;">Jl. Veteran Malang Telp. 0341 583787 Fax. 0341
                            575453</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="alamat-font" style="margin-bottom: 0;">Telp. 0341 551611 Ext. 130</p>
                    </td>
                </tr>
                <tr>
                    <td class="d-flex">
                        <a class="alamat-font" href="http://upkk.ub.ac.id"
                            style="margin-right: 5px;">http://upkk.ub.ac.id</a>
                        <p class="alamat-font"> - </p>
                        <a class="alamat-font" href="mailto:jpc@ub.ac.id">jpc@ub.ac.id</a>
                    </td>
                </tr>
            </table>
            <div class="content-container">
                <table border="0" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%;"
                    class="table-content-font">
                    <tr>
                        <td class="top">Nomor</td>
                        <td class="top">:</td>
                        <td class="top">
                            {{ $transaction['transaction_number'] }}/BCE-I/DPKA/II/{{ $transaction['created_at']->year }}
                        </td>
                    </tr>
                    <tr>
                        <td class="top">Telah terima dari</td>
                        <td class="top">:</td>
                        <td class="top"> <strong>{{ $transaction['company_name'] }}</strong></td>
                    </tr>
                    <tr>
                        <td class="top">Buat Pembayaran</td>
                        <td class="top">
                            <p>:</p>
                        </td>
                        <td class="w-75 top">
                            Biaya Sewa Gedung Kegiatan {{ $transaction['agenda_name'] }}<br>
                            Tanggal {{ $transaction['start_date'] }} - {{ $transaction['end_date'] }}.<br>
                            Dengan Rincian Sebagai Berikut:<br>
                            <table>
                                @foreach ($bookedBooths as $booth)
                                    <tr>
                                        <td>{{ $booth->booth_name }} - {{ $booth->type . $booth->label }}</td>
                                        <td>:</td>
                                        <td class="text-end">Rp. {{ number_format($booth->fixed_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($items != null)
                                    @for ($i = 0; $i < count($items['name']); $i++)
                                        <tr>
                                            <td>{{ ucwords($items['name'][$i] . ' ' . $items['quantity'][$i] . ' ' . $items['unit'][$i]) }}
                                            </td>
                                            <td>:</td>
                                            <td class="text-end">Rp.
                                                {{ number_format((int) $items['total_price'][$i], 0, ',', '.') }}</td>
                                        </tr>
                                    @endfor
                                @endif
                                @if ($additionalFee != null)
                                    @foreach ($additionalFee as $key => $value)
                                        <tr>
                                            <td>{{ $value['name'] }}</td>
                                            <td>:</td>
                                            <td class="text-end">Rp.
                                                {{ number_format((int) $value['amount'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="top">Terbilang</td>
                        <td class="top">:</td>
                        <td class="top">{{ ucwords($transaction['grand_total_terbilang']) }} Rupiah</td>
                    </tr>
                    <tr>
                        <td class="top">
                            <p class="m-0">Jumlah</p>
                            <i><small>*include tax</small></i>
                        </td>
                        <td class="top">:</td>
                        <td class="top">
                            <div class="paralellogram">
                                <b>
                                    <p class="my-auto paralellogram-text">Rp. {{ $transaction['grand_total'] }},-* </p>
                                </b>
                            </div>
                        </td>
                    </tr>
                </table>
                <table style="border: 0; margin-top: 10px; width: 100%; margin-bottom: 15px;"
                    class="table-content-font">
                    <tr>
                        <td class="w-75 top">
                            @if ($transaction['payment_type'] == 'transfer')
                                <b><i><u>
                                            <p class="m-0 ms-2">Transfer ke Virtual Account Universitas Brawijaya:</p>
                                            <p class="m-0 ms-2">{{ $setting->booth_bank_account_name }}:
                                                {{ $setting->booth_bank_account_number }} a/n
                                                {{ $setting->booth_bank_account_owner }} (Gedung)</p>
                                            <p class="m-0 ms-2">{{ $setting->tax_bank_account_name }}:
                                                {{ $setting->tax_bank_account_number }} a/n
                                                {{ $setting->tax_bank_account_owner }} (Pajak)</p>
                                        </u></i></b>
                            @else
                                <b><i><u>
                                            <p class="m-0 ms-2">Pembayaran bisa langsung dilakukan di : </p>
                                            <p class="m-0 ms-2">Kantor DPKA Universitas Brawijaya,</p>
                                            <p class="m-0 ms-2">Jl. Veteran, Kota Malang.</p>
                                        </u></i></b>
                            @endif
                        </td>
                        <td class="w-525">
                            <p class="text-end pe-3">Malang, {{ $transaction['invoice_generated'] }}</p>
                            <b>
                                <p class="text-end pe-3" style="margin-bottom: 0; margin-top: 40px;">Andy Sulistyowatik
                                </p>
                            </b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <div class="d-flex flex-row justify-content-center" style="margin-top: 20px">
        <button onclick="printPDF()" class="btn btn-success" style="margin-right:20px">Print invoice</button>
        <a href="{{ route('boothTransaction.show', [$id]) }}" class="btn btn-primary">Kembali ke detail transaksi</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function printPDF() {
            const element = document.getElementById('invoice-container');
            const opt = {
                margin: 0.5,
                filename: 'invoice.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: window.devicePixelRatio * 2, // Higher scale = sharper output
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: [215, 210],
                    orientation: 'landscape'
                }
            };

            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>

</html>
