<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblengdegree
 * 
 * @property int $id
 * @property string $item
 * @property int|null $mainid
 * @property string|null $aritem
 * @property int|null $forfield
 *
 * @package App\Models
 */
class Tblengdegree extends Model
{
	protected $table = 'tblengdegree';
	public $timestamps = false;

	protected $casts = [
		'mainid' => 'int',
		'forfield' => 'int'
	];

	protected $fillable = [
		'item',
		'mainid',
		'aritem',
		'forfield'
	];
}
