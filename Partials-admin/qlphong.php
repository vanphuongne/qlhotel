<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location:../login.php");
    }
?>

<?php include('content_admin.php') ?>
                <!-- End of Topbar -->

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
                        
                        $sql="Select * from PHONG";
                        $result=sqlsrv_query($conn,$sql);
                        echo
                        '<table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">Mã Phòng</th>
                                <th scope="col">Loại Phòng</th>
                                <th scope="col">Giá Phòng</th>
                                <th scope="col">Ktra Phòng Trống</th>
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
                                    echo"<td>".$row['MaP']."</td>";
                                    echo"<td>".$row['LoaiP']."</td>";
                                    echo"<td>".$row['GiaP']."</td>";
                                    echo"<td>".$row['CHECKPhongTrong']."</td>";
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
                                                    <label for="input-MaP" class="col-sm-4 col-form-label">Mã Phòng</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-MaP" value="'.$row['MaP'].'"name="txtMaP" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    <label for="input-LoaiP" class="col-sm-4 col-form-label">Loại Phòng</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-LoaiP"value="'.$row['LoaiP'].'"name="txtLoaiP" readonly>
                                                    </div>
                                                    </div>

                                                    <div class="form-group row">
                                                    <label for="input-GiaP" class="col-sm-4 col-form-label">Giá Phòng</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-GiaP" value="'.$row['GiaP'].'"name="txtGiaP" readonly>
                                                    </div>                                                    
                                                    </div>

                                                    <div class="form-group row">
                                                    <label for="input-CHECKPhongTrong" class="col-sm-4 col-form-label">Check Phòng Trống</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="input-CHECKPhongTrong" value="'.$row['CHECKPhongTrong'].'"name="txtCHECKPhongTrong" readonly>
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
                                                <a href="../ProcessDB/deleteKhachHang.php?idKH='.$row['MaP'].'" type="button" class="btn btn-primary">Xóa</a>
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
