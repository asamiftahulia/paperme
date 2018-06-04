<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    // //
    // protected $connection = 'secondary';
    // protected $table='users';
    // protected $primaryKey = 'nik';
    protected $connection = 'secondary';
    protected $table = 'flow_cabang';
    protected $primaryKey = 'id';
    
    
}
