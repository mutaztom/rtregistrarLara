<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vwregisterrequest
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
 * @property string|null $committeecomment
 * @property string|null $meetingno
 * @property Carbon|null $meetingdate
 * @property bool|null $payed
 * @property string|null $regname
 * @property string|null $engclass
 * @property string|null $arengclass
 * @property string|null $engdegree
 * @property string|null $arengdegree
 * @property string|null $regjob
 * @property string|null $byuser
 * @property string|null $onmachine
 * @property Carbon|null $modifydate
 *
 * @package App\Models
 */
class Vwregisterrequest extends Model
{
	protected $table = 'vwregisterrequest';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
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
		'modifydate' => 'datetime'
	];

	protected $hidden = [
		'unionsecretary',
		'socitysecretary'
	];

	protected $fillable = [
		'id',
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
		'committeecomment',
		'meetingno',
		'meetingdate',
		'payed',
		'regname',
		'engclass',
		'arengclass',
		'engdegree',
		'arengdegree',
		'regjob',
		'byuser',
		'onmachine',
		'modifydate'
	];
}
