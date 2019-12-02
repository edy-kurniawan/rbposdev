<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/AdminLTE/dist/img/1.jpg')?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata("nama"); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    </form>
    <ul class="sidebar-menu">
      <li class="header">MENU UTAMA</li>
      <li class="treeview dash">
        <a href="<?php echo site_url('dashboard'); ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <?php if($this->session->userdata('level') =='hrd'): ?>
      <li class="header">Master</li>
      <li class="treeview data">
        <a href="#">
          <i class="fa fa-database"></i> <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('hrd/jabatan'); ?>"><i class="glyphicon glyphicon-briefcase"></i>Jabatan</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('hrd/karyawan'); ?>"><i class="glyphicon glyphicon-user"></i>Karyawan</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('hrd/user'); ?>"><i class="glyphicon glyphicon-lock"></i>User</a></li>
        </ul>
        <li class="header">Laporan</li>
      <li class="treeview data">
        <a href="#">
          <i class="fa fa-database"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('hrd/barang'); ?>"><i class="glyphicon glyphicon-briefcase"></i>Barang</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('hrd/penjualan'); ?>"><i class="glyphicon glyphicon-usd"></i>Penjualan</a></li>
        </ul>
        <?php endif; ?>
        <?php if($this->session->userdata('level') =='gudang'): ?>
      <li class="header">Master</li>
      <li class="treeview data">
        <a href="#">
          <i class="fa fa-database"></i> <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('gudang/kategori'); ?>"><i class="fa fa-tags"></i>Kategori</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('gudang/supplier'); ?>"><i class="fa fa-truck"></i>Supplier</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('gudang/satuan'); ?>"><i class="fa fa-plus-square"></i>Satuan</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('gudang/barang'); ?>"><i class="fa fa-suitcase"></i>Barang</a></li>
        </ul>
        <?php endif; ?>
        <?php if($this->session->userdata('level') =='kasir'): ?>
      <li class="header">Master</li>
      <li class="treeview data">
        <a href="#">
          <i class="fa fa-database"></i> <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('kasir/penjualan'); ?>"><i class="glyphicon glyphicon-usd"></i>Transaksi Penjualan</a></li>
        </ul>
        <ul class="treeview-menu data">
          <li class="penjualandet"><a href="<?php echo site_url('kasir/lpenjualan'); ?>"><i class="glyphicon glyphicon-list-alt"></i>Laporan Penjualan</a></li>
        </ul>
        <?php endif; ?>
     </li>
  </section>
</aside>
<div class="content-wrapper">