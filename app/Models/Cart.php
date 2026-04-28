<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'ayune_carts';

    protected $fillable = [
        'user_id',
        'product_id',
        'seller_id'
    ];

    //RELASI
    public function user(){
        return $this->belongsTo(User::class);
        //keranjang cmn dimiliki sm satu user
    }

    public function product(){
        return $this->belongsTo(Product::class);
        //keranjang ini berisi satu produk kl ada produk lain line baru
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
        //produk di keranjang ini dijual ole siapa 
    }  
}
