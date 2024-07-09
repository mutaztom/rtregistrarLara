<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tbloption
 * 
 * @property int $id
 * @property string|null $forfield
 * @property string|null $item
 *
 * @package App\Models
 */
class Tbloption extends Model
{
	protected $table = 'tbloption';
	public $timestamps = false;

	protected $fillable = [
		'forfield',
		'item'
	];
}
