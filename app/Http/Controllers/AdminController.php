<?php

namespace App\Http\Controllers;

use App\FeaturAd;
use App\Upload;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function paymentlist($search){

        return response()->json($search);
    }

    public function Dashboard(){
        $upload = Upload::all();
        $user = User::all();
        $amount = FeaturAd::all();
        foreach ($amount as $value){
            $total = $value->price / 100;
        }
        $data = new store();
        $data->allEstate = $upload->count();
        $data->allUser = $user->count();
        $data->allAmount = $amount->count() * $total;
        $data->allPromoted =  $amount->count();
        return response()->json($data);
    }
    public function exportExcel(Request $request){
       if( $request->filter == null){
            if($request->select == 'DailyReport'){
                $yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-1,date("Y")));
                $export = FeaturAd::where('created_at','like', '%' . $yesterday . '%')->get();
            }else if($request->select == 'WeekReport'){
                $week = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-7,date("Y")));
                $export = FeaturAd::where('created_at','like','%' . $week . '%')->get();
            }
        }else{
           $export = FeaturAd::where('created_at','like','%' . $request->filter . '%')->get();
       }
        return response()->json($export);
    }

    public function test(){
        $delete = User::where('id', 1)->get();
        foreach ($delete as $remove){
            $gg = $remove->profile;
            $getImageNameOnly = explode('/', $remove->profile);
            Storage::delete("/public/profile/".$getImageNameOnly[2]);
        }
       return response()->json($gg);
    }
    public function EstatePromoted($search){
        $get = FeaturAd::where('UpId', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhere('day', 'like', '%' . $search . '%')
            ->orWhere('expire', 'like', '%' . $search . '%')
            ->orWhere('viewer', 'like', '%' . $search . '%')->get();;
        return response()->json($get);
    }
    public function DeletePromote($id){
        $get = FeaturAd::where('promoteId',$id)->delete();
        return response()->json(['Deleted']);
    }

    public function disablepro($id,$disable){

        if ($disable == 'true'){
            $user = Upload::find($id);
            $user->disable = 'false';
            $user->save();
            return response()->json(['message'=>'This Real Estate Has Disabled .....']);
        }else{
            $user = Upload::find($id);
            $user->disable = 'true';
            $user->save();
            return response()->json(['message'=>'This Real Estate Has UnDisable.....']);
        }
    }
    public function disablePromote($id,$disable){
        if ($disable == 'true'){
            $user = FeaturAd::find($id);
            $user->disable = 'false';
            $user->save();
            return response()->json(['message'=>'This Real Estate Has Disabled.....']);
        }else {
            $user = FeaturAd::find($id);
            $user->disable = 'true';
            $user->save();
            return response()->json(['message'=>'This Real Estate Has  UnDisable.....']);
        }
    }
    public function deletepro($id){
        Upload::where('UpId',$id)->delete();
        return response()->json(['This Real Estate Has Been delete!!!!']);
    }
    public function estatelist($search){
        $upload =  Upload::where('uid', 'like', '%' . $search . '%')
            ->orWhere('UpId', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('cat_name', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')->get();
        return response()->json($upload);
    }
    public function DeleteUser($id){
        User::where('id',$id)->delete();
       return response()->json(['Deleted']);
    }
    public function UserList($search){
        $user =  User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('dob', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('province', 'like', '%' . $search . '%')->get();
        return response()->json($user );
    }
    public function disable($id,$disable){
        if ($disable == 'true'){
            $user = User::find($id);
            $user->disable = 'false';
            $user->save();
            return response()->json(['message'=>'This User Has Disabled.....']);
        }else{
            $user = User::find($id);
            $user->disable = 'true';
            $user->save();
            return response()->json(['message'=>'This User Has UnDisable.....']);
        }
    }
}
class store{
    public $allEstate;
    public $allUser;
    public $allAmount;
    public $allPromoted;

}
