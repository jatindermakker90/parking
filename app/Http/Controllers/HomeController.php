<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class HomeController extends WebController
{

   public function uploadImage(Request $request){
         try {
            $user = Auth::user();
            $rules = [
                'image' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return $this->sendError($validator->errors()->first(),$validator->errors(), 400);
            }
            if ($request->hasfile('image')) {
                if ($image = $request->file('image')) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                    $FileEnconded=  \File::get($request->image);
                    \Storage::put('profile-image/'.$filename, (string)$FileEnconded,'public');
                    $image_name = $filename;
                    $type = $extension;
                    $message = "Image Uploaded Successfully";
                    return $this->sendSuccess(['image_name'=>$image_name,'type'=>$type],$message,200); 
                }else{
                  $message = "Image not Found";
                  return $this->sendError($message);       
                }
            }else{
                $message = "Please upload image correctly";
                return $this->sendError($message);
            }
        } catch (Exception $e) {
            $message = $e->getMessage()." at line ".$e->getLine()." in file ".$e->getFile();
            return $this->sendError($message);
        }
    }
}
