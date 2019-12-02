<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

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
        $this->load->model(array('DbHelper', 'M_karyawan')); 
    

        // $this->load->model('M_login');
    }

    public function index(){       
        $data['ref_jabatan']   = $this->DbHelper->getjabatan($this->DbHelper->Tjabatan, 'Pilih Jabatan');
        $this->load->view('hrd/v_karyawan', $data);
    }
 public function setView(){
        $result = $this->M_karyawan->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "id"       => $r->id,
                        "nik"        => $r->nik,
                        "nama"    => $r->nama,
                        "noktp"    => $r->noktp,
                        "nohp"    => $r->nohp,
                        "alamat"    => $r->alamat,
                        "tgllahir"      => $r->tgllahir,
                        "kelamin"     => $r->kelamin,
                        "jabatan"     => $r->jabatan,
                        "tglmasuk"     => $r->tglmasuk,
                        "aktif"    => $r->aktif,
                        "action"     => tombol($r->id)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_karyawan->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

   function ajax_add(){

        $user = $this->session->userdata("nama");
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $nohp = $this->input->post('nohp');
        $noktp = $this->input->post('noktp');
        $alamat = $this->input->post('alamat');
        $aktif = $this->input->post('aktif');
        $agama = $this->input->post('agama');
        $tglmasuk = $this->input->post('tglmasuk');
        $tgllahir = $this->input->post('tgllahir');
        $kelamin = $this->input->post('kelamin');  
        $jabatan = $this->input->post('jabatan');
 
        $data = array(
            "useri"       => $user,
            "datei"        => 'now()',
            "nik"        => $nik,
            "nama"       => $nama,
            "noktp"       => $noktp,
            "nohp"       => $nohp,
            "alamat"       => $alamat,
            "tglmasuk"       => $tglmasuk,
            "tgllahir"       => $tgllahir,
            "agama"       => $agama,
            "kelamin"       => $kelamin,       
            "ref_jabatan"       => $jabatan,
            "aktif"       => $aktif
            );
        $this->M_karyawan->inputdata($data,'mkaryawan');
        echo json_encode(array("status" => TRUE));
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_karyawan->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $user = $this->session->userdata("nama");
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $nohp = $this->input->post('nohp');
        $noktp = $this->input->post('noktp');
        $alamat = $this->input->post('alamat');
        $aktif = $this->input->post('aktif');
        $agama = $this->input->post('agama');
        $tglmasuk = $this->input->post('tglmasuk');
        $tgllahir = $this->input->post('tgllahir');
        $kelamin = $this->input->post('kelamin');
        $jabatan = $this->input->post('ref_jabatan');

    $data = array(     

            "useru"       => $user,
            "dateu"        => 'now()',
            "nik"        => $nik,
            "nama"       => $nama,
            "noktp"       => $noktp,
            "nohp"       => $nohp,
            "alamat"       => $alamat,
            "tglmasuk"       => $tglmasuk,
            "tgllahir"       => $tgllahir,   
            "ref_jabatan"       => $jabatan,
            "agama"       => $agama,
            "kelamin"       => $kelamin,
            "aktif"       => $aktif
           
            );

        $where = array(
        'id' => $id
    );
 
        $this->M_karyawan->update($where,$data);
        echo json_encode(array("status" => TRUE));

}
 
   
	
}
