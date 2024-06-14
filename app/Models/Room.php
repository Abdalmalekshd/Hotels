<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    protected $fillable=['id','room_id','people_number','room_floor','cost','hotel_id'];


    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }

    public function rooms(){
        return $this->hasMany(RoomImage::class,'room_id');
    }

    public function rerservation(){
        return $this->hasOne(Reservation::class,'room_id','id');
    }

    public function attachments(){
        return $this->hasOne(RoomAttachment::class);
    }

    public function scopewhereDoesntHaveReservations($query,$var1,$var2){
        return  $query->where(function($query) use($var1,$var2){

            $query-> whereDoesntHave('rerservation', function($query) use($var1,$var2){
                $query->where(function($query) use($var1,$var2){
                    $query->whereBetween('reservations_start_date', [$var1,$var2])
                          ->orWhereBetween('reservations_end_date', [$var1,$var2]);
                });


       });
    });
    }

}