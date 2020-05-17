    <?php 
      include '../../application/header.php'; 
      
      if (isset($_POST['submit'])) {
        $conn->query("INSERT INTO `course`( `code_id`, `name`, `term`, `credit`, `teacher_id`) VALUES ('".$_POST['courseid']."','".$_POST['coursename']."','".$_POST['term']."','".$_POST['credit']."','".$_POST['teacher']."')");
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');</script>";
      }

      if (isset($_POST['submitedit']) && $_POST['submitedit']) {
        $conn->query("UPDATE `course` SET `code_id`='".$_POST['courseid']."',`name`='".$_POST['coursename']."',`term`='".$_POST['term']."',`credit`='".$_POST['credit']."'
          ,`teacher_id`='".$_POST['teacher']."' WHERE `id` = '".$_POST['submitedit']."'");
        echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'>window.location='course.php';</script>";

      }

      if (isset($_POST['delete']) && $_POST['delete']) {
        $conn->query("DELETE FROM `course` WHERE `id` = '".$_POST['delete']."';");
        echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');</script>";
       }

      $editid = "";
      if (isset($_GET['edit']) && $_GET['edit']) {
        $editid = $_GET['edit'];
        $edit = $conn->query("SELECT * FROM `course` WHERE id = $editid") or die($conn->error());
        $result = $edit->fetch_assoc();
      }

#      if(isset($_POST['submitexcel'])) {
#        $file = $_FILES['fileCSV']['tmp_name'];
#          $handle = fopen($file, "r");
#          $c = 0;
#          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
#                    {
#
#          $sql = "INSERT INTO `teacher`(`fullname`, `username`, `password`, `Role`) VALUES ('".$filesop[0]."','".$filesop[1]."','".$filesop[2]."','".$filesop[3]."')";
#          $conn->query($sql);
#
#          $c = $c + 1;
#           }
#
#            if($sql){
#               echo "<script type='text/javascript'>alert('อัพโหลดข้อมูลสำเร็จ');</script>";;;
#             } else{
#               echo "<script type='text/javascript'>alert('อัพโหลดข้อมูลไม่สำเร็จ !!!');</script>";;
#             }
#
#      };
    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">ข้อมูลรายวิชาที่เปิดสอน</h1>

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
                    <span class="text">เพิ่มข้อมูลรายวิชา</span>
                  </a>
                  <!--
                  <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addteaexcel">
                    <span class="icon text-white-50">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="text">Import CSV</span>
                  </a> 
                  -->
              </div>
              <div class="table-responsive">
                <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ลำดับ</th>
                      <th>รหัสวิชา</th>
                      <th>ชื่อวิชา</th>
                      <th>เทอม</th>
                      <th>หน่วยกิจ</th>
                      <th>อาจารย์ผู้สอน</th>
                      <th>รายชื่อนักศึกษา</th>
                      <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $course = $conn->query("SELECT course.id,course.code_id,course.name,course.term,course.credit,teacher.fullname,course.teacher_id
                                            FROM course
                                            INNER JOIN teacher
                                            ON course.teacher_id = teacher.teacher_id;");
                    while($course_row = $course->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo $course_row['id'];?></td>
                      <td><?php if($editid == $course_row['id']) { ?>
                        <input type="text" class="form-control" id="courseid" name="courseid" value="<?php echo $result['code_id']; ?>" required>
                        <?php }else{
                        echo $course_row['code_id']; }?></td>
                      <td><?php if($editid == $course_row['id']) { ?>
                        <input type="text" class="form-control" id="coursename" name="coursename" value="<?php echo $result['name']; ?>" required style="width:200px;">
                        <?php }else{
                        echo $course_row['name']; }?></td>
                      <td><?php if($editid == $course_row['id']) { ?>
                        <input type="text" class="form-control" id="term" name="term" value="<?php echo $result['term']; ?>" required style="width:200px;">
                        <?php }else{
                        echo $course_row['term']; }?></td>
                      <td><?php if($editid == $course_row['id']) { ?>
                        <input type="text" class="form-control" id="credit" name="credit" value="<?php echo $result['credit']; ?>" required>
                        <?php }else{
                        echo $course_row['credit']; }?></td>
                      <td><?php if($editid == $course_row['id']) { ?>
                        <div class="form-group">
                          <select id="select-testing" name="teacher" class="form-control selectpicker" data-live-search="true">
                            <?php
                            $teacher = $conn->query("SELECT * FROM `teacher`");
                            while($teacher_row = $teacher->fetch_assoc()){
                            ?>
                                  <option value="<?php echo $teacher_row['Teacher_id']; ?>" 
                                  	<?php if ($teacher_row['Teacher_id'] == $course_row['teacher_id']) {echo "selected"; }; ?>><?php echo $teacher_row['fullname']; ?>
                                  		
                                  </option>
                            <?php } ?>
                          </select>
                          <?php 
                            }else{
                              echo $course_row['fullname']; 
                            }?>
                        </div></td>
                      <td align="center"><a href="student_se.php?class=<?php echo $course_row['code_id']; ?>" target="_blank" class="btn btn-primary">รายชื่อนักศึกษา</a></td>
                      <td align="center">
                        <?php if($editid == $course_row['id']) { ?>
                          <button type="submit" value="<?php echo $course_row['id'];?>" name="submitedit" class="btn btn-primary">บันทึก</button>
                          <a href="course.php" class="btn btn-danger"><i class="fas fa-times"></i></a>
                        <?php }else{ ?>
                          <a href="course.php?edit=<?php echo $course_row['id']; ?>" class="btn btn-warning">แก้ไข</a>
                          <button type="submit" value="<?php echo $course_row['id'];?>" name="delete" onclick="return confirm('ยืนยันจะลบรายวิชา : <?php echo $course_row['name'];?>')" class="btn btn-danger">ลบ</button>

                        <?php }?>
                    </td>
                    </tr>
                    <?php } ?>
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
                  <label for="courseid">รหัสวิชา</label>
                  <input type="text" class="form-control" id="courseid" name="courseid" placeholder="รหัสวิชา" required>
                </div>
                <div class="form-group">
                  <label for="coursename">ชื่อวิชา</label>
                  <input type="text" class="form-control" id="coursename" name="coursename" placeholder="ชื่อวิชา" required>
                </div>
                <div class="form-group">
                  <label for="term">เทอม</label>
                  <input type="text" class="form-control" id="term" name="term" placeholder="เทอม" required>
                </div>
                <div class="form-group">
                  <label for="credit">หน่วยกิต</label>
                  <input type="text" class="form-control" id="credit" name="credit" placeholder="หน่วยกิต" required>
                </div>
                <div class="form-group">
                  <label>อาจารย์ผู้สอน</label>
                  <select id="select-testing" name="teacher" class="form-control selectpicker" data-live-search="true" title="กรุณาเลือกอาจารย์ผู้สอน" required>
                    <?php
                    $teacher = $conn->query("SELECT * FROM `teacher`");
                    while($teacher_row = $teacher->fetch_assoc()){
                    ?>
                          <option value="<?php echo $teacher_row['Teacher_id']; ?>"><?php echo $teacher_row['fullname']; ?></option>
                    <?php } ?>
                  </select>
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
              <h5 class="modal-title" id="addteaexcel">เพิ่มชื่ออาจารย์ ผ่านไฟล์ Excel/CSV</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" enctype="multipart/form-data" method="post" role="form">
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputFile">File Upload : </label>
                    <input type="file" name="fileCSV" id="file" size="150">
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
