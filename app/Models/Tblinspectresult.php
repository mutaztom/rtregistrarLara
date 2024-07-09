<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblinspectresult
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $aritem
 * @property string|null $forfield
 * @property int|null $mainid
 *
 * @package App\Models
 */
class Tblinspectresult extends Model
{
	protected $table = 'tblinspectresults';
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
