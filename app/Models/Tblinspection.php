<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblinspection
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $byuser
 * @property int|null $orderid
 * @property Carbon|null $ondate
 * @property string|null $bymachine
 * @property string|null $notes
 * @property string|null $itemchecked
 * @property int|null $inspectresult
 *
 * @package App\Models
 */
class Tblinspection extends Model
{
	protected $table = 'tblinspection';
	public $timestamps = false;

	protected $casts = [
		'orderid' => 'int',
		'ondate' => 'datetime',
		'inspectresult' => 'int'
	];

	protected $fillable = [
		'item',
		'byuser',
		'orderid',
		'ondate',
		'bymachine',
		'notes',
		'itemchecked',
		'inspectresult'
	];
}
