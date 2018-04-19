<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Sodium\crypto_box_publickey_from_secretkey;

class ShopDetailController extends Controller
{
    //
    public function index()
    {
        return view('shopDetail/index');
    }
}
