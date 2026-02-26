<?php
namespace App\Traits;

use DateTime;
use Exception;

trait HasHumanTime {
    /**
     * Calculates precise difference and returns a human-readable string.
     */
    public function getDetailedAge(string $date): string {
        try {
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
        } catch (Exception $e) {
            return "Invalid date format";
        }
    }

    /**
     * Generates advanced statistics and fixes the parsing error.
     */
    public function getStats(string $date): array {
        try {
            $start = new DateTime($date);
            $now = new DateTime();
            $diff = $now->diff($start);

            $totalDays = $diff->days;
            
            // FIX: We must provide a Year. We'll use the current year.
            $currentYear = $now->format('Y');
            $birthdayString = $currentYear . '-' . $start->format('m-d');
            $nextBday = new DateTime($birthdayString);

            // If the birthday has already passed this year, move to the next year
            if ($nextBday < $now && $now->format('m-d') !== $start->format('m-d')) {
                $nextBday->modify('+1 year');
            }

            $untilBday = $now->diff($nextBday);

            return [
                'total_days'    => number_format($totalDays),
                'total_weeks'   => number_format(floor($totalDays / 7)),
                'total_hours'   => number_format(($totalDays * 24) + $diff->h),
                'days_until_next' => $untilBday->days,
                'is_birthday'   => ($now->format('m-d') === $start->format('m-d')),
                // NEW FEATURE: Life Progress Percentage (based on 80-year expectancy)
                'life_progress' => min(100, round(($diff->y / 80) * 100, 1)),
                'weeks_lived'     => floor($totalDays / 7),
                'total_weeks_life' => 80 * 52, // 80 years in weeks
                'mercury_age'     => round($totalDays / 87.97, 1),
                'mars_age'        => round($totalDays / 686.98, 1),
                'jupiter_age'     => round($totalDays / 4332.59, 2),
            ];
        } catch (Exception $e) {
            return [];
        }
    }
}