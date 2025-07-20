<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class CompanyContact
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CompanyContact extends Model
{
    use HasUuids;
	protected $table = 'company_contacts';
	public $incrementing = false;

	protected $fillable = [
		'name',
		'email',
		'phone_number'
	];
}
