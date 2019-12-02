<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

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
         $this->load->helper(array('form', 'url','tombol','add','kode','detail','hapus','stok')); 
         $this->load->model(array('DbHelper', 'M_penjualan')); 
    

        // $this->load->model('M_login');
    }

    public function index(){
        
        $data['kodetrx'] = kode();
        $data['detail'] = kode();
        $data['sum'] = $this->DbHelper->total($data['detail']); 
        $this->load->view('kasir/v_penjualan', $data);
    }

    public function total(){
        
        $data['detail'] = detail();
        $data['sum'] = $this->DbHelper->total($data['detail']); 
    }

    public function cari(){
        
        $result = $this->M_penjualan->cari()->result();
        $list   = array();
        foreach ($result as $r) {
            $row    = array(
                        "id"       => $r->id,
                        "nama"    => $r->nama,
                        "kode"      => $r->kode,
                        "total"      => $r->total,
                        "harga"    => number_format($r->harga),
                        "ref_diskon"      => $r->ref_diskon,
                        "action"     => add($r->id)
            );

            $list[] = $row;
        }   

        echo json_encode(array('data' => $list));
    }

    public function detail(){
        $detail = $this->input->post('detail');
        $result = $this->M_penjualan->detail($detail)->result();   
        $list   = array();
        foreach ($result as $r) {
            $row    = array(
                        "id"       => $r->id,
                        "kode"    => $r->kode,
                        "total"     => $r->total,
                        "kode_brg"      => $r->kode_brg,
                        "harga"    => number_format($r->harga),
                        "nama"    => $r->nama,
                        "sub_total"    => number_format($r->sub_total),
                        "jumlah"    => number_format($r->jumlah),
                        "diskon"      => number_format($r->diskon),
                        "action"     => hapus($r->kode_brg)
            );

            $list[] = $row;
        }   

        echo json_encode(array('data' => $list));
    }

    public function hapus_brg($kode_brg)
    {
        $detail = $this->input->post('detail');
        $this->M_penjualan->delete_by_kode($kode_brg,$detail);
        $jumlah = $this->M_penjualan->cekstokxpenjualand($kode_brg,$detail);
        $stok = $this->M_penjualan->cekstok($kode_brg);
        $updatestok= $jumlah + $stok;
        $data = array(  
            "total"     => $updatestok
            );

        $where = array(
        'kode' => $kode_brg
    );
 
        $this->M_penjualan->update($where,$data);
        echo json_encode(array("status" => TRUE));
    }

    function simpan(){
        
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $user = $this->session->userdata("nama");
        $kode = $this->input->post('kode');
        $detail = $this->input->post('detail');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');
        
        if ($this->input->post('ref_diskon') == '')
                    
                    { $ref_diskon = null ;

                    $sub_total = $harga * $jumlah ; }
        else
                    {   $ref_diskon = $this->input->post('ref_diskon'); 

                    $sub_total = ($harga * $ref_diskon / 100 ) * $jumlah ;  }

        

        $data = array(
            
            "nama"       => $nama,
            "useri"       => $user,
            "datei"       => 'now()',
            "kode"       => $detail,
            "kode_brg"     => $kode,
            "diskon"     => $ref_diskon,
            "jumlah"     => $jumlah,
            "harga"     => $harga,
            "sub_total"     => $sub_total
            
            );

        $this->M_penjualan->inputdata($data,'xpenjualand');
        $this->kurangi_stok();
        echo json_encode(array("status" => TRUE));

        
    }

    function simpantransaksi(){

        $user = $this->session->userdata("nama");
        $kode = $this->input->post('kodetrx');
        $total = $this->input->post('total');  
 
        $data = array(
            "useri"       => $user,
            "datei"        => 'now()',
            "tgl"        => 'now()',
            "kode"          => $kode,
            "total"       => $total,
            "ref_detail"     => $kode
            );

        $this->M_penjualan->simpantransaksi($data,'xpenjualan');
        echo json_encode(array("status" => TRUE));
    }
    
       public function ajax_add($id)
    {
        $data = $this->M_penjualan->add($id);
        echo json_encode($data);
    }

    public function cekstok($kode_brg)
    {
        $detail = $this->input->post('detail');
        $data = $this->M_penjualan->cekstokxpenjualand($kode_brg,$detail);
        echo json_encode($data);
    }

    public function kurangi_stok()
    {
        $id = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');
        $updatestok = $total - $jumlah;

    $data = array(  
            "total"     => $updatestok
            );

        $where = array(
        'id' => $id
    );
 
        $this->M_penjualan->update($where,$data);

    }

    public function tambah_stok()
    {
        $id = $this->input->post('kode_brg');
        $total = "SELECT
                        mbarang.total
                    FROM
                        mbarang
                    WHERE mbarang.kode='$id'";
        $jumlah = $this->input->post('jumlah');
        $updatestok = $total + $jumlah;

    $data = array(  
            "total"     => $updatestok
            );

        $where = array(
        'id' => $id
    );
 
        $this->M_penjualan->update($where,$data);

    }
 
   
	
}
