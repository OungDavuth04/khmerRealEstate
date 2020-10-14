<?php

namespace App\Http\Controllers\API\V1;

use App\Commune;
use App\DataUpload;
use App\District;
use App\FeaturAd;
use App\Http\Controllers\Controller;
use App\Notifications\InvoicePaid;
use App\Province;
use App\Upload;
use App\Upload_Images;
use http\Client\Response;
use Illuminate\Http\Request;
use App\User;
//use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getupdate($id){
        $data_text = Upload::where('UpId', $id)->get();
        $data_img = Upload_Images::where('UpId', $id)->get();
        $data = array();
        foreach ( $data_text as $value){
            $store = New NewData();
            $store->title = $value->title;
            $store->bedroom = $value->bedroom;
            $store->bathroom = $value->bathroom;
            $store->facing = $value->facing;
            $store->size = $value->size;
            $store->price = $value->price;
            $store->description = $value->description;
            $store->glat = $value->map_lat;
            $store->glng = $value->map_lng;
            $store->localdetail = $value->localdetail;
            $store->email = $value->email;
            $store->phone = $value->phone;
            $store->province = $value->province;
            $store->district = $value->district;
            $store->commune = $value->commune;
            $store->images = $data_img;
            array_push($data,  $store);
        }

        return response()->json($data);
    }


    public function delete($id){
        Upload::where('UpId', $id)->delete();
        FeaturAd::where('UpId', $id)->delete();
        $image = Upload_Images::where('UpId',$id)->get();
        foreach ( $image as $img){
            Upload_Images::where('UpId',$id)->delete();
            $getImageNameOnly = explode('/', $img->image);
            Storage::delete("/public/images/".$getImageNameOnly[2]);
        }
        return response()->json($id);
    }
    public function getpost( Request $request){
        $values = Upload::where('uid',$request->user()->id)->Where('disable','true')->orderBy('UpId', 'DESC')->get();
        $promote = FeaturAd::where('uid',$request->user()->id)->where('disable','true')->get();

        $newArray = array();
        foreach ($values as $value){
            $export = new NewData();
            $isPromoted = false;
            foreach ($promote as $promoted){
                if($promoted->UpId == $value->UpId ){
                    $isPromoted = true;
                }
            }
            $image = Upload_Images::where("UpId", $value->UpId)->get();

            $export->upId = $value->UpId;
            $export->uid = $value->uid;
            $export->title = $value->title;
            $export->size = $value->size;
            $export->price = $value->price;
            $export->images = $image;
            $export->promoted = $isPromoted;
            array_push($newArray, $export);
        }

        return response()->json($newArray);
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $http = new \GuzzleHttp\Client;

        try{
            $response = $http->post(config('services.passport.login_end_point'),[
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        }catch (\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() === 400){
                return response()->json('Invalid Request', $e->getCode());
            }else if($e->getCode() === 401){
                return response()->json('Your Credentials are incorrect', $e->getCode());
            }
            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }

    public function logout(){
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });
        return response()->json(['Logout Successfully'], 200);
    }
    public function register(Request $request){
        User::create([
            'name' => $request->username,
            'email'=> $request->email,
            'password' =>  Hash::Make($request->password),
            'province' => $request->province,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);
        return response()->json($request);
    }
    public function upload(Request $request){
        $upload = Upload::create([
            'uid' => $request->uid,
            'title' =>  $request->title,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'facing' => $request->facing,
            'size' => $request->size,
            'price' => $request->price,
            'description' => $request->description,
            'map_lat' => $request->glat,
            'map_lng' => $request->glng,
            'localdetail' => $request->localDetail,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => $request->provinceSelected,
            'district' => $request->districtSelected,
            'commune' => $request->communeSelected,
            'cat_name' => $request->cat_name
         ]);
        $up_id = $upload->UpId;
        $photo = null;
        foreach ($request->temp as $item){
            $explodeRawImage = explode(',', $item['img']);
            $decodedImage = base64_decode($explodeRawImage[1]);
            $generateRandomNumberForFileName = explode(" ", microtime());
            $imageNameWithExtension = $generateRandomNumberForFileName[0] . '.' . explode('/', explode(':', substr($item['img'], 0, strpos($item['img'], ';')))[1])[1];
            $saveDirectory = storage_path() . '/app/public/images/' . $imageNameWithExtension;
            file_put_contents($saveDirectory, $decodedImage);
            $photo = 'storage/images/'.$imageNameWithExtension;
            Upload_Images::create([
                'UpId' =>  $up_id,
                'image' => $photo,
            ]);
        }
        return response()->json($request);
    }
    public function update(Request $request){
        $photo = null;
        foreach ($request->temp as $item){
            if($item["isNew"]){
                $explodeRawImage = explode(',', $item['img']);
                $decodedImage = base64_decode($explodeRawImage[1]);
                $generateRandomNumberForFileName = explode(" ", microtime());
                $imageNameWithExtension = $generateRandomNumberForFileName[0] . '.' . explode('/', explode(':', substr($item['img'], 0, strpos($item['img'], ';')))[1])[1];
                $saveDirectory = storage_path() . '/app/public/images/' . $imageNameWithExtension;
                file_put_contents($saveDirectory, $decodedImage);
                $photo = 'storage/images/'.$imageNameWithExtension;
                Upload_Images::create([
                    'UpId' => $request->up_id,
                    'image' => $photo
                ]);
            }
        }
        foreach ($request->removed_image_array as $img){
            Upload_Images::where('UpId', $request->up_id)->where('image', $img['image_name'])->delete();
            $getImageNameOnly = explode('/', $img['image_name']);
            Storage::delete("/public/images/".$getImageNameOnly[2]);
        }
        Upload::where('UpId', $request->up_id)->
        update([
            'title' => $request->title,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'facing' => $request->facing,
            'size' => $request->size,
            'price' => $request->price,
            'description' => $request->description,
            'map_lat' => $request->glat,
            'map_lng' => $request->glng,
            'localdetail' => $request->localdetail,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => $request->province,
            'district' => $request->district,
            'commune' => $request->commune
        ]);
        return response()->json($request);
    }
    public function getprovince(){
        $data = Province::all();
        return response()->json($data);
    }
    public function getdistricts ($id){
        $data = District::all()->where('pro_id',$id);
        return response()->json($data);
    }
    public function getcommunes($dis_id){
        $data = Commune::all()->where('dis_id',$dis_id);
        return response()->json($data);
    }
}

class NewData{
    public $upId;
    public $uid;
    public $title;
    public $bedroom;
    public $bathroom;
    public $facing;
    public $size;
    public $price;
    public $description;
    public $glat;
    public $glng;
    public $images;
    public $localdetail;
    public $email;
    public $phone;
    public $province;
    public $district;
    public $commune;
    public $cat_name;
    public $promoted;
}
