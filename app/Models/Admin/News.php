<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	use HasFactory;

	protected $table = 'news';

	protected $fillable = [
		'title',
		'short_content',
		'content',
		'user_id',
		'is_deleted',
		'created_at',	
		'updated_at'	
	];
}
