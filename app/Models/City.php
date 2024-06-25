<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory,Translatable;

    protected $with = ['translations'];



    protected $translatedAttributes=['name'];

    protected $fillable=[

        'country_id'
    ];

    protected $hidden=['created_at','updated_at'];


    public function Hotels(){
        return $this->hasMany(Hotel::class,'city_id');
    }


    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }


    public function scopeWhereHasCountry($query,$country){
    $query->whereHas('country', function($query) use ($country) {
        $query->WhereHasCountry($country);
    });
    }
}
