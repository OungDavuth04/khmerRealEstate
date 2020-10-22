<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\PasswordReset;
use App\User;
use http\Env\Response;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    public function ChangePassword(Request $request){
        $user = Auth::guard('api')->user();
        //Changing the password only if is different of null
            //checking the old password first
            $check  = Auth::guard('web')->attempt([
                'email' => $user->email,
                'password' => $request->CurrentPass
            ]);
            if($check){
                if($request->NewPass == $request->RetypePass){
                    $user = User::find($request->user_id);
                    $user->password = bcrypt($request->NewPass);
                    $user->save();
                    return response()->json(['Message'=>'Changed'],200);
                }else{
                    return response()->json(['Message'=>'Password Not Match']);
                }
            }else{
                return response()->json(["Message"=>"Your Password was inCorrect!"]);
            }

    }
    public function sendToken(Request $request){
        $user = User::where('email', $request->email)->first();
        $token = Str::random(40);
        Mail::to($user->email)->send(new ResetPasswordEmail($token));
        PasswordReset::create([
            'email' =>$user->email,
            'token' => $token
        ]);
//        $PasswordReset = new PasswordReset();
//        $PasswordReset->email = $user->email;
//        $PasswordReset->token = $token;
//        $PasswordReset->save();
        return response()->json(['Message' => 'Token Has Sending To Email']);
    }

    public function validateToken(Request $request){
        $PasswordReset = PasswordReset::where('token',$request->token)->first();
        if(empty($PasswordReset)){
            return response()->json(['error'=> 'Invalid Token'],401);
        }
        $user = User::where('email',$PasswordReset->email)->first();
        return response()->json($user);
    }

    public function resetPassword(Request $request){
        $user = User::find($request->user_id);
        $passwordReset = PasswordReset::where('email',$user->email)->first();
        $passwordReset->delete();
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['Success']);
    }


}
