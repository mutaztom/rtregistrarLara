<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tblspecialization;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tblqualification;
use App\Models\Tblregmembership;
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
 * @property int|null $idtype
 * @property int|null $idnumber
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
		'specialization',
		'idnumber',
		'idtype',
	];
	public function specialization_name() :HasOne{
		return $this->hasOne(Tblspecialization::class, 'id', 'specialization');
	}
	public function qualifications() :HasMany{
        return $this->hasMany(Tblqualification::class, 'empid', 'id');
    }
	public function memberships() :HasMany{
        return $this->hasMany(Tblregmembership::class, 'regid', 'id');
    }
}
