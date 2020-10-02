<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function estatelist(){


        return response()->json(['Hi']);
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
