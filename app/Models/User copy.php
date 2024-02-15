<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $phone
 * @property string|null $location
 * @property string|null $about
 * @property string|null $remember_token
 * @property string|null $photo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $company_id
 * @property int|null $rule_id
 * @property int|null $employer_id
 *
 * @property Company|null $company
 * @property Employer|null $employer
 * @property Rule|null $rule
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use SoftDeletes;
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'company_id' => 'int',
		'rule_id' => 'int',
		'employer_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'phone',
		'location',
		'about',
		'remember_token',
		'photo',
		'company_id',
		'rule_id',
		'employer_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function employer()
	{
		return $this->belongsTo(Employer::class);
	}

	public function rule()
	{
		return $this->belongsTo(Rule::class);
	}
}
