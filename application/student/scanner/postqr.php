<?php
header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
require __DIR__.'/../../../vendor/Carbon/autoload.php';

      use Carbon\Carbon;
      use Carbon\CarbonInterval;
include_once __DIR__.'/../../../config/db.php';
        $chk = $conn->query("SELECT * FROM `checkin` where code = '".$_POST['content']."'");
        $chk_row = $chk->fetch_assoc();

        if ($chk_row['code'] == $_POST['content']) {

          $checktime = Carbon::now();
          $startclass = $chk_row['startclass'];
          $status = "";
          $date = new Carbon($startclass, 'Asia/Bangkok');
          $time = $date->diffInSeconds($checktime);  
          $chkid = $chk_row['id'];
          $stuid = $_GET['stu'];

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
              echo "บันทึกข้อมูลสำเร็จ";
          }else{
              echo "มีข้อมูลในระบบแล้ว";
          }
        }
?>