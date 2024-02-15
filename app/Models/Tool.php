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
 * Class Tool
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $make
 * @property string|null $model
 * @property string|null $reference_num
 * @property string|null $description
 * @property float|null $quantity
 * @property string|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $company_id
 * @property int|null $tool_group_id
 * @property string|null $photo
 * 
 * @property Company $company
 * @property ToolGroup|null $tool_group
 * @property Collection|Stock[] $stocks
 *
 * @package App\Models
 */
class Tool extends Model
{
	use SoftDeletes;
	protected $table = 'tools';

	protected $casts = [
		'quantity' => 'float',
		'active' => 'int',
		'company_id' => 'int',
		'tool_group_id' => 'int'
	];

	protected $fillable = [
		'name',
		'make',
		'model',
		'reference_num',
		'description',
		'quantity',
		'status',
		'active',
		'company_id',
		'tool_group_id',
		'photo'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function tool_group()
	{
		return $this->belongsTo(ToolGroup::class);
	}

	public function stocks()
	{
		return $this->belongsToMany(Stock::class, 'tools_has_stock', 'tools_id')
					->withPivot('id', 'operation_type', 'quantity', 'last_qty', 'atual_qty', 'deleted_at', 'employer_id', 'operation_out_id')
					->withTimestamps();
	}
}
