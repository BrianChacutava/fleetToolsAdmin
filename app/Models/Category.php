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
 * Class Category
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $descriptio
 * @property int|null $level
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $company_id
 * 
 * @property Company $company
 * @property Collection|Employer[] $employers
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes;
	protected $table = 'category';

	protected $casts = [
		'level' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'name',
		'descriptio',
		'level',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function employers()
	{
		return $this->hasMany(Employer::class);
	}
}
