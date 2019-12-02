<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('status')) {
    function platform($text)
    {
        if ($text=='d') {
            $text = '<span class="label label-success">Desktop</span>';
        }
        if ($text=='m') {
            $text = '<span class="label label-danger">Mobile</span>';
        }
        if ($text=='w') {
            $text = '<span class="label label-primary">Web</span>';
        }
       
        return $text;
    }
}