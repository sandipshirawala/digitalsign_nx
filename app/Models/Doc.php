<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doc
 * 
 * @property int $doc_id
 * @property string|null $doc_title
 * @property string|null $doc_email
 * @property Carbon|null $doc_sent_date
 * @property string|null $doc_status
 * @property string|null $doc_open
 * @property int|null $company_id
 *
 * @package App\Models
 */
class Doc extends Model
{
	protected $table = 'doc';
	protected $primaryKey = 'doc_id';
	public $timestamps = false;

	protected $casts = [
		'doc_sent_date' => 'datetime',
		'company_id' => 'int'
	];

	protected $fillable = [
		'doc_title',
		'doc_email',
		'doc_sent_date',
		'doc_status',
		'doc_open',
		'company_id'
	];
}
