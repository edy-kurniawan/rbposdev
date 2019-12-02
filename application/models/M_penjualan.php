<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    
    function cari(){
        $sql    =   "SELECT
                        mbarang.id,
                        mbarang.nama,
                        mbarang.total,
                        mbarang.harga,
                        mbarang.ref_diskon,
                        mbarang.kode
                    FROM
                        mbarang
                    WHERE mbarang.total>='1'
                    AND mbarang.aktif='t'";
        return $this-> DbHelper->execQuery($sql);

    }

    function cekstokxpenjualand($kode_brg,$detail){
        $sql    =   "SELECT
                        mbarang.total, 
                        xpenjualand.kode_brg,                       
                        xpenjualand.jumlah
                    FROM           
                        xpenjualand left outer join mbarang
                        on xpenjualand.kode_brg=mbarang.kode
                    where
                    xpenjualand.kode_brg='$kode_brg'";
        return $this-> DbHelper->execQuery($sql);

    }

    function cekstok($kode_brg){
        $sql    =   "SELECT
                        mbarang.total
                    FROM
                        mbarang
                    WHERE mbarang.kode='$kode_brg'";
        return $this-> DbHelper->execQuery($sql);

    }

    function total($detail){
        $sql    =   "SELECT SUM
                        ( sub_total ) AS total 
                    FROM
                        xpenjualand 
                    WHERE
                        xpenjualand.kode='$detail'";
        return $this-> DbHelper->execQuery($sql);

    }

    function stok($kode){
        $sql    =   "SELECT mbarang.total
                     AS total
                     FROM mbarang  
                    where mbarang.kode='$kode'";
        return $this-> DbHelper->execQuery($sql);

    }

    function detail($detail){
       $sql    =   "    SELECT
                        mbarang.total, 
                        xpenjualand.id,
                        xpenjualand.kode,
                        xpenjualand.kode_brg,
                        xpenjualand.nama,
                        xpenjualand.harga,                        
                        xpenjualand.jumlah,    
                        xpenjualand.diskon,      
                        xpenjualand.sub_total
                    FROM           
                        xpenjualand left outer join mbarang
                        on xpenjualand.kode_brg=mbarang.kode
                        where xpenjualand.kode='$detail'";         
    
        return $this-> DbHelper->execQuery($sql);
    }

    function inputdata($data2,$table){
        $this->db->insert($table,$data2);
    }

    function simpantransaksi($data,$table){
        $this->db->insert($table,$data);
    }

    public function add($id)
    {
     $query = $this->db->query("SELECT
                        mbarang.id,
                        mbarang.nama,
                        mbarang.total,
                        mbarang.kode,
                        mbarang.harga,
                        mbarang.ref_diskon
                        FROM mbarang
                                where mbarang.id='$id'");
       return $query->row(); 
    }

     public function delete_by_kode($kode_brg,$detail)
    {
        $this->db->where('kode_brg', $kode_brg);
        $this->db->where('kode', $detail);
        $this->db->delete('xpenjualand');
    }  
    
     public function update($where, $data)
    {
        $this->db->update('mbarang', $data, $where);
    }

    function getlaporan(){
        $sql    =   "SELECT 
                    xpenjualan.id,
                    xpenjualan.kode,
                    xpenjualan.ref_detail,
                    xpenjualan.tgl,
                    xpenjualan.useri kasir,
                    xpenjualan.ket,
                    xpenjualan.total
                    FROM xpenjualan ";

        return $this->DbHelper->execQuery($sql);
    }

    function getSemua($awal, $akhir, $kasir = NULL){
        $sql    =   "SELECT 
                    xpenjualan.id,
                    xpenjualan.kode,
                    xpenjualan.ref_detail,
                    xpenjualan.tgl,
                    xpenjualan.useri kasir,
                    xpenjualan.ket,
                    xpenjualan.total
                    FROM xpenjualan ";
        $sql    .= "where xpenjualan.tgl between '$awal' and '$akhir'";
        if ($kasir) {
            $sql .= "and xpenjualan.useri = '$kasir'";
        }

        return $this->DbHelper->execQuery($sql);
    }

    function getDetail($ref_detail){
        $sql    =  "SELECT 
                    xpenjualand.kode,
                    xpenjualand.kode_brg,
                    xpenjualand.nama,
                    xpenjualand.jumlah,
                    xpenjualand.harga,
                    xpenjualand.sub_total,
                    xpenjualand.diskon
                    from xpenjualand
                    where xpenjualand.kode = '$ref_detail'";

        return $this->DbHelper->execQuery($sql);
    }   
 

}
