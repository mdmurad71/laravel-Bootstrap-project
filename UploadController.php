<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
   function onUpload(Request $request){
   $path= $request->file('fileKey')->store('loader');
    //$request->fileKey->store('public');
    $result= DB::table('myfile')->insert(['file_path'=>$path]);
    if($result==true){
        return 1;
    }else{
        return 0;
    }
   }
}
