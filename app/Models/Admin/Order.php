<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   	protected $table = 'orders';

	protected $fillable = [
		'user_id',
		'phone',
		'address',
		'user_id',
		'order_date',
		'status_id',
		'created_at',	
		'updated_at'	
	];


	 public function orderdetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }
}

