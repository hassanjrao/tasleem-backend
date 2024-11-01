<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\OTP as ResourcesOTP;
use App\Http\Resources\User as ResourcesUser;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function sendOTP(Request $request)
    {

        $request->validate([
            "country_code" => "required|int",
            "phone" => "required|numeric",
        ], [
            'country_code.required' => 'Country code is required',
            'phone.required' => 'Phone number is required',
        ]);

        $user = User::where('country_code', $request->country_code)
        ->where('phone', $request->phone)
        ->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 422);
        }

        if($user->is_verified){
            return response()->json([
                'message'=>'User already verified'
            ],422);
        }


        $otp = new OTP();
        $otp = $otp->generateOTP($request->country_code, $request->phone);

        $user=ResourcesUser::make($user);

        $data=[
            'user'=>$user
        ];



        if (config('app.env') == 'local' || config('app.env') == 'staging') {
            $data['otp'] = ResourcesOTP::make($otp);
        }

        return response()->json([
            'message' => 'OTP sent successfully',
            'data' => $data
        ], 200);
    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required|string',
            'country_code' => 'required|string',
            'phone'=> 'required|string',
        ]);

        $user=User::where('country_code',$request->country_code)->where('phone',$request->phone)->first();

        if($user){
            return response()->json([
                'message'=>'User with this phone number already exists'
            ],422);
        }

        $user=new User();

        $user->name=$request->name;
        $user->country_code=$request->country_code;
        $user->phone=$request->phone;
        // random password of 8 characters with digits and alphabets
        $password=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),1,8);
        $user->password=bcrypt($password);
        $user->save();

        $user=ResourcesUser::make($user);

        return response()->json([
            'message'=>'User registered successfully',
            'data'=>[
                'user'=>$user,
            ]
        ],200);
    }


    public function verifyUser(Request $request)
    {
        $request->validate([
            "country_code" => "required|int",
            "phone" => "required|numeric",
            "otp" => "required|numeric",
        ], [
            'country_code.required' => 'Country code is required',
            'phone.required' => 'Phone number is required',
            'otp.required' => 'OTP is required',
        ]);

        $otp = OTP::where('country_code', $request->country_code)
        ->where('phone', $request->phone)
        ->where('otp', $request->otp)
        ->where('is_active', true)
        ->where('expires_at', '>', now())
        ->first();

        if (!$otp) {
            return response()->json([
                'message' => 'Invalid OTP'
            ], 422);
        }

        $user = User::where('country_code', $request->country_code)
        ->where('phone', $request->phone)
        ->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 422);
        }

        $otp->is_active = false;
        $otp->save();

        $user->is_verified = true;
        $user->save();

        $user=ResourcesUser::make($user);

        return response()->json([
            'message' => 'User verified successfully',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }

}
