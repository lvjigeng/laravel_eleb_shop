<?php

namespace App\Http\Controllers;

use App\Model\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth', [
            'except' => ['welcome']
        ]);

        $this->middleware('guest', [
            'only' => ['welcome']
        ]);


    }

    public function index()
    {

      return view('index/index',compact('foodCategories'));
    }
    public function welcome()
    {
        return view('index/welcome');
    }
}
