<?php
function render($SQLquery,$itemActive){
    $serverName = "DESKTOP-JUFRPS4\MSSQLSERVER01";
    $connectionInfo = array( "Database"=>"QLKHACHSAN ", "UID"=>$_SESSION['loginOK']['user'] , "PWD"=>$_SESSION['loginOK']['pass'],'CharacterSet' => 'UTF-8');
    
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        $sql = $SQLquery;
        $result = sqlsrv_query($conn, $sql);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
            if($row[1]===$itemActive)
                 echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
            else
                echo '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
     sqlsrv_close( $conn );
}
   
?>
