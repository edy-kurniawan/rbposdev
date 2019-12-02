<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function tomboltimeline($text)
{
	if ($r->startw != ''){
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='glyphicon glyphicon-pencil'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus' onclick='delete_data(".$text.")'><i class='glyphicon glyphicon-trash'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-info' data-toggle='tooltip' data-placement='top' title='Mulai' onclick='mulai(".$text.")'><i class='glyphicon glyphicon-play'></i></a>");
 
    return $text;
}else {

}
}
 
?>