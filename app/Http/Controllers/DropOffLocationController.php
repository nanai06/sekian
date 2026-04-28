<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DropBox;

class DropOffLocationController extends Controller
{
    public function index()
    {
        $dropBoxes = DropBox::where('aktif', true)->get();
        return view('dropoff-lokasi', compact('dropBoxes'));
    }
}
