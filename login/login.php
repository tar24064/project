<?php
    session_start();
    include_once("../config/db.php");

  //  if(isset($_SESSION["username"])) // ถ้า login อยู่แล้ว redirect เลย
  //      header("location:../index.php");
    if (isset($_POST['submit'])) { // เชคก่อนว่ากดปุ่ม
      if($_POST['level'] == "tea"){
         $tea = $conn->query("SELECT * FROM teacher WHERE username = '".($_POST['user'])."'
                   and password = '".($_POST['pass'])."'");
         $tea_result = $tea->fetch_assoc();
         $tfname = $tea_result["username"];
        if($tfname == $_POST['user']){
            $_SESSION["Teacher_id"] = $tea_result["Teacher_id"];
            $_SESSION["username"] = $tea_result["username"];
            $_SESSION["role"] = $tea_result["Role"];
            $_SESSION["name"] = $tea_result["fullname"];
            session_write_close();
            if($tea_result["Role"] == "1"){
              header("location:../application/admin/course.php");
            }else{
              header("location:../application/teacher/checkin.php");
            }
          }else{
            echo "<script type='text/javascript'>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
          }

      }else if ($_POST['level'] == "stu"){
        $stu = $conn->query("SELECT * FROM student WHERE student_id = '".($_POST['user'])."'
                   and Password = '".($_POST['pass'])."'");
        $stu_result = $stu->fetch_assoc();
        $sfname = $stu_result["student_id"];
        if($sfname == $_POST['user']){
           $_SESSION["student_id"] = $stu_result["student_id"];
           $_SESSION["title_name"] = $stu_result["title_name"];
           $_SESSION["full_name"] = $stu_result["full_name"];
           session_write_close();
           header("location:../application/student/checkin.php");
       }else{
           echo "<script type='text/javascript'>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
        }

      }else{
        echo "<script type='text/javascript'>alert('กรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลใหม่อีกครั้ง');</script>";
      }
    //mysqli_close();
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

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <style>
  * {font-family: 'Kanit', sans-serif;}
  </style>

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">ระบบเช็คชื่อเข้าชั้นเรียน</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="user" name="user" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="pass" name="pass" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>ระดับการใช้งาน : </label>
                      <input type="radio" id="stu" name="level" value="stu">
                      <label for="stu">นักศึกษา</label>
                      <input type="radio" id="tea" name="level" value="tea">
                      <label for="tea">อาจารย์</label>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">Login</button>
                  </form
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>

</body>

</html>
