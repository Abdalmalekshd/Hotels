<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAttachment extends Model
{
    use HasFactory;


    protected $fillable=['id','room_id','attachemnts'];

    public function room(){
    return $this->belongsTo(Room::class);
    }

}
