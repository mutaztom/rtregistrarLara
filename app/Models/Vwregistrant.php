<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vwregistrant
 * 
 * @property int $id
 * @property Carbon|null $ondate
 * @property string|null $regname
 * @property string|null $item
 * @property string|null $email
 * @property int|null $regid
 * @property string|null $address
 * @property int|null $nationality
 * @property string|null $phone
 * @property string|null $photofile
 * @property int|null $job
 * @property int|null $birthplace
 * @property Carbon|null $birthdate
 * @property string|null $gender
 * @property bool|null $socityMember
 * @property string|null $hieducid
 * @property string|null $engcouncilid
 * @property string|null $cvfile
 * @property string|null $pwd
 * @property int|null $membership
 * @property int|null $engsociety
 * @property string|null $regnationality
 * @property string|null $regjob
 * @property string|null $regbirthplace
 * @property string|null $regmembership
 * @property string|null $regengsociety
 *
 * @package App\Models
 */
class Vwregistrant extends Model
{
	protected $table = 'vwregistrant';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'ondate' => 'datetime',
		'regid' => 'int',
		'nationality' => 'int',
		'job' => 'int',
		'birthplace' => 'int',
		'birthdate' => 'datetime',
		'socityMember' => 'bool',
		'membership' => 'int',
		'engsociety' => 'int'
	];

	protected $fillable = [
		'id',
		'ondate',
		'regname',
		'item',
		'email',
		'regid',
		'address',
		'nationality',
		'phone',
		'photofile',
		'job',
		'birthplace',
		'birthdate',
		'gender',
		'socityMember',
		'hieducid',
		'engcouncilid',
		'cvfile',
		'pwd',
		'membership',
		'engsociety',
		'regnationality',
		'regjob',
		'regbirthplace',
		'regmembership',
		'regengsociety'
	];
}
