<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\City;
use App\Category;
use App\Pet;
use App\Care;
use File;
class CareController extends Controller
{
    // --------------------- 寄養相關 --------------------------
    public function showForm()
    {
        if(Auth::check()){
            $cities = City::all();
            $categories = Category::all();
            return view('apply', ['cities'=>$cities, 'categories'=>$categories]);
        }else {
            return view('auth/login');
        }
    }
    
    // 假設只能一次寄養一隻動物
    public function createCareForm(Request $request){
        try {
            $pets = new Pet();
            $pets->user_id = Auth::user()->id;
            $pets->city_id = $request->city;
            $pets->category_id = $request->category;
            $pets->name = $request->name;
            $pets->color = $request->color;
            $pets->age = $request->age;
            $pets->personality = $request->personality;

            $this->validate($request, [
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->img->getClientOriginalExtension();
            $request->img->move(public_path('pet_img'), $imageName);

            $pets->img_url= $imageName;
            $pets->save();
            return redirect('/'); //回首頁
        } catch(Exception $e) {
            
            return view('/apply');
        }
    }
    public function userPetList(){
        
        # 判斷使否已經登入
        if(Auth::check()){
            # model 跟 DB 拿資料
            $pets = Pet::where('user_id', '=', Auth::user()->id)->get();
            return view('care', ['pets'=>$pets]);
        }
        else{
            
            # 返回登入
            return view('auth.login');
        }
        
    }
        
    public function applicantList(Pet $pet){
    //Article為Modle中的class, 就像是int $article, 這邊的$article是變數
       //$comments = Comment::paginate(3);
       //$comments = Comment::where('article_id','=',$article->id)->get();
//       foreach ($comments as $comment) {
//           $comment->username = User::find($comment->user_id)->name;
//           // find直接用來找pk(唯一值), 從comment的Model中取'user_id', 找到user_id後再去User的Model中取name
//           $date = date_format($comment->created_at, 'Y-m-d');
//           // 取整段created_at中的日期, single中的foreach會使用到
//           $time = date_format($comment->created_at, 'g:i A');
//           // 取整段created_at中的時間, single中的foreach會使用到
//           $comment->date = $date;
//           $comment->time = $time;
//       }
        
        $users = \DB::table('cares')
                ->join('users', 'cares.user_id', '=', 'users.id')
                ->select('users.*', 'cares.*')
                ->where('cares.pet_id', '=', $pet->id)
                ->get();
        return view('applicant', ['users' => $users]);
 
    }
    public function updateFoster(Pet $pet, Request $request){
        try {
            $care = Care::where('id',$request->id);
            $care->update(['is_foster'=>"1"]);
            
            $foster = Care::where('id',$request->id)->first();
            $other = Care::where('pet_id', '=', $foster->pet_id)->Where('user_id', '!=', $foster->user_id);
            $other->update(['is_foster'=>"-1"]);
            
//            $pet = Pet::where('id',$pet->id);
            $pet->update(['is_host'=>"1"]);
        } catch(Exception $e) {
            
            return view('/');
        }
    }
    // --------------------- 託管相關 --------------------------
    
    // 顯示申請的託管紀錄 
    public function showFoster()
    {
        # 判斷使否已經登入
        if(Auth::check()){
            # model 跟 DB 拿資料
            $pets = \DB::table('cares')
                    ->join('pets', 'cares.pet_id', '=', 'pets.id')
                    ->select('pets.*', 'cares.*')
                    ->where('cares.user_id', '=', Auth::user()->id)
                    ->get();
//            $pets = Care::where('user_id', '=', Auth::user()->id)->get();
            return view('foster', ['pets'=>$pets]);
        }
        else{
            
            # 返回登入
            return view('auth.login');
        }
    }
    // 顯示申請的託管紀錄 
    public function deleteFoster(Request $request)
    {
        // 取得是哪一個要刪除
        $care = Care::where('id',$request->id);
        // 刪除
        $care->delete();
    }
}