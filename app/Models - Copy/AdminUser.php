<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminUser
 * 
 * @property int $admin_user_id
 * @property string $admin_user_name
 * @property string $admin_user_pwd
 * @property string $admin_user_email
 * @property string $admin_user_phone
 * @property string $admin_user_mobile
 * @property Carbon $admin_user_doj
 * @property Carbon $admin_user_last_login
 * @property int $role_type_id
 *
 * @package App\Models
 */
class AdminUser extends Model
{
	protected $table = 'admin_user';
	protected $primaryKey = 'admin_user_id';
	public $timestamps = false;

	protected $casts = [
		'admin_user_doj' => 'datetime',
		'admin_user_last_login' => 'datetime',
		'role_type_id' => 'int'
	];

	protected $fillable = [
		'admin_user_name',
		'admin_user_pwd',
		'admin_user_email',
		'admin_user_phone',
		'admin_user_mobile',
		'admin_user_doj',
		'admin_user_last_login',
		'role_type_id'
	];
}
