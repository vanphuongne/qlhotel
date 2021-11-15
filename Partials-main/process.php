<?php 
session_start();
if(isset($_POST['submit-send']))
{
    $username=$_POST['txt-user-name'];
    $password=$_POST['txt-password'];

    $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
    $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$username , "PWD"=>$password,'CharacterSet' => 'UTF-8');

    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn) {
        $_SESSION['loginOK'] = ['user'=> $username,'pass'=>$password];
        header("Location: ../Partials-admin/index.php");
    }
    else{
        header("Location: ../Partials-admin/qlnhanvien.php");

    }
    sqlsrv_close( $conn );

}

?>