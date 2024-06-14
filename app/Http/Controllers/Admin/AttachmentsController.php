<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{

    //Get All Attachments

    public function GetAttachments(){

        $attachments = Attachment::all();
        return view("Admin.Attachment.index", compact("attachments"));
    }

    //Get Add Attachment View

    public function AddAttachments(){

        return view("Admin.Attachment.create");
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


           return redirect()->back()->with("success","Attachment created successfully");
        }else{
        return redirect()->back()->with("error","This attachment already exist");

        }

    }

    // Get Edit Attachment view

    public function EditAttachments($id){

        $attach=Attachment::find($id);

        if(!$attach){

            return redirect()->back()->with('error','This attachemnt does not exist');
        }

        return view("Admin.Attachment.Edit",compact("attach"));

    }


    // Update Attachment Code

    public function UpdateAttachments(AttachmentRequest $request, $id){

  $attach=Attachment::find($id);

        if($attach){

        $attach->update(["name_en"=>$request->name_en,"name_ar"=>$request->name_ar,'slug'=> $request->slug,'attachment_level'=>$request->attachment_level]);

        return redirect()->back()->with('success','Updated Successfully');

    }else{
        return redirect()->back()->with('error','This attachemnt does not exist');
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
