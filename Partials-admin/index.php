<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location:../login.php");
    }
?>
<?php include('content_admin.php') ?>

<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-xm-8"></div>
        </div>

        <?php 
                        $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
                        $connectionInfo = array( "Database"=>"QLKHACHSAN","UID"=>$_SESSION['loginOK'] ['user'], "PWD"=>$_SESSION['loginOK'] ['pass'],'CharacterSet' => 'UTF-8');
                        $conn = sqlsrv_connect( $serverName, $connectionInfo);
                        if( $conn === false) {
                            die( print_r( sqlsrv_errors(), true));
                        }
                        
                        $sql="Select * from view_nhanvien";
                        $result=sqlsrv_query($conn,$sql);
                        echo
                        '<table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID Nhân Viên </th>
                                    <th scope="col">Tên Nhân Viên</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">SĐT</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Lương</th>
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
                                    echo"<td>".$row['MaNV']."</td>";
                                    echo"<td>".$row['TenNV']."</td>";
                                    echo"<td>".$row['DChi']."</td>";
                                    echo"<td>".$row['SDTNV']."</td>";
                                    echo"<td>".$row['ChucVu']."</td>";
                                    echo"<td>".$row['QToan']."</td>";
                                    echo'<td>
                                                <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$i.'">
                                            <i class="fas fa-pen"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal'.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel'.$i.'" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel'.$i.'">Sửa Thông Tin Nhân Viên</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form>

                                                    <div class="form-group row">
                                                    <label for="input-nv" class="col-sm-4 col-form-label">ID Nhân Viên</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-nv" value="'.$row['MaNV'].'"name="txtMaNV" readonly>
                                                    </div>
                                                    </div>
                                                
                                                    <div class="form-group row">
                                                    <label for="input-nv" class="col-sm-4 col-form-label">Tên Nhân Viên</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-nv" value="'.$row['TenNV'].'"name="txtTenNV" >
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    <label for="input-address" class="col-sm-4 col-form-label">Địa Chỉ</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-address"value="'.$row['DChi'].'"name="txtDChi" >
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    <label for="input-phone" class="col-sm-4 col-form-label">Số Điện Thoại</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-phone" value="'.$row['SDTNV'].'"name="txtSDTNV" >
                                                    </div>                                                    
                                                    </div>


                                                    <div class="form-group row">
                                                    <label for="inputPassword'.$i.'"class="col-sm-4 col-form-label">Chức vụ</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="inputPassword'.$i.'" value="'.$row['ChucVu'].'"name="txtChucvU" > ';?>
        <?php 
                                                        if($row['ChucVu']==="Nhân viên")
                                                        echo   '<option selected >Nhân viên</option>
                                                                <option>Quản lý</option>
                                                                <option>Lễ tân</option>';

                                                        else if($row['ChucVu']==="Quản lý")  
                                                        echo   '<option >Nhân viên</option>
                                                                <option selected>Quản lý</option>
                                                                <option>Lễ tân</option>';  

                                                        else
                                                        echo   '<option >Nhân Viên</option>
                                                                <option>Quản lý</option>
                                                                <option selected >Lễ tân</option>';         
                                                        ?>

        <?php echo' </select>
                                                    </div>
                                                    </div>


                                                    <div class="form-group row">
                                                    <label for="input-luong" class="col-sm-4 col-form-label">Lương</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-luong"value="'.$row['QToan'].'">
                                                    </div>
                                                    </div>

                                                </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button buttontype="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <input type="submit" value="Lưu" class="btn btn-primary"></input>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                    </td>';
                                    $i++;

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
                                                <a href="../ProcessDB/deleteKhachHang.php?idKH='.$row['MaNV'].'" type="button" class="btn btn-primary">Xóa</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div> 
                                        </td>
                                       </tr>';
                                        $i++;
                                        }
                                echo "</body>";
                                echo"</table>";
                                sqlsrv_close($conn);

                    ?>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('footer_admin.php') ?>