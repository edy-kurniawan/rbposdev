<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    function getSemua(){
        $sql    =   "SELECT
                        msupplier.id,
                        msupplier.nama,
                        msupplier.kode,
                        msupplier.alamat,
                        msupplier.telp,
                        msupplier.fax,
                        msupplier.email,
                        msupplier.ket
                    FROM
                        msupplier";
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
                        msupplier.id,
                        msupplier.kode,
                        msupplier.nama,
                        msupplier.alamat,
                        msupplier.telp,
                        msupplier.fax,
                        msupplier.email,
                        msupplier.ket
                        FROM msupplier
                                where msupplier.id='$id'");
       return $query->row(); 
    }

     public function delete_by_kode($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('msupplier');
    }  
     public function update($where, $data)
    {
        $this->db->update('msupplier', $data, $where);
    }
 

}
