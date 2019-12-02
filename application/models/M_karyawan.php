<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_karyawan extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    function getSemua(){
        $sql    =   "SELECT
                        mkaryawan.id,
                        mkaryawan.nik,
                        mkaryawan.nama,
                        mkaryawan.tgllahir,
                        mkaryawan.tglmasuk,
                        mkaryawan.alamat,
                        mkaryawan.nik,
                        mkaryawan.nohp,
                        mkaryawan.noktp,
                        mkaryawan.agama,
                        mkaryawan.aktif,
                        mkaryawan.kelamin,
                        mkaryawan.ref_jabatan,
                        mjabatan.kode,
                        mjabatan.nama jabatan
                    FROM
                        mkaryawan left outer join mjabatan
                        on mkaryawan.ref_jabatan=mjabatan.kode";
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
                        mkaryawan.id,
                        mkaryawan.nik,
                        mkaryawan.nama,
                        mkaryawan.tgllahir,
                        mkaryawan.tglmasuk,
                        mkaryawan.alamat,
                        mkaryawan.nik,
                        mkaryawan.nohp,
                        mkaryawan.noktp,
                        mkaryawan.agama,
                        mkaryawan.aktif,
                        mkaryawan.kelamin,
                        mkaryawan.ref_jabatan,
                        mjabatan.kode,
                        mjabatan.nama jabatan
                    FROM
                        mkaryawan left outer join mjabatan
                        on mkaryawan.ref_jabatan=mjabatan.kode
                                where mkaryawan.id='$id'");
       return $query->row(); 
    }

     public function delete_by_kode($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mkaryawan');
    }  
     public function update($where, $data)
    {
        $this->db->update('mkaryawan', $data, $where);
    }
 

}
