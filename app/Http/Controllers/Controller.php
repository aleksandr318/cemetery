<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 	public function getUniqueFileName(){
        $ldate = date('Y-m-d H:i:s');
        $p = 0;
        $ndate = "";
    	for ($i = 0; $i < strlen($ldate); $i ++){
            if(!($ldate[$i] == "-" || $ldate[$i] == ":" || $ldate[$i] == " "))
            {
                $ndate[$p++] = $ldate[$i];
            }
        }
        return $ndate;
    }
    public function UploadFile(Request $request){
        $uploads_dir = './uploads/';
        $tmp_name = $_FILES["files"]["tmp_name"];
        
        $tempname = basename($_FILES["files"]["name"]);
        $name = $this->getUniqueFileName().$tempname;

        move_uploaded_file($tmp_name, $uploads_dir.$name);

        echo json_encode(array('path'=>$uploads_dir.$name, 'full_path'=>asset($uploads_dir.$name), 'name'=>$tempname));
    }
}
