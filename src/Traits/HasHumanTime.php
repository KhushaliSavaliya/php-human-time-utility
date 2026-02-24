<?php

namespace App\Traits;

use DateTime;

trait HasHumanTime {
    /**
     * Calculates precise difference and returns a human-readable string.
     */
    public function getDetailedAge(string $date): string {
        $start = new DateTime($date);
        $now = new DateTime();
        
        if ($start > $now) return "Date is in the future";

        $diff = $now->diff($start);

        $parts = [
            'y' => 'year',
            'm' => 'month',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];

        $output = [];
        foreach ($parts as $key => $label) {
            if ($diff->$key > 0) {
                $output[] = $diff->$key . ' ' . $label . ($diff->$key > 1 ? 's' : '');
            }
        }

        return $output ? implode(', ', $output) : 'Just now';
    }

    /** Keep your existing method for the "Time Ago" style **/
    public function getElapsed(string $date): string {
        $timestamp = strtotime($date);
        $seconds = time() - $timestamp;
        if ($seconds < 1) return 'Just now';
        
        $units = [31536000 => 'year', 2592000 => 'month', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second'];
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