<?php

class M_login extends CI_Model{

  function cek_login($muser,$where){

    return $this->db->get_where($muser,$where);

  }
}