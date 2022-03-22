<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\BloodTypeClient;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientGovernorate;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class AuthController extends Controller
{
    //
    public  function register(Request $request)
    {
        $validation=validator($request->all(),
        [
            'name'=>'required',
            'city_id'=>'required',
            'phone'=>'required',
            'email'=>'required|unique:clients',
            'd_o_b'=>'required',
            'password'=>'required|confirmed',
            'blood_type'=>'required|in:o+,O+,o-,A-,A+'
        ]
        );
        if($validation->fails()){
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }
        //The merge() method on the Collection does not modify the collection on which it was called. It returns a new collection with the new data merged in. You would need
        $request->merge(['password'=>bcrypt($request->password)]);  //to encrypt password in new password var not edit
        $client=Client::create($request->all());
        $client->api_token=Str::random(60);                   //to make api_token
        $client->save();
        return apiResponse(1,'تم الإضافة بنجاح',[
            'api_token'=>$client->api_token,  //not appear in client but before it
            'client'=>$client
        ]);

    }
    public function login(Request $request){
        $validation=validator($request->all(),
            [
                'phone'=>'required',
                'password'=>'required',
                ]);
        if($validation->fails()){
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }
        $client=Client::where('phone',$request->phone)->first();
        if($client) {
            if (Hash::check($request->password, $client->password)) //check hashed password
            {
                return apiResponse(1, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            }
            else {
                return apiResponse(0, 'لم يتم تسجيل الدخول');
            }
        }
    }
    public  function contactus(Request $request){
        $validation=validator($request->all(),
            [
                'name'=>'required',
                'phone'=>'required',
                'email'=>'required|unique:contactus',
                'subject'=>'required',
                'message'=>'required'

            ]
        );
        if($validation)
        {
            $contactus=Contact::create($request->all());
            $contactus->save();
            return apiResponse(1,'success',$contactus);

        }
        else
        {
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }



    }
    public function editprofile(Request $request,$id){

        $validation=validator($request->all(),
            [
                'name'=>'required',
                'city_id'=>'required',
                'phone'=>'required',
                'email'=>'required|unique:clients',
                'password'=>'required|confirmed',
                'blood_type'=>'required|in:o+,O+,o-,A-,A+'
            ]
        );
        if($validation->fails()){
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }
        $client=Client::find($id);
        $client->update($request->all());
        if($client)
        {
            return apiResponse(1,'updated',$client);
        }
        else{
            return $this->apiResponse(0,'not updated',$client);
        }


    }


    public function getSetting(Request $request,$id){
//        $rules=[
//            'blood_type_id'=>'required',
//            'client_id'=>'required'
//        ];
//        $validation=validator($request->all(),$rules);
//        if($validation->fails()){
//            return apiResponse(0,$validation->errors()->first(),$validation->errors());
//
//        }

        $client=Client::find($id);
        $bloodtype=BloodTypeClient::whereIn('id',$client)->get(); //whereIn :extract id from Client obj.
//        $blood=Client::select('blood_type')->where('id',$id)->get();
        return apiResponse(1,'this',$bloodtype);
        $governorate=ClientGovernorate::whereIn('id',$client)->get();
        $blood_type_governorate=['bloodTypeId:'=>$bloodtype,'GovernoratesId'=>$governorate];
        if($client){
            return apiResponse(1,'success',$blood_type_governorate);
        }

    }

}



















//$validation=validator($request->all(),$rules);
//$city_id=Client::select('city_id')->where('id',$id)->get();
//$governorate=City::whereIn('id',$city_id)->get();
//$blood=Client::select('blood_type')->where('id',$id)->get();
//$blood_govern=['bloodType'=>$blood,'governorate'=>$governorate];
