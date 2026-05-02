<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DropoffLocation extends Model
{
    protected $table = 'dropoff_locations';

    protected $fillable = [
        'nama_lokasi',
        'alamat',
        'kota',
        'jenis_kemasan_diterima',
        'qr_code',
        'foto_lokasi',
        'is_active',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'jenis_kemasan_diterima' => 'array',
        'is_active' => 'boolean'
    ];

    //RELASO
    public function Recyclings(){
        return $this->hasMany(Recycling::class);
        //satu lokasi puny bnyk pengajuan daur ulang
    }
}
