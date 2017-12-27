<?php

namespace App;

use Log;
use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Bill extends Eloquent
{
   use Notifiable;

   /**
    * The attributes that are mass assignable.
    * payment_type = job|fine
    * @var array
    */
   protected $fillable = [
       'user_id', 'amount_pending', 'total_amount', 'amount_paid', 'amount_paid_date'
   ];
}
