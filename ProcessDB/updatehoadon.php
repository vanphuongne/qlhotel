<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location: ../Partials-main/login.php");
    }
        //Nhận các biến
        if(isset($_POST['txtMaHD']))
            $MaHD=$_POST['txtMaHD'];

        if(isset($_POST['txtNgayVietHD']->format('d/m/Y')))
            $NgayVietHD=$_POST['txtNgayVietHD'];

        if(isset($_POST['txtTienCoc']))
            $TienCoc=$_POST['txtTienCoc'];

        if(isset($_POST['txtSotienconphaithanhtoan']))
            $Sotienconphaithanhtoan=$_POST['txtSotienconphaithanhtoan'];

        if(isset($_POST['txtTenNhanVien']))
            $TenNV=$_POST['txtTenNhanVien'];

        $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
        $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$_SESSION['loginOK']['user'] , "PWD"=>$_SESSION['loginOK']['pass'],'CharacterSet' => 'UTF-8');
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        $sql = "EXECUTE sp_qlhoadon  @MaKH=? , @MaP=?,
        @NgayNhan=?,@NgayTra=?,@GiaP=?,@idDichVu=?,@idDatPhong=?";
        $params = array($MaKH,$txtMaP,$txtNgayNhan,$txtNgayTra,$txtGiaP,$txtTenDV,$txtIDdatphong);
        
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true));
           
        }
      
        header("Location:../Partials-admin/qldatphong.php");
     sqlsrv_close( $conn );
?>
