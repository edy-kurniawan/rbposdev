<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
         $this->load->helper(array('form', 'url','tombol')); 
         $this->load->model(array('DbHelper', 'M_user')); 
         $this->load->library('form_validation'); 

    }

    public function index(){
        $data['level']   = $this->DbHelper->getlevel($this->DbHelper->Tlevel, 'Pilih Level');
        $this->load->view('hrd/v_user', $data);
    }
 public function setView(){
        $result = $this->M_user->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "id"       => $r->id,
                        "nik"        => $r->ref_karyawan,
                        "nama"    => $r->nama,
                        "pass"      => $r->pass,
                        "lvl"    => $r->lvl,
                        "aktif"      => $r->aktif,
                        "action"     => tombol($r->id)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_user->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $user = $this->session->userdata("nama");
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $pass = $this->input->post('pass');
        $level = $this->input->post('level');
        $aktif = $this->input->post('aktif');
 
        $data = array(
            "useri"       => $user,
            "datei"        => 'now()',
            "ref_karyawan"        => $nik,
            "nama"       => $nama,
            "pass"     => md5($pass),
            "ref_level"       => $level,
            "aktif"     => $aktif
            );

        $this->M_user->inputdata($data,'muser');
        echo json_encode(array("status" => TRUE));    
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_user->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $user = $this->session->userdata("nama");
        $id = $this->input->post('id');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $pass = $this->input->post('pass');       
        $level = $this->input->post('level');
        $aktif = $this->input->post('aktif');

    $data = array(  
            "useru"         =>$user,
            "dateu"         => 'now()',            
            "ref_karyawan"  => $nik,
            "nama"          => $nama,
            "pass"          => md5($pass),
            "ref_level"     => $level,
            "aktif"         => $aktif
            );

        $where = array(
        'id' => $id
    );
 
        $this->M_user->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

 
   
	
}
