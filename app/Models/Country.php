<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory,Translatable;

    protected $with = ['translations'];



    protected $translatedAttributes=['name'];


    protected $fillable=[];


    public function cities(){
        return $this->hasMany(City::class,'country_id');
    }

    public function scopeWhereHasCountry($query,$country){

  $query-> whereHas('translations', function($query) use ($country) {
        $query->where('name', 'LIKE', '%' . $country . '%');
    });
    }
}