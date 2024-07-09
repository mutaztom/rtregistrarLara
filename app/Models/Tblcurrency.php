<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblcurrency
 * 
 * @property int $id
 * @property float|null $fraction
 * @property bool|null $isMain
 * @property string|null $item
 * @property string|null $name
 * @property float|null $rate
 * @property string|null $shortName
 * @property string|null $symbol
 *
 * @package App\Models
 */
class Tblcurrency extends Model
{
	protected $table = 'tblcurrency';
	public $timestamps = false;

	protected $casts = [
		'fraction' => 'float',
		'isMain' => 'bool',
		'rate' => 'float'
	];

	protected $fillable = [
		'fraction',
		'isMain',
		'item',
		'name',
		'rate',
		'shortName',
		'symbol'
	];
}
