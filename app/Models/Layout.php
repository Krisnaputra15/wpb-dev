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
 * Class Layout
 *
 * @property string $id
 * @property string $name
 * @property int $x_length
 * @property int $y_length
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Booth[] $booths
 *
 * @package App\Models
 */
class Layout extends Model
{
    use HasUuids;
	protected $table = 'layouts';
	public $incrementing = false;

	protected $casts = [
		'x_length' => 'int',
		'y_length' => 'int'
	];

	protected $fillable = [
		'name',
		'x_length',
		'y_length'
	];

	public function booth_layout()
	{
		return $this->hasMany(BoothLayout::class, 'layout_id');
	}
}
