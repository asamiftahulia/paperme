<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    //
    protected $connection = 'secondary';
    protected $table = 's_user_job';
}
