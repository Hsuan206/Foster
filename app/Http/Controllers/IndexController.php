<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\City;
use App\Category;
use App\Pet;
use App\Care;
class IndexController extends Controller
{

    public function create()
    {
        $cities = City::all();
        $categories = Category::all();
//        $pets = \DB::table('cares')
//                ->join('pets', 'cares.pet_id', '=', 'pets.id')
//                ->select('pets.*')
//                ->where('cares.is_foster', '=', 0)
//                ->get();
        $pets = Pet::whereNull('is_host')->get();
//        $pets = Pet::all();
        if(Auth::check()){
            return view('index', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 'user_id'=>Auth::user()->id]);
        }else {
            return view('index', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 'user_id'=>-1]);
        }
        
    }
    // 申請託管
    public function createFoster(Request $request)
    {
        $cares = new Care();
        $cares->user_id = Auth::user()->id;
        $cares->pet_id = $request->pet_id;
        $cares->experience = $request->experience;
        $cares->save();
    }
    // 搜尋頁面
    public function createSearch()
    {
          return view('search');
    }
    // 搜尋
    public function searchPet(Request $request)
    {
        $cities = City::all();
        $categories = Category::all();
        if(Auth::check()){
            $userID = Auth::user()->id;
        }else{
            $userID = -1;
        }
        // 0 為 all 地區或是類別
        if(($request->category == '0') and ($request->city != '0')) {
            $city = City::where('id','=',$request->city)->value('name');
            $pets = Pet::where('city_id','=',$request->city)
                        ->whereNull('is_host')
                        ->get();
            return view('search', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 
                                   'user_id'=>$userID, 'city'=>$city, 'category'=>'所有種類的動物']);
            
        }elseif(($request->category != '0') and ($request->city == '0')) {
            $category = Category::where('id','=',$request->category)->value('name');
            $pets = Pet::Where('category_id', '=', $request->category)
                        ->whereNull('is_host')
                        ->get();
            return view('search', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 
                                   'user_id'=>$userID, 'city'=>'所有地區', 'category'=>$category]);
            
        }elseif(($request->category == '0') and ($request->city == '0')) {
            
            $pets = Pet::whereNull('is_host')->get();
            return view('search', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 
                                   'user_id'=>$userID, 'city'=>'所有地區', 'category'=>'所有種類的動物']);
            
        }else {
            
            $city = City::where('id','=',$request->city)->value('name');
            $category = Category::where('id','=',$request->category)->value('name');
            $pets = Pet::where('category_id','=',$request->category)
                        ->where('city_id', '=', $request->city)
                        ->whereNull('is_host')
                        ->get();
            return view('search', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 
                                   'user_id'=>$userID, 'city'=>$city, 'category'=>$category]);
            
        }
//            //return view('search', ['cities'=>$cities, 'categories'=>$categories, 'pets'=>$pets, 'user_id'=>-1]);
//        }
    }
}