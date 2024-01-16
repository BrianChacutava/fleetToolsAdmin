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
 * Class ToolGroup
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $descricao
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Tool[] $tools
 *
 * @package App\Models
 */
class ToolGroup extends Model
{
	use SoftDeletes;
	protected $table = 'tool_group';

	protected $fillable = [
		'name',
		'descricao'
	];

	public function tools()
	{
		return $this->hasMany(Tool::class);
	}
}
