<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
{
  //  function onDownload(){
      //  $result= Storage::download('loader/wuHCFqs6CuVzodrwE5W8lUhcHtqAHOdkbevsvPfd.png', 'picture.png');
       // return $result;
  //  }

    function onSelectFile(){
        $result= DB::table('myfile')->get();
        return $result;
    }
}
