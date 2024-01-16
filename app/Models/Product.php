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
 * Class Product
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $make
 * @property string|null $model
 * @property string|null $description
 * @property string|null $reference_num
 * @property string|null $quantity
 * @property string|null $status
 * @property string|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $company_id
 * @property int|null $product_group_id
 * 
 * @property Company $company
 * @property ProductGroup|null $product_group
 * @property Collection|Stock[] $stocks
 *
 * @package App\Models
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'product';

	protected $casts = [
		'company_id' => 'int',
		'product_group_id' => 'int'
	];

	protected $fillable = [
		'name',
		'make',
		'model',
		'description',
		'reference_num',
		'quantity',
		'status',
		'active',
		'company_id',
		'product_group_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function product_group()
	{
		return $this->belongsTo(ProductGroup::class);
	}

	public function stocks()
	{
		return $this->belongsToMany(Stock::class, 'product_has_stock')
					->withPivot('id', 'operation_type', 'quantity', 'last_qty', 'atual_qty', 'deleted_at', 'employer_id', 'operation_out_id')
					->withTimestamps();
	}
}
