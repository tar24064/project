    <?php 
      include '../../application/header.php'; 
      
      if (isset($_POST['submit'])) {
        $conn->query("INSERT INTO `checkin` (`course_id`,`classtime`, `checklimit`,code) VALUES ('".$_GET['code']."','".$_POST['classtime']."','".$_POST['checklimit']."','".$_POST['codeRD']."')");
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');</script>"; ?>
        <script type='text/javascript'>window.location='checkin.php';</script>
        <?php
      };
      $codeRD = ""
    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary">ตั้งค่าระบบเช็คชื่อ</h1>
            </div>
            <div class="card-body">
              <form method="post">
                <div class="row">
                  <div class="col">
                    <div class="col col-auto form-group">
                        <label>วันที่ : <?php echo date("Y-m-d H:i:s"); ?></label>
                    </div>
                    <div class="col col-auto form-group">
                        <?php 
                        //รอแก้ SQL
                        $countep = $conn->query("SELECT count(id) as num FROM `checkin` where id = '".$_GET['code']."'");
                        $countep_row = $countep->fetch_assoc();
                        if($countep_row['num'] >=1){
                          $cr = $countep_row['num']+1;?>
                          <label>ครั้งที่ : <?php echo $cr; ?></label>
                        <?php }else{?>
                          <label>ครั้งที่ : <?php echo "1"; ?></label>
                        <?php  
                        }
                        ?>

                    </div>
                    <div class="col col-auto form-group">
                        <label for="classtime">ระยะเวลาที่ใช้ในการสอน (วินาที) :</label>
                        <input type="text" class="form-control" id="classtime" name="classtime" placeholder="กรอกระยะเวลาเป็นหน่วยวินาที" required>
                        <p class="help-block">1 ชั่วโมง = 3600 วินาที</p>
                    </div>
                    <div class="col col-auto form-group">
                        <label for="checklimit">ระยะเวลาที่เปิดให้เช็คชื่อ (วินาที) :</label>
                        <input type="text" class="form-control" id="checklimit" name="checklimit" placeholder="กรอกระยะเวลาเป็นหน่วยวินาที" required>
                        <p class="help-block">30 นาที = 1800 วินาที</p>
                        <p class="">หากสิ้นสุดเวลาที่เปิดให้นักศึกษาเช็คชื่อ สถานะของนักศึกษาจะถูกเปลี่ยนเป็น "สาย"</p>
                        <?php 
                            $n=20; 
                            function getName($n) { 
                                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                                $randomString = ''; 
                              
                                for ($i = 0; $i < $n; $i++) { 
                                    $index = rand(0, strlen($characters) - 1); 
                                    $randomString .= $characters[$index]; 
                                } 
                              
                                return $randomString; 
                            } 
                        ?>
                        <input type="hidden" class="form-control" id="codeRD" name="codeRD" value="<?php echo getName($n); ?>">
                    </div>
                  </div>
                  <div class="col">
                    <?php 
                        $course = $conn->query("SELECT a.code_id,a.name,a.term,b.fullname
                                            FROM course as a
                                            INNER JOIN teacher as b ON a.teacher_id = b.Teacher_id
                                            where a.code_id = '".$_GET['code']."'");
                        $course_row = $course->fetch_assoc();
                        $countcos = $conn->query("SELECT count(id) as num FROM course as a
                                                              INNER JOIN teacher as b ON a.teacher_id = b.Teacher_id
                                                              where a.code_id = '".$_GET['code']."'");
                        $countcos_row = $countcos->fetch_assoc();
                        if($countcos_row['num'] >=1){?>
                            <div class="col col-auto form-group">
                              <label>วิชา : <?php echo $course_row['code_id']; ?> <?php echo $course_row['name']; ?></label>
                            </div>
                            <div class="col col-auto form-group">
                              <label>ผู้สอน : <?php echo $course_row['fullname']; ?></label>
                            </div>
                            <div class="col col-auto form-group">
                              <label>ภาคเรียน : <?php echo $course_row['term']; ?></label>
                            </div>
                        <?php }else{?>
                          <div class="col col-auto form-group">
                            <label>วิชา : </label>
                          </div>
                          <div class="col col-auto form-group">
                            <label>ผู้สอน : </label>
                          </div>
                          <div class="col col-auto form-group">
                            <label>ภาคเรียน : </label>
                          </div>
                        <?php  
                        }
                        ?>
                  </div>
                </div>
                <div class="" align="center">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-check"></i> เปิดระบบเช็คชื่อ</button>
                    <button class="btn btn-secondary"><i class="fas fa-times" ></i> ปิดหน้าต่าง</button>
                  </div>
            </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>

      <?php include '../../application/footer.php'; ?>
