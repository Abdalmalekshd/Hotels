<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public $fillable=[
        'hotel_id','user_id'
    ];



    public function hotels(){
     return   $this->belongsTo(Hotel::class,'hotel_id');
    }


    public function user(){
        return   $this->belongsTo(User::class,'user_id');
       }
}
