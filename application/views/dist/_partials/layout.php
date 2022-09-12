
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1 ">
      <div class="navbar-bg "></div>
      <nav class="navbar navbar-expand-lg main-navbar ">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          <div class="search-element">
          
          
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
        
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('assets/'.Globals::layout('logo_2')) ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('nama') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
              <div class="bg-info text-center text-uppercase text-white py-2">
              <?= $this->session->userdata('nama_level') ?>
              </div>
              <a href="<?= base_url('password') ?>" class="dropdown-item has-icon ">
                <i class="fas fa-key"></i> Ganti Password
              </a>
              <a href="#" data-toggle="modal" data-target="#logout-modal" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <?php  $this->load->view('content/logout_modal') ?>
