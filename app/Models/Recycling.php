<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recycling extends Model
{
    protected $table = 'ayune_recyclings';

    protected $fillable = [
       'user_id',
       'dropoff',
       'location_id',
       'jenis_kemasan',
       'jumlah',
       'foto_kemasan',
       'koin_didapat',
       'sudah_scan',
       'waktu_scan',
       'catatan',
       'status' 
    ];

    protected $casts = [
        'jenis_kemasan' => 'array',
        'sudah_scan' => 'boolean',
        'waktu_scan' => 'datetime'
    ];
    //casts berguna untuk ngubah formay database ke php krn db sama php beda fotmat
    //db nyimpen json krn php bacanya array cast in yg ngubahnya lh gt intinya
    // boolean disimpen 0/1 di db
    //datetime dsiimpen string di db

    //RELASI
    public function user(){
        return $this->belongsTo(User::class);
        //daur ulang pengajuan hany 1 user
    }

    public function dropoffLocation(){
        return $this->belongsTo(DropoffLocation::class);
        //pengajuan daur ulang hny bisa diajukan ke 1 lokasi 
    }
}
