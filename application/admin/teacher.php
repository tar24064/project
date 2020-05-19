    <?php 
      include '../../application/header.php'; 
      
      if (isset($_POST['submit'])) {
        $conn->query("INSERT INTO `teacher`(`fullname`, `username`, `password`, `Role`) VALUES ('".$_POST['name']."','".$_POST['username']."','".$_POST['Password']."','".$_POST['role']."')");
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');</script>";
      }

      if (isset($_POST['submitedit']) && $_POST['submitedit']) {
        $conn->query("UPDATE `teacher` SET `fullname`='".$_POST['name']."',`username`='".$_POST['username']."',`password`='".$_POST['password']."',`Role`='".$_POST['role']."' WHERE `Teacher_id` = '".$_POST['submitedit']."'");
        echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'>window.location='teacher.php';</script>";

      }

      if (isset($_POST['delete']) && $_POST['delete']) { 
        $conn->query("DELETE FROM `teacher` WHERE `Teacher_id` = '".$_POST['delete']."';");
        echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');</script>";
       }

      $editid = "";
      if (isset($_GET['edit']) && $_GET['edit']) {
        $editid = $_GET['edit'];
        $edit = $conn->query("SELECT * FROM `teacher` WHERE Teacher_id = $editid") or die($conn->error());
        $result = $edit->fetch_assoc();
      }

      if(isset($_POST['submitexcel'])) {
        $file = $_FILES['fileCSV']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                    {

          $sql = "INSERT INTO `teacher`(`fullname`, `username`, `password`, `Role`) VALUES ('".$filesop[0]."','".$filesop[1]."','".$filesop[2]."','".$filesop[3]."')";
          $conn->query($sql);

          $c = $c + 1;
           }

            if($sql){
               echo "<script type='text/javascript'>alert('อัพโหลดข้อมูลสำเร็จ');</script>";;;
             } else{
               echo "<script type='text/javascript'>alert('อัพโหลดข้อมูลไม่สำเร็จ !!!');</script>";;
             }

      }; 
    ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">ข้อมูลอาจารย์</h1>

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
                    <span class="text">เพิ่มอาจารย์</span>
                  </a>
                  <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addteaexcel">
                    <span class="icon text-white-50">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="text">Import CSV</span>
                  </a>
              </div>
              <div class="table-responsive">
                <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Teacher_id</th>
                      <th>ชื่อ-นามสกุล</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>สิทธิ์การใช้งาน</th>
                      <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tea = $conn->query("SELECT * FROM `teacher`");
                    while($tea_row = $tea->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo $tea_row['Teacher_id'];?></td>
                      <td><?php if($editid == $tea_row['Teacher_id']) { ?>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['fullname']; ?>" required>
                        <?php }else{
                        echo $tea_row['fullname']; }?></td>
                      <td><?php if($editid == $tea_row['Teacher_id']) { ?>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $result['username']; ?>" required style="width:200px;">
                        <?php }else{
                        echo $tea_row['username']; }?></td>
                      <td><?php if($editid == $tea_row['Teacher_id']) { ?>
                        <input type="password" class="form-control" id="password" name="password" required style="width:200px;">
                        <?php }else{ ?>******<?php }?></td>
                      <td><?php if($editid == $tea_row['Teacher_id']) { ?>
                        <div class="form-group">
                          <?php 
                            if ($tea_row['Role'] == "1") { ?>
                              <input type="radio" id="stu" name="role" value="1" required checked>
                              <label for="stu">Admin</label>
                              <input type="radio" id="tea" name="role" value="0" required>
                              <label for="tea">User</label>
                          <?php 
                            }else{?>
                              <input type="radio" id="stu" name="role" value="1" required>
                              <label for="stu">Admin</label>
                              <input type="radio" id="tea" name="role" value="0" required checked>
                              <label for="tea">User</label>
                          <?php 
                            }
                          ?>
                        </div>
                        <?php }else{
                          if ($tea_row['Role'] == "1") {
                            echo "Admin";
                          }else{
                            echo "User";
                          }
                        }
                      ?></td>
                      <td align="center">
                        <?php if($editid == $tea_row['Teacher_id']) { ?>
                          <button type="submit" value="<?php echo $tea_row['Teacher_id'];?>" name="submitedit" class="btn btn-primary">บันทึก</button>
                          <a href="teacher.php" class="btn btn-danger"><i class="fas fa-times"></i></a>
                        <?php }else{ ?>
                          <a href="teacher.php?edit=<?php echo $tea_row['Teacher_id']; ?>" class="btn btn-warning">แก้ไข</a>
                          <button type="submit" value="<?php echo $tea_row['Teacher_id'];?>" name="delete" onclick="return confirm('ยืนยันจะลบข้อมูลของ : <?php echo $tea_row['fullname'];?>')" class="btn btn-danger">ลบ</button>

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
                  <label for="name">ชื่อ-นามสกุล</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="กรอกชื่อ-นามสกุล" required>
                </div>
                <div class="form-group">
                  <label for="username">ชื่อผู้ใช้</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <label for="Password">รหัสผ่าน</label>
                  <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
                </div>
                <div class="form-group">
                      <label>ระดับการใช้งาน : </label>
                      <input type="radio" id="stu" name="role" value="1" required>
                      <label for="stu">Admin</label>
                      <input type="radio" id="tea" name="role" value="0" required>
                      <label for="tea">User</label>
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
              <h5 class="modal-title" id="addteaexcel">เพิ่มชื่ออาจารย์ ผ่านไฟล์ CSV</h5>
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

      <!-- End of Main Content -->
      <?php include '../../application/footer.php'; ?>
