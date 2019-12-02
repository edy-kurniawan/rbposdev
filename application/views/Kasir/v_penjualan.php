<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Penjualan</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
  $this->load->view('template/head');
  ?>
 
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')?>">
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
              <input type="hidden" value="" name="id"/>
                <div class="form-body">
                    <input type="hidden" value="<?php echo $detail; ?>" name="detail" id="detail">
                      <input type="hidden" class="form-control" name="kode" >
                      <input type="hidden" class="form-control" name="nama" >
                      <input type="hidden" class="form-control" name="harga" >                      
                      <input type="hidden" class="form-control" name="total" >
                      <input type="hidden" class="form-control" name="ref_diskon">
                  <div class="form-group">
                    <label>Jumlah Beli</label>
                      <input type="text" class="form-control" onkeypress="return angka(event)" placeholder="Masukan Jumlah" name="jumlah" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>     
                </div>
            </form>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>

  <section class="content-header">
    <h1>
      Data penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Penjualan</li>
    </ol>
  </section>

  <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
   
    <div class="row">
          <!-- Custom tabs (Charts with tabs)-->
        <div class="col-md-7">
        <div class="box box-danger">
          <div class="box-header">
              <h2 class="box-title"><b>Data Transaksi</b></h2>
              <button class="btn btn-default pull-right" onclick="reload_table2()" data-toggle="tooltip" data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
              <button class="btn btn-default pull-right" onclick="simpantransaksi()" data-toggle="tooltip" data-placement="top" title="Simpan Transaksi"><i class="glyphicon glyphicon-check"></i> Simpan</button>
              <div class="form-group">
                  <br>
                  <label>Kode Transaksi</label>                                   
                  <input type="text" value="<?php echo $kodetrx; ?>" class="form-control" name="kodetrx" id="kodetrx" placeholder="Enter ..." disabled>
                  <input type="hidden" value="<?php echo $this->session->userdata("nama"); ?>" class="form-control">
                  <input type="hidden" value="<?php echo $detail; ?>" id="detail" name="detail">
              </div>
              <div class="form-group">
                    <label>Total</label>                  
                    <input type="text" value="<?php echo $sum; ?>" id="totalsum" name="totalsum" class="form-control" placeholder="Total ..." disabled>
              </div>
              <div class="form-group">
                    <label>Bayar</label>                  
                    <input type="text" id="uang" onkeyup="sum();" name="uang" class="form-control" placeholder="Bayar ...">
              </div>
              <div class="form-group">
                    <label>Kembalian</label>                  
                    <input type="text" id="kembalian" name="kembalian" class="form-control" placeholder="Kembalian ..." disabled>
              </div>
          </div>

          <div class="box-body">
            
            <div class="table-responsive mailbox-messages">                    
              <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>jumlah</th>
                    <th>Diskon</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>            
          </div>
        </div>
      </div>

      <div class="col-md-5  pull-right">
        <div class="box box-danger">
          <div class="box-header">
              <h3 class="box-title"><b>Cari Barang</b></h3>
              <button class="btn btn-default pull-right" onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div>

          <div class="box-body">
            
            <div class="table-responsive mailbox-messages">                    
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Diskon</th>
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
  
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/delconfirmation.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/select2/select2.full.min.js')?>"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bootstrap/js/moment.min.js"></script>
  
        
    <script type="text/javascript">
        var table;
        var tablemodal;
        var save_method;

        $(document).ready(function() {
          table = $('#table').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('kasir/penjualan/cari'); ?>",
                "type": "POST",
                "data": {
                detail : function() { return $('#detail').val() }
              }
            },
            "columns": [
  
              { "data": "kode" },
              { "data": "nama" },
              { "data": "harga" },
              { "data": "ref_diskon" },
              { "data": "action" }
            ],
            "order": [[0, 'asc']]
          });
        });

    function savetransaksi()
    {
    save_method = 'simpan';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_save').modal('show'); // show bootstrap modal
    $('.modal-title').text('Simpan Transaksi'); // Set Title to Bootstrap modal title
    }

    function reload_table()
    {
    table.ajax.reload(null,false); //reload datatable ajax
    }
    
    function add_data(id)
    {
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    url : "<?php echo base_url('kasir/penjualan/ajax_add')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="id"]').val(data.id);
    $('[name="nama"]').val(data.nama);
    $('[name="kode"]').val(data.kode);
    $('[name="total"]').val(data.total);
    $('[name="harga"]').val(data.harga);
    $('[name="ref_diskon"]').val(data.ref_diskon);
    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Masukan Jumlah Beli'); // Set title to Bootstrap modal title
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }

    function save()
    {
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    // ajax adding data to database
    $.ajax({
    url : "<?php echo base_url('kasir/penjualan/simpan')?>",
    type: "POST",
    data: $('#form').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.status) //if success close modal and reload ajax table
    {
    $('#modal_form').modal('hide');
    location.reload();
    }
    
    $('#btnSave').text('Save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    $('#btnSave').text('save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    location.reload();
    }
    });
    }

    function simpantransaksi()
    {
    if(confirm('Simpan Transaksi ?'))
    {
    // ajax delete data to database
    $.ajax({
    url : "<?php echo base_url('kasir/penjualan/simpantransaksi')?>/",
    type: "POST",
    "data": {
                kodetrx : function() { return $('#kodetrx').val() },
                total : function() { return $('#totalsum').val() }
              },
    dataType: "JSON",
    success: function(data)
    {
    //if success reload ajax table
    $('#modal_form').modal('hide');
    location.reload();
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('error');
    }
    });
    
    }
    }

</script>

<script type="text/javascript">
        var table2;
        var tablemodal;
        var save_method;

        $(document).ready(function() {
          table2 = $('#table2').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('kasir/penjualan/detail'); ?>",
                "type": "POST",
                "data": {
                detail : function() { return $('#detail').val() }
              }
            },
            "columns": [
  
              { "data": "kode_brg" },
              { "data": "nama" },
              { "data": "harga" },
              { "data": "jumlah" },
              { "data": "diskon" },      
              { "data": "sub_total"},
              { "data": "action"}
            ],
            "order": [[0, 'asc']]
          });
        });


    function reload_table2()
    {
    table2.ajax.reload(null,false); //reload datatable ajax
    }

    
    function delete_data(kode_brg)
    {
    if(confirm('Yakin Hapus Data ?'))
    {
    // ajax delete data to database
    $.ajax({
    url : "<?php echo base_url('kasir/penjualan/hapus_brg')?>/" +kode_brg,
    type: "POST",
    "data": {
                detail : function() { return $('#detail').val() }
              },
    dataType: "JSON",
    success: function(data)
    {
    //if success reload ajax table
    $('#modal_form').modal('hide');
    reload_table2();
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    reload_table2();
    }
    });
    
    }
    }

    function sum() {
      var total = document.getElementById('totalsum').value;
      var uang = document.getElementById('uang').value;
      var result = parseInt(uang) - parseInt(total) ;
      if (!isNaN(result)) {
         document.getElementById('kembalian').value = result;
      }
}

function angka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;
}

</script>

<script>
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
  </script>

    <?php
    $this->load->view('template/sidebar_theme');
    ?>

  <script>
    $( ".data" ).addClass( "active" );
  </script>

  <script>
  $(document).ready(function(){
  setTimeout(function() {
  $('.alrt-success').fadeOut('fast');
  }, 2000); 
  });
  </script>

  </body>
</html>