<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserImage;
use Storage;
use Image;
use File;
class UserImageController extends Controller
{  

   public function index () {
      $result = UserImage::where("user_id" , auth()->user()->id)->where("status" , 'A')->whereNull("is_profile")->get();
      if($result){
         foreach ($result as $key => $value) {
            $result[$key]->_p_ = auth()->user()->folder;
         }
      }
      return response()->json($result);
   }
   
   public function imageUpload (Request $request) {
      $request->validate([
         'image.*' => 'mimes:jpeg,png,jpg',
      ]);
      
    
      $allowed = [
         "jpeg",
         "png",
         "jpg",
         "PNG" ,
         "JPG",
         "JPEG"
      ];
      $image = $request->file('image');
           
      if(!in_array( $image->extension() , $allowed )){
       
         return response()->json([
            "status" => false
         ]);
      }

      $input['imagename'] = time().'.'.$image->extension();

    
      $destinationPath = storage_path('/photo'.'/'.auth()->user()->folder);

      $img = Image::make($image->path());

      
      $img->resize(800, 800, function ($constraint) {
          $constraint->aspectRatio();
      })->save($destinationPath.'/'.$input['imagename'] , 100);
 
      $destinationPath = storage_path('/photo'.'/'.auth()->user()->folder);
      $image->move($destinationPath,'/'. $input['imagename']);

     //Put file with own name
      Storage::put($input['imagename'], $img);

      //Move file to your location 
      Storage::move($input['imagename'], 'public/photo/'.auth()->user()->folder.'/'.$input['imagename']);

      if($request->is_profile != null){
         $toUpdate = UserImage::where("user_id" , auth()->user()->id)->where("is_profile" , 'Y')->first();
         if( $toUpdate ){
            $toUpdate->is_profile = NULL;
            $toUpdate->save();
         }
         
      }


      UserImage::create([
         'image' => $input['imagename'],
         'user_id' => auth()->user()->id,
         'file_type' => $image->getClientOriginalExtension(),
         "is_profile" => ($request->is_profile != null) ? 'Y': NULL
     ]);


   }

   public function removeImg (Request $request){
      # CHECK IF USER OWN THE IMAGE ID 
      $check = UserImage::select("image","status","id")->where("id" , $request->id)->where("user_id" , auth()->user()->id)->first();
      if($check == null){
         return response()->json([
            "status" => false,
            "message" => "Error!"
         ]);
      }
     
      $check->status = 'H';
      $check->save();
      
      return response()->json([
         "status" => true,
         "message" => "Deleted!"
      ]);
   }
}
