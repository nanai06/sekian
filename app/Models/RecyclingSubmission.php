<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecyclingSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'drop_box_id',
        'foto_kemasan',
        'status',
        'koin_diberikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dropBox()
    {
        return $this->belongsTo(DropBox::class);
    }
}