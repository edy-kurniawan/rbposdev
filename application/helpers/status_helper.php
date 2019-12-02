<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('status')) {
    function status($text)
    {
        if ($text=='f') {
            $text = '<span class="label label-danger">Tidak Selesai</span>';
        }
        else {
            $text = '<span class="label label-success">Selesai</span>';
        }
       
        return $text;
    }
}