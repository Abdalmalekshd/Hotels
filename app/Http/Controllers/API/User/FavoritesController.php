<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Hotel;
use App\Traits\FunctionsFolder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends ResponseController
{

    use FunctionsFolder;
    public function showfav(){


          $data['fav']=Favorite::with(['hotels'=>function($q){
            $this->WhereTranslationIsLocale($q);
        }])->where('user_id',Auth::user()->id)->get();

        if($data['fav']){

        return $this->sendResponse($data,'User Favorites Hotels:');

      }else{
          return $this->sendError('You do not have any favorite hotel yet');
      }
      }


    public function addtofav($id){

        $hotel=Hotel::find($id);

        if($hotel){

            $findfav=Favorite::where('hotel_id','=',$hotel->id )->where('user_id','=',Auth::user()->id)->first();

            if(!$findfav){
        $addtofav=Favorite::create(
            [
                'hotel_id'  =>$id,
                'user_id'   =>Auth::user()->id,
            ]
        );


        return $this->sendResponse($addtofav, $hotel->name .' '. __('admin.addedtofavsuccess'));
    }else{
        return $this->sendError('This hotel already exist in favorite');
    }
    }else{
         return $this->sendError('This hotel does not exist');
    }
    }



    public function removefromfav($id){

        try{
          $hotel=Hotel::find($id);

        if($hotel){
           $findfav=Favorite::where('hotel_id','=',$hotel->id)->where('user_id','=',Auth::user()->id)->first()->delete();

            return $this->sendResponse( $hotel , $hotel->name .' '. __('admin.deletefromfavsuccess'));
        }
    }
        catch(\Exception $ex){
            return $this->sendError('This hotel does not exist');

        }
    }

    public function searchinfav(Request $req){
      $data['search']=Hotel::whereHas('translations',function($qu) use ($req){
        $qu->where('name','LIKE', '%'. $req->name.'%');
         $qu->where('locale',config('app.locale'));
      })->whereHas('favorite',function($q){
        $q->where('user_id',Auth::user()->id);
     })->get();

     return $this->sendResponse($data,"User Search Result:");
    }

}