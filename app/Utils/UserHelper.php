<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class  UserHelper
{
   public static function getBalance()
   {
       if (Auth::check()) {
           return Auth::user()->balance;
       }

       return 0;
   }
}
