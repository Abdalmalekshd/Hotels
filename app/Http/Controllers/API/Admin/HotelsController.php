<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelAttachment;
use App\Models\Room;
use App\Traits\FunctionsFolder;
use App\Traits\UplaodImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class HotelsController extends ResponseController
{
    use UplaodImageTraits;

    use FunctionsFolder;


    //Get All Hotels
    public function GetHotels(){
        $data=[];



           $data['hotels']=Hotel::with(['city'=>function($q){
            $q->with('country',function($qq){
                $this->WhereTranslationIsLocale($qq);
            });
            $this->WhereTranslationIsLocale($q);
            }])->with('translations',function($q){
            $q->where('locale',config('app.locale'));
        })->with('attachments')->orderByDesc('id')->paginate(10);


        return $this->sendResponse($data,'Hotels :');

     }



    // Add Hotel To Database

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

        return  $this->sendResponse($hotel, $hotel -> name .'Hotel created successfully');

    }
        catch(\Exception $ex){

            DB::rollBack();

        return  $this->sendError('Error while adding new hotel');

    }

         }




    // Update Hotel Code

         public function UpdateHotels(Request $req,$id){

            $hotel=Hotel::find($id);


            try{
            DB::beginTransaction();


                $hotel->update($req->except(['name','photo','latitude','longitude']));


            $hotel->name=$req->name?:$hotel->name;


        $hotel->latitude=$req->latitude?:$hotel->latitude;

        $hotel->longitude=$req->longitude?:$hotel->longitude;

            if ($req->input('photo')) {


                 $des ='storage/hotels/' . $hotel->photo;


           if (File::exists($des)) {
                File::delete($des);

       }

       $img=$this->UploadImage('hotels',$req->photo);

       $hotel->photo=$img;


   }


            $hotel->save();

            $hotelAttach=HotelAttachment::where('hotel_id',$hotel->id)->first();
            if($hotelAttach && $req->has('attach')){

                $hotelAttach->update(['attachemnts'=>json_encode($req->attach)]);

            }elseif($req->has('attach') && !$hotelAttach){
            $hotelAttach=new HotelAttachment();
            $hotelAttach->hotel_id = $hotel->id;
            $hotelAttach->attachemnts=json_encode($req->attach);
            $hotelAttach->save();
         }



            DB::commit();

            return $this->sendResponse($hotel,$hotel.'Hotel Info Updated');

            }
                catch(\Exception $ex){

                    DB::rollBack();
                return  $this->sendError('Error while updating hotel info');

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

        return $this->sendResponse($hotel, $hotel .'Hotel has been deleted');

        }else{

        return  $this->sendError(__('admin.iddoesnotexist'));

        }



                 }

    public function ActivateHotel($id){
        $hotel=Hotel::find($id);

        if($hotel && $hotel->active== 0){

            $hotel->update(['active'=>1]);
           return $this->sendResponse($hotel,'Hotel has been activated');

        }
        else{
             return  $this->sendError('This Hotel does not exist or already activated');
        }


    }


    public function SearchHotel(SearchRequest $req){

        $data['search']=Hotel::whereHas('translations',function($qu) use ($req){
            $qu->where('name','LIKE', '%'. $req->search.'%');
          })->paginate(10);

          return $this->sendResponse($data,'Search Result:');

        }


        }