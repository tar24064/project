    <?php 
      include '../../application/headerstu.php'; 
      require __DIR__.'/../../vendor/Carbon/autoload.php';

      use Carbon\Carbon;
      use Carbon\CarbonInterval;


      if (isset($_POST['submit'])) {
        $chk = $conn->query("SELECT * FROM `checkin` where code = '".$_POST['checkin']."'");
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
      }

    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">เช็คชื่อเข้าห้องเรียน</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary"></h1>
            </div>
            <form method="post">
            <div class="card-body">
              <div class="" align="center">
                    <input type="text" class="form-control" id="checkin" name="checkin" placeholder="กรอกรหัสเข้าเรียน" required>
                    <input type="hidden" class="form-control" id="student_id" name="student_id" value="<?php echo $_SESSION["student_id"]; ?>">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-check"></i> เช็คชื่อ</button><br>
                    <a href="#" class="btn btn-primary btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-qrcode"></i>
                      </span>
                      <span class="text">แสกน QR Code</span>
                    </a>
                  </div>
            </div>
            </form>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php include '../../application/footer.php'; ?>
