<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tblmembership;
use App\Models\Tblsociety;
use App\Models\Tblregistrant;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
	public function membership():HasOne{
		return $this->hasOne(Tblmembership::class, 'id', 'memtype');
	}
	public function society():HasOne{
        return $this->hasOne(Tblsociety::class, 'id', 'socityid');
    }
	public function registrant():HasOne{
        return $this->hasOne(Tblregistrant::class, 'id','regid');
    }
}
