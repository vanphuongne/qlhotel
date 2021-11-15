<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location: ../Partials-main/login.php");
    }
    $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
    $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$_SESSION['loginOK']['user'] , "PWD"=>$_SESSION['loginOK']['pass'],'CharacterSet' => 'UTF-8');
    $result;
    
    if(isset($_GET['idKH']))
        $MaKH=$_GET['idKH'];
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        
        $sql = "EXEC sp_DeleteKH @MaKH =? ";
        $params = array($MaKH);
        $stmt = sqlsrv_query( $conn, $sql, $params);
     

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true));
        }
        
     header("Location:../Partials-admin/qlKhachHang.php");
     sqlsrv_close( $conn );
?>
