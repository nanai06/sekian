<?php

namespace App\Enums;

enum StoreStatus: string
{
    case Active   = 'aktif';
    case Inactive = 'nonaktif';
    case Suspend  = 'suspend';
}
