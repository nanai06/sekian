<?php

namespace App\Models;

use App\Enums\SellerVerificationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SellerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'tipe_penjual',
        'nama_ktp',
        'nik',
        'foto_ktp',
        'foto_selfie',
        'setuju_syarat',
        'status_verifikasi',
        'catatan_admin',
        'step_selesai',
    ];

    protected $casts = [
        'setuju_syarat'     => 'boolean',
        // Cast otomatis ke Enum — tidak perlu string manual lagi
        'status_verifikasi' => SellerVerificationStatus::class,
    ];

    // ── Relasi ──────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    // ── Helper ──────────────────────────────────────────────

    public function step1Selesai(): bool
    {
        return $this->step_selesai >= 1;
    }

    public function step2Selesai(): bool
    {
        return $this->step_selesai >= 2;
    }

    public function onboardingSelesai(): bool
    {
        return $this->step_selesai >= 3;
    }

    public function sudahDiverifikasi(): bool
    {
        return $this->status_verifikasi === SellerVerificationStatus::Approved;
    }
}