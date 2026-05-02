<?php

namespace App\Enums;

enum SellerVerificationStatus: string
{
    case Belum     = 'belum';
    case Step1Done = 'step1_done';
    case Step2Done = 'step2_done';
    case Aktif     = 'aktif';
    case Ditolak   = 'ditolak';

    // Alias yang dipakai oleh model
    public const Approved = self::Aktif;
}
