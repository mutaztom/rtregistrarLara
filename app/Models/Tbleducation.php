<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tbleducation
 * 
 * @property int $id
 * @property string|null $item
 * @property string|null $aritem
 *
 * @package App\Models
 */
class Tbleducation extends Model
{
	protected $table = 'tbleducation';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'item',
		'aritem'
	];
}
