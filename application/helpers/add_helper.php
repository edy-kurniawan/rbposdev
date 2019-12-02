<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function add($text)
{
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Add' onclick='add_data(".$text.")'><i class='glyphicon glyphicon-plus'></i></a>");
 
    return $text;
}

?>