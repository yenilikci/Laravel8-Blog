<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    //bağlanacağımız model, o modeldeki bağlanılacak ilişkisel sütun, bağlanacak sütun   
    function getCategory(){
        return $this->hasOne('app\Models\Category','id','category_id');
    }
}
