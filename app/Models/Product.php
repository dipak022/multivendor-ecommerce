<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','slug','sammary','description','strock','brand_id','cat_id','clild_cat_id','photo','price','offer_price','discount','size','conditions','vandor_id','status',
    ];

    public function brand(){
        return $this->beLongsTo('App\Models\Brand');

    }
}
