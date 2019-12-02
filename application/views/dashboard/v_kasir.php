<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
    $this->load->view('template/head');
    $this->load->helper('indonesian_date');
  ?>
  <style type="text/css">
  </style>
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')?>">
  <link href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/plugins/morris/morris.css">
  </head>

  <?php
    $this->load->view('template/topbar');
    $this->load->view('template/sidebar');
  ?>

  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">            
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 id="product">0</h3>
            <p>Total Jenis Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-briefcase"></i>
          </div>
          <a href="<?php echo site_url('product') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3 id="piutang">0</h3>
            <p>Piutang Belum Dibayar</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-settings"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3 id="penjualan">0</h3>
            <p>Omset Tahun Berjalan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3 id="cust">0</h3>
            <p>Customer Active</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo site_url('customer'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#revenue-chart" data-toggle="tab">Chart</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i> Omzet Graph</li>
          </ul>
          <div class="tab-content no-padding">
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 400px;">              
            </div>
          </div>
        </div>
      </section>
  </section>

  <?php
    $this->load->view('template/js');
  ?>

  <script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
  </script>        
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bootstrap/js/raphael-min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/morris/morris.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/knob/jquery.knob.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $.ajax({
          url : "<?php echo site_url('dashboard/getcount'); ?>",
          type: "POST",
          data: "",
          dataType: "json",
          cache:false,
          success: function(data){
            $('#product').text(data.prod);
            $('#cust').text(data.cust);
            $('#penjualan').text(data.jual);
            $('#piutang').text(data.piutang);

            var area = new Morris.Area({
              element: 'revenue-chart',
              resize: true,
              data: data.chart,
              xkey: 'tgl',
              ykeys: ['jumlah'],
              labels: ['Pendapatan'],
              lineColors: ['#3c8dbc'],
              hideHover: 'auto',
              parseTime:'false'
            });
          },
          error: function (jqXHR, textStatus, errorThrown){
              console.log(errorThrown);
          }
        });

      });
  </script>

  <script>
    $( ".dash" ).addClass( "active" );
  </script>

  </body>
</html>