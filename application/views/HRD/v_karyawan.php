<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Karyawan</title>
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
              <input type="hidden" value="" name="id"/>
                <div class="form-body">
                      <input type="hidden" class="form-control" placeholder="Masukan Nama" name="id" >
                      <input type="hidden" class="form-control" placeholder="Masukan Nama" name="ref_jabatan" > 
                  <div class="form-group">
                    <label>NIK</label>
                      <input type="text" class="form-control" placeholder="Masukan Nik" name="nik" >
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                  <div class="form-group">
                    <label>Nama</label>
                      <input type="text" class="form-control" placeholder="Masukan Nama" name="nama" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div> 
                  <div class="form-group">
                    <label>No KTP</label>
                      <input type="text" class="form-control" placeholder="Masukan No KTP" onkeypress="return angka(event)" name="noktp" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div> 
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                      <select name="kelamin" class="form-control">
                      <option value="">--Jenis Kelamin--</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>                      
                      </select>
                  </div>    
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                       <input placeholder="masukkan tanggal lahir" type="text" class="form-control datepicker" name="tgllahir">
                  </div> 
                  <div class="form-group">
                    <label>No Hp</label>
                      <input type="text" class="form-control" onkeypress="return angka(event)" placeholder="Masukan No Hp" name="nohp" >
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                  <div class="form-group">
                    <label>Agama</label>
                      <select name="agama" class="form-control">
                      <option value="">--Piih Agama--</option>
                      <option value="Islam">Islam</option>
                      <option value="Kristen Protestan">Kristen Protestan</option>
                      <option value="Katolik">Katolik</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Buddha">Buddha</option>
                      <option value="Kong Hu Cu">Kong Hu Cu</option>
                      </select>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>   
                  <div class="form-group">
                    <label>Alamat</label>
                      <input type="text" class="form-control" placeholder="Masukan Alamat" name="alamat" >
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                  <div class="form-group">
                    <label>Tanggal Masuk</label>
                      <input placeholder="masukkan tanggal masuk" type="text" class="form-control datepicker" name="tglmasuk">
                  </div>                 
                  <div class="form-group">
                    <label>Jabatan</label>
                      <?php
                    echo form_dropdown('ref_jabatan', $ref_jabatan, '', 'class="form-control" name="jabatan" required');
                    ?>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>
                  <div class="form-group">
                    <label>Aktif</label>
                      <select name="aktif" class="form-control">
                      <option value="">--Silahkan pilih--</option>
                      <option value="t">True</option>
                      <option value="f">False</option>                      
                      </select>
                    </label>   
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
      Data Karyawan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Karyawan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          
        </div>
        <div class="box box-info">
          <div class="box-header">
              <button class="btn btn-primary pull-right" onclick="add_karyawan()" data-toggle="tooltip" data-placement="top" title="Tambah Data"><span class="glyphicon glyphicon-file"></span>Tambah</button>
              <button class="btn btn-default " onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div>

          <div class="box-body">
            
            <div class="table-responsive mailbox-messages">                    
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No KTP</th>
                    <th>Tanggal Lahir</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
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
                "url": "<?php echo base_url('hrd/karyawan/setView'); ?>",
                "type": "POST",
            },
            "columns": [

              { "data": "no" },
              { "data": "nik" },   
              { "data": "nama" },
              { "data": "kelamin" },
              { "data": "noktp" },
              { "data": "tgllahir" },             
              { "data": "nohp" },
              { "data": "alamat" },
              { "data": "jabatan" },
              { "data": "tglmasuk" },
              { "data": "aktif" },
              { "data": "action" }
            ],
            "order": [[0, 'asc']]
          });
        });


    function reload_table()
    {
    table.ajax.reload(null,false); //reload datatable ajax
    }

    function add_karyawan()
    {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Input karyawan'); // Set Title to Bootstrap modal title
    }
    
    function edit_data(id)
    {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    url : "<?php echo base_url('hrd/karyawan/ajax_edit')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="id"]').val(data.id);
    $('[name="nik"]').val(data.nik);
    $('[name="nama"]').val(data.nama);
    $('[name="noktp"]').val(data.noktp);
    $('[name="nohp"]').val(data.nohp);
    $('[name="kelamin"]').val(data.kelamin);
    $('[name="tgllahir"]').val(data.tgllahir);
    $('[name="tglmasuk"]').val(data.tglmasuk);
    $('[name="ref_jabatan"]').val(data.ref_jabatan);
    $('[name="jabatan"]').val(data.jabatan);
    $('[name="agama"]').val(data.agama);
    $('[name="alamat"]').val(data.alamat);
    $('[name="aktif"]').val(data.aktif);
    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Edit Data Karyawan'); // Set title to Bootstrap modal title
    
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
    var url;
    
    if(save_method == 'add') {
    url = "<?php echo base_url('hrd/karyawan/ajax_add')?>";
    } else {
    url = "<?php echo base_url('hrd/karyawan/ajax_update')?>";
    }
    // ajax adding data to database
    $.ajax({
    url : url,
    type: "POST",
    data: $('#form').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.status) //if success close modal and reload ajax table
    {
    $('#modal_form').modal('hide');
    reload_table();
    }
    
    $('#btnSave').text('Save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    $('#btnSave').text('save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    }
    });
    }

    function delete_data(id)
    {
    if(confirm('Yakin Hapus Data ?'))
    {
    // ajax delete data to database
    $.ajax({
    url : "<?php echo base_url('hrd/karyawan/ajax_delete')?>/" +id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
    //if success reload ajax table
    $('#modal_form').modal('hide');
    reload_table();
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error deleting data');
    }
    });
    
    }
    }
     function angka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;
}
</script>

<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });
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