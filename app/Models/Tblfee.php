<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
/**
 * Class Tblfee
 * 
 * @property int $id
 * @property string|null $item
 * @property int|null $regclass
 * @property Carbon|null $ondate
 * @property string|null $byuser
 * @property bool|null $active
 * @property int|null $regdegree
 * @property float|null $amount
 *
 * @package App\Models
 */
class Tblfee extends Model
{
	protected $table = 'tblfees';
	public $timestamps = false;

	protected $casts = [
		'regclass' => 'int',
		'ondate' => 'datetime',
		'active' => 'bool',
		'regdegree' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'item',
		'regclass',
		'ondate',
		'byuser',
		'active',
		'regdegree',
		'amount'
	];
	public function regclass_name():HasOne{
		return $this->hasOne(Tblengclass::class, 'id','regclass');
	}
	public function regdegree_name():HasOne{
        return $this->hasOne(Tblengdegree::class, 'id','regdegree');
    }
}
