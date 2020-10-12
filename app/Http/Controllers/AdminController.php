<?php

namespace App\Http\Controllers;

use App\FeaturAd;
use App\Upload;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function exportExcel(){
       $export = FeaturAd::all();
        return response()->json($export);
    }

    public function test(){

       return response()->json(['GG']);
    }


    public function EstatePromoted(){
        $get = FeaturAd::all();
        return response()->json($get);
    }
    public function DeletePromote($id){
        $get = FeaturAd::where('promoteId',$id)->delete();
        return response()->json(['Deleted']);
    }

    public function disablepro($id,$disable){
        Upload::where('UpId',$id)->update([
            'disable' => $disable
        ]);

        if ($disable == 'true'){
            return response()->json(['This Real Estate Has UnDisable.....']);
        }else{
            return response()->json(['This Real Estate Has Disabled.....']);
        }
    }
    public function disablePromote($id,$disable){
        FeaturAd::where('promoteId',$id)->update([
            'disable' => $disable
        ]);

        if ($disable == 'true'){
            return response()->json(['This Real Estate Has UnDisable.....']);
        }else{
            return response()->json(['This Real Estate Has Disabled.....']);
        }
    }
    public function deletepro($id){
        Upload::where('UpId',$id)->delete();
        return response()->json(['This Real Estate Has Been delete!!!!']);
    }


    public function estatelist(){
        $upload = Upload::orderBy('UpId', 'desc')->get();
        return response()->json($upload);
    }
    public function DeleteUser($id){
        User::where('id',$id)->delete();
       return response()->json(['Deleted']);
    }
    public function UserList(){
        $user = User::all();
        return response()->json($user );
    }
    public function disable($id,$disable){
        User::where('id',$id)->update([
            'disable' => $disable
        ]);
        return response()->json($disable);
    }
}
