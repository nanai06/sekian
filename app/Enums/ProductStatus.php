<?php

namespace App\Enums;

enum ProductStatus: string
{
    case Draft       = 'draft';
    case UnderReview = 'under_review';
    case Aktif       = 'aktif';
    case Nonaktif    = 'nonaktif';
    case Terjual     = 'terjual';

    public function label(): string
    {
        return match($this) {
            self::Draft       => 'Draft',
            self::UnderReview => 'Menunggu Review',
            self::Aktif       => 'Aktif',
            self::Nonaktif    => 'Nonaktif',
            self::Terjual     => 'Terjual',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Draft       => 'badge-secondary',
            self::UnderReview => 'badge-warning',
            self::Aktif       => 'badge-success',
            self::Nonaktif    => 'badge-danger',
            self::Terjual     => 'badge-info',
        };
    }
}