<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        {
            if ($this->session->userdata['level'] == 'gudang')
                    { }
        else
                    {   redirect('errors/forbidden');   }
        }
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect(base_url('login'));
        }
        
         $this->load->helper(array('form', 'url','tombol')); 
         $this->load->model(array('DbHelper', 'M_kategori')); 
    }

    public function index(){
        $this->load->view('gudang/v_kategori');
    }
 public function setView(){
        $result = $this->M_kategori->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "id"       => $r->id,
                        "nama"    => $r->nama,
                        "ket"      => $r->ket,
                        "action"     => tombol($r->id)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_kategori->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $user = $this->session->userdata("nama");
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');
 
        $data = array(
            "useri"       => $user,
            "datei"        => 'now()',
            "kode"          => $kode,
            "nama"       => $nama,
            "ket"     => $ket
            );

        $this->M_kategori->inputdata($data,'mkategori');
        echo json_encode(array("status" => TRUE));
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_kategori->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        
        $user = $this->session->userdata("nama");
        $id = $this->input->post('id');      
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');
 
        $data = array(
            "useru"       => $user,
            "dateu"        => 'now()',
            "kode"          => $kode,
            "nama"       => $nama,
            "ket"     => $ket
            );

        $where = array(
        'id' => $id
    );
 
        $this->M_kategori->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

 
   
	
}
