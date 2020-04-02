<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    if (!isset($_SESSION['PERSONAL_NUMBER'])) {
        redirect(base_url());
    } 
    
?>

<!DOCTYPE html>

<html>
    <head>
        <title>BRI Corporate Segmented Report</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/favicon.ico'); ?>"/>
        <!-- Bootstrap -->
        <link href="<?=base_url();?>template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Table -->
        <link href="<?=base_url();?>assets/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css">
        <!-- Font Titillium Web -->
        <link href="<?=base_url();?>template/vendors/Titillium_Web/Titillium_Web.css" rel="stylesheet">
        <!-- Material io -->
        <link href="<?=base_url();?>template/vendors/material-design-icons-master/materialio.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?=base_url();?>template/vendors/fontawesome/css/all.css" rel="stylesheet">
        <link href="<?=base_url();?>template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?=base_url();?>template/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <!-- <link href="<?=base_url();?>template/vendors/iCheck/skins/all.css" rel="stylesheet"> -->
        <link href="<?=base_url();?>template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- <link href="<?=base_url();?>template/vendors/iCheck/skins/flat/blue.css" rel="stylesheet"> -->
        <!-- bootstrap-progressbar -->
        <link href="<?=base_url();?>template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?=base_url();?>template/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?=base_url();?>template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="<?=base_url();?>template/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="<?=base_url();?>template/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="<?=base_url();?>template/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="<?=base_url();?>template/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
        <!-- Select 2 -->
        <link href="<?=base_url();?>assets/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- JS Tree -->
        <link href="<?=base_url();?>template/vendors/jstree/dist/themes/default/style.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?=base_url();?>template/build/css/custom.css" rel="stylesheet">
        <link href="<?= base_url(); ?>template/vendors/datatables.net-checkbox/css/dataTables.checkboxes.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/mobile/mobile-res.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button { 
              -webkit-appearance: none; 
              margin: 0; 
            }
            .btn-xs{
              font-weight: 600;
            }
            .nopadding {
               padding: 0 !important;
               margin: 0 !important;
            }
             [contenteditable] {
                outline: none;
                text-align: left;
                background: #fff;
                padding: 8px;
                border: 1px solid #ccc;
              }
              span[contenteditable] {
                display: inline-block;
              }
              .profile-usermenu ul li {
                border-bottom: 1px solid #f0f4f7;
              }

              .profile-usermenu ul li:last-child {
                border-bottom: none;
              }

              .profile-usermenu ul li a {
                color: #93a3b5;
                font-size: 14px;
                font-weight: 400;
              }

              .profile-usermenu ul li a i {
                margin-right: 8px;
                font-size: 14px;
              }

              .profile-usermenu ul li a:hover {
                background-color: #fafcfd;
                color: #5b9bd1;
              }

              .profile-usermenu ul li.active {
                border-bottom: none;
              }
              .btn-info.active, .btn-info:active, .open>.dropdown-toggle.btn-info {
                  color: #fff;
                  background-color: #148698;
                  border-color: #269abc;
              }
              .btn-info.active, .btn-info:hover, .open>.dropdown-toggle.btn-info {
                  color: #fff;
                  background-color: #148698;
                  border-color: #269abc;
              }
              .error{
                color: #f00;
              }
              .buttons-flash{
                display: none;
              }
              thead{
                  height: 40px;
              }
              .table>thead:first-child>tr:first-child>th {
                  padding-bottom: 7px;
              }
              .search .form-control {
                  box-shadow: inset 0 1px 0 rgba(0,0,0,.075);
                  border-radius: 25px 0 0 25px;
                  padding-left: 20px;
                  border: 1px solid rgba(221,226,232,.49);
              }
              .kanan{
                float: right;
              }
              thead{
                background-color: #012D5A; color: #FFF; 
              }
              #toolbar{
                display: none;
              }
              .filter-selectpicker{
                border-radius: 25px;
              }
              .lbl-million{
                color: #f00;
                font-weight: 700;
                
              }
        </style>
        <script src="<?=base_url();?>assets/jquery/dist/jquery.min.js"></script>
        
    </head>
