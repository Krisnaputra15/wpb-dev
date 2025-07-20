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
 * Class Content
 *
 * @property string $id
 * @property string $title
 * @property string|null $cover
 * @property string $type
 * @property string $description
 * @property string $location
 * @property bool $is_active
 * @property string|null $video_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Content extends Model
{
    use HasUuids, HasSlug;
	protected $table = 'contents';
	public $incrementing = false;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title',
        'slug',
		'cover',
		'type',
		'description',
		'is_active',
		'video_link'
	];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
