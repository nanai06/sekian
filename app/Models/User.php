<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
        'no_hp',
        'foto_profil',
        'bio',
        'kota',
        'poin_eco',
        'rating_pembeli',
        'ayu_koin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'poin_eco' => 'integer',
            'rating_pembeli' => 'decimal:1',
        ];
    }

    // ==========================================
    // ACCESSOR PROFIL
    // Computed attributes buat halaman profil
    // ==========================================

    /**
     * Ambil 2 huruf inisial dari nama user
     * Contoh: "Ayu Cantik" → "AC"
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->name));
        $initials = strtoupper(substr($words[0], 0, 1));
        if (count($words) > 1) {
            $initials .= strtoupper(substr(end($words), 0, 1));
        }
        return $initials;
    }

    /**
     * Cek apakah user layak dapat badge "Eco Warrior"
     * Syarat: poin_eco >= 500
     */
    public function getIsEcoWarriorAttribute(): bool
    {
        return ($this->poin_eco ?? 0) >= 500;
    }

    /**
     * URL foto profil, fallback null jika belum ada
     * Di blade nanti dicek: kalau null tampilkan inisial
     */
    public function getFotoProfilUrlAttribute(): ?string
    {
        if ($this->foto_profil) {
            return Storage::url($this->foto_profil);
        }
        return null;
    }

    // ==========================================
    // RELASI
    // ==========================================

    //RELASI YG DITAMBAHIN MANUAL YG DI ATAS DISII SM LRVL BREEZE
    public function products(){
        return $this->hasMany(Product::class);
        //satu user punny bnyk produk ynk dijual
    }

    public function purchases(){
        return $this->hasMany(Order::class,'buyer_id');
        //stu user puny bnyk rowayat pembelian
    }

    public function sales(){
        return $this->hasMany(Order::class,'seller_id');
        //satu sller puny bnyk riwayat penjualan
    }

    public function recyclings(){
        return $this->hasMany(Recycling::class);
        //satu user bisa pny bnyk riwata daur ulang
    }

    public function coin(){
        return $this->hasOne(Coin::class);
        //satu user cmn punya stu saldo koin
    }

    public function coinHistories(){
        return $this->hasMany(CoinHistory::class);
        //satu user bisa punya bnyk histori koin, riwayat transaksi yg
        //berhbungan sm koin contoh lu punya transaksi nambah koin satu, koin kepake 2 gtu dh 
    }

    public function carts(){
        return $this->hasMany(Cart::class);
        //satu user bisa punya bnyk item di kranjank
    }

    public function cartAsSeller(){
        return $this->hasMany(Cart::class,'seller_id');
        //produk siapa ajh ynk ada di keranjang? jd seller tau ow brng gua ada di ni org
    }

    /**
     * Relasi ke tabel alamat (ayune_addresses)
     * Satu user bisa punya banyak alamat pengiriman
     */
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    /**
     * Ambil alamat utama user (is_primary = true)
     * Dipake di halaman profil buat nampilkan alamat
     */
    public function primaryAddress(){
        return $this->hasOne(Address::class)->where('is_primary', true);
    }

    public function isAdmin(){
        return $this->role == 'admin';
        //ngecek lu admin apa sosok tdk dikenal
    }
}



 //model:
//Bahasa teknisnya:
//Model adalah representasi dari tabel database dalam bentuk class PHP menggunakan Eloquent ORM.
// Bahasa mudahnya:
// database itu gudang. tabelnya itu rak-raknya.
// Model itu kyk petugas gudang untuk tiap rak:

