<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblcontact
 * 
 * @property int $id
 * @property string|null $address
 * @property Carbon|null $birthdate
 * @property string|null $city
 * @property string|null $country
 * @property string|null $EMail
 * @property string|null $facebook
 * @property string|null $fax
 * @property string|null $job
 * @property string|null $location
 * @property string|null $mobile
 * @property string|null $Name
 * @property string|null $Notes
 * @property string|null $otherPhone
 * @property int|null $ownerid
 * @property string|null $ownertype
 * @property string|null $Phone
 * @property string|null $website
 *
 * @package App\Models
 */
class Tblcontact extends Model
{
	protected $table = 'tblcontact';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'birthdate' => 'datetime',
		'ownerid' => 'int'
	];

	protected $fillable = [
		'address',
		'birthdate',
		'city',
		'country',
		'EMail',
		'facebook',
		'fax',
		'job',
		'location',
		'mobile',
		'Name',
		'Notes',
		'otherPhone',
		'ownerid',
		'ownertype',
		'Phone',
		'website'
	];
}
