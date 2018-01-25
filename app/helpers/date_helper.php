<?php 

use Carbon\Carbon;

function convertDateFromClient($data_due, $time, $timezone) {
    $dates = explode('-', $data_due);
    $month = $dates[0];
    $day = $dates[1];
    $year = $dates[2];
    if($dates[2][0] == 0 || $dates[2][0] == 1) {
        $year = "20".$year;
    } else {
        $year = "19".$year;
    }
    $due = Carbon::create($year, $month, $day, $time[0], $time[1], $time[2], $timezone);
    return $due;
}
