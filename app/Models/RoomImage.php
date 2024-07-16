<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;


    public $fillable = ['img','room_id'];


    public function room(){
    return $this->belongsToMany(Room::class,'room_id');
    }
}
