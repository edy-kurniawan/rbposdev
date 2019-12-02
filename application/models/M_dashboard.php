<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model{

    function __construct() {
        parent::__construct();
        
    }
   function countproduct(){

        $query = $this->db->query("SELECT count(kode) jml from mbarang ");
        return $query->row();
    }
    function countkaryawan(){

        $query = $this->db->query("SELECT count(nik) jml from mkaryawan where aktif = 't' ");
        return $query->row();
    }
    function countuser(){

        $query = $this->db->query("SELECT count(kode) jml from muser where aktif = 't' ");
        return $query->row();
    }
    function countsupplier(){

        $query = $this->db->query("SELECT count(kode) jml from msupplier");
        return $query->row();
    }
    function counttotal(){

        $query = $this->db->query("SELECT sum(total) jml from mbarang where aktif = 't' ");
        return $query->row();
    }
    function countkategori(){

        $query = $this->db->query("SELECT count(kode) jml from mkategori");
        return $query->row();
    }
    function countbarangmasuk(){
        $query  = $this->db->query("select mbarang.tgl, sum(mbarang.total) jumlah from mbarang  GROUP BY mbarang.tgl");
        return $query->result();
    }
}