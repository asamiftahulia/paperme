<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowMapping extends Model
{
    //
    protected $connection = 'secondary';
    protected $table = 'flow_cabang';
}
