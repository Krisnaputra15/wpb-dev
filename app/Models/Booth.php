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
 * Class Booth
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $color
 * @property string $description
 * @property string $default_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Layout[] $layouts
 *
 * @package App\Models
 */
class Booth extends Model
{
    use HasUuids;
    protected $table = 'booths';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'type',
        'color',
        'description',
        'default_price',
        'length_in_m',
        'width_in_m',
        'height_in_m',
        'facilities',
        'branding_facilities',
        'lo_count',
        'lo_performance',
        'is_buyable'
    ];

    public function booth_layout()
    {
        return $this->hasMany(BoothLayout::class, 'booth_id');
    }
}
