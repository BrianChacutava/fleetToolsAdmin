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
 * Class Employer
 * 
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $identification_num
 * @property string|null $identification_type
 * @property string|null $adress
 * @property string|null $phone1
 * @property string|null $phone2
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $category_id
 * @property int $company_id
 * @property string|null $bage_number
 * 
 * @property Category $category
 * @property Company $company
 * @property Collection|ProductHasStock[] $product_has_stocks
 * @property Collection|ToolsHasStock[] $tools_has_stocks
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Employer extends Model
{
	use SoftDeletes;
	protected $table = 'employer';

	protected $casts = [
		'category_id' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'identification_num',
		'identification_type',
		'adress',
		'phone1',
		'phone2',
		'category_id',
		'company_id',
		'bage_number'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

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

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
