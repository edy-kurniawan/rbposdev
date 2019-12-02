<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function total($detail)
{
        $query = "SELECT SUM
                        ( sub_total ) AS total 
                    FROM
                        xpenjualand 
                    WHERE
                        xpenjualand.kode='$detail'";
        $hasil = pg_query($query);
        $data  = pg_fetch_array($hasil);
        $total = $data['total'];
        
 
    return $total;
}

?>