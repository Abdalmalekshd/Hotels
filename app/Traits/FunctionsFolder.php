<?php

namespace App\Traits;

trait FunctionsFolder
{
function WhereTranslationIsLocale($table){//Upload Photo To DataBase
   return $table->with('translations',function($q){
        $q->where('locale',config('app.locale'));
    });
}




}
