<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblsystemoption
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $tblname
 * @property int|null $defoption
 * @property string|null $aritem
 *
 * @package App\Models
 */
class Tblsystemoption extends Model
{
	protected $table = 'tblsystemoption';
	public $timestamps = false;

	protected $casts = [
		'defoption' => 'int'
	];

	protected $fillable = [
		'item',
		'tblname',
		'defoption',
		'aritem'
	];
}
