<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('time_ago')) {
function is_date_time_valid($date) {
if (date('Y-m-d H:i:s', strtotime($date)) == $date) {
return TRUE;
} else {
return FALSE;
}
}
function time_ago($date) {
$is_valid = is_date_time_valid($date);
if ($is_valid) {
$timestamp = strtotime($date);
$difference = time() - $timestamp;
$periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

if ($difference > 0) { // this was in the past time
$ending = "ago";
} else { // this was in the future time
$difference = -$difference;
$ending = "to go";
}
for ($j = 0; $difference >= $lengths[$j]; $j++)
$difference /= $lengths[$j];
$difference = round($difference);
if ($difference != 1)
$periods[$j].= "s";
$text = "$difference $periods[$j] $ending";
return $text;
}else {
return 'Date Time must be in "yyyy-mm-dd hh:mm:ss" format';
}
}
}