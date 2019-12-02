<?php

class Login extends CI_Controller{

    function __construct(){
        parent::__construct();

        $this->load->model('M_login');

    }

    function index(){
        $this->load->view('v_login');
    }

    function aksi_login(){
        $username = $this->input->post('nama_user');
        $password = $this->input->post('pass');
        $where = array(
            'nama' => $username,
            'pass' => md5($password),
            );
        $cek = $this->M_login->cek_login("muser",$where)->num_rows();
        if($cek > 0){
           $query = $this->db->query("SELECT
                                    muser.kode,
                                    muser.nama,
                                    muser.pass,
                                    muser.ref_level,
                                    mlevel.nama lvl,
                                    mkaryawan.nama,
                                    mkaryawan.nik
                                    FROM muser
                                    JOIN mkaryawan ON mkaryawan.nik = muser.ref_karyawan
                                    JOIN mlevel on muser.ref_level = mlevel.kode 
                                    where muser.aktif='t' and mkaryawan.aktif='t'
                                    and muser.nama='$username'
                                    ");
            $row = $query->row();
            $data_session = array(
                'nama_user' => $username,
                'status'    => "online",
                'logged'    => TRUE,
                'kode'        => $row->kode,
                'nama'      => $row->nama,
                'nik'       => $row->nik,
                'level'   => $row->lvl,
                
            );

            $this->session->set_userdata($data_session);

            $this->session->set_flashdata('message', '<div  class="col-md-3 alrt-success alert-dismissible" data-dismiss="alert" aria-hidden="true" >
                <i class="icon fa fa-check"></i>
                Login Sukses
              </div>');
                redirect('dashboard');

        }else{
            $this->session->set_flashdata('message', '<div style="color : red;">Username dan password Tidak Ditemukan</div>');
            redirect('login');
        }
    }
    
    function logout(){
        $this->session->unset_userdata('logged');
        redirect(base_url('login'));
    }
}
