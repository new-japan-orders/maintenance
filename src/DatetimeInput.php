<?php

namespace NewJapanOrders\Maintenance;

use \DateTime;

class DatetimeInput
{
    static public function combine($datetime)
    {
        $combined = sprintf(
            "%s-%s-%s %s:%s:%s",
            $datetime['year'] ?? '0000',
            $datetime['month'] ?? '00',
            $datetime['day'] ?? '00',
            $datetime['hour'] ?? '00',
            $datetime['min'] ?? '00',
            $datetime['sec'] ?? '00'
        );
        
        return $combined;
    }

    static public function separate($datetime)
    {
        $datetime = new DateTime($datetime);
        $separated = [
            'year' => $datetime->format('Y'),
            'month' => $datetime->format('n'),
            'day' => $datetime->format('j'),
            'hour' => $datetime->format('G'),
            'min' => ltrim($datetime->format('i'), "0"),
            'sec' => ltrim($datetime->format('s'), "0"),
        ];
        return $separated; 
    }
}
