<?php

namespace App\Http\Controllers\API\V1;
use App\Commune;
use App\District;
use App\Events\PaymentSummited;
use App\FeaturAd;
use App\Province;
use App\Upload_Images;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpseclib\Crypt\Random;
use App\Upload;

class ProductController extends Controller
{

    public  function Promote(){
//        $get =
        $replace = [1,2,3,4,5,6,7];

        $id = array(1,2,3,4,5,6,7);

       $rand = array_rand($id,1);
       if($rand == 1){
           array_splice($id, 1, 1);
       }else if($rand == 2){
           array_splice($id, 2, 1);
       }else if($rand == 3){
           array_splice($id, 3, 1);
       }else if($rand == 4){
           array_splice($id, 4, 1);
       }else if($rand == 5){
           array_splice($id, 5, 1);
       }else if($rand == 6){
           array_splice($id, 6, 1);
       }else if($rand == 7){
           array_splice($id, 7, 1);
       }

        return response()->json($id);

    }
    public function procategory($cat){
        $dataCat =  Upload::where('cat_name',$cat)->get();

        $allCat = array();
        foreach ( $dataCat as $value){

            $img =  Upload_Images::where('UpId',$value->UpId)->get();
            $store = New TempData();
            $store->title = $value->title;
            $store->bedroom = $value->bedroom;
            $store->bathroom = $value->bathroom;
            $store->facing = $value->facing;
            $store->size = $value->size;
            $store->price = $value->price;
            $store->description = $value->description;
            $store->glat = $value->glat;
            $store->glng = $value->glng;
            $store->localdetail = $value->localdetail;
            $store->email = $value->email;
            $store->phone = $value->phone;
            $store->province = $value->province;
            $store->district = $value->district;
            $store->commune = $value->commune;
            $store->images = $img;
            $store->upId = $value->UpId;
            $store->cat_name = $value->catname;
            array_push($allCat,  $store);
        }
        return response()->json($allCat);
    }


