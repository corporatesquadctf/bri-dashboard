<?php

$server = 'localhost';
$connection = sqlsrv_connect($server, [
    'Database' => 'dashboard_bri'
        ]);
if ($connection === FALSE) {
    die('Something went wrong while connecting to SQL Server');
}

// Getting current year and month
$year = date("Y");
$month = date("m");

$month--;

if ($month == 0):
    $month = 12;
    $year--;
endif;

echo "Performing Import\n";

require_once 'update_summary_top_bottom.php';
require_once 'update_leaderboard.php';

require_once 'update_exec_sum_classified_loan.php';
require_once 'update_exec_sum_customer_profit.php';
require_once 'update_exec_sum_deposito.php';
require_once 'update_exec_sum_dpk.php';
require_once 'update_exec_sum_fee_income.php';
require_once 'update_exec_sum_giro.php';
require_once 'update_exec_sum_interest_income.php';
require_once 'update_exec_sum_loany_raw.php';
require_once 'update_exec_sum_loan_outstanding.php';
require_once 'update_exec_sum_loan_sector.php';
require_once 'update_exec_sum_plafon.php';


echo "Import Done\n";
?>