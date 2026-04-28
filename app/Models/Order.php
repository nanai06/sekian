<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'ayune_orders';
    //utk tsble ap ne

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'alamat_pengiriman',
        'metode_pengiriman',
        'total_harga',
        'koin_digunakan',
        'diskon',
        'total_bayar',
        'bukti_pembayaran',
        'catatan',
        'status'
    ];
    // kolom ynk cmn blh diisi dr form ntr, kolom products id masukny di order_items

    //RELASI
    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id');
        //cmn dimilikin oleh satu pembeliy
        //buyer id krn di order ada 2 user
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
        //cmmn dikilikin sm satu penjual
        //ngasi tau lrvel kl mke sleer kl manual ntr gedebak gebebuk servernya
    }

    public function orderItems(){
        return $this->belongsTo(OrderItem::class);
        //pesanan ini cmn untuk satu produk kan tiap pesanan punya nomro unikny masing"
    }
    
}
