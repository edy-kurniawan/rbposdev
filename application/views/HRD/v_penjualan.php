<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Penjualan</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
  $this->load->view('template/head');
  $this->load->helper('indonesian_date');
  ?>
  <style type="text/css">
  td.details-control {
          background: url('<?php echo base_url(); ?>assets/details_open.png') no-repeat center center;
          cursor: pointer;
        }
        tr.shown td.details-control {
          background: url('<?php echo base_url(); ?>assets/details_close.png') no-repeat center center;
        }
  </style>
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')?>">
  <link href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>">
  </head>

  <?php
    $this->load->view('template/topbar');
    $this->load->view('template/sidebar');
  ?>


  <section class="content-header">
    <h1>
      Laporan Penjualan 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan Penjualan</li>
    </ol>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header bg-green">
            
            <div class="pull-right box-tools">
              <button class="btn btn-default btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>

            <i class="fa fa-search"></i>
            <h3 class="box-title">
              Filter Data
            </h3>
          </div>
          <div class="box-body">
            <form id="form_filter">
              <div class="row">

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Periode Awal:</label>
                    <input type="text" class="form-control tgl" placeholder="Periode Awal" id="awal" name="awal" />
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Sampai Dengan:</label>
                    <input type="text" class="form-control tgl" placeholder="Periode Akhir" id="akhir" name="akhir" />
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Kasir:</label>
                    <?php
                      echo form_dropdown('kasir', $kasir, '', 'class="form-control" id="kasir" name="kasir" required'); 
                    ?>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
                  <button class="btn btn-default " onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div>
          <div class="box-body">
            <div class="table-responsive mailbox-messages">                    
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Ket</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>

  <?php
  $this->load->view('template/js');
  ?>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/delconfirmation.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/select2/select2.full.min.js')?>"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bootstrap/js/moment.min.js"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
        
  <script>
    $(function () {
      $('.tgl').daterangepicker({
        singleDatePicker: true,
        timePicker: false, 
        format: 'DD-MM-YYYY'
      });

      $('#awal').val(moment().format('DD-MM-YYYY'));
      $('#akhir').val(moment().format('DD-MM-YYYY'));
    });
  </script>
   
  <script type="text/javascript">
        var table;
        var tablemodal;
        var save_method;

        $(document).ready(function() {
          table = $('#table').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('hrd/penjualan/setView'); ?>",
                "type": "POST",
                "data": {
                awal  : function() { return $('#awal').val() },
                akhir : function() { return $('#akhir').val() },
                bayar : function() { return $('#kasir').val() }
              }
            },
            "columns": [

              { "data": "kode" },   
              { "data": "tgl" },
              { "data": "kasir" },
              { "data": "total" },             
              { "data": "ket" },
              { "data": "action" }
            ],
            "order": [[0, 'asc']]
          });
        });

    function detail_data(id)
    {
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    url : "<?php echo base_url('hrd/barang/detail_data')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="useri"]').val(data.useri);
    $('[name="useru"]').val(data.useru);
    $('[name="datei"]').val(data.datei);
    $('[name="dateu"]').val(data.dateu);
    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Detail data barang'); // Set title to Bootstrap modal title
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }

    function reload_table()
    {
    table.ajax.reload(null,false); //reload datatable ajax
    }
   </script>
  </body>
</html>