<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblregmembership
 * 
 * @property int $id
 * @property int|null $regid
 * @property int|null $socityid
 * @property int|null $memtype
 * @property Carbon|null $ondate
 *
 * @package App\Models
 */
class Tblregmembership extends Model
{
	protected $table = 'tblregmemberships';
	public $timestamps = false;

	protected $casts = [
		'regid' => 'int',
		'socityid' => 'int',
		'memtype' => 'int',
		'ondate' => 'datetime'
	];

	protected $fillable = [
		'regid',
		'socityid',
		'memtype',
		'ondate'
	];
}
