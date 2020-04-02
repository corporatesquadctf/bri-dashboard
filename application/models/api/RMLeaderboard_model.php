<?php

class RMLeaderboard_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function getDetailRM($rm_id)
    {
        $sql = 'SELECT "A"."UserId", "A"."Name" AS "RmName", "A"."ProfilePicture", "A"."Title", 
                        "B"."Name" AS "UnitKerja", "A"."CorporateEmail", "A"."OtherEmail","A"."PhoneNumber1"
      ,"A"."PhoneNumber2",
                        "C"."LogDate" "LastAccess"
                FROM "User" "A"
                LEFT JOIN "UnitKerja" "B" on "A"."UnitKerjaId"="B"."UnitKerjaId"
                LEFT JOIN "Log" "C" on "A"."UserId"="C"."CreatedBy" and "C"."Action"=\'Get Task Profile\'
                WHERE "A"."RoleId"=10 AND "A"."UserId"=\'' . $rm_id . '\'';
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getSimpananRMMonthly($rm_id)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM '; 

        for ($i = $last_month; $i > $last_month - 6; $i--) {
            $sql .= '( SELECT ISNULL(SUM(Saldo),0) \'' . $d->format('m') . '\'
            FROM Summary_SimpananDailyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy = \'' . $rm_id . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = '.$d->format('Y').' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
    
    public function getPinjamanRMMonthly($rm_id)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM '; 

        for ($i = $last_month; $i > $last_month - 6; $i--) {
            $sql .= '( SELECT ISNULL(SUM(BakiDebet),0) \'' . $d->format('m') . '\'
            FROM Summary_PinjamanMonthlyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy = \'' . $rm_id . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = '.$d->format('Y').' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityRMMonthly($rm_id)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM '; 

        for ($i = $last_month; $i > $last_month - 6; $i--) {
            $sql .= '( SELECT ISNULL(SUM(labarugisetelahmodal),0) \'' . $d->format('m') . '\'
            FROM Summary_CpaCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy = \'' . $rm_id . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = '.$d->format('Y').' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
}
