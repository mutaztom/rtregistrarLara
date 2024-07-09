<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblqualification
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $entity
 * @property Carbon|null $startdate
 * @property string|null $degree
 * @property Carbon|null $enddate
 * @property int $appid
 * @property float|null $salary
 * @property string|null $qualtype
 * @property string|null $quality
 * @property int|null $empid
 * @property string|null $pdf
 *
 * @package App\Models
 */
class Tblqualification extends Model
{
	protected $table = 'tblqualification';
	public $timestamps = false;

	protected $casts = [
		'startdate' => 'datetime',
		'enddate' => 'datetime',
		'appid' => 'int',
		'salary' => 'float',
		'empid' => 'int'
	];

	protected $fillable = [
		'item',
		'entity',
		'startdate',
		'degree',
		'enddate',
		'appid',
		'salary',
		'qualtype',
		'quality',
		'empid',
		'pdf'
	];
}
