<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends ResponseController
{

    //Get All Attachments

    public function GetAttachments(){

        $attachments = Attachment::all();

    if($attachments){
        return $this->sendResponse($attachments,'Attachments:');

    }else{
        return $this->sendError('There is no attachments yet add some');

    }
    /*Need test*/


    }


    // Add Attachment To Database Code
    public function CreateAttachments(AttachmentRequest $request){


         $attach=Attachment::where(function($qu) use($request){
            $qu->where("slug",$request->slug)->
            where("name_en",$request->name_en)->
            where("name_ar",$request->name_ar);
         })->first();


        if(!$attach){
           $attachment= Attachment::create(['name_en'=>$request->name_en,'name_ar'=>$request->name_ar,'slug'=>$request->slug,'attachment_level'=>$request->attachment_level]);



           return $this->sendResponse($attachment ,$attachment->name_en  . ' Added Successfully to database');


        }else{
        return $this->sendError("This attachment already exist");

        }

    /*Need test*/


    }


    // Update Attachment Code

    public function UpdateAttachments(UpdateAttachmentRequest $request, $id){

  $attach=Attachment::find($id);

        if($attach){

        $attach->update([
            "name_en"=>$request->name_en?:$attach->name_en
            ,"name_ar"=>$request->name_ar?:$attach->name_ar
            ,'slug'=> $request->slug?:$attach->slug,
            'attachment_level'=>$request->attachment_level
    ]);


        return $this->sendResponse($attach ,'Updated Successfully');


    }else{

        return $this->sendError("This attachemnt does not exist");

    }
   }


    // Delete Attachment Code

   public function DeleteAttachments($id){

    $attach=Attachment::find($id);

    if($attach){

    $attach->delete();

    return redirect()->back();

    }else{

    return redirect()->back()->with(['error'=>'This id does not exist any more']);

    }

   }


}
