<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Hotel extends Authenticatable
{
    use HasFactory,Translatable,HasApiTokens;

    protected $with = ['translations'];

    protected $translatedAttributes=['name'];

    protected $fillable = ['photo','city_id','email','phone','password','active'];


    protected $timestamp=false;




    public function city(){
        return $this->belongsTo(City::class,'city_id');

    }




    public function rooms(){
        return $this->hasMany(Room::class,'hotel_id');
    }


    public function reservations(){
        return $this->hasMany(Reservation::class);
    }


    public function ratingrelation(){
        return $this->hasMany(Rating::class,'hotel_id');
    }

    public function attachments(){
        return $this->hasOne(HotelAttachment::class);
    }


    public function favorite(){
        return   $this->hasMany(Favorite::class,'hotel_id');
       }






    public function scopewithCountRooms($query,$var1,$var2){
        return  $query-> withCount(['rooms' => function($query) use($var1,$var2){
            $query->whereDoesntHaveReservations($var1,$var2);

        }]);
    }

    public function scopeWhereHasContryInThisName($query,$country){

        return  $query->  whereHas('city', function($query) use ($country) {
        $query->WhereHasCountry($country);
    });

}


    public function scopeActive($query){
      return  $query->where('active', 1);
    }

}
