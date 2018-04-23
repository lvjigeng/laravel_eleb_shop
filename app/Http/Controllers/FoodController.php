<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use OSS\Core\OssException;

class FoodController extends Controller
{
    //没登录什么都不能操作
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }
    //食品添加
    public function create()
    {
        $foodCategories=FoodCategory::where('shop_detail_id',Auth::user()->id)->get();
        return view('food/create',compact('foodCategories'));
    }
    //添加保存
    public function store(Request $request)
    {
            $this->validate($request,[
               'name'=>'required|max:20',
                'price'=>'required',
                'food_img'=>'required',
                'tips'=>'required|max:100',
            ],[
                'name.required'=>'名字不能为空',
                'name.max'=>'名字过长',
                'price.required'=>'价格不能为空',
                'tips.required'=>'描述不能为空',
                'food_img.required'=>'请上传图片',
            ]);
            //保存图片

            Food::create([
                'name'=>$request->name,
                'price'=>$request->price,
                'tips'=>$request->tips,
                'food_img'=>$request->food_img,
                'food_category_id'=>$request->food_category_id,
                'shop_detail_id'=>Auth::user()->id,
            ]);
            //提示
            session()->flash('success','添加成功');
            return redirect()->route('food.index');
    }
    //
    public function index()
    {
//        $quires=$request->query();

        $foods=Food::where('shop_detail_id',Auth::user()->id)->get();
        return view('food/index',compact('foods'));

    }
    //修改
    public function edit(Food $food)
    {
        $foodCategories=FoodCategory::where('id',Auth::user()->id)->get();
        return view('food/edit',compact('food','foodCategories'));
    }
    //修改保存
    public function update(Request $request,Food $food)
    {
        $this->validate($request,[
            'name'=>'required|max:20',
            'price'=>'required',
            'tips'=>'required|max:100',

        ],[
            'name.required'=>'名字不能为空',
            'name.max'=>'名字过长',
            'price.required'=>'价格不能为空',
            'tips.required'=>'描述不能为空',

        ]);
        //保存
        $food->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'tips'=>$request->tips,
            'food_img'=>$request->food_img,
            'food_category_id'=>$request->food_category_id,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('food.index');
    }
    //删除
    public function destroy(Food $food)
    {

        $food->delete();
        echo 'success';
    }

}
