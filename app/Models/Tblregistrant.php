<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblregistrant
 * 
 * @property int $id
 * @property string|null $regname
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
 * @property Carbon|null $ondate
 * @property int|null $specialization
 *
 * @package App\Models
 */
class Tblregistrant extends Model
{
	protected $table = 'tblregistrant';
	public $timestamps = false;

	protected $casts = [
		'regid' => 'int',
		'nationality' => 'int',
		'job' => 'int',
		'birthplace' => 'int',
		'birthdate' => 'datetime',
		'socityMember' => 'bool',
		'membership' => 'int',
		'engsociety' => 'int',
		'ondate' => 'datetime',
		'specialization' => 'int'
	];

	protected $fillable = [
		'regname',
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
		'ondate',
		'specialization'
	];
}
