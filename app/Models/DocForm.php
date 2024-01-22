<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocForm
 * 
 * @property int $doc_form_id
 * @property int|null $doc_id
 * @property int|null $form_id
 * @property int|null $company_id
 *
 * @package App\Models
 */
class DocForm extends Model
{
	protected $table = 'doc_form';
	protected $primaryKey = 'doc_form_id';
	public $timestamps = false;

	protected $casts = [
		'doc_id' => 'int',
		'form_id' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'doc_id',
		'form_id',
		'company_id'
	];
}
