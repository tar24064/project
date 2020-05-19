    <?php 
      session_start();
      include_once("../../config/db.php");
      if($_SESSION['username'] == ""){
        header('location:../../login/login.php');
      };
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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

  <style>
  * {font-family: 'Kanit', sans-serif;}
  </style>
</head>
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-top:20px;">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary"></h1>
            </div> 
            -->
            <div class="card-body">
              <?php
                $course = $conn->query("SELECT  a.id,a.course_id,a.startclass,a.code,b.name
                                        FROM `checkin` as a
                                        INNER JOIN course as b ON a.course_id = b.code_id 
                                        where`course_id` = '".$_GET['code']."'");
                $course_row = $course->fetch_assoc()
              ?>
              <h1 class="h3 mb-2 text-gray-800">วิชา : <?php if($course_row == null){}else{echo $course_row['name'];} ?></h1>
              <p class="mb-4">
              </p>
              <div class="mb-4" align="right">
              </div>
              <div class="table-responsive">
                <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <td style="width: 5%;">ครั้งที่ </td> 
                      <td style="width: 10%;">วันเวลาที่เปิดคลาส</td> 
                      <td style="width: 15%;"></td> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $course1 = $conn->query("SELECT  a.id,a.course_id,a.startclass,a.code,b.name
                                        FROM `checkin` as a
                                        INNER JOIN course as b ON a.course_id = b.code_id 
                                        where`course_id` = '".$_GET['code']."'");
                        $c = 1;
                        while($course1_row = $course1->fetch_assoc()){ ?>
                            <tr>
                              <td><?php echo $c; ?></td>
                              <td><?php echo $course1_row['startclass']; ?></td>
                              <td align="center">
                                <a href="http://api.qrserver.com/v1/create-qr-code/?data=<?php echo $course1_row['code']; ?>&size=300*300" target="_blank" class="btn btn-primary">QR Code</a>  รหัสเช็คชื่อ : <?php echo $course1_row['code']; ?>
                              </td>
                            </tr>
                    <?php $c++;} ?>
                  </tbody>
                </table>
              </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
    
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Your Website 2019</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
