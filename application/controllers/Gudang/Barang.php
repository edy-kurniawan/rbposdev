<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

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
        $this->load->model(array('DbHelper', 'M_barang')); 
    

        // $this->load->model('M_login');
    }

    public function index(){
        $data['ktg']   = $this->DbHelper->getkategori($this->DbHelper->Tktg, 'Pilih Kategori');
        $data['sup']   = $this->DbHelper->getsupplier($this->DbHelper->Tsup, 'Pilih Supplier');
        $data['sat']   = $this->DbHelper->getsatuan($this->DbHelper->Tsat, 'Pilih Satuan');
        $this->load->view('gudang/v_barang', $data);
    }
 public function setView(){
        $result = $this->M_barang->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "id"       => $r->id,
                        "kode"        => $r->kode,
                        "nama"    => $r->nama,
                        "ref_kategori"    => $r->kat,                       
                        "harga"    => $r->harga,
                        "total"    => $r->total,
                        "ref_diskon"    => $r->ref_diskon,
                        "ref_supplier"    => $r->sup,
                        "aktif"      => $r->aktif,
                        "satuan"     => $r->sat,
                        "action"     => tombol($r->id)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_barang->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

   function ajax_add(){

        $user = $this->session->userdata("nama");
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');       
        $harga = $this->input->post('harga');
        $total = $this->input->post('total');
        $satuan = $this->input->post('satuan');
        $ref_supplier = $this->input->post('ref_supplier');
        $aktif = $this->input->post('aktif');
        $ref_kategori = $this->input->post('ref_kategori');

        if ($this->input->post('ref_diskon') == '')
                    
                    { $ref_diskon = NULL ; }
        else
                    {   $ref_diskon = $this->input->post('ref_diskon');   }
 
        $data = array(
            "useri"       => $user,
            "datei"        => 'now()',
            "tgl"        => 'now()',
            "kode"        => $kode,
            "nama"    => $nama,
            "total"    => $total,
            "harga"    => $harga,
            "ref_diskon"    => $ref_diskon,
            "ref_kategori"    => $ref_kategori,
            "ref_supplier"    => $ref_supplier,
            "aktif"      => $aktif,
            "satuan"     => $satuan,
            );
        $this->M_barang->inputdata($data,'mbarang');
        echo json_encode(array("status" => TRUE));
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_barang->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){

        $id = $this->input->post('id');
        $user = $this->session->userdata("nama");
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $total = $this->input->post('total');
        $harga = $this->input->post('harga');
        $satuan = $this->input->post('satuan');
        $ref_supplier = $this->input->post('ref_supplier');
        $aktif = $this->input->post('aktif');
        $ref_kategori = $this->input->post('ref_kategori');
 
     if ($this->input->post('ref_diskon') == '')
                    
                    { $ref_diskon = NULL ; }
        else
                    {   $ref_diskon = $this->input->post('ref_diskon');   }
       
        $data = array(
            "useru"       => $user,
            "dateu"        => 'now()',
            "kode"        => $kode,
            "nama"    => $nama,
            "total"    => $total,
            "harga"    => $harga,
            "ref_diskon"    => $ref_diskon,
            "ref_kategori"    => $ref_kategori,
            "ref_supplier"    => $ref_supplier,
            "aktif"      => $aktif,
            "satuan"     => $satuan,
            );
        $where = array(
        'id' => $id
    );
 
        $this->M_barang->update($where,$data);
        echo json_encode(array("status" => TRUE));

}
 
   
	
}
