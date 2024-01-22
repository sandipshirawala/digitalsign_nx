<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocDecline
 * 
 * @property int $doc_decline_id
 * @property int|null $document_id
 * @property int|null $form_id
 * @property Carbon|null $doc_decline_date
 * @property string|null $doc_reply_ip
 * @property int|null $company_id
 *
 * @package App\Models
 */
class DocDecline extends Model
{
	protected $table = 'doc_decline';
	protected $primaryKey = 'doc_decline_id';
	public $timestamps = false;

	protected $casts = [
		'document_id' => 'int',
		'form_id' => 'int',
		'doc_decline_date' => 'datetime',
		'company_id' => 'int'
	];

	protected $fillable = [
		'document_id',
		'form_id',
		'doc_decline_date',
		'doc_reply_ip',
		'company_id'
	];
}
