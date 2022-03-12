<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'photo',
        'is_parent',
        'sammary',
        'parent_id',
        'status',
       
    ];

    public static function shifChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }

    public static function getChildByParentId($id){
        //return Category::where('parent_id',$id)->get();
        return Category::where('parent_id',$id)->pluck('title','id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product','cat_id','id');
    }
}
