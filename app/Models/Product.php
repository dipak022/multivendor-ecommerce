<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','slug','sammary','description','strock','brand_id','cat_id','clild_cat_id','photo','price',
        'offer_price','discount','size','conditions','vandor_id','status','additional_info','return_cancellation','size_guide',
    ];

    public function brand(){
        return $this->beLongsTo('App\Models\Brand');
    }

    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit('10');
    }

    public static function getProductByCart($id){
        return self::where('id',$id)->get()->toArray();
    }

}
