<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $title; ?> &mdash; <?= Globals::layout('title') ?></title>
    <link rel="icon" href="<?= base_url('assets/'.Globals::layout('logo_1')); ?>">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/ionicons/css/ionicons.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css?v=2">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom_user.css?v=2.9">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

</head>