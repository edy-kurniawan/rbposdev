<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
  $this->load->view('template/head');
  ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">
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
                  <div class="form-group">
                    <label>NIK</label>
                      <input type="text" class="form-control" placeholder="Masukan NIK" name="nik" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                  <div class="form-group">
                    <label>Nama</label>
                      <input type="text" class="form-control" placeholder="Masukan Nama" name="nama" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>     
                  <div class="form-group">
                    <label>Password</label>
                      <input type="password" class="form-control" placeholder="Masukan Password" name="pass" >
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div> 
                  <div class="form-group">
                    <label>Level</label>
                      <?php
                      echo form_dropdown('level', $level, '', 'class="form-control" name="level" required'); 
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
      Data User
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data User</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          
        </div>
        <div class="box box-info">
          <div class="box-header">
              <button class="btn btn-primary pull-right" onclick="add_user()" data-toggle="tooltip" data-placement="top" title="Tambah Data"><span class="glyphicon glyphicon-file"></span>Tambah</button>
              <button class="btn btn-default " onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div>

          <div class="box-body">
            
            <div class="table-responsive mailbox-messages">                    
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Level</th>
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
  
  <script src="<?php echo base_url('assets/delconfirmation.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/plugins/select2/select2.full.min.js')?>"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bootstrap/js/moment.min.js"></script> 
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  
  </script>
        
    <script type="text/javascript">
        var table;
        var tablemodal;
        var save_method;

        $(document).ready(function() {
          table = $('#table').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('hrd/user/setView'); ?>",
                "type": "POST",
            },
            "columns": [

              { "data": "no" },
              { "data": "nik" },   
              { "data": "nama" },
              { "data": "pass" },
              { "data": "lvl" },
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

    function add_user()
    {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Input User'); // Set Title to Bootstrap modal title
    }
    
    function edit_data(id)
    {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    url : "<?php echo base_url('hrd/user/ajax_edit')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="id"]').val(data.id);
    $('[name="nama"]').val(data.nama);
    $('[name="level"]').val(data.level);
    $('[name="aktif"]').val(data.aktif);
    $('[name="nik"]').val(data.nik);
    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Edit Data Jabatan'); // Set title to Bootstrap modal title
    
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
    url = "<?php echo base_url('hrd/user/ajax_add')?>";
    } else {
    url = "<?php echo base_url('hrd/user/ajax_update')?>";
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
    url : "<?php echo base_url('hrd/user/ajax_delete')?>/" +id,
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