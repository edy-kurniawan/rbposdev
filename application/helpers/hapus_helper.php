<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function hapus($text)
{
    $text = ("<a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus' onclick='delete_data(".$text.")'><i class='glyphicon glyphicon-trash'></i></a>");
 
    return $text;
}
 
?>