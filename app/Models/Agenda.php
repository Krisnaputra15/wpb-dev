<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Agenda
 *
 * @property string $id
 * @property string|null $layout_id
 * @property string $cover
 * @property string $name
 * @property string $description
 * @property string $location
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Layout|null $layout
 *
 * @package App\Models
 */
class Agenda extends Model
{
    use HasUuids, HasSlug;
	protected $table = 'agendas';
	public $incrementing = false;

	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'layout_id',
        'cover',
		'name',
        'slug',
		'description',
		'location',
		'start_date',
		'end_date',
		'is_active'
	];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

	public function layout()
	{
		return $this->belongsTo(Layout::class);
	}
}
