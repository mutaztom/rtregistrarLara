<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblexpense
 * 
 * @property int $id
 * @property bool|null $active
 * @property int|null $currency
 * @property string|null $exptype
 * @property string|null $formula
 * @property string|null $item
 * @property bool|null $localCurrency
 * @property int|null $owner
 * @property bool|null $persent
 * @property string|null $refference
 * @property bool|null $taxable
 * @property float|null $taxamount
 * @property float|null $val
 *
 * @package App\Models
 */
class Tblexpense extends Model
{
	protected $table = 'tblexpense';
	public $timestamps = false;

	protected $casts = [
		'active' => 'bool',
		'currency' => 'int',
		'localCurrency' => 'bool',
		'owner' => 'int',
		'persent' => 'bool',
		'taxable' => 'bool',
		'taxamount' => 'float',
		'val' => 'float'
	];

	protected $fillable = [
		'active',
		'currency',
		'exptype',
		'formula',
		'item',
		'localCurrency',
		'owner',
		'persent',
		'refference',
		'taxable',
		'taxamount',
		'val'
	];
}
