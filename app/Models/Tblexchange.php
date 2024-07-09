<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblexchange
 * 
 * @property int $id
 * @property string|null $byuser
 * @property int|null $currency
 * @property Carbon|null $entryDate
 * @property float|null $rate
 *
 * @package App\Models
 */
class Tblexchange extends Model
{
	protected $table = 'tblexchange';
	public $timestamps = false;

	protected $casts = [
		'currency' => 'int',
		'entryDate' => 'datetime',
		'rate' => 'float'
	];

	protected $fillable = [
		'byuser',
		'currency',
		'entryDate',
		'rate'
	];
}
