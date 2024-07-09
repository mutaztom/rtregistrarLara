<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblpayment
 * 
 * @property int $id
 * @property string $item
 * @property string|null $type
 * @property float|null $amount
 * @property int|null $orderid
 * @property Carbon|null $ondate
 * @property string|null $receipt
 * @property bool $paid
 * @property string|null $rrn
 *
 * @package App\Models
 */
class Tblpayment extends Model
{
	protected $table = 'tblpayment';
	public $timestamps = false;

	protected $casts = [
		'amount' => 'float',
		'orderid' => 'int',
		'ondate' => 'datetime',
		'paid' => 'bool'
	];

	protected $fillable = [
		'item',
		'type',
		'amount',
		'orderid',
		'ondate',
		'receipt',
		'paid',
		'rrn'
	];
}
