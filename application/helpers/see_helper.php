<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function see($text)
{
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Detail' onclick='detail_data(".$text.")'><i class='fa fa-user'></i></a>");
 
    return $text;
}
 
?>