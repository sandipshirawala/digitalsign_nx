<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * 
 * @property int $document_id
 * @property string|null $document_mode
 * @property string|null $document_form_files
 * @property string|null $document_email
 * @property string|null $document_message
 * @property Carbon|null $document_sent_date
 * @property string|null $document_status
 * @property string|null $doc_open
 * @property int|null $company_id
 *
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'document';
	protected $primaryKey = 'document_id';
	public $timestamps = false;

	protected $casts = [
		'document_sent_date' => 'datetime',
		'company_id' => 'int'
	];

	protected $fillable = [
		'document_mode',
		'document_form_files',
		'document_email',
		'document_message',
		'document_sent_date',
		'document_status',
		'doc_open',
		'company_id'
	];
}
