<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinHistory extends Model
{
    protected $table = 'ayune_coin_histories';

    protected $fillable = [
        'user_id',
        'jumlah',
        'tipe',
        'sumber',
        'keterangan',
        'saldo_sebelum',
        'saldo_sesudah',
    ];

    //RELASI
    public function user(){
        return $this->belongsTo(User::class);
        //satu user cmn punya satu riwayadddsss
    }
}
