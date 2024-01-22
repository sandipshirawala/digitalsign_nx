<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * 
 * @property int $company_id
 * @property string|null $company_name
 * @property string|null $company_email
 * @property string|null $company_phone
 * @property string|null $company_password
 * @property Carbon|null $company_doj
 * @property string|null $company_status
 *
 * @package App\Models
 */
class Company extends Model
{
	protected $table = 'company';
	protected $primaryKey = 'company_id';
	public $timestamps = false;

	protected $casts = [
		'company_doj' => 'datetime'
	];

	protected $hidden = [
		'company_password'
	];

	protected $fillable = [
		'company_name',
		'company_email',
		'company_phone',
		'company_password',
		'company_doj',
		'company_status'
	];
}
