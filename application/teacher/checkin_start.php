    <?php 
      include '../../application/header.php'; 
      
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
                        <label>วันที่ : <?php echo date("Y-m-d"); ?> <?php echo date("H:i:s"); ?></label>
                    </div>
                    <div class="col col-auto form-group">
                        <?php 
                        //รอแก้ SQL
                        $countep = $conn->query("SELECT count(enroll_id) as num FROM `enroll` as a
                                            INNER JOIN course as b ON a.code_id = b.code_id
                                            INNER JOIN teacher as c ON b.teacher_id = c.Teacher_id
                                            INNER JOIN student as d on a.student_id = d.student_id
                                            where a.code_id = '".$_GET['code']."'");
                        $countep_row = $countep->fetch_assoc();
                        if($countep_row['num'] >=1){
                          $cr = $countep_row['num']+1;?>
                          <label>ครั้งที่ : <?php echo $cr; ?></label>
                        <?php }else{?>
                          <label>ครั้งที่ : <?php echo "0"; ?></label>
                        <?php  
                        }
                        ?>

                    </div>
                    <div class="col col-auto form-group">
                        <label for="exampleInputEmail1">ระยะเวลาที่ใช้ในการสอน (วินาที) :</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="กรอกระยะเวลาเป็นหน่วยวินาที">
                        <p class="help-block">1 ชั่วโมง = 3600 วินาที</p>
                    </div>
                    <div class="col col-auto form-group">
                        <label for="exampleInputEmail1">ระยะเวลาที่เปิดให้เช็คชื่อ (วินาที) :</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="กรอกระยะเวลาเป็นหน่วยวินาที">
                        <p class="help-block">30 นาที = 1800 วินาที</p>
                        <p class="">หากสิ้นสุดเวลาที่เปิดให้นักศึกษาเช็คชื่อ สถานะของนักศึกษาจะถูกเปลี่ยนเป็น "สาย"</p>
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
                    <a href="#" class="btn btn-primary btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                      </span>
                      <span class="text">เปิดระบบเช็คชื่อ</span>
                    </a>
                    <a href="#" class="btn btn-secondary btn-icon-split"">
                      <span class="icon text-white-50">
                        <i class="fas fa-times"></i>
                      </span>
                      <span class="text">ปิดหน้าต่าง</span>
                    </a>
                  </div>
            </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>

      <?php include '../../application/footer.php'; ?>
