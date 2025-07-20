<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class BoothTransaction
 *
 * @property string $id
 * @property string $participant_id
 * @property int $total_price
 * @property string $feature_request
 * @property string $additional_request
 * @property bool $is_paid
 * @property Carbon $payment_date
 * @property bool $is_verified
 * @property bool $is_payment_verified
 * @property string|null $surat_permohonan_file
 * @property string $payment_type
 * @property string|null $payment_proof_file
 * @property string|null $invoice_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property AgendaParticipant $agenda_participant
 * @property Collection|RegisteredBooth[] $registered_booths
 *
 * @package App\Models
 */
class BoothTransaction extends Model
{
    use HasUuids;
	protected $table = 'booth_transactions';
	public $incrementing = false;

	protected $casts = [
		'total_price' => 'int',
		'is_paid' => 'bool',
		'payment_date' => 'datetime',
		'is_verified' => 'bool',
		'is_payment_verified' => 'bool'
	];

	protected $fillable = [
        'transaction_number',
		'participant_id',
        'status',
		'total_price',
        'additional_fee_price',
		'feature_request',
		'additional_request',
        'additional_transaction_items',
		'is_paid',
		'payment_date',
		'is_verified',
		'is_payment_verified',
        'rejection_reason',
		'surat_permohonan_file',
        'faktur_file',
		'payment_type',
		'payment_proof_file',
        'tax_payment_proof_file',
        'documentation_link',
        'applicant_recap_link',
		'invoice_file'
	];

	public function registered_booths()
	{
		return $this->hasMany(RegisteredBooth::class);
	}
}
