<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ExtApiController;

class ApiReviewController extends ExtApiController
{
     // Mendapatkan semua review
    public function index(){
        $reviews = Review::query()
                ->get()
                ->toArray();
        return $this->send_success("Data review:", $reviews);
    }

    // Mendapatkan semua review sesuatu tempat wisata
   public function show_destination(int $destination_id){
       $reviews = Review::query()
               ->where('destination_id', '=', $destination_id)
               ->get()
               ->toArray();
       return $this->send_success("Data review:", $reviews);
   }

     // Menampilkan review sesuatu tempat wisata berdasarkan id
     // (id)
    public function show(int $review_id){
        $destination = Destination::findOrFail($review_id);
        if ($destination == null){
            return $this->send_bad_request("Tidak ada destinasi wisata dengan id ini");
        }
        return $this->send_success("Menampilkan review ber-id $review_id:", $destination);
    }

    public function create(Request $request, int $destination_id){
        /*
        if (empty(Review::first([
            "destination_id" => $destination_id,
            "user_id" => auth()->id()])))
        {
            */
            $added_review = Review::create([
                "destination_id" => $destination_id,
                "user_id" => auth()->id(),
                "username" => auth()->user()->name,
                "stars" => $request->stars,
                "description" => $request->description
            ]);
            return $this->send_success("Berhasil menambah review untuk destinasi wisata ber-id $destination_id:", $added_review);
        //}
        //else{
            //return $this->send_bad_request("Tidak dapat membuat lebih dari satu review per destinasi wisata");
        //}
    }

    public function remove(int $destination_id){
        
        if (!empty(Review::first([
            "destination_id" => $destination_id,
            "user_id" => auth()->id()])))
        {
            Review::query()
            ->where("id", "=", auth()->id())
            ->take(1)
            ->delete();

            return $this->send_success("Berhasil menghapus review untuk destinasi wisata ber-id $destination_id");
        }
        else{
            return $this->send_bad_request("Tidak ada review milik pengguna ini untuk destinasi wisata ini!");
        }
        
    }
}
