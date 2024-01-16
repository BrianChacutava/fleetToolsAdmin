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
 * Class Company
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $acronym
 * @property string|null $email
 * @property string|null $adress
 * @property string|null $nuit
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $company_id
 * 
 * @property Company|null $company
 * @property Collection|Category[] $categories
 * @property Collection|Company[] $companies
 * @property Collection|Employer[] $employers
 * @property Collection|OperationOut[] $operation_outs
 * @property Collection|Product[] $products
 * @property Collection|Stock[] $stocks
 * @property Collection|Tool[] $tools
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Company extends Model
{
	use SoftDeletes;
	protected $table = 'company';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $fillable = [
		'name',
		'acronym',
		'email',
		'adress',
		'nuit',
		'logo',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function categories()
	{
		return $this->hasMany(Category::class);
	}

	public function companies()
	{
		return $this->hasMany(Company::class);
	}

	public function employers()
	{
		return $this->hasMany(Employer::class);
	}

	public function operation_outs()
	{
		return $this->hasMany(OperationOut::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function stocks()
	{
		return $this->hasMany(Stock::class);
	}

	public function tools()
	{
		return $this->hasMany(Tool::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
