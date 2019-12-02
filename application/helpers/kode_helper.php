<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function kode()
{
   		$today=date("Ymd");
        $query = "SELECT max(kode) AS last FROM xpenjualan WHERE kode LIKE '$today%'";
        $hasil = pg_query($query);
        $data  = pg_fetch_array($hasil);
        $lastNoTransaksi = $data['last'];
        $lastNoUrut = substr($lastNoTransaksi, 8, 3);
        $nextNoUrut =  $lastNoUrut + 1;
        $kode = $today.sprintf('%03s', $nextNoUrut);
 
    return $kode;
}

?>