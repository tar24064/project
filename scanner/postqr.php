<?php
header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
include_once("../../config/db.php");
//if (isset($_POST['submit'])) {
        $chk = $conn->query("SELECT * FROM `checkin`");
        $chk_row = $chk->fetch_assoc();

        if ($chk_row['code'] == $_POST['checkin']) {

          $checktime = Carbon::now();
          $startclass = $chk_row['startclass'];
          $status = "";
          $date = new Carbon($startclass, 'Asia/Bangkok');
          $time = $date->diffInSeconds($checktime);  
          $chkid = $chk_row['id'];
          $stuid = $_POST['student_id'];

          if ($time <= $chk_row['checklimit']) {
            $status = "มา";
          }elseif ($time <= $chk_row['classtime']) {
            $status = "สาย";
          }else{
            $status = "ขาด";
          }
          $chktime = $conn->query("SELECT * FROM `checktime` where chk_id = $chkid and student_id = $stuid");
          $chktime_row = $chktime->fetch_assoc();
          if($chktime_row == null){
            $conn->query("INSERT INTO `checktime`(`chk_id`, `student_id`, `status`, `checkin`) VALUES ($chkid,$stuid,'$status','$checktime')");
              echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');</script>";
          }else{
              echo "<script type='text/javascript'>alert('มีข้อมูลในระบบแล้ว');</script>";
          }
        }
//      }

//if(isset($_POST['checkinID']) && $_POST['checkinID']!=""){
//    echo $_POST['checkinID']; // ตัวอย่าง
//}
?>