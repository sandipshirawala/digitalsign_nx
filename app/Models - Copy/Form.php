<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Form
 * 
 * @property int $form_id
 * @property string|null $form_title
 * @property string|null $form_file
 * @property Carbon|null $form_created_date
 * @property string|null $form_status
 * @property string|null $category_id
 *
 * @package App\Models
 */
class Form extends Model
{
	protected $table = 'form';
	protected $primaryKey = 'form_id';
	public $timestamps = false;

	protected $casts = [
		'form_created_date' => 'datetime'
	];

	protected $fillable = [
		'form_title',
		'form_file',
		'form_created_date',
		'form_status',
		'category_id'
	];
}
