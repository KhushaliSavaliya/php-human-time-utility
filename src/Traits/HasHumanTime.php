<?php

namespace App\Traits;

trait HasHumanTime {
    /**
     * Convert a date string into a "Time Ago" format.
     */
    public function getElapsed(string $date): string {
        $timestamp = strtotime($date);
        $seconds = time() - $timestamp;

        if ($seconds < 1) return 'Just now';

        $units = [
            31536000 => 'year',
            2592000  => 'month',
            86400    => 'day',
            3600     => 'hour',
            60       => 'minute',
            1        => 'second'
        ];

        foreach ($units as $unitSeconds => $label) {
            $division = $seconds / $unitSeconds;

            if ($division >= 1) {
                $value = round($division);
                return $value . ' ' . $label . ($value > 1 ? 's' : '') . ' ago';
            }
        }
        
        return $date;
    }
}