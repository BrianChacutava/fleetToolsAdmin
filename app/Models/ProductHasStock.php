<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductHasStock
 * 
 * @property int $id
 * @property int $product_id
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
 * @property Product $product
 * @property Stock $stock
 *
 * @package App\Models
 */
class ProductHasStock extends Model
{
	use SoftDeletes;
	protected $table = 'product_has_stock';

	protected $casts = [
		'product_id' => 'int',
		'stock_id' => 'int',
		'employer_id' => 'int',
		'operation_out_id' => 'int'
	];

	protected $fillable = [
		'product_id',
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

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function stock()
	{
		return $this->belongsTo(Stock::class);
	}
}
