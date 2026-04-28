<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'ayune_order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'seller_id',
        'harga',
    ];

    //RELASI
    public function order(){
        return $this->belongsTo(Order::class);
        //barang ini punya satu order item pupui masuk ke order #1
    }

    public function product(){
        return $this->belongsTo(Product::class);
        //item ini adalh satu produk cth item A adalah pupui
        //bisa akses nama, foto desc dll
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
        //item ni di jual  sape?
    }

}
