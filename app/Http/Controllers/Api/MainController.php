<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Element;

class MainController extends Controller
{
    public function apiResponse($status,$message,$data=null)
    {
        $response=[
            'status'=> $status,
            'message'=>$message,
            'data'=>$data
        ];
        //The response: function creates a response instance or obtains an instance of the response factory:
        //The json :method will automatically set the Content-Type header to application/json:
        return response()->json($response);

    }

    public function governorates(){
        $governorates=Governorate::all();
        return $this->apiResponse(1,'success',$governorates);

}
    public function posts(){
        $posts=Post::all();
        return $this->apiResponse(1,'success',$posts);


    }
//    public function getnotific($id=6){
//       $city_id=Client::select('city_id')->where('id',$id)->get();
//       $governorate=City::whereIn('id',$city_id)->get();
//       $blood=Client::select('blood_type')->where('id',$id)->get();
//       $blood_govern=['bloodType'=>$blood,'governorate'=>$governorate];
//       return $this->apiResponse(1,'success',$blood_govern);
//
//    }


public function cities(Request $request){
        $cities=City::WHERE('governorate_id',$request->governorate_id)->get();
        return $this->apiResponse(1,'success',$cities);
}
public function setting(Request $request){
        $setting=Setting::first();
        return $this->apiResponse(1,'success',$setting);
}
public function bloodType(Request $request){
        $blood_type=BloodType::all();
        return $this->apiResponse(1,'success',$blood_type);
}
public function categories(){
        $categories=Category::all();
        return $this->apiResponse(1,'success',$categories);
}



}
