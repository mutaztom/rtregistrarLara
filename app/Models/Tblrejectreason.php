<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblrejectreason
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $aritem
 * @property string|null $forfield
 * @property int|null $mainid
 *
 * @package App\Models
 */
class Tblrejectreason extends Model
{
	protected $table = 'tblrejectreason';
	public $timestamps = false;

	protected $casts = [
		'mainid' => 'int'
	];

	protected $fillable = [
		'item',
		'aritem',
		'forfield',
		'mainid'
	];
}