    public function search(Request $request){
           function searchData($pro,$dist,$com,$input,$cat){

               if($cat == null){
                   if($pro != null ){
                       if($dist != null ){
                           if($com != null){
                               $data = Upload::where('province',$pro)
                                   ->where('district',$dist)
                                   ->where('commune',$com)
                                   ->orWhere('title','LIKE','%'.$input.'%')
                                   ->orWhere('description','LIKE','%'.$input.'%')->get();
                           }else{
                               $data = Upload::where('province',$pro)
                                   ->where('district',$dist)
                                   ->orWhere('title','LIKE','%'.$input.'%')
                                   ->orWhere('description','LIKE','%'.$input.'%')->get();
                           }
                       }else{
                           $data = Upload::where('province',$pro)
                               ->orWhere('title','LIKE','%'.$input.'%')
                               ->orWhere('description','LIKE','%'.$input.'%')->get();
                       }
                   }else {
                       $data = Upload::where('title','LIKE','%'.$input.'%')
                           ->orWhere('description','LIKE','%'.$input.'%')->get();
                   }
               }else{
                   if($pro != null ){
                       if($dist != null ){
                           if($com != null){
                               $data = Upload::where('catname',$cat)
                                   ->where('province',$pro)
                                   ->where('district',$dist)
                                   ->where('commune',$com)
                                   ->orWhere('title','LIKE','%'.$input.'%')
                                   ->orWhere('description','LIKE','%'.$input.'%')->get();
                           }else{
                               $data = Upload::where('catname',$cat)
                                   ->where('province',$pro)
                                   ->where('district',$dist)
                                   ->orWhere('title','LIKE','%'.$input.'%')
                                   ->orWhere('description','LIKE','%'.$input.'%')->get();
                           }
                       }else{
                           $data = Upload::where('catname',$cat)
                               -> where('province',$pro)
                               ->orWhere('title','LIKE','%'.$input.'%')
                               ->orWhere('description','LIKE','%'.$input.'%')->get();
                       }
                   }
                   else {
                       $data = Upload::where('catname',$cat)
                           ->where('title','LIKE','%'.$input.'%')
                           ->orWhere('description','LIKE','%'.$input.'%')->get();
                   }
               }

               return $data;
           }

        $data = [];
        if($request->category == 'allCartegory'){
           $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,null);
        }else if($request->category == 'houseSale'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'HomeSell');
        }else if($request->category == 'houseRent'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'HomeRent');
        }else if($request->category == 'condoSale'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'condoSell');
        }else if($request->category == 'apRent'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'apartmentRent');
        }else if($request->category == 'landSale'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'landSell');
        }else if($request->category == 'landRent'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'landRent');
        }else if($request->category == 'comSale'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'commercialSell');
        }else if($request->category == 'comRent'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'commercialRent');
        }else if($request->category == 'roomRent'){
            $data = searchData($request->searchPro,$request->searchDist,$request->searchCom,$request->searchBox,'romeRent');
        }
        $allData = array();
        foreach ($data as $result){
            $id[] = $result->UpId;
            $img  = Upload_Images::where('UpId',$id)->get();
            $store = New TempData();
            $store->title = $result->title;
            $store->bedroom = $result->bedroom;
            $store->bathroom = $result->bathroom;
            $store->facing = $result->facing;
            $store->size = $result->size;
            $store->price = $result->price;
            $store->description = $result->description;
            $store->glat = $result->glat;
            $store->glng = $result->glng;
            $store->localdetail = $result->localdetail;
            $store->email = $result->email;
            $store->phone = $result->phone;
            $store->province = $result->province;
            $store->district = $result->district;
            $store->commune = $result->commune;
            $store->images = $img;
            $store->upId = $result->UpId;
            $store->cat_name = $result->catname;
            array_push($allData,  $store);
        }
        return response()->json($allData);
    }

    public function getpromote(Request $request){

        $getpromote = FeaturAd::where('uid',$request->user()->id)->get();
        foreach ($getpromote as $item){
            $gg[] = $item->UpId;
        }
        $all = array();
        for ($i= 0; $i <= count($gg)-1; $i++){
          $get[] =  Upload::where('UpId', $gg[$i])->get();
        }
        $allData = array();
        foreach ($get as $item){
            foreach ($item as $data){
                $id = $data->UpId;
                $img  = Upload_Images::where('UpId',$id)->get();
                $store = New TempData();
                $store->title = $data->title;
                $store->bedroom = $data->bedroom;
                $store->bathroom = $data->bathroom;
                $store->facing = $data->facing;
                $store->size = $data->size;
                $store->price = $data->price;
                $store->description = $data->description;
                $store->glat = $data->glat;
                $store->glng = $data->glng;
                $store->localdetail = $data->localdetail;
                $store->email = $data->email;
                $store->phone = $data->phone;
                $store->province = $data->province;
                $store->district = $data->district;
                $store->commune = $data->commune;
                $store->images = $img;
                $store->upId = $data->UpId;
                $store->cat_name = $data->catname;
                array_push($allData,  $store);
            }
        }
        return response()->json($allData);

    }
    public function getdistricts (){
        $data = District::all();
        return response()->json($data);
    }
    public function getcommunes(){
        $data = Commune::all();
        return response()->json($data);
    }
    public  function Detail($id){
        $map = Upload::where('UpId',$id)->get();
        $mapWithImages = [];

        foreach ($map as $item){
            $mapImage = Upload_Images::where('UpId',$item->UpId)->get();
            $item['images'] = $mapImage;
            array_push($mapWithImages, $item);
        }
        return response()->json($mapWithImages);
    }

    public function map(){
        $map = Upload::all();
        $mapWithImages = [];

        foreach ($map as $item){
            $mapImage = Upload_Images::where('UpId', $item->UpId)->get();
            $item['images'] = $mapImage;
            array_push($mapWithImages, $item);
        }
        return response()->json($mapWithImages);
    }

    public function getpro(){

            $UpId = [];
            $alldata = [];
            $date = Carbon::now()->toDateTimeString();
            $last = Upload::orderBy('created_at', 'DESC')->first();
            $getDateOnly = Carbon::parse($last->created_at)->format('d/m/Y');
            $lastInsertedItem = Carbon::createFromFormat('d/m/Y', $getDateOnly);
            $data = Upload::whereBetween('created_at', [$lastInsertedItem->subDay(10)->toDateString(), $date])->get();

            foreach ($data as $set){
             array_push($UpId,$set->UpId );
            }
            $random = array_rand($UpId,4);

            foreach ($random as $item) {
                array_push($alldata,$UpId[$item]) ;
            }

            $data =  Upload::where('UpId',$alldata[0])
                ->orWhere('UpId',$alldata[1])
                ->orWhere('UpId',$alldata[2])
                ->orWhere('UpId',$alldata[3])
                ->get();

            $all = array();
            foreach ( $data as $value){

                $img =  Upload_Images::where('UpId',$value->UpId)->get();
                $store = New TempData();
                $store->title = $value->title;
                $store->bedroom = $value->bedroom;
                $store->bathroom = $value->bathroom;
                $store->facing = $value->facing;
                $store->size = $value->size;
                $store->price = $value->price;
                $store->description = $value->description;
                $store->glat = $value->glat;
                $store->glng = $value->glng;
                $store->localdetail = $value->localdetail;
                $store->email = $value->email;
                $store->phone = $value->phone;
                $store->province = $value->province;
                $store->district = $value->district;
                $store->commune = $value->commune;
                $store->images = $img;
                $store->upId = $value->UpId;
                $store->cat_name = $value->catname;
                array_push($all,  $store);
            }
//        event(new PaymentSummited($all));
        return response()->json($all);


    }

}
class TempData{
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
}
