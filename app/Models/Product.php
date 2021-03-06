<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','slug','sammary','description','strock','brand_id','cat_id','clild_cat_id','photo','price',
        'offer_price','discount','size','conditions','vandor_id','status','additional_info','return_cancellation','size_guide','added_by','user_id',
    ];

    public function brand(){
        return $this->beLongsTo('App\Models\Brand');
    }

    public function category(){
        return $this->beLongsTo('App\Models\Category','cat_id','id');
    }

    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit('10');
    }

    public static function getProductByCart($id){
        return self::where('id',$id)->get()->toArray();
    }

    public function oders(){
        return $this->beLongsToMany(Order::class,'product_orders')->withPivot('quantity');
    }

    public function reviews(){
        return $this->hasMany(ProductReview::class);
    }

}
