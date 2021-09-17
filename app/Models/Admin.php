<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
//
//
//, CanResetPassword
class Admin extends Authenticatable implements MustVerifyEmail , CanResetPassword
{
    use HasFactory;
    use Notifiable;
    use \Illuminate\Auth\Passwords\CanResetPassword;
    
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
         'name',  'email', 'password' , 'is_super'
     ];
     protected $hidden = [
        'password', 'remember_token', 'is_super'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'data' => 'array'
    ];




       
}
