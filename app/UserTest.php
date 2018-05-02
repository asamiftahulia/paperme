<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\InvoicePaid;

class UserTest extends Model
{
    use Notifiable;
    
}
