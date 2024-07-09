<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblservicelog
 * 
 * @property int $id
 * @property string $item
 * @property int|null $serviceid
 * @property int|null $empid
 * @property Carbon|null $ondate
 * @property string|null $byuser
 * @property string|null $fromstatus
 * @property string|null $tostatus
 * @property string|null $machine
 *
 * @package App\Models
 */
class Tblservicelog extends Model
{
	protected $table = 'tblservicelog';
	public $timestamps = false;

	protected $casts = [
		'serviceid' => 'int',
		'empid' => 'int',
		'ondate' => 'datetime'
	];

	protected $fillable = [
		'item',
		'serviceid',
		'empid',
		'ondate',
		'byuser',
		'fromstatus',
		'tostatus',
		'machine'
	];
}
