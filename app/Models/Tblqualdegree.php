<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblcity
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $aritem
 * @property int|null $forfield
 * @property int|null $mainid
 *
 * @package App\Models
 */
class Tblqualdegree extends Model
{
	protected $table = 'Tblqaldegree';
	public $timestamps = false;

	protected $casts = [
		'forfield' => 'int',
		'mainid' => 'int'
	];

	protected $fillable = [
		'item',
		'aritem',
		'forfield',
		'mainid'
	];
}
