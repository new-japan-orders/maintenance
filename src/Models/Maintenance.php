<?php

namespace NewJapanOrders\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
    protected $fillable = [ 
        'start_at', 'finish_at', 'finished_at',
    ];

    public function scopeCurrent($query, $now=null)
    {
        if (is_null($now)) {
            $now = date('Y-m-d H:i:s');
        }
        
        $ret = $query->whereNull('finished_at')
                     ->orWhere(function($query) use ($now) {
                        $query->where('start_at', '<=', $now)
                              ->where('finish_at', '>=', $now);
                    });
        return $ret;
    }
}
