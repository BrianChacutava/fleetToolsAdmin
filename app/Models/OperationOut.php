<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OperationOut
 * 
 * @property int $id
 * @property string|null $description
 * @property Carbon|null $initial_time
 * @property Carbon|null $finish_time
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $company_id
 * 
 * @property Company|null $company
 * @property Collection|ProductHasStock[] $product_has_stocks
 * @property Collection|ToolsHasStock[] $tools_has_stocks
 *
 * @package App\Models
 */
class OperationOut extends Model
{
	use SoftDeletes;
	protected $table = 'operation_out';

	protected $casts = [
		'initial_time' => 'datetime',
		'finish_time' => 'datetime',
		'company_id' => 'int'
	];

	protected $fillable = [
		'description',
		'initial_time',
		'finish_time',
		'status',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function product_has_stocks()
	{
		return $this->hasMany(ProductHasStock::class);
	}

	public function tools_has_stocks()
	{
		return $this->hasMany(ToolsHasStock::class);
	}
}
