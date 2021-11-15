<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK'])){
        header("Location: ../Partials-main/login.php");
    }
        //Nhận các biến
        if(isset($_POST['txtIDdatphong']))
            $txtIDdatphong=$_POST['txtIDdatphong'];

        if(isset($_POST['txtHoTenKH']))
            $MaKH=$_POST['txtHoTenKH'];

        if(isset($_POST['txtMaP']))
            $txtMaP=$_POST['txtMaP'];

        if(isset($_POST['txtNgayNhan']))
            $txtNgayNhan=$_POST['txtNgayNhan'];

        if(isset($_POST['txtNgayTra']))
            $txtNgayTra=$_POST['txtNgayTra'];

            if(isset($_POST['txtGiaP']))
                $txtGiaP=$_POST['txtGiaP'];

        if(isset($_POST['txtTenDV']))
            $txtTenDV=$_POST['txtTenDV'];
    $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
        $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$_SESSION['loginOK']['user'] , "PWD"=>$_SESSION['loginOK']['pass'],'CharacterSet' => 'UTF-8');
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        
        $sql = "EXECUTE sp_updatedatphong @MaKH=? , @MaP=?,
        @NgayNhan=?,@NgayTra=?,@GiaP=?,@idDichVu=?,@idDatPhong=?";
        $params = array($MaKH,$txtMaP,$txtNgayNhan,$txtNgayTra,$txtGiaP,$txtTenDV,$txtIDdatphong);
        
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true));
           
        }
      
        header("Location:../Partials-admin/qldatphong.php");
     sqlsrv_close( $conn );
?>
