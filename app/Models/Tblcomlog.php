<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblcomlog
 * 
 * @property int $id
 * @property string|null $address
 * @property string|null $status
 * @property Carbon|null $smstime
 * @property string|null $byuser
 * @property string|null $title
 * @property string|null $message
 * @property string|null $email
 *
 * @package App\Models
 */
class Tblcomlog extends Model
{
	protected $table = 'tblcomlog';
	public $timestamps = false;

	protected $casts = [
		'smstime' => 'datetime'
	];

	protected $fillable = [
		'address',
		'status',
		'smstime',
		'byuser',
		'title',
		'message',
		'email'
	];
}
