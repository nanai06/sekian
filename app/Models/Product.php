<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'ayune_products';
    // model ini buat ayune ptofuk

    protected $fillable = [
        'user_id',
        'nama_produk',
        'kategori',
        'kondisi',
        'deskripsi',
        'harga',
        'foto',
        'status'
    ];
    //protek cmn ini kolom yg boleh diisii dr form gada kolom lain yg blh

    //relasi ke table user BELONG BBRTI SATU
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderItems(){
        return $this->hasMany(Order::class);
        //satu produk bisa masuk ke bnyk order (order tu udh co ya), nh logika
        //nya harusny satu doang kn preloved cmn ya jaga jaga aja jd bisa bnyk produk di co org
    }   

    public function carts(){
        return $this->hasMany(Cart::class);
        //satu produk bisa ada di bnyk kernjang
    }
}
