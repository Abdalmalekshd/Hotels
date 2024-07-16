<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id','rating','user_id'];


    protected $hidden   = ['created_at','updated_at'];


    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
        }

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
}