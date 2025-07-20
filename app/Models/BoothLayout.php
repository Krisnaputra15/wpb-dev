<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\RegisteredBooth;

/**
 * Class BoothLayout
 *
 * @property string $id
 * @property string $layout_id
 * @property string $booth_id
 * @property int $number
 * @property string $position_start
 * @property string $position_end
 * @property string $positions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Booth $booth
 * @property Layout $layout
 *
 * @package App\Models
 */
class BoothLayout extends Model
{
    use HasUuids;
	protected $table = 'booth_layouts';
	public $incrementing = false;

	protected $fillable = [
		'layout_id',
		'booth_id',
		'label',
        'positions',
		'position_start',
		'position_end',
        'booth_pov_file',
        'need_label',
	];

	public function booth()
	{
		return $this->belongsTo(Booth::class);
	}

	public function layout()
	{
		return $this->belongsTo(Layout::class);
	}

    public function registered_booths()
	{
		return $this->hasMany(RegisteredBooth::class, 'booth_layout_id');
	}

    public static function getBoothLayout($columns, $layoutId, $isTransaction){
        if($isTransaction){
            return self::from('booth_layouts as bl')
            ->join('booths as b', 'b.id', 'bl.booth_id')
            ->leftJoin('registered_booths as rb', 'rb.booth_layout_id','bl.id')
            ->leftJoin('booth_transactions as bt', 'bt.id', 'rb.booth_transaction_id')
            ->leftJoin('agenda_participants as ap', 'ap.id', 'bt.participant_id')
            ->leftJoin('users as u', 'u.id', 'ap.user_id')
            ->leftJoin('companies as c', 'c.id', 'u.company_id')
            ->select($columns)
            ->where('bl.layout_id', $layoutId)
            ->orderBy('label', 'asc');
        } else {
            return self::select($columns)->join('booths', 'booths.id', 'booth_layouts.booth_id')
            ->where('booth_layouts.layout_id', $layoutId);
        }
    }
}
