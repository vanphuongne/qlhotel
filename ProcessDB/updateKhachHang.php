<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location: ../Partials-main/login.php");
    }
        //Nhận các biến
        if(isset($_POST['txtMaKH']))
            $MaKH=$_POST['txtMaKH'];

        if(isset($_POST['txtHoTenKH']))
            $TenKH=$_POST['txtHoTenKH'];

        if(isset($_POST['txtDiaChi']))
            $DiaChi=$_POST['txtDiaChi'];

        if(isset($_POST['txtSDTKH']))
            $SoDT=$_POST['txtSDTKH'];

        if(isset($_POST['opTenNhanVien']))
            $MaNV=$_POST['opTenNhanVien'];

        $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
        $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$_SESSION['loginOK']['user'] , "PWD"=>$_SESSION['loginOK']['pass'],'CharacterSet' => 'UTF-8');
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        $sql = "EXECUTE sp_updateKH @TenKH=?,@DChi=?,@SDT=?,@MaNV=?,@MaKH=?";
        $params = array($TenKH,$DiaChi,$SoDT,$MaNV,$MaKH);
        
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true));
           
        }
      
        header("Location:../Partials-admin/qlKhachHang.php");
     sqlsrv_close( $conn );
?>
