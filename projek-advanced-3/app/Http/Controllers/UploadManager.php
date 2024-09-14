<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadManager extends Controller
{
    function upload(){
        return view('upload');
    }

    function uploadPost(Request $request){
        $file = $request->file('file');

             	        // nama file
		echo 'File Name: '.$file->getClientOriginalName();
		echo '<br>';
 
      	        // ekstensi file
		echo 'File Extension: '.$file->getClientOriginalExtension();
		echo '<br>';
 
      	        // real path
		echo 'File Real Path: '.$file->getRealPath();
		echo '<br>';
 
      	        // ukuran file
		echo 'File Size: '.$file->getSize();
		echo '<br>';
 
      	        // tipe mime
		echo 'File Mime Type: '.$file->getMimeType();

        $destination_path = 'uploads';
        if ($file->move($destination_path, $file->getClientOriginalName())){
            echo "File Upload Success";
        }
        else{
            echo "Failed to upload file";
        }
    }
}
