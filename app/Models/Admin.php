<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
         'name',  'email', 'password' , 'is_super'
     ];
     protected $hidden = [
        'password', 'remember_token', 'is_super'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];




       
}
