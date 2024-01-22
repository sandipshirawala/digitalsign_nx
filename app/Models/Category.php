<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $category_id
 * @property string|null $category_name
 * @property string|null $category_status
 * @property string|null $category_description
 * @property int|null $category_sort_order
 * @property int|null $company_id
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'category_id';
	public $timestamps = false;

	protected $casts = [
		'category_sort_order' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'category_name',
		'category_status',
		'category_description',
		'category_sort_order',
		'company_id'
	];
}
