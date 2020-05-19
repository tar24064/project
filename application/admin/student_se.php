    <?php 
      include '../../application/header.php'; 
      $course = $conn->query("SELECT a.enroll_id,a.student_id,d.full_name,a.code_id,b.name,c.Teacher_id,c.fullname,b.term
                                            FROM `enroll` as a
                                            INNER JOIN course as b ON a.code_id = b.code_id
                                            INNER JOIN teacher as c ON b.teacher_id = c.Teacher_id
                                            INNER JOIN student as d on a.student_id = d.student_id
                                            where a.code_id = '".$_GET['class']."'");
      $course_row = $course->fetch_assoc();
      $rc = $_GET['class'];
      $count = $conn->query("SELECT count(enroll_id) as num FROM `enroll` as a
                                            INNER JOIN course as b ON a.code_id = b.code_id
                                            INNER JOIN teacher as c ON b.teacher_id = c.Teacher_id
                                            INNER JOIN student as d on a.student_id = d.student_id
                                            where a.code_id = '".$_GET['class']."'");
      $count_row = $count->fetch_assoc();
      if (isset($_POST['submit'])) {
        $conn->query("INSERT INTO `enroll`( `student_id`, `code_id`) VALUES ('".$_POST['stu']."','".$_POST['codeid']."')");
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');</script>"; ?>
        <script type='text/javascript'>indow.location='student_se.php?class=<?php echo $rc; ?>';</script>
      <?php }

      if (isset($_POST['delete']) && $_POST['delete']) {
        $conn->query("DELETE FROM `enroll` WHERE `enroll_id` = '".$_POST['delete']."';");
        echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');</script>"; ?>
        <script type='text/javascript'>window.location='student_se.php?class=<?php echo $rc; ?>';</script>
       <?php } 

      if(isset($_POST['submitexcel'])) {
        $file = $_FILES['fileCSV']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                    {

          $sql = "INSERT INTO `enroll`( `student_id`, `code_id`) VALUES ('".$filesop[0]."','".$_POST['codeid']."')";
          $conn->query($sql);

          $c = $c + 1;
           }

            if($sql){
               echo "<script type='text/javascript'>alert('อัพโหลดข้อมูลสำเร็จ');</script>";
             } else{
               echo "<script type='text/javascript'>alert('อัพโหลดข้อมูลไม่สำเร็จ !!!');</script>";
             }

      };

    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <?php 
          if ($count_row['num'] >= 1) { ?>
            <h1 class="h3 mb-2 text-gray-800">วิชา : <?php echo $course_row['code_id'] ?> <?php echo $course_row['name'] ?></h1>
            <p class="mb-4">
              อาจารย์ผู้สอน : <?php echo $course_row['fullname'] ?><br>
              เทอม : <?php echo $course_row['term'] ?> <br>
              จำนวนนักศึกษา : <?php echo $count_row['num']; ?> คน
            </p>
          <?php }else{ 
            $ec = $conn->query("SELECT a.code_id,a.name,a.term,b.fullname
                                            FROM `course` as a
                                            INNER JOIN teacher as b ON a.teacher_id = b.Teacher_id
                                            where a.code_id = '".$_GET['class']."'");
            $ecrow = $ec->fetch_assoc(); ?>

            <h1 class="h3 mb-2 text-gray-800">วิชา : <?php echo $ecrow['code_id'] ?> <?php echo $ecrow['name'] ?></h1>
            <p class="mb-4">
              อาจารย์ผู้สอน : <?php echo $ecrow['fullname'] ?><br>
              เทอม : <?php echo $ecrow['term'] ?><br>
              จำนวนนักศึกษา : <?php echo $count_row['num']; ?> คน
            </p>
          <?php } ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary"></h1>
            </div>
            <div class="card-body">
              <div class="mb-4" align="right">
                  <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addtea">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">เพิ่มนักศึกษา</span>
                  </a>
                  <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addteaexcel">
                    <span class="icon text-white-50">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="text">Import CSV</span>
                  </a>
              </div>
              <div class="mb-4" align="right">
              </div>
              <div class="table-responsive">
                <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ลำดับ</th>
                      <th>รหัสนักศึกษา</th>
                      <th>ชื่อ - นามสกุล</th>
                      <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $c = 1;
                    $course = $conn->query("SELECT a.enroll_id,a.student_id,d.full_name,a.code_id,b.name,c.Teacher_id,c.fullname
                                            FROM `enroll` as a
                                            INNER JOIN course as b ON a.code_id = b.code_id
                                            INNER JOIN teacher as c ON b.teacher_id = c.Teacher_id
                                            INNER JOIN student as d on a.student_id = d.student_id
                                            where a.code_id = '".$_GET['class']."'");
                    while($course_row = $course->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $course_row['student_id'];?></td>
                      <td><?php echo $course_row['full_name'];?></td>
                      <td align="center">
                          <button type="submit" value="<?php echo $course_row['enroll_id'];?>" name="delete" onclick="return confirm('ยืนยันจะลบนักศึกษา : <?php echo $course_row['full_name'];?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </td>
                    </tr>
                    <?php 
                      $c++; } 
                    ?>
                  </tbody>
                </table>
              </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- Modal Add -->
      <div class="modal fade" id="addtea" tabindex="-1" role="dialog" aria-labelledby="addteaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addtea">เพิ่มชื่ออาจารย์</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="courseid">รหัสวิชา : <?php echo $rc; ?></label>
                  <input type="hidden" class="form-control" id="codeid" name="codeid" value="<?php echo $rc; ?>">
                </div>
                <div class="form-group">
                  <label for="stu">รหัสนักศึกษา</label>
                  <input type="text" class="form-control" id="stu" name="stu" placeholder="กรอกรหัสนักศึกษา" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
              <button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Add Excel/CSV -->
      <div class="modal fade" id="addteaexcel" tabindex="-1" role="dialog" aria-labelledby="addteaexcelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addteaexcel">เพิ่มรายชื่อนักศึกษา ผ่านไฟล์ CSV</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" enctype="multipart/form-data" method="post" role="form">
            <div class="modal-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="codeid" name="codeid" value="<?php echo $rc; ?>">
                    <label for="exampleInputFile">File Upload : </label>
                    <input type="file" name="fileCSV" id="file" size="150" required>
                    <p class="help-block">รองรับไฟล์ CSV เท่านั้น</p>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
              <button type="submit" name="submitexcel" class="btn btn-primary">อัพโหลดข้อมูล</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

      <!-- (Optional) Latest compiled and minified JavaScript translation files -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
      <!-- End of Main Content -->

      <?php include '../../application/footer.php'; ?>
