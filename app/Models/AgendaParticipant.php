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
 * Class AgendaParticipant
 *
 * @property string $id
 * @property string $agenda_id
 * @property string $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Agenda $agenda
 * @property User $user
 * @property Collection|BoothTransaction[] $booth_transactions
 *
 * @package App\Models
 */
class AgendaParticipant extends Model
{
    use HasUuids;
	protected $table = 'agenda_participants';
	public $incrementing = false;

	protected $fillable = [
		'agenda_id',
		'user_id'
	];

	public function agenda()
	{
		return $this->belongsTo(Agenda::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function booth_transactions()
	{
		return $this->hasMany(BoothTransaction::class, 'participant_id');
	}
}
