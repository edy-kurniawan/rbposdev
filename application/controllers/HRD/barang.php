<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        {
            if ($this->session->userdata['level'] == 'hrd')
                    { }
        else
                    {   redirect('errors/forbidden');   }
        }
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect(base_url('login'));
        }
         $this->load->library('form_validation'); 
         $this->load->helper(array('form', 'url','see')); 
         $this->load->model(array('DbHelper', 'M_barang')); 
    

        // $this->load->model('M_login');
    }

    public function index(){
        $this->load->view('hrd/v_barang');
    }
 public function setView(){
        $result = $this->M_barang->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "kode"      => $r->kode,
                        "nama"      => $r->nama,
                        "satuan"    => $r->sat,
                        "kategori"  => $r->kat,
                        "supplier"  => $r->sup,
                        "harga"     => $r->harga,
                        "diskon"    => $r->ref_diskon,
                        "total"     => $r->total,
                        "aktif"     => $r->aktif,
                        "action"    => see($r->id)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

public function detail_data($id)
    {
        $data = $this->M_barang->detail($id);
        echo json_encode($data);
    }
 
   
	
}
