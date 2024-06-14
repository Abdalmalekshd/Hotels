<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = "reservatins";
    protected $fillable = ['hotel_id','room_id','user_id','reservations_start_date','reservations_end_date'];

    protected $hidden   = ['created_at','updated_at'];


    public function user(){
    return $this->belongsTo(User::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }


    public function room(){
        return $this->belongsTo(Room::class,'room_id','id');
    }




}