<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request) {
        //cek apkh user sdh logain
        if (!auth()->check()) {
            //blm login ya balik ke hl login, ntr kl udh dibalikin kesini
            return redirect()->route('login')
            ->with('message', 'Silahkan LogIn terlebih dahulu ya!');
        }
    }
}
