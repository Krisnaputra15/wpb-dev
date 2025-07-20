<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class CompanyRegistrationInput
 *
 * @property string $id
 * @property string $column_name
 * @property string $column_label
 * @property string $column_type
 * @property bool $is_nullable
 * @property string|null $default_value
 * @property string|null $list_value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CompanyRegistrationInput extends Model
{
    use HasUuids;
	protected $table = 'company_registration_inputs';
	public $incrementing = false;

	protected $casts = [
		'is_nullable' => 'bool'
	];

	protected $fillable = [
		'column_name',
		'column_label',
		'column_type',
		'is_nullable',
		'default_value',
		'list_value'
	];
}
