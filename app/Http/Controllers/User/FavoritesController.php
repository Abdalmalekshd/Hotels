<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{


    public function showfav(){


          $data['fav']=Favorite::with('hotels')->where('user_id',Auth::user()->id)->get();

        if($data['fav']){

            $data['search']='';

        return view('User.Favorite.index',$data);

      }else{
          return redirect()->back()->with(['error'=>'You do not have any favorite hotel yet']);
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


        return redirect()->back()->with(['success'=> $hotel->name .' '. __('admin.addedtofavsuccess')]);
    }else{
        return redirect()->back()->with(['error'=>'This hotel already exist in favorite']);
    }
    }else{
        return redirect()->back()->with(['error'=>'This hotel does not exist']);
    }
    }



    public function removefromfav($id){

        try{
          $hotel=Hotel::find($id);

        if($hotel){
           $findfav=Favorite::where('hotel_id','=',$hotel->id)->where('user_id','=',Auth::user()->id)->first()->delete();

            return redirect()->back()->with(['success'=> $hotel->name .' '. __('admin.deletefromfavsuccess')]);
        }
    }
        catch(\Exception $ex){
            return $ex;

        }
    }

    public function searchinfav(Request $req){
      $data['search']=Hotel::whereHas('translations',function($qu) use ($req){
        $qu->where('name','LIKE', '%'. $req->searchforfav.'%');
      })->whereHas('favorite',function($q){
        $q->where('user_id',Auth::user()->id);
     })->get();

     return view('User.Favorite.index',$data);
    }

}
