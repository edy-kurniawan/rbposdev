<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function tombolworkorder($text)
{
    $text = ("
    	<a href='javascript:void(0)' class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='glyphicon glyphicon-pencil'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Void' onclick='void_data(".$text.")'><i class='glyphicon glyphicon-folder-close'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-primary' data-toggle='tooltip' data-placement='top' title='Print' onclick='showprint(".$text.")'><i class='glyphicon glyphicon-print'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-success' data-toggle='tooltip' data-placement='top' title='PDF' onclick='pdf(".$text.")'><i class='fa fa-file-pdf-o'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-info' data-toggle='tooltip' data-placement='top' title='Email' onclick='email(".$text.")'><i class='glyphicon glyphicon-envelope'></i></a>
    	");
 
    return $text;
}
 
?>