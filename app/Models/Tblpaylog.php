<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblpaylog
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $bank
 * @property Carbon|null $ondate
 * @property string|null $bankdate
 * @property bool|null $paystatus
 * @property float|null $amount
 * @property string|null $errordet
 * @property string|null $rrn
 * @property string|null $rpin
 *
 * @package App\Models
 */
class Tblpaylog extends Model
{
	protected $table = 'tblpaylog';
	public $timestamps = false;

	protected $casts = [
		'ondate' => 'datetime',
		'paystatus' => 'bool',
		'amount' => 'float'
	];

	protected $fillable = [
		'item',
		'bank',
		'ondate',
		'bankdate',
		'paystatus',
		'amount',
		'errordet',
		'rrn',
		'rpin'
	];
}
