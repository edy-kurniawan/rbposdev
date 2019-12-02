<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Barang</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
  $this->load->view('template/head');
  ?>
 
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">
  <!-- Date Picker -->
  <link href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
  <!-- Daterange picker -->
  <link href="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>">
  
  <?php
    $this->load->view('template/topbar');
    $this->load->view('template/sidebar');
  ?>
  <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel"></h3>
          </div>
        <div class="modal-body">
          <div class="box-body pad">
            <form  id="form" class="form-horizontal">
                <div class="form-body"> 
                  <div class="form-group">
                    <label>Useri</label>
                      <input type="text" class="form-control" name="useri" disabled>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                  <div class="form-group">
                    <label>Useru</label>
                      <input type="text" class="form-control" name="useru" disabled>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>     
                  <div class="form-group">
                    <label>Datei</label>
                      <input type="text" class="form-control" name="datei" disabled>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                  <div class="form-group">
                    <label>Dateu</label>
                      <input type="text" class="form-control" name="dateu" disabled>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>      
              </div>
            </form>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
  <section class="content-header">
    <h1>
      Data Barang
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Barang</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          
        </div>
        <div class="box box-info">
          <div class="box-header">
              <button class="btn btn-default " onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div>

          <div class="box-body">
            
            <div class="table-responsive mailbox-messages">                    
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Total</th>
                    <th>Aktif</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <?php
  $this->load->view('template/js');
  ?>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/delconfirmation.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/select2/select2.full.min.js')?>"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bootstrap/js/moment.min.js"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script> 

  
  </script>
        
    <script type="text/javascript">
        var table;
        var tablemodal;
        var save_method;

        $(document).ready(function() {
          table = $('#table').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('hrd/barang/setView'); ?>",
                "type": "POST",
            },
            "columns": [

              { "data": "no" },
              { "data": "kode" },   
              { "data": "nama" },
              { "data": "satuan" },
              { "data": "kategori" },
              { "data": "supplier" },             
              { "data": "harga" },
              { "data": "diskon" },
              { "data": "total" },
              { "data": "aktif" },
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