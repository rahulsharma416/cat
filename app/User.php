<?php

namespace App;

use Log;
use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Eloquent implements Authenticatable
{
   use Notifiable;
   use AuthenticableTrait;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'name', 'email', 'password', 'user_type',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       'password', 'remember_token',
   ];

   public function bills() {
      return $this->hasMany('App\Bill');
   }   
   
   /**
    * Automatically creates hash for the user password.
    *
    * @param  string  $value
    * @return void
    */
   public function setPasswordAttribute($value)
   {
     $hashValue = Hash::make($value);
     Log::info("VALUE: $value");
     Log::info("HASHED VALUE: " . $hashValue);
     $this->attributes['password'] = $hashValue;
     
   }

   public function getAuthIdentifier()
   {
      return $this->attributes['id'];
   }

   public function getAuthIdentifierName()
   {
     return "id";
   }

   public function getAuthPassword()
   {
       Log::info("PASSWORD: " . $this->attributes['password']);
       return $this->attributes['password'];
   }

   public function getRememberToken()
   {

   }

   public function getRememberTokenName()
   {

   }

   public function setRememberToken($value)
   {

   }

}
