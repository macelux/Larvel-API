<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\SoftDeletes;






class User extends Authenticatable implements JWTSubject

{
    use HasFactory;
    use Notifiable;
//    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id','first_name','last_name','email','password','address','city','country','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getFullname()
    {
         return $this->first_name. ' '. $this->last_name;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public static function seedDb()
    {

    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected static function booted()
    {

    }
    public function scopePopular($query)
    {
        return $query->where('votes' , '>' , 100    );
    }
    public function scopeActive($query)
    {
        return $query->where('active'  , 1);
    }


    public function scopeofType($query , $type)
    {
        return $query->where('type' , $type);

    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function carts()
    {
        return $this->hasMany(CartItem::class , 'customer_id');
    }




}
