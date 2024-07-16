<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelAttachment;
use App\Models\Room;
use App\Traits\UplaodImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class HotelsController extends Controller
{
    use UplaodImageTraits;

    //Get All Hotels
    public function GetHotels(){
        $data=[];


           $data['hotels']=Hotel::with(['city'=>function($q){
            $q->with('country');
        }])->with('attachments')->orderByDesc('id')->paginate(10);

        $data['search']='';

         return view('Admin.Hotels.index',$data);

     }

        //Get Add Hotel View
    public function AddHotels(){
       $data=[];
        $data['city']=City::get();
        $data['attachments']=Attachment::select('id','name_en',
        'name_'.LaravelLocalization::getCurrentLocale() . ' as Name'
        ,
        'attachment_level'
        )->where('attachment_level',0)->get();
        return view('Admin.Hotels.Create',$data);

    }

    // Add Hotel To Database Code

    public function CreateHotels(HotelRequest $req){

        try{

        DB::beginTransaction();


        $img=$this->UploadImage('hotels', $req->photo);

        $hotel=Hotel::create($req->except(['name','photo','password','latitude','longitude']));

        $hotel->photo=$img;

        $hotel->password=Hash::make($req->password);

        $hotel->latitude=$req->latitude;

        $hotel->longitude=$req->longitude;

        $hotel->name=$req->name;



        $HotelAttachment=new HotelAttachment();
        $HotelAttachment->Hotel_id = $hotel->id;
        $HotelAttachment->attachemnts=json_encode($req->attach);
        $HotelAttachment->save();

        $hotel->save();


        DB::commit();

        return redirect()->back()->with(['success'=>'New hotel Added']);

    }
        catch(\Exception $ex){

            DB::rollBack();

        return redirect()->back()->with(['error'=>'Error while adding new hotel']);

    }

         }


    // Get Edit Hotel view

         public function EditHotels($id){
            $data=[];
            $data['hotel']=Hotel::find($id);

            if(!$data['hotel']){

            return redirect()->back()->with(['error'=>__('admin.iddoesnotexist')]);
        }else{

           $data['city']=City::get();

           $data['attachments']=Attachment::select(['id','name_ar','name_en',
           'name_' . LaravelLocalization::getCurrentLocale() .' as Name',
           ])->where('attachment_level',0)->get();

            return view('Admin.Hotels.edit',$data);
        }
         }

    // Update Hotel Code

         public function UpdateHotels(HotelRequest $req){

            $hotel=Hotel::find($req->id);


            try{
            DB::beginTransaction();


                $hotel->update($req->except(['name','photo','latitude','longitude']));


            $hotel->name=$req->name;


        $hotel->latitude=$req->latitude;

        $hotel->longitude=$req->longitude;

            if ($req->hasFile('photo')) {


                 $des ='storage/hotels/' . $hotel->photo;


           if (File::exists($des)) {
                File::delete($des);

       }

       $img=$this->UploadImage('hotels',$req->photo);

       $hotel->photo=$img;


   }


            $hotel->save();

            $hotelAttach=HotelAttachment::where('hotel_id',$hotel->id)->first();
            if($hotelAttach){

                $hotelAttach->update(['attachemnts'=>json_encode($req->attach)]);

            }else{
            $hotelAttach=new HotelAttachment();
            $hotelAttach->hotel_id = $hotel->id;
            $hotelAttach->attachemnts=json_encode($req->attach);
            $hotelAttach->save();
         }



            DB::commit();

            return redirect()->back()->with(['success'=>'Hotel Data Updated']);

            }
                catch(\Exception $ex){

                    DB::rollBack();
                return redirect()->back()->with(['error'=>'Error while adding new hotel']);

            }

                 }



    // Delete Hotel Code

    public function DeleteHotels($id){
        $hotel=Hotel::find($id);

            if($hotel){

         $des='storage/hotels/' . $hotel->photo;

            if (File::exists($des)) {
            File::delete($des);

        }

        $hotel->delete();

        return redirect()->back();

        }else{

        return redirect()->back()->with(['error'=>__('admin.iddoesnotexist')]);

        }



                 }

    public function ActivateHotel($id){
        $hotel=Hotel::find($id);

        if($hotel && $hotel->active== 0){

            $hotel->update(['active'=>1]);
            return redirect()->back()->with(['success'=>'Hotel has been activated']);

        }
        else{
            return redirect()->back()->with(['error'=>'This Hotel does not exist or already activated']);
        }


    }


    public function SearchHotel(SearchRequest $req){

        $data['search']=Hotel::whereHas('translations',function($qu) use ($req){
            $qu->where('name','LIKE', '%'. $req->search.'%');
          })->paginate(10);

          return view('Admin.Hotels.index',$data);

        }


        }
