<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

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
         $this->load->helper(array('form', 'url','see','tomboldetail')); 
         $this->load->model(array('DbHelper', 'M_penjualan')); 
    

        // $this->load->model('M_login');
    }

    public function index(){
        $data['kasir']  = $this->DbHelper->getkasir($this->DbHelper->Tuser, 'Pilih Kasir');
        $this->load->view('hrd/v_penjualan', $data);
    }
   
    public function setView(){
        $awal   = date('Y-m-d', strtotime($this->input->post('awal')));
        $akhir  = date('Y-m-d', strtotime($this->input->post('akhir')));
        $kasir  = $this->input->post('kasir');
        $result = $this->M_penjualan->getSemua($awal, $akhir, $kasir)->result();
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

    public function setDetail(){
        $ref_detail   = $this->input->post('ref_detail');
        $result = $this->M_penjualan->getDetail($ref_detail)->result();
        $no     = 1;
        $str    = '<table class="table table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Sub Total</th>
                    </tr>';
        foreach ($result as $r) {
            $str    .= '<tr>
                            <td>'.$no.'</td>
                            <td>'.$r->kode_brg.'</td>
                            <td>'.$r->nama.'</td>
                            <td>'.$r->jumlah.'</td>
                            <td>'.$r->diskon.'</td>
                            <td>'.number_format($r->harga).'</td>
                            <td>'.number_format($r->sub_total).'</td>
                        </tr>';

            $no++;
        }

            $str    .= '</table>';
        echo $str;
    }
	
}
