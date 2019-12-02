<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DbHelper extends CI_Model{

    public $FAC             = 'Prompt';

    public $Tuser           = 'muser';
    public $Tlevel          = 'mlevel';
    
    public $Tsat            = 'msatuan';
    public $Tktg            = 'mkategori';
    public $TProduct        = 'mbarang';
    public $Tsup            = 'msupplier';
    public $Tjabatan        = 'mjabatan';  
    
    public $TPenjualan    = 'xpenjualan';
    public $TPenjualand   = 'xpenjualand';

    public $PK              = 'id';
    
    public $SUCCESS         = 'sukses';
    public $ERROR           = 'error';

    public $Name            = 'nama';


    public $mbarang            = 'mbarang';
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');  
    }

    public $Email_Config = Array(        
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_port'     => 465,
            'smtp_user'     => 'SMTP Username',
            'smtp_pass'     => 'SMTP Password',
            // 'smtp_timeout'  => '4',
            'mailtype'      => 'html', 
            'charset'       => 'iso-8859-1',
            'crlf'          => "\r\n",
            'newline'       => "\r\n"
    );
    
    

    function getKodeByID($id, $table){
        $sql    = "select kode as kode from ".$table." where id = '$id'";
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $res = $data->row();

            return $res->kode;
        }
    }

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
    
    function getKodeAndNama($table, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        return $this->execQuery($sql);
    }

    function getjabatan($table, $str, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode] = $r->nama;
            }
        }
        
        return $result;
    }


    function getlevel($table, $str, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode] = $r->nama;
            }
        }
        
        return $result;
    }

    function getkasir($table, $str, $where = NULL){
        $sql    = "select kode, nama from ".$table." where ref_level='011' ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode] = $r->nama;
            }
        }
        
        return $result;
    }

    function getsatuan($table, $str, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode] = $r->nama;
            }
        }
        
        return $result;
    }

    function getsupplier($table, $str, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode] = $r->nama;
            }
        }
        
        return $result;
    }

    function getkategori($table, $str, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode] = $r->nama;
            }
        }
        
        return $result;
    }

    function getIdcNamaCust($table, $str, $where = NULL){
        $sql    = "select idc, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->idc] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->idc] = $r->nama;
            }
        }
        
        return $result;
    }

    function getComboByValueSeperator($table, $str, $sepertor, $where = NULL){
        $sql    = "select kode, nama from ".$table." ";
        if ($where) {

            $sql .= $where;
        }
        $sql    .= " order by nama asc";
        
        $data   = $this->execQuery($sql);
        if ($data->num_rows() == 1) {
            $row = $data->row();
        } else {
            $row = $data->result();
        } 

        $result['']     = $str;
        if (count($row) == 1) {
            $result[$row->kode.$sepertor.$row->nama] = $row->nama;
        }else{
            foreach ($row as $r) {
                $result[$r->kode.$sepertor.$r->nama] = $r->nama;
            }
        }
        
        return $result;
    }

    function getProfil(){
        $sql    = "select * from tcompany limit 1";

        return $this->execQuery($sql)->row();
    }

    function isPosted($table, $where){
        $this->execQuery("update ".$table." set posted = true where ".$where);
    }

    function isVoid($table, $where){
        $this->execQuery("update ".$table." set void = true where ".$where);
    }

    function insert($table, $data, $return = TRUE){
        $this->db->set($data);
        $this->db->insert($table);

        $id = $this->db->insert_id();

        if ($return == TRUE) {
            return $this->getKodeByID($id, $table); 
        }        
    }

    function insertMultiple($table, $data){

        $this->db->insert_batch($table, $data);
    }

    function update($table, $data, $id, $field = 'id'){
        $this->db->set($data);
        $this->db->where($field, $id);
        $this->db->update($table);

        return $id;
    }

    function update_sql($table, $data, $where){

        return $this->db->update_string($table, $data, $where);
    }

    function insert_sql($table, $data){

        return $this->db->insert_string($table, $data);
    }

    function delete($table, $id, $field = 'id'){
        try{
            $this->db->where($field, $id);
            $this->db->delete($table);

            return json_encode(array(
                                'msg'       => $this->SUCCESS, 
                                'feedback'  => $id)
            );
        }catch (Exception $e){
            return json_encode(array(
                                'msg'       => $this->ERROR, 
                                'feedback'  => $id)
            );
        }
    }

    function beginTrx(){

        $this->db->trans_begin();
    }

    function rollbackTrx(){

        $this->db->trans_rollback();
    }

    function commitTrx(){

        $this->db->trans_commit();
    }

    function statusTrx(){

        return $this->db->trans_status();
    }

    function execQuery($sql){
        
        return $this->db->query($sql);
    }

    function loggedin() {

        return (bool) $this->session->userdata($this->FAC);
    }
}