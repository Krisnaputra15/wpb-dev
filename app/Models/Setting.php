<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class Setting
 *
 * @property string $id
 * @property string|null $default_email
 * @property string|null $message_template
 * @property string|null $default_wa_number
 * @property string|null $booth_bank_account_code
 * @property string|null $booth_bank_account_name
 * @property string|null $booth_bank_account_number
 * @property string|null $tax_bank_account_code
 * @property string|null $tax_bank_account_name
 * @property string|null $tax_bank_account_number
 * @property string|null $surat_permohonan_template_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Setting extends Model
{
    use HasUuids;
	protected $table = 'settings';
	public $incrementing = false;

	protected $fillable = [
		'default_email',
		'message_template',
        'wa_message_template',
		'default_wa_number',
		'booth_bank_account_code',
		'booth_bank_account_name',
		'booth_bank_account_number',
        'booth_bank_account_owner',
		'tax_bank_account_code',
		'tax_bank_account_name',
		'tax_bank_account_number',
        'tax_bank_account_owner',
		'surat_permohonan_template_file',
        'invoice_number_format',
        'additional_fee_settings'
	];
}
