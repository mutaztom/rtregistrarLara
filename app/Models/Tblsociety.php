<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblsociety
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $aritem
 * @property int|null $forfield
 * @property int|null $mainid
 *
 * @package App\Models
 */
class Tblsociety extends Model
{
	protected $table = 'tblsocieties';
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
