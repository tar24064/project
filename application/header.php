<?php
session_start();
include_once("../../config/db.php");
if($_SESSION['username'] == ""){
  header('location:../../login/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="../../css/bootstrap-select.min.css">

  <!-- Custom styles for this page -->
  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
  * {font-family: 'Kanit', sans-serif;}
  </style>
</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ระบบเช็คชื่อ</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php 
        if ($_SESSION["role"] == "1") {
          echo '<div class="sidebar-heading">
                  ผู้ดูแลระบบ
                </div>


                  <li class="nav-item">
                    <a class="nav-link" href="../admin/teacher.php">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>ข้อมูลอาจารย์</span></a>

                    <a class="nav-link" href="../admin/course.php">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>ข้อมูลรายวิชา</span></a>

                    <a class="nav-link" href="../admin/student.php">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>ข้อมูลนักศึกษา</span></a>

                    <a class="nav-link" href="../admin/report.php">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>ข้อมูลการเช็คชื่อ</span></a>
                  </li>

                <!-- อาจารย์ -->
                <div class="sidebar-heading">
                  ระบบอาจารย์
                </div>


                <li class="nav-item">
                  <a class="nav-link" href="../teacher/checkin.php">
                  <i class="fas fa-fw fa-tasks"></i>
                  <span>ระบบเช็คชื่อ</span></a>

                  <a class="nav-link" href="../teacher/report.php">
                  <i class="fas fa-fw fa-tasks"></i>
                  <span>รายงานการเช็คชื่อ</span></a>
                </li>';
        }else{
          echo '<!-- อาจารย์ -->
                <div class="sidebar-heading">
                  ระบบอาจารย์
                </div>


                <li class="nav-item">
                  <a class="nav-link" href="../teacher/checkin.php">
                  <i class="fas fa-fw fa-tasks"></i>
                  <span>ระบบเช็คชื่อ</span></a>

                  <a class="nav-link" href="../teacher/report.php">
                  <i class="fas fa-fw fa-tasks"></i>
                  <span>รายงานการเช็คชื่อ</span></a>
                </li>';
        }
      ?>
     
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["name"] ?> <i class="fas fa-caret-down"></i></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../../login/logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
