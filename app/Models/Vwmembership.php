<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vwmembership
 * 
 * @property int|null $regid
 * @property Carbon|null $memdate
 * @property string|null $society
 * @property string|null $arsociety
 * @property string|null $membership
 * @property string|null $armembership
 *
 * @package App\Models
 */
class Vwmembership extends Model
{
	protected $table = 'vwmembership';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'regid' => 'int',
		'memdate' => 'datetime'
	];

	protected $fillable = [
		'regid',
		'memdate',
		'society',
		'arsociety',
		'membership',
		'armembership'
	];
}
