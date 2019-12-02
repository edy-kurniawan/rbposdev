<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

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
         $this->load->helper(array('form', 'url','tombol')); 
         $this->load->model(array('DbHelper', 'M_jabatan')); 
    

        // $this->load->model('M_login');
    }

    public function index(){
        $this->load->view('hrd/v_jabatan');
    }
 public function setView(){
        $result = $this->M_jabatan->getSemua()->result();
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
        $this->M_jabatan->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $user = $this->session->userdata("nama");
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');
 
        $data = array(
            "useri"       => $user,
            "datei"        => 'now()',
            "nama"       => $nama,
            "ket"     => $ket
            );
        $this->M_jabatan->inputdata($data,'mjabatan');
        echo json_encode(array("status" => TRUE));
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_jabatan->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $user = $this->session->userdata("nama");
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');

    $data = array(  
            "useru"         =>$user,
            "dateu"         => 'now()',     
            "nama"       => $nama,
            "ket"     => $ket
            );

        $where = array(
        'id' => $id
    );
 
        $this->M_jabatan->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

 
   
	
}
