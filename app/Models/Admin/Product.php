<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

	protected $fillable = [
		'name',
		'category_id',
		'brand_id',
		'price',
		'price_discount',
		'price_lerver',	
		'quantity_available',
		'descreption',
		'is_deleted',
		'created_at',
		'updated_at',
		'short_descreption',
		'quantity_sale',
		'image',
	];
}
