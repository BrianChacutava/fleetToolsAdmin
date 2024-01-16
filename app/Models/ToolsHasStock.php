<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ToolsHasStock
 * 
 * @property int $id
 * @property int $tools_id
 * @property int $stock_id
 * @property string|null $operation_type
 * @property string|null $quantity
 * @property string|null $last_qty
 * @property string|null $atual_qty
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $employer_id
 * @property int|null $operation_out_id
 * 
 * @property Employer $employer
 * @property OperationOut|null $operation_out
 * @property Stock $stock
 * @property Tool $tool
 *
 * @package App\Models
 */
class ToolsHasStock extends Model
{
	use SoftDeletes;
	protected $table = 'tools_has_stock';

	protected $casts = [
		'tools_id' => 'int',
		'stock_id' => 'int',
		'employer_id' => 'int',
		'operation_out_id' => 'int'
	];

	protected $fillable = [
		'tools_id',
		'stock_id',
		'operation_type',
		'quantity',
		'last_qty',
		'atual_qty',
		'employer_id',
		'operation_out_id'
	];

	public function employer()
	{
		return $this->belongsTo(Employer::class);
	}

	public function operation_out()
	{
		return $this->belongsTo(OperationOut::class);
	}

	public function stock()
	{
		return $this->belongsTo(Stock::class);
	}

	public function tool()
	{
		return $this->belongsTo(Tool::class, 'tools_id');
	}
}
