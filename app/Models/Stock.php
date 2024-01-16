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
 * Class Stock
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $company_id
 * 
 * @property Company $company
 * @property Collection|Product[] $products
 * @property Collection|Tool[] $tools
 *
 * @package App\Models
 */
class Stock extends Model
{
	use SoftDeletes;
	protected $table = 'stock';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_has_stock')
					->withPivot('id', 'operation_type', 'quantity', 'last_qty', 'atual_qty', 'deleted_at', 'employer_id', 'operation_out_id')
					->withTimestamps();
	}

	public function tools()
	{
		return $this->belongsToMany(Tool::class, 'tools_has_stock', 'stock_id', 'tools_id')
					->withPivot('id', 'operation_type', 'quantity', 'last_qty', 'atual_qty', 'deleted_at', 'employer_id', 'operation_out_id')
					->withTimestamps();
	}
}
