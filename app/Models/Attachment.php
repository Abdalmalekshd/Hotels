<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;



    protected $fillable = ['id','name_en','name_ar','slug','attachment_level'];


    public function getAttachLevel()
    {
        return $this->attachment_level == 0 ? __("admin.hotelattach") : __("admin.Roomattach");
    }

}
