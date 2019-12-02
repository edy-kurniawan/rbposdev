<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lpenjualan extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        {
            if ($this->session->userdata['level'] == 'kasir')
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
         $this->load->helper(array('form', 'url','tomboldetail')); 
         $this->load->model(array('DbHelper', 'M_penjualan')); 

    }

    public function index(){
        $this->load->view('kasir/v_lpenjualan');
    }
   
    public function setView(){
        $result = $this->M_penjualan->getlaporan()->result();
        $list   = array();
        foreach ($result as $r) {
            $row    = array(
                        "kode"      => $r->kode,
                        "tgl"       => date('d-m-Y', strtotime($r->tgl)),
                        "kasir"    => $r->kasir,
                        "total"     => number_format($r->total),
                        'ket'     => $r->ket,
                        'action'    => tomboldetail($r->ref_detail)
            );
            $list[] = $row;
        }   
        echo json_encode(array('data' => $list));
    }

    }