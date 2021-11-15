<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location:../login.php");
    }
?>


<?php include('content_admin.php') ?>
<?php include('renderKey-Value.php') ?>

<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-xm-8"></div>
        </div>
    <?php
    // echo '<pre>';
    // print_r($_SESSION['loginOK']);
    // echo '/<pre>';
    $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
    $connectionInfo = array( "Database"=>"QLKHACHSAN","UID"=>$_SESSION['loginOK'] ['user'], "PWD"=>$_SESSION['loginOK'] ['pass'],'CharacterSet' => 'UTF-8');
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    $sql = 'EXECUTE sp_qlkhachhang ';

    $result = sqlsrv_query($conn, $sql);
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    echo
    '<table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Mã KH</th>
                <th scope="col">Tên Khách Hàng</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">SĐT</th>
                <th scope="col">TenNV</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
    <tbody >';
    
    $i=1;
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['MaKH'] . "</td>";
        echo "<td>" . $row['TenKH'] . "</td>";
        echo "<td>" . $row['DChi'] . "</td>";
        echo "<td>" . $row['SDTKH'] . "</td>";
        echo  "<td>". $row['TenNV']. "</td>";
        echo '<td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$i.'">
        <i class="fas fa-pen"></i>
        </button>

        <div class="modal fade" id="exampleModal'.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel'.$i.'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Cập nhật thông tin nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
              <div class="modal-body">
              <form action="../ProcessDB/updateKhachHang.php" method="post">
                       <div class="form-group row">
                        <label for="inputIDNV" class="col-sm-3 col-form-label">ID Nhân Viên</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputIDNV" value="'.$row['MaKH'].'" name="txtMaKH" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputHoTenNhanVien" class="col-sm-3 col-form-label">Họ tên</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputHoTenNhanVien" value="'.$row['TenKH'].'" name="txtHoTenKH">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDiaChiNhanVien" class="col-sm-3 col-form-label">Địa chỉ</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputDiaChiNhanVien" value="'.$row['DChi'].'" name="txtDiaChi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSoDienThoaiNV" class="col-sm-3 col-form-label">Số điện thoại</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputSoDienThoaiNV" value="'.$row['SDTKH'].'" name="txtSDTKH">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selectNhanVien'.$i.'" class="col-sm-3 col-form-label">Tên Nhân Viên</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="selectNhanVien'.$i.'" name="opTenNhanVien" >' ?>
                            <?php 
                                render("Select MaNV,TenNV from NhanVien",$row['TenNV']);
                            ?>
                            <?php echo' 
                            </select>
                        </div>
                    </div>
                
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <input type="submit" class="btn btn-primary" value="Lưu Lại" name="smUpdateNV"></input>
                    </div>

                    </form>
                 </div>
                </div>
            </div>
            </div> 
        </td>';
        echo '<td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ConfrimDeleteEmployee'.$i.'">
        <i class="far fa-trash-alt"></i>
        </button>
        <div class="modal fade" id="ConfrimDeleteEmployee'.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel'.$i.'" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Xóa Nhân Viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6>Bạn có muốn xóa nhân viên này ?</h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                <a href="../ProcessDB/deleteKhachHang.php?idKH='.$row['MaKH'].'" type="button" class="btn btn-primary">Xóa</a>
              </div>
            </div>
          </div>
        </div> 
        </td>';
    $i++;
    }
    echo "</body>";
    echo "</table>";
    sqlsrv_close($conn);

    ?>
    </div>
   

</div>


</div>
<?php include('footer_admin.php') ?>
