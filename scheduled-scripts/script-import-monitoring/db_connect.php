<?php
date_default_timezone_set('Asia/Jakarta');

define('BASEPATH', $_SERVER['DOCUMENT_ROOT']);

$serverName = "localhost";
$connectionInfo = array( "Database"=>"CPA_KORPORASI_DEV_7", "UID"=>"sa", "PWD"=>"12345678");
// $connectionInfo = array( "Database"=>"CPA_KORPORASI_DEV", "UID"=>"sa", "PWD"=>"andre.marga");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn === FALSE) {
    echo "Connection could not be established.\n";
    die( print_r( sqlsrv_errors(), true));
}

// echo "Connection established.\n";

?>