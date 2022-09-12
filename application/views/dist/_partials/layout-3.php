<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="layout-2 bg-light">
  <div id="app">
    <div class="main-wrapper ">
      <nav class="navbar bg-primary navbar-expand-lg main-navbar">
        <div class="container">
        <a href="<?php echo base_url(); ?>dist/index" class="navbar-brand "><?= Globals::layout('title') ?></a>
        <ul class="navbar-nav ml-auto">
          <ul class="navbar-nav d-flex justify-content-center">
            <li class="nav-item  <?php echo $this->uri->segment(1) == 'panitra' &&  $this->uri->segment(2) == '' ? 'active' : ''; ?>">
              <a href="<?= base_url('panitra') ?>" class="nav-link " ><span>Home</span></a>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'panitra' &&  $this->uri->segment(2) == 'qiraat' ? 'active' : ''; ?>">
              <a href="<?= base_url('panitra/qiraat/f') ?>" class="nav-link"><span>Qiraat</span></a>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'panitra' &&  $this->uri->segment(2) == 'mushaf' ? 'active' : ''; ?>">
              <a href="<?= base_url('panitra/mushaf') ?>" class="nav-link"><span>Mushaf</span></a>
            </li>
          </ul>
            <li class="nav-item "><a href="#" class="nav-link full-screen"><i class="fas fa-expand-arrows-alt"></i></a></li>
          </ul>
        <ul class="navbar-nav navbar-right">  
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('assets/'.Globals::layout('logo_1')) ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('nama') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url('panitra/ganti_password') ?>" class="dropdown-item has-icon">
                <i class="fas fa-unlock-alt"></i> Ganti Password
              </a>
              <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
        </div>
      </nav>
