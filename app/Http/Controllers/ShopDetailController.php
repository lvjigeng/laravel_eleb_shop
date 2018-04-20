<?php

namespace App\Http\Controllers;

use App\Model\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\crypto_box_publickey_from_secretkey;

class ShopDetailController extends Controller
{
    //
    public function index(ShopDetail $shopDetail)
    {

        $id=Auth::user()->id;
        $shopDetail=ShopDetail::find($id);
        return view('shopDetail/index',compact('shopDetail'));
    }
}
