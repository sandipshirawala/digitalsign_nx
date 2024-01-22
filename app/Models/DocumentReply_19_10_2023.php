<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentReply
 * 
 * @property int $document_reply_id
 * @property int|null $document_id
 * @property int|null $form_id
 * @property string|null $form_title
 * @property string|null $form_file
 * @property string|null $document_reply_file
 * @property string|null $document_reply_file_original_name
 * @property Carbon|null $document_reply_date
 * @property string|null $document_reply_email
 *
 * @package App\Models
 */
class DocumentReply extends Model
{
	protected $table = 'document_reply';
	protected $primaryKey = 'document_reply_id';
	public $timestamps = false;

	protected $casts = [
		'document_id' => 'int',
		'form_id' => 'int',
		'document_reply_date' => 'datetime'
	];

	protected $fillable = [
		'document_id',
		'form_id',
		'form_title',
		'form_file',
		'document_reply_file',
		'document_reply_file_original_name',
		'document_reply_date',
		'document_reply_email'
	];
}
