<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function tomboldetaildu($text)
{
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Edit' onclick='detail_edit(".$text.")'><i class='glyphicon glyphicon-pencil'></i></a>
    	<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus' onclick='delete_detail(".$text.")'><i class='glyphicon glyphicon-trash'></i></a>");
 
    return $text;
}
 
?>