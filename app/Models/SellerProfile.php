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
        'verifikasi_wajah',
        'setuju_syarat',
        'status_verifikasi',
        'catatan_admin',
        'step_selesai',
        'verified_at',
    ];

    protected $casts = [
        'setuju_syarat'      => 'boolean',
        'verifikasi_wajah'   => 'boolean',
        'status_verifikasi'  => SellerVerificationStatus::class,
        'verified_at'        => 'datetime',
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

    public function isAktif(): bool
    {
        return $this->status_verifikasi === SellerVerificationStatus::Aktif;
    }

    public function currentStep(): int
    {
        return match ($this->status_verifikasi) {
            SellerVerificationStatus::Step1Done => 2,
            SellerVerificationStatus::Step2Done => 3,
            SellerVerificationStatus::Aktif     => 3,
            default                             => 1,
        };
    }

    public function step1Selesai(): bool
    {
        return in_array($this->status_verifikasi, [
            SellerVerificationStatus::Step1Done,
            SellerVerificationStatus::Step2Done,
            SellerVerificationStatus::Aktif,
        ]);
    }

    public function step2Selesai(): bool
    {
        return in_array($this->status_verifikasi, [
            SellerVerificationStatus::Step2Done,
            SellerVerificationStatus::Aktif,
        ]);
    }

    public function onboardingSelesai(): bool
    {
        return $this->status_verifikasi === SellerVerificationStatus::Aktif;
    }

    public function sudahDiverifikasi(): bool
    {
        return $this->status_verifikasi === SellerVerificationStatus::Aktif;
    }
}