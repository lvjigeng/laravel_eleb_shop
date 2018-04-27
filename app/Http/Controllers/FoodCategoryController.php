<?php

namespace App\Http\Controllers;

use App\Model\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodCategoryController extends Controller
{

    //没登录什么都不能操作
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }
    //添加分类页面
    public function create()
    {
        return view('foodCategory/create');
    }
    //添加分类保存
    public  function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'description'=>'required',
        ],[
            'name.required'=>'分类名字不能为空',
            'name.max'=>'分类名字不能超过十个字',
            'description'=>'描述不能为空',
        ]);
        //保存
        $foodCategory=FoodCategory::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'is_selected'=>true,
        'shop_detail_id'=>Auth::user()->id
        ]);
        //
        DB::table('food_categories')
            ->where('id','<>',$foodCategory->id)
            ->update(['is_selected'=>false]);
        //修改分类组c1,c2
        $foodCategory
            ->where('id',$foodCategory->id)
            ->update(['type_accumulation'=>'c'.$foodCategory->id]);

        //保存成功提示
        session()->flash('success','添加成功');
        return redirect()->route('foodCategory.index');
    }
    //食物分类列表
    public function index()
    {
        $foodCategories=FoodCategory::where('shop_detail_id',Auth::user()->id)->get();
        return view('foodCategory/index',compact('foodCategories'));
    }
    //食物分类修改表单
    public function edit(FoodCategory $foodCategory)
    {
        return view('foodCategory/edit',compact('foodCategory'));
    }
    //修改食物分类保存
    public function update(Request $request,FoodCategory $foodCategory)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'description'=>'required',
        ],[
            'name.required'=>'分类名字不能为空',
            'name.max'=>'分类名字不能超过十个字',
            'description'=>'描述不能为空',
        ]);
        //保存
        $foodCategory
            ->where('id',$foodCategory->id)
            ->where('shop_detail_id',Auth::user()->id)
            ->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
            ]);
          DB::table('food_categories')
              ->where('id','<>',$foodCategory->id)
              ->update(['is_selected'=>!$request->is_selected]);
        //提示
        session()->flash('success','修改成功');
        return redirect()->route('foodCategory.index');
    }
    //删除分类
    public function destroy(FoodCategory $foodCategory)
    {
        $foodCategory->delete();
        echo 'success';
    }

}
