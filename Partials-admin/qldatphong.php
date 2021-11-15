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

    $sql = "Select * from view_datphong";

    $result = sqlsrv_query($conn, $sql);
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    echo
                        '<table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID Đặt Phòng</th>
                                    <th scope="col">Tên Khách Đặt </th>
                                    <th scope="col">Mã Phòng</th>
                                    <th scope="col">Ngày nhận</th>
                                    <th scope="col">Ngày Trả</th>
                                    <th scope="col">Giá Phòng</th>
                                    <th scope="col">Dịch vụ kèm theo</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                        <tbody >';
                             if($result === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                                   $i=1;                    
                            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<td>".$row['idDatPhong']."</td>";
                                    echo"<td>".$row['TenKH']."</td>";
                                    echo"<td>".$row['MaP']."</td>";
                                    echo"<td>".$row['NgayNhan']->format('d/m/Y')."</td>";
                                    echo"<td>".$row['NgayTra']->format('d/m/Y')."</td>";
                                    echo"<td>".$row['GiaP']."</td>";
                                    echo"<td>".$row['TenDV']."</td>";
                                    echo'<td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$i.'">
        <i class="fas fa-pen"></i>
        </button>

        <div class="modal fade" id="exampleModal'.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel'.$i.'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Cập nhật thông tin đặt phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
              <div class="modal-body">
              <form action="../ProcessDB/updateDatPhong.php" method="post">
                       <div class="form-group row">
                        <label for="inputIDNV" class="col-sm-3 col-form-label">ID Phòng Đặt</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputIDNV" value="'.$row['idDatPhong'].'" name="txtIDdatphong" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selectkhachhang" class="col-sm-3 col-form-label">Tên khách hàng</label>
                        <div class="col-sm-9">
                        <select class="form-control" id="selectkhachhang'.$i.'" name="txtHoTenKH" >' ?>
                            <?php 
                                render("Select MaKH,TenKH from KHACHHANG",$row['TenKH']);
                            ?>
                            <?php echo' 
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputDiaChiNhanVien" class="col-sm-3 col-form-label">Mã Phòng</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputDiaChiNhanVien" value="'.$row['MaP'].'" name="txtMaP">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSoDienThoaiNV" class="col-sm-3 col-form-label">Số điện thoại</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputSoDienThoaiNV" value="'.$row['NgayNhan']->format('d/m/Y').'" name="txtNgayNhan">
                        </div>
                    </div>
                    
                <div class="form-group row">
                    <label for="inputSoDienThoaiNV" class="col-sm-3 col-form-label">Ngày trả</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputSoDienThoaiNV" value="'.$row['NgayTra']->format('d/m/Y').'" name="txtNgayTra">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputGiaP" class="col-sm-3 col-form-label">Giá Phòng</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputGiaP" value="'.$row['GiaP'].'" name="txtGiaP">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputTenDV" class="col-sm-3 col-form-label">Tên Dịch Vụ kèm theo</label>
                    <div class="col-sm-9">
                    <select class="form-control" id="inputTenDV'.$i.'"value="'.$row['TenDV'].'" name="txtTenDV" >' ?>
                    <?php 
                        render("Select idDichVu,TenDV from DICHVU",$row['TenDV']);
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
                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Xóa Đặt Phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6>Bạn có muốn xóa đặt Phòng này ?</h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                <a href="../ProcessDB/deleteKhachHang.php?idKH='.$row['idDatPhong'].'" type="button" class="btn btn-primary">Xóa</a>
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


