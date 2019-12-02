<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function tombol($text)
{
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='glyphicon glyphicon-pencil'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus' onclick='delete_data(".$text.")'><i class='glyphicon glyphicon-trash'></i></a>");
 
    return $text;
}

?>