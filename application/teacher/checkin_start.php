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
                        <label>วันที่ : </label>
                    </div>
                    <div class="col col-auto form-group">
                        <label>ครั้งที่ : </label>
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
                    <div class="col col-auto form-group">
                      <label>วิชา : </label>
                    </div>
                    <div class="col col-auto form-group">
                      <label>ผู้สอน : </label>
                    </div>
                    <div class="col col-auto form-group">
                      <label>ภาคเรียน : </label>
                    </div>
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
