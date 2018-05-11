<?php

namespace NewJapanOrders\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
    protected $fillable = [ 
        'start_at', 'finish_at', 'finished_at',
    ];
}
