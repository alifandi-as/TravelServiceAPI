<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Review;
use App\Models\Category;
use App\Models\Destination;
use App\Models\CategoryLink;
use Illuminate\Http\Request;
use App\Models\DestinationImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ExtApiController;

class ApiDestinationController extends ExtApiController
{
     // Mendapatkan semua tempat wisata
    public function index(){
        $destinations = Destination::query()
                ->select('id', 'name', 'province', 'city', 'budget')
                ->get()
                ->toArray();
        for($i = 0; $i < count($destinations); $i++){
            $destination_id = $destinations[$i]["id"];

            $destinations[$i]["categories"] = Category::whereIn("id", CategoryLink::query()
                                                                                ->where("destination_id", "=", $destination_id)
                                                                                ->pluck("category_id"))
                                                    ->pluck("name");
            $destinations[$i]["images"] = DestinationImage::query()
                                                        ->where("destination_id", "=", $destination_id)
                                                        ->pluck("image");
        }
        return $this->send_success("Data tempat wisata:", $destinations);
    }

    // Mendapatkan semua tempat wisata secara detail
   public function index_detailed(){
       $destinations = Destination::query()
               ->get()
               ->toArray();
        for($i = 0; $i < count($destinations); $i++){
            $destination_id = $destinations[$i]["id"];

            $destinations[$i]["categories"] = Category::whereIn("id", CategoryLink::query()
                                                                                ->where("destination_id", "=", $destination_id)
                                                                                ->pluck("category_id"))
                                                    ->pluck("name");
            $destinations[$i]["review"] = Review::query()
                                                    ->where("destination_id", "=", $destination_id)
                                                    ->select("id", "username", "stars", "description", "created_at")
                                                    ->get()
                                                    ->toArray();
                                                    /*
            for($i2 = 0; $i2 < count($destinations[$i]["review"]); $i2++){
                $destinations[$i]["review"][$i2]["user"] = User::where("id", "=", $destinations[$i]["review"][$i2]["user_id"])
                                                                ->pluck("name")[0];
                unset($destinations[$i]["review"][$i2]["user_id"]);
            }
                */
            $destinations[$i]["images"] = DestinationImage::query()
                                                        ->where("destination_id", "=", $destination_id)
                                                        ->pluck("image");
        }
       return $this->send_success("Data tempat wisata detail:", $destinations);
   }

     // Menampilkan suatu tempat wisata berdasarkan id
     // (id)
    public function show($id = 0){
        $destination = Destination::find($id);
        if ($destination == null){
            return $this->send_bad_request("Tidak ada destinasi wisata dengan id ini");
        }
        return $this->send_success("Menampilkan destinasi wisata ber-id $id:", $destination);
    }

    // Mencari tempat wisata berdasarkan kueri pencarian
    // (q (kueri pencarian))
    public function search(Request $request){
 
        $category = $request->category;
        $province = $request->province;
        $city = $request->city;
        $name = $request->q;

        // mengambil data dari table destinasi wisata sesuai pencarian data
        $query = $users = Destination::query()
        ->select('id', 'name', 'province', 'city', 'budget');

        if (isset($request->category)){
            $query->where('category','=',$category);
        }
        if (isset($request->province)){
            $query->where('province','=',$province);
        }
        if (isset($request->city)){
            $query->where('city','=',$city);
        }
        if (isset($name)){
            $query->where('name','like', "%".$name."%");
        }
        
        $query2 = $query->get()
                ->toArray();

        // mengirim data pegawai ke view index
        return $this->send_success("Hasil pencarian:", $query2);
    }
}
