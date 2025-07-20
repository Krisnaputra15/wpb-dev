<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class RegisteredBooth
 *
 * @property string $id
 * @property string $booth_layout_id
 * @property string $agenda_id
 * @property string|null $booth_transaction_id
 * @property bool $is_booked
 * @property int $fixed_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Agenda $agenda
 * @property BoothLayout $booth_layout
 * @property BoothTransaction|null $booth_transaction
 *
 * @package App\Models
 */
class RegisteredBooth extends Model
{
    use HasUuids;
	protected $table = 'registered_booths';
	public $incrementing = false;

	protected $casts = [
		'is_booked' => 'bool',
		'fixed_price' => 'int'
	];

	protected $fillable = [
		'booth_layout_id',
		'agenda_id',
		'booth_transaction_id',
		'is_booked',
		'fixed_price'
	];

	public function agenda()
	{
		return $this->belongsTo(Agenda::class);
	}

	public function booth_layout()
	{
		return $this->belongsTo(BoothLayout::class);
	}

	public function booth_transaction()
	{
		return $this->belongsTo(BoothTransaction::class);
	}
}
