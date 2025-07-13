<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CustomClass;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OwnLibrary {

    public static function uploadFile($image,$folderName){
        $image_name = Str::random(15);
        $ext = strtolower($image->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'public/upload/'.$folderName.'/';
        $image_url = $upload_path . $image_full_name;
        $image->move($upload_path, $image_full_name);
        return $image_url;
    }
}
