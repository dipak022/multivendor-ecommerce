<?php
class Helpers{
    public static function UserDefaultImage(){
        return asset('frontend/avatar.png');
    }

    public static function minPrice(){
        return floor(App\Models\Product::min('offer_price'));
    }

    public static function maxPrice(){
        return floor(App\Models\Product::max('offer_price'));
    }
}