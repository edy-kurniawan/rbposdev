<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    function getSemua(){
        $sql    =   "SELECT
                        mbarang.id,
                        mbarang.kode,
                        mbarang.nama,
                        mbarang.total,            
                        mbarang.harga,
                        mbarang.aktif,
                        mbarang.ref_supplier,
                        mbarang.ref_kategori,
                        mbarang.ref_diskon,
                        mbarang.satuan,
                        msatuan.nama sat,
                        msupplier.nama sup,
                        mkategori.nama kat
                    FROM
                        mbarang left outer join msupplier
                        on mbarang.ref_supplier=msupplier.kode
                        left outer join mkategori
                        on mbarang.ref_kategori=mkategori.kode
                        left outer join msatuan
                        on mbarang.satuan=msatuan.kode";
        return $this-> DbHelper->execQuery($sql);

    }


function hapus_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    function inputdata($data2,$table){
        $this->db->insert($table,$data2);
    }

    public function edit($id)
    {
     $query = $this->db->query("SELECT
                        mbarang.id,
                        mbarang.kode,
                        mbarang.nama,                                
                        mbarang.harga,
                        mbarang.total,
                        mbarang.aktif,
                        mbarang.ref_diskon,
                        mbarang.ref_supplier,
                        mbarang.ref_kategori,
                        mbarang.satuan,
                        msatuan.nama sat,
                        msupplier.nama sup,
                        mkategori.nama kat
                    FROM
                        mbarang left outer join msupplier
                        on mbarang.ref_supplier=msupplier.kode
                        left outer join mkategori
                        on mbarang.ref_kategori=mkategori.kode
                        left outer join msatuan
                        on mbarang.satuan=msatuan.kode
                        where mbarang.id='$id'");

       return $query->row(); 
    }

    public function detail($id)
    {
     $query = $this->db->query("SELECT
                        mbarang.useri,
                        mbarang.useru,
                        mbarang.datei,                                
                        mbarang.dateu
                    FROM mbarang
                        where mbarang.id='$id'");

       return $query->row(); 
    }

     public function delete_by_kode($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mbarang');
    }  
     public function update($where, $data)
    {
        $this->db->update('mbarang', $data, $where);
    }
 

}
