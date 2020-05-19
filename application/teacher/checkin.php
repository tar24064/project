    <?php 
      include '../../application/header.php'; 
      
    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">ระบบเช็คชื่อ</h1>
          <p class="mb-4">
            กรุณาเลือกวิชาที่ต้องการเปิดระบบเช็คชื่อค่ะ
          </p>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary"></h1>
            </div>
            <div class="card-body">
              <div class="mb-4" align="right">
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
                      <th></th>
                      <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $course = $conn->query("SELECT a.id,a.code_id,a.name,a.term,a.credit,b.fullname
                                            FROM course as a
                                            INNER JOIN teacher as b ON a.teacher_id = b.teacher_id
                                            
                                            where a.teacher_id = '".$_SESSION["Teacher_id"]."';");
                    while($course_row = $course->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo $course_row['id'];?></td>
                      <td><?php echo $course_row['code_id'];?></td>
                      <td><?php echo $course_row['name'];?></td>
                      <td><?php echo $course_row['term'];?></td>
                      <td align="center"><a href="course_list.php?code=<?php echo $course_row['code_id']; ?>" target="_blank" class="btn btn-primary">QR Code</a></td>
                        <td align="center">  
                            <a href="checkin_start.php?code=<?php echo $course_row['code_id']; ?>" target="_blank" class="btn btn-primary">เปิดระบบเช็คชื่อ</a>
                            <a href="student.php?class=<?php echo $course_row['code_id']; ?>" target="_blank" class="btn btn-danger">รายชื่อนักศึกษา</a>
                            <a href="student_list.php?code=<?php echo $course_row['code_id']; ?>" target="_blank" class="btn btn-secondary">ปรับข้อมูล</a>
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

      <?php include '../../application/footer.php'; ?>
