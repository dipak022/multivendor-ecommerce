<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Seller extends Authenticatable
{
    use HasFactory;
    protected $guard='sellers';
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'photo',
        'phone',
        'address',
        'status',
        'is_verified',
       
    ];

}
