<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function tomboldetail($text)
{
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-success' data-toggle='tooltip' data-placement='top' title='Detail' onclick='detail(".$text.")'><i class='glyphicon glyphicon-list-alt'></i></a>
    	");
 
    return $text;
}
 
?>