<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function stok($kode)
{
        $query = "SELECT mbarang.total as stok FROM mbarang WHERE mbarang.kode = '$kode'";
        $hasil = pg_query($query);
        $data  = pg_fetch_array($hasil);
        $total  = $data['stok'];
    
    return $total;
}

?>