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
 * Class ProductGroup
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class ProductGroup extends Model
{
	use SoftDeletes;
	protected $table = 'product_group';

	protected $fillable = [
		'name',
		'description'
	];

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
