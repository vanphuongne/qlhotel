<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location: ../Partials-main/login.php");
    }
        //Nhận các biến
        if(isset($_POST['txtMaNV']))
            $txtMaNV=$_POST['txtMaNV'];

        if(isset($_POST['txtTenNV']))
            $txtTenNV=$_POST['txtTenNV'];

        if(isset($_POST['txtDChi']))
            $txtDChi=$_POST['txtDChi'];

        if(isset($_POST['txtSDTNV']))
            $txtSDTNV=$_POST['txtSDTNV'];

        if(isset($_POST['txtChucvU']))
            $txtChucvU=$_POST['txtChucvU'];

        if(isset($_POST['txtQToan']))
            $txtQToan=$_POST['txtQToan'];

        $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
        $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$_SESSION['loginOK']['user'] , "PWD"=>$_SESSION['loginOK']['pass'],'CharacterSet' => 'UTF-8');
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        $sql = "EXECUTE sp_updatenNV @TenNV=?,@DChi=?,@SDTNV=?,@ChucVu=?,@MaL=?,@MaNV=?";
        $params = array($txtTenNV,$txtDChi,$txtSDTNV,$txtChucvU,$txtQToan,$txtMaNV);
        
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true));
           
        }
      
       header("Location:../Partials-admin/qlnhanvien.php");
     sqlsrv_close( $conn );
?>
