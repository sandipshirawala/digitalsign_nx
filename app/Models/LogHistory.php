<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogHistory
 * 
 * @property int $log_history_id
 * @property int|null $document_id
 * @property int|null $form_id
 * @property string|null $log_history_action
 * @property string|null $log_name
 * @property string|null $log_email
 * @property Carbon|null $log_date_time
 * @property string|null $log_date_time_zone
 * @property string|null $log_ip_address
 * @property string|null $log_message
 * @property string|null $log_guid
 *
 * @package App\Models
 */
class LogHistory extends Model
{
	protected $table = 'log_history';
	protected $primaryKey = 'log_history_id';
	public $timestamps = false;

	protected $casts = [
		'document_id' => 'int',
		'form_id' => 'int',
		'log_date_time' => 'datetime'
	];

	protected $fillable = [
		'document_id',
		'form_id',
		'log_history_action',
		'log_name',
		'log_email',
		'log_date_time',
		'log_date_time_zone',
		'log_ip_address',
		'log_message',
		'log_guid'
	];
}
