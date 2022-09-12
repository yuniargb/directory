<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login | <?= Globals::layout('title') ?></title>

    <link rel="icon" href="<?= base_url('assets/'.Globals::layout('logo_1')); ?>">
    

    <link rel="shortcut icon" href="<?php echo base_url('assets/'.Globals::layout('logo_1')); ?>" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_style/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_style/css/all.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_style/css/animate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_style/plugins/slider/css/owl.carousel.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_style/plugins/slider/css/owl.theme.default.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login_style/css/style.css?v=2" />

</head>



    <body class="form-login-body"> 

            <div class="container">

                <div class="row">

                    <div class="col-lg-10 mx-auto login-desk">

                       <div class="row">

                            <div class="col-md-7 detail-box">

                                <div class="row">

                                    <div class="col-md-6 col-8">

                                        <img class="logo float-left w-25 mr-3" src="<?php echo base_url('assets/'.Globals::layout('logo_1')); ?>" alt=""> 

                                        <h6 class="">Dikrektori</h6>

                                        <h4 class=""><?= Globals::layout('title') ?></h4>

                                    </div>

                                </div>

                                <div class="detailsh">

                                     <img class="help w-75"   src="<?php echo base_url(); ?>assets/login_style/images/display-4-bgtr.png" alt="">

                                </div>

                            </div>

                            <div class="col-md-5 loginform">

                                <form method="POST" action="<?= base_url('/proses_login'); ?>" autocomplete="off">

                                    <h4>Selamat datang</h4>   

                                    <h3 class=""></h3>                

                                    <p>silahkan login dengan akun anda</p>

                                    <?php if($this->session->flashdata('error')) { ?>

                                    <p class="text-light text-left"><?= $this->session->flashdata('error') ?></p>

                                    <?php } ?>

                                    <div class="login-det">

                                        <div class="form-row">

                                            <label for="">Username</label>

                                                <div class="input-group mb-3">

                                                <div class="input-group-prepend">

                                                    <span class="input-group-text" id="basic-addon1">

                                                        <i class="far fa-user"></i>

                                                    </span>

                                                </div>

                                                <input type="text" class="form-control" name="username" placeholder="Enter Username" aria-label="Username" aria-describedby="basic-addon1">

                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <label for="">Password</label>

                                                <div class="input-group mb-3">

                                                <div class="input-group-prepend">

                                                    <span class="input-group-text" id="basic-addon1">

                                                        <i class="fas fa-lock"></i>

                                                    </span>

                                                </div>

                                                <input type="password" class="form-control" name="password" placeholder="Enter Password" aria-label="Username" aria-describedby="basic-addon1">

                                            </div>

                                        </div>

                                        

                                        <!-- <p class="forget"><a href="">Forget Password?</a></p> -->

                                        

                                        <button class="btn btn-sm btn-danger mb-3" type="submit">Login</button>

                                        <hr class="bg-light ">

                                        

                                        <div class="social-link">

                                            <p><?= Globals::layout('footer') ?></p>

                                        </div>

                                        

                                    </div>

                                </form>

                            </div>

                       </div>

                      

                    </div>

                </div>

            </div>

    </body>



    <script src="<?php echo base_url(); ?>assets/login_style/js/jquery-3.2.1.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/login_style/js/popper.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/login_style/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/login_style/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>

    <script src="<?php echo base_url(); ?>assets/login_style/plugins/slider/js/owl.carousel.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/login_style/js/script.js"></script>

</html>

