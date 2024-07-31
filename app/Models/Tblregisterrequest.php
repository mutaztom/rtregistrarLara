<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasOne;
use App\Models\Tblregclass;
use App\Models\Tblregdegree;
/**
 * Class Tblregisterrequest
 * 
 * @property int $id
 * @property string|null $item
 * @property int|null $ownerid
 * @property Carbon|null $ondate
 * @property string|null $rpin
 * @property int|null $regcat
 * @property int|null $regclass
 * @property string|null $status
 * @property string|null $workplace
 * @property int|null $job
 * @property bool|null $ecshared
 * @property string|null $esocnotes
 * @property string|null $esocstatus
 * @property string|null $esocdoc
 * @property string|null $esocuser
 * @property Carbon|null $esocdate
 * @property string|null $ecunion
 * @property string|null $unionsecretary
 * @property string|null $sciencesocity
 * @property string|null $socitysecretary
 * @property string|null $rejectreason
 * @property string|null $decision
 * @property string|null $secgencomments
 * @property Carbon|null $approvalDate
 * @property string|null $engcouncilNumber
 * @property string|null $meetingno
 * @property Carbon|null $meetingdate
 * @property string|null $committeecomment
 * @property bool|null $payed
 * @property string|null $byuser
 * @property string|null $onmachine
 * @property Carbon|null $modifydate
 * @property bool|null $noticed
 *
 * @package App\Models
 */
class Tblregisterrequest extends Model
{
	protected $table = 'tblregisterrequest';
	public $timestamps = false;

	protected $casts = [
		'ownerid' => 'int',
		'ondate' => 'datetime',
		'regcat' => 'int',
		'regclass' => 'int',
		'job' => 'int',
		'ecshared' => 'bool',
		'esocdate' => 'datetime',
		'approvalDate' => 'datetime',
		'meetingdate' => 'datetime',
		'payed' => 'bool',
		'modifydate' => 'datetime',
		'noticed' => 'bool'
	];

	protected $hidden = [
		'unionsecretary',
		'socitysecretary'
	];

	protected $fillable = [
		'item',
		'ownerid',
		'ondate',
		'rpin',
		'regcat',
		'regclass',
		'status',
		'workplace',
		'job',
		'ecshared',
		'esocnotes',
		'esocstatus',
		'esocdoc',
		'esocuser',
		'esocdate',
		'ecunion',
		'unionsecretary',
		'sciencesocity',
		'socitysecretary',
		'rejectreason',
		'decision',
		'secgencomments',
		'approvalDate',
		'engcouncilNumber',
		'meetingno',
		'meetingdate',
		'committeecomment',
		'payed',
		'byuser',
		'onmachine',
		'modifydate',
		'noticed'
	];
	public function regclass_name():hasOne{
		return $this->hasOne(Tblregclass::class, 'id','regclass');
	}
	public function regcat_name():hasOne{
        return $this->hasOne(Tblregdegree::class, 'id','regcat');
    }
}
