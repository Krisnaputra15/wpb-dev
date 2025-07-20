<?php

namespace App\Helper;

use App\Models\BoothLayout;
use App\Models\RegisteredBooth;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeneralHelper
{
    public static function generateIndonesiaBankList()
    {
        $banks = [
            [
                "name" => "BANK BRI",
                "code" => "002"
            ],
            [
                "name" => "BANK MANDIRI",
                "code" => "008"
            ],
            [
                "name" => "BANK BNI",
                "code" => "009"
            ],
            [
                "name" => "BANK DANAMON",
                "code" => "011"
            ],
            [
                "name" => "BANK PERMATA",
                "code" => "013"
            ],
            [
                "name" => "BANK PERMATA SYARIAH",
                "code" => "013"
            ],
            [
                "name" => "BANK BCA",
                "code" => "014"
            ],
            [
                "name" => "BLL MAYBANK",
                "code" => "016"
            ],
            [
                "name" => "MAYBANK SYARIAH",
                "code" => "016"
            ],
            [
                "name" => "BANK PANIN",
                "code" => "019"
            ],
            [
                "name" => "CIMB NIAGA",
                "code" => "022"
            ],
            [
                "name" => "BANK UOB INDONESIA",
                "code" => "023"
            ],
            [
                "name" => "BANK OCBC NISP",
                "code" => "028"
            ],
            [
                "name" => "CITIBANK",
                "code" => "031"
            ],
            [
                "name" => "BANK WINDU KENTJANA INTERNATIONAL",
                "code" => "036"
            ],
            [
                "name" => "BANK ARTHA GRAHA",
                "code" => "037"
            ],
            [
                "name" => "BANK TOKYO MITSUBISHI UFJ",
                "code" => "042"
            ],
            [
                "name" => "BANK DBS",
                "code" => "046"
            ],
            [
                "name" => "STANDART CHARTERED",
                "code" => "050"
            ],
            [
                "name" => "BANK CAPITAL",
                "code" => "054"
            ],
            [
                "name" => "ANZ INDONESIA",
                "code" => "061"
            ],
            [
                "name" => "BANK OF CHINA",
                "code" => "069"
            ],
            [
                "name" => "BANK BUMI ARTA",
                "code" => "076"
            ],
            [
                "name" => "BANK HSBC",
                "code" => "087"
            ],
            [
                "name" => "BANK ANTARDAERAH",
                "code" => "088"
            ],
            [
                "name" => "BANK RABOBANK",
                "code" => "089"
            ],
            [
                "name" => "BANK JTRUST INDONESIA",
                "code" => "095"
            ],
            [
                "name" => "BANK MAYAPADA",
                "code" => "097"
            ],
            [
                "name" => "BANK JAWA BARAT",
                "code" => "110"
            ],
            [
                "name" => "BANK DKI",
                "code" => "111"
            ],
            [
                "name" => "BANK BPD DIY",
                "code" => "112"
            ],
            [
                "name" => "BANK JATENG",
                "code" => "113"
            ],
            [
                "name" => "BANK JATIM",
                "code" => "114"
            ],
            [
                "name" => "BANK JAMBI",
                "code" => "115"
            ],
            [
                "name" => "BANK JAMBI SYARIAH",
                "code" => "115"
            ],
            [
                "name" => "BANK ACEH",
                "code" => "116"
            ],
            [
                "name" => "BANK ACEH SYARIAH",
                "code" => "116"
            ],
            [
                "name" => "BANK SUMUT",
                "code" => "117"
            ],
            [
                "name" => "BANK NAGARI",
                "code" => "118"
            ],
            [
                "name" => "BANK RIAU",
                "code" => "119"
            ],
            [
                "name" => "BANK RIAU SYARIAH",
                "code" => "119"
            ],
            [
                "name" => "BANK SUMSEL BABEL",
                "code" => "120"
            ],
            [
                "name" => "BANK SUMSEL BABEL SYARIAH",
                "code" => "120"
            ],
            [
                "name" => "BANK LAMPUNG",
                "code" => "121"
            ],
            [
                "name" => "BANK KALSEL",
                "code" => "122"
            ],
            [
                "name" => "BANK KALBAR",
                "code" => "123"
            ],
            [
                "name" => "BANK BPD KALTIM",
                "code" => "124"
            ],
            [
                "name" => "BANK BPD KALTIM",
                "code" => "125"
            ],
            [
                "name" => "BANK SULSELBAR",
                "code" => "126"
            ],
            [
                "name" => "BANK SULUT",
                "code" => "127"
            ],
            [
                "name" => "BANK NTB",
                "code" => "128"
            ],
            [
                "name" => "BANK NTB SYARIAH",
                "code" => "128"
            ],
            [
                "name" => "BANK BPD BALI",
                "code" => "129"
            ],
            [
                "name" => "BANK NTT",
                "code" => "130"
            ],
            [
                "name" => "BANK MALUKU",
                "code" => "131"
            ],
            [
                "name" => "BANK BPD PAPUA",
                "code" => "132"
            ],
            [
                "name" => "BANK SULTENG",
                "code" => "134"
            ],
            [
                "name" => "BANK SULTRA",
                "code" => "135"
            ],
            [
                "name" => "BANK BANTEN",
                "code" => "137"
            ],
            [
                "name" => "BANK NUSANTARA PARAHYANGAN",
                "code" => "145"
            ],
            [
                "name" => "BANK OF INDIA INDONESIA",
                "code" => "146"
            ],
            [
                "name" => "BANK MUAMALAT",
                "code" => "147"
            ],
            [
                "name" => "BANK MESTIKA",
                "code" => "151"
            ],
            [
                "name" => "BANK SHINHAN",
                "code" => "152"
            ],
            [
                "name" => "BANK SINARMAS",
                "code" => "153"
            ],
            [
                "name" => "BANK MASPION",
                "code" => "157"
            ],
            [
                "name" => "BANK GANESHA",
                "code" => "161"
            ],
            [
                "name" => "BANK ICBC",
                "code" => "164"
            ],
            [
                "name" => "BANK QNB INDONESIA",
                "code" => "167"
            ],
            [
                "name" => "BANK BTN",
                "code" => "200"
            ],
            [
                "name" => "BANK WOORI SAUDARA",
                "code" => "212"
            ],
            [
                "name" => "BANK BTPN",
                "code" => "213"
            ],
            [
                "name" => "BANK VICTORIA SYARIAH",
                "code" => "405"
            ],
            [
                "name" => "BANK BRI SYARIAH",
                "code" => "422"
            ],
            [
                "name" => "BANK JABAR BANTEN SYARIAH",
                "code" => "425"
            ],
            [
                "name" => "BANK MEGA",
                "code" => "426"
            ],
            [
                "name" => "BANK BNI SYARIAH",
                "code" => "427"
            ],
            [
                "name" => "BANK BUKOPIN",
                "code" => "441"
            ],
            [
                "name" => "BANK SYARIAH MANDIRI",
                "code" => "451"
            ],
            [
                "name" => "BANK JASA JAKARTA",
                "code" => "472"
            ],
            [
                "name" => "BANK KEB HANA",
                "code" => "484"
            ],
            [
                "name" => "BANK MNC INTERNATIONAL",
                "code" => "485"
            ],
            [
                "name" => "BANK YUDHA BHAKTI",
                "code" => "490"
            ],
            [
                "name" => "BANK RAKYAT INDONESIA AGRONIAGA",
                "code" => "494"
            ],
            [
                "name" => "BANK SBI INDONESIA (INDOMONEX)",
                "code" => "498"
            ],
            [
                "name" => "BANK ROYAL",
                "code" => "501"
            ],
            [
                "name" => "BANK NATIONAL NOBU",
                "code" => "503"
            ],
            [
                "name" => "BANK MEGA SYARIAH",
                "code" => "506"
            ],
            [
                "name" => "BANK INA",
                "code" => "513"
            ],
            [
                "name" => "BANK PANIN SYARIAH",
                "code" => "517"
            ],
            [
                "name" => "PRIMA MASTER BANK",
                "code" => "520"
            ],
            [
                "name" => "BANK SYARIAH BUKOPIN",
                "code" => "521"
            ],
            [
                "name" => "BANK SAHABAT SAMPOERNA",
                "code" => "523"
            ],
            [
                "name" => "BANK DINAR",
                "code" => "526"
            ],
            [
                "name" => "BANK KESEJAHTERAAN EKONOMI",
                "code" => "535"
            ],
            [
                "name" => "BANK BCA SYARIAH",
                "code" => "536"
            ],
            [
                "name" => "BANK ARTOS",
                "code" => "542"
            ],
            [
                "name" => "BANK BTPN SYARIAH",
                "code" => "547"
            ],
            [
                "name" => "BANK MULTIARTA SENTOSA",
                "code" => "548"
            ],
            [
                "name" => "BANK MAYORA",
                "code" => "553"
            ],
            [
                "name" => "BANK INDEX",
                "code" => "555"
            ],
            [
                "name" => "CNB",
                "code" => "559"
            ],
            [
                "name" => "BANK MANTAP",
                "code" => "564"
            ],
            [
                "name" => "BANK VICTORIA INTL",
                "code" => "566"
            ],
            [
                "name" => "HARDA",
                "code" => "567"
            ],
            [
                "name" => "IBK",
                "code" => "945"
            ],
            [
                "name" => "BANK COMMONWEALTH",
                "code" => "950"
            ],
            [
                "name" => "OVO",
                "code" => "ovo"
            ],
            [
                "name" => "LINKAJA",
                "code" => "linkaja"
            ],
            [
                "name" => "DANA",
                "code" => "dana"
            ],
            [
                "name" => "GOPAY",
                "code" => "gopay"
            ]
        ];

        return $banks;
    }

    public static function uploadFile($modelFile, $file, $path, $id = '', $fileColumnName, $newFileName = '')
    {
        $newName = ($newFileName ?: Str::uuid()) . '.' . $file->getClientOriginalExtension();

        if ($id != '') {
            $sql = $modelFile::find($id);
            if ($sql->$fileColumnName) {
                Storage::disk('public')->delete($sql->$fileColumnName);
            }
        }

        $file->storeAs($path, $newName, 'public');
        return $path . '/' . $newName;
    }

    public static function insertRegisteredBooth($columnToSearch, $columnValue, $agenda): void
    {
        $newBooths = BoothLayout::from('booth_layouts as bl')
            ->join('booths as b', 'bl.booth_id', 'b.id')
            ->where($columnToSearch, $columnValue)
            ->select('bl.id', 'b.default_price')
            ->get()
            ->map(function ($booth) use ($agenda) {
                return [
                    'id' => Str::uuid(),
                    'booth_layout_id' => $booth->id,
                    'agenda_id' => $agenda->id,
                    'is_booked' => 0,
                    'fixed_price' => str_replace('.', '', $booth->default_price),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            })
            ->toArray();
        RegisteredBooth::insert($newBooths);
    }

    public static function calculateAdditionalFee($totalTransactionPrice)
    {
        $setting = Setting::first();

        $totalAdditionalFee = [];
        $additionalFee = json_decode($setting->additional_fee_settings, true);
        if (!empty($additionalFee)) {
            for ($i = 0; $i < count($additionalFee['fee_name']); $i++) {
                $feeType = $additionalFee['fee_type'][$i];
                $feeValue = $additionalFee['fee_value'][$i];
                $row = [
                    'name' => $additionalFee['fee_name'][$i],
                    'tax_type' => $additionalFee['fee_tax_type'][$i],
                    'amount' => 0
                ];
                if ($feeType == 'formula') {
                    $row['amount'] = eval('return ' . str_replace('{}', $totalTransactionPrice, $feeValue . ';'));
                } else if ($feeType == 'percentage') {
                    $row['amount'] = $feeValue / 100 * $totalTransactionPrice;
                } else {
                    $row['amount'] = (int) $feeValue;
                }
                $totalAdditionalFee[] = $row;
            }
        }

        return $totalAdditionalFee;
    }

    public static function generateTerbilang($number)
    {
        $units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $levels = ['', 'ribu', 'juta', 'miliar', 'triliun'];

        if ($number == 0) {
            return 'nol';
        }

        $words = '';
        $level = 0;

        while ($number > 0) {
            $group = $number % 1000;
            $number = intval($number / 1000);

            if ($group > 0) {
                $groupWords = '';

                if ($group >= 100) {
                    $groupWords .= $units[intval($group / 100)] . ' ratus ';
                    $group %= 100;
                }

                if ($group >= 20) {
                    $groupWords .= $units[intval($group / 10)] . ' puluh ';
                    $group %= 10;
                } elseif ($group >= 10) {
                    if ($group == 10) {
                        $groupWords .= 'sepuluh ';
                    } elseif ($group == 11) {
                        $groupWords .= 'sebelas ';
                    } else {
                        $groupWords .= $units[$group - 10] . ' belas ';
                    }
                    $group = 0;
                }

                if ($group > 0) {
                    $groupWords .= $units[$group] . ' ';
                }

                $words = $groupWords . $levels[$level] . ' ' . $words;
            }

            $level++;
        }

        return trim($words);
    }

    public static function getStatusColor()
    {
        return [
            "belum checkout" => ['danger', 'Belum checkout'],
            "belum upload surat permohonan" => ['danger', 'Silakan upload surat permohonan dengan template surat yang ada di bawah'],
            "menunggu verifikasi transaksi" => ['warning', 'Silakan tunggu verifikasi transaksi untuk membayar transaksi'],
            "menunggu pembayaran" => ['info', 'Transaksi anda sudah diverifikasi, Silakan upload bukti pembayaran melalui tombol di bawah'],
            "menunggu verifikasi pembayaran" => ['info', 'Bukti pembayaran anda sudah diupload, silakan tunggu pembayaran anda diverifkasi'],
            "selesai" => ['success', 'Bukti pembayaran anda sudah diverifikasi'],
            "dibatalkan" => ['secondary', 'Transaksi anda telah dibatalkan, silakan menghubungi nomor (0341) 583787 atau email ke jpc@ub.ac.id'],
            "ditolak" => ['danger', 'Transaksi anda ditolak dengan alasan : '],
        ];
    }
}
