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

    $sql = 'Select * from DICHVU ';

    $result = sqlsrv_query($conn, $sql);
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    echo
    '<table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID Dịch Vụ</th>
                <th scope="col">Tên Dịch Vụ</th>
                <th scope="col">Đơn Giá</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
    <tbody >';
    
    $i=1;
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo"<td>".$row['idDichVu']."</td>";
        echo"<td>".$row['TenDV']."</td>";
        echo"<td>".$row['DonGia']."</td>";
        echo '<td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$i.'">
        <i class="fas fa-pen"></i>
        </button>

        <div class="modal fade" id="exampleModal'.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel'.$i.'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Cập nhật dịch vụ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
              <div class="modal-body">
              <form action="../ProcessDB/updateKhachHang.php" method="post">
                       <div class="form-group row">
                        <label for="inputIDDichVu" class="col-sm-3 col-form-label">ID Nhân Viên</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputIDDichVu" value="'.$row['idDichVu'].'" name="txtidDichVu" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTenDV" class="col-sm-3 col-form-label">Tên Dịch Vụ</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputTenDV" value="'.$row['TenDV'].'" name="txtTenDV">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDonGia" class="col-sm-3 col-form-label">Địa chỉ</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputDonGia" value="'.$row['DonGia'].'" name="txtDonGia">
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
                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Xóa Dịch Vụ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6>Bạn có muốn xóa dịch vụ này ?</h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                <a href="../ProcessDB/deleteKhachHang.php?idKH='.$row['idDichVu'].'" type="button" class="btn btn-primary">Xóa</a>
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
