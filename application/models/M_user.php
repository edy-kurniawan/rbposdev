<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    function getSemua(){
                        $sql    =   "SELECT
                    muser.ID,
                    muser.kode,
                    muser.nama,
                    muser.pass,
                    muser.ref_karyawan,
                    muser.ref_level,
                    muser.aktif,
                    mkaryawan.nik,
                    mlevel.nama lvl
                FROM
                    muser
                    LEFT OUTER JOIN mkaryawan ON muser.ref_karyawan = mkaryawan.nik 
                    LEFT OUTER JOIN mlevel ON muser.ref_level = mlevel.kode
                        ";
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
                    muser.ID,
                    muser.kode,
                    muser.nama,
                    muser.ref_karyawan,
                    muser.ref_level,
                    muser.aktif,
                    mkaryawan.nik,
                    mlevel.nama lvl
                FROM
                    muser
                    LEFT OUTER JOIN mkaryawan ON muser.ref_karyawan = mkaryawan.nik 
                    LEFT OUTER JOIN mlevel ON muser.ref_level = mlevel.kode 
                                        where muser.id='$id'");
       return $query->row(); 
    }

     public function delete_by_kode($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('muser');
    }  
     public function update($where, $data)
    {
        $this->db->update('muser', $data, $where);
    }
 

}
