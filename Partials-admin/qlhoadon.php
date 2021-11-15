<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location:../login.php");
    }
?>

<?php include('content_admin.php') ?>
<?php include('renderKey-Value.php') ?>

                <!-- Begin Page Content -->
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
                        
                        $sql="EXECUTE sp_qlhoadon";
                        $result=sqlsrv_query($conn,$sql);
                        echo
                        '<table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Mã Hóa Đơn</th>
                                    <th scope="col">Ngày Viết Hóa Đơn</th>
                                    <th scope="col">Tiền Đã Cọc</th>
                                    <th scope="col">Tổng tiền Phải thanh toán</th>
                                    <th scope="col">Số tiền còn phải trả</th>
                                    <th scope="col">Nhân Viên Thanh Toán</th>
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
                                    echo"<td>".$row['MaHD']."</td>";
                                    echo"<td>".$row['NgayVietHD']->format('d/m/Y')."</td>";
                                    echo"<td>".$row['TienCoc']."</td>";
                                    echo"<td>".$row['TongTien']."</td>";
                                    echo"<td>".$row['Sotienconphaithanhtoan']."</td>";
                                    echo"<td>".$row['TenNV']."</td>";
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
                                                    <h5 class="modal-title" id="exampleModalLabel'.$i.'">Sửa Thông Tin Phòng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form>

                                                    <div class="form-group row">
                                                    <label for="input-MaHD" class="col-sm-4 col-form-label">Mã Hóa Đơn</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-MaHD" value="'.$row['MaHD'].'"name="txtMaHD" >
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    <label for="input-NgayVietHD" class="col-sm-4 col-form-label">Ngày Viết Hóa Đơn</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-NgayVietHD"value="'.$row['NgayVietHD']->format('d/m/Y').'"name="txtNgayVietHD" >
                                                    </div>
                                                    </div>

                                                    <div class="form-group row">
                                                    <label for="input-TienCoc" class="col-sm-4 col-form-label">Tiền đã cọc</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-TienCoc" value="'.$row['TienCoc'].'"name="txtTienCoc" >
                                                    </div>                                                    
                                                    </div>

                                                    <div class="form-group row">
                                                    <label for="input-Sotienconphaithanhtoan" class="col-sm-4 col-form-label">Tổng tiền Phải thanh toán</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-Sotienconphaithanhtoan" value="'.$row['Sotienconphaithanhtoan'].'"name="txtSotienconphaithanhtoan" >
                                                    </div>                                                    
                                                    </div>

                                                    <div class="form-group row">
                                                    <label for="selectNhanVien'.$i.'" class="col-sm-4 col-form-label">Tên Nhân Viên</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selectNhanVien'.$i.'" name="txtTenNhanVien" >' ?>
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
                                                <h5 class="modal-title" id="exampleModalLabel'.$i.'">Xóa Phòng</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Bạn có muốn xóa phòng này ?</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                                <a href="../ProcessDB/deleteKhachHang.php?idKH='.$row['MaHD'].'" type="button" class="btn btn-primary">Xóa</a>
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
</div>
<?php include('footer_admin.php') ?>
