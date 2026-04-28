<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $table = 'ayune_coins';
    // model ini bwt table ayune coins

    protected $fillable = [
        'user_id',
        'saldo'
    ];
    //2 kolom yg bisa diisi sisanya dri lrvlnya

    //RELASI
    public function user(){
        return $this->belongsTo(User::class);
        //saldo hny dimiliki satu user ja
    }
}
