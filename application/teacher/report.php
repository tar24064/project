    <?php 
      include '../../application/header.php'; 
      
    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">ข้อมูลรายวิชาที่สอน</h1>
          <p class="mb-4">
            กรุณาเลือกวิชาที่ต้องการดูรายงานการเข้าเรียนของนักศึกษา
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
                      <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $course = $conn->query("SELECT course.id,course.code_id,course.name,course.term,course.credit,teacher.fullname
                                            FROM course
                                            INNER JOIN teacher
                                            ON course.teacher_id = teacher.teacher_id
                                            where course.teacher_id = '".$_SESSION["Teacher_id"]."';");
                    while($course_row = $course->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo $course_row['id'];?></td>
                      <td><?php echo $course_row['code_id'];?></td>
                      <td><?php echo $course_row['name'];?></td>
                      <td><?php echo $course_row['term'];?></td>
                        <td align="center">  
                            <a href="student_list.php?class=<?php echo $course_row['code_id'];?>" target="_blank" class="btn btn-primary">รายชื่อนักศึกษา</a>
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
