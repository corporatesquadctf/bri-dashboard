<?php

class Home_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
        $this->last_year = $today->format('Y') - 1;
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    public function getFundingCasa($userId)
    {
        $sql = "SELECT Total, GIRO, DEPO, 
                CASE 
                WHEN Total = 0 THEN 0
                ELSE (GIRO/Total)*100 END AS Casa FROM 
                (SELECT ISNULL(SUM(Saldo),0) Total
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer) AND year(Periode)= '" . $this->current_year . "') \"Total\",
                (SELECT ISNULL(SUM(Saldo),0) GIRO
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer) AND year(Periode)= '" . $this->current_year . "' AND Desc1 = 'GIRO') \"GIRO\",
                (SELECT ISNULL(SUM(Saldo),0) DEPO
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer) AND year(Periode)= '" . $this->current_year . "' AND Desc1 ='DEPOSITO') \"DEPO\"";
    // return var_dump($sql);
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getGiroMonthly($userId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(Saldo),0)  \'' . $d->format('m') . '\'
            FROM Summary_SimpananDailyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy=\'' . $userId . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' AND Desc1 = \'GIRO\' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
    // return var_dump($sql);
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getDepositoMonthly($userId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(Saldo),0)  \'' . $d->format('m') . '\'
            FROM Summary_SimpananDailyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy=\'' . $userId . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' AND Desc1 = \'DEPOSITO\' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
    // return var_dump($sql);
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananMonthly($userId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(Saldo),0)  \'' . $d->format('m') . '\'
            FROM Summary_SimpananDailyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy=\'' . $userId . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
    // return var_dump($sql);
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getLoanCurrentYear($userId)
    {
        $sql = "SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer) AND year(Periode)= '" . $this->current_year . "'";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLoanMonthly($userId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(bakidebet),0)  \'' . $d->format('m') . '\'
            FROM Summary_PinjamanMonthlyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy=\'' . $userId . '\'
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getLastDateLoan($userId)
    {
        $sql = "SELECT MAX(Periode) Periode 
        FROM Summary_PinjamanMonthlyCustomer
        WHERE Vcif IN(
            SELECT VCIF
            FROM AccountPlanningCustomer
            WHERE CreatedBy='" . $userId . "'
        )";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLoanCurrentlastMonth($userId, $periode)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) 'current'
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND month(Periode)=" . $periode['currentMonth'] . " AND YEAR(Periode) = " . $periode['currentYear'] . " ) \"current\",
        
                ( SELECT ISNULL(SUM(bakidebet),0) 'previous'
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND month(Periode)=" . $periode['lastMonth'] . " AND YEAR(Periode) = " . $periode['lastYear'] . " ) \"previous\"";

        // return var_dump($sql);
        $result = $this->db->query($sql);

        return $result->result_array();
    }

    /////// Modal Kerja

    public function getmodalKerjaCurrentYear($userId)
    {
        $sql = "SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer) AND year(Periode)= '" . $this->current_year . "' AND JenisPenggunaan = 2";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getmodalKerjaMonthly($userId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(bakidebet),0)  \'' . $d->format('m') . '\'
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                        SELECT VCIF
                        FROM AccountPlanningCustomer
                        WHERE CreatedBy=\'' . $userId . '\'
                    ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' AND JenisPenggunaan = 2) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getLastDatemodalKerja($userId)
    {
        $sql = "SELECT MAX(Periode) Periode 
        FROM Summary_PinjamanMonthlyCustomer
        WHERE Vcif IN(
            SELECT VCIF
            FROM AccountPlanningCustomer
            WHERE CreatedBy='" . $userId . "'
        ) AND JenisPenggunaan = 2";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getmodalKerjaCurrentlastMonth($userId, $periode)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) 'current'
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND month(Periode)=" . $periode['currentMonth'] . " AND YEAR(Periode) = " . $periode['currentYear'] . " AND JenisPenggunaan = 2) \"current\",
                
                ( SELECT ISNULL(SUM(bakidebet),0) 'previous'
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                ) AND month(Periode)=" . $periode['lastMonth'] . " AND YEAR(Periode) = " . $periode['lastYear'] . " AND JenisPenggunaan = 2) \"previous\"";

        // return var_dump($sql);
        $result = $this->db->query($sql);

        return $result->result_array();
    }

    /////// investasi

    public function getinvestasiCurrentYear($userId)
    {
        $sql = "SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
            FROM Summary_PinjamanMonthlyCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy='" . $userId . "'
            ) AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer) AND year(Periode)= '" . $this->current_year . "' AND JenisPenggunaan = 1";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getinvestasiMonthly($userId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(bakidebet),0)  \'' . $d->format('m') . '\'
        FROM Summary_PinjamanMonthlyCustomer
        WHERE Vcif IN(
            SELECT VCIF
            FROM AccountPlanningCustomer
            WHERE CreatedBy=\'' . $userId . '\'
        ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' AND JenisPenggunaan = 1) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getLastDateinvestasi($userId)
    {
        $sql = "SELECT MAX(Periode) Periode 
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='" . $userId . "'
                )AND JenisPenggunaan = 1";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getinvestasiCurrentlastMonth($userId, $periode)
    {
        $sql = "SELECT * FROM 
    ( SELECT ISNULL(SUM(bakidebet),0) 'current'
    FROM Summary_PinjamanMonthlyCustomer
    WHERE Vcif IN(
    SELECT VCIF
    FROM AccountPlanningCustomer
    WHERE CreatedBy='" . $userId . "'
    ) AND month(Periode)=" . $periode['currentMonth'] . " AND YEAR(Periode) = " . $periode['currentYear'] . " AND JenisPenggunaan = 1) \"current\",
    
    ( SELECT ISNULL(SUM(bakidebet),0) 'previous'
    FROM Summary_PinjamanMonthlyCustomer
    WHERE Vcif IN(
    SELECT VCIF
    FROM AccountPlanningCustomer
    WHERE CreatedBy='" . $userId . "'
    ) AND month(Periode)=" . $periode['lastMonth'] . " AND YEAR(Periode) = " . $periode['lastYear'] . " AND JenisPenggunaan = 1) \"previous\"";

        // return var_dump($sql);
        $result = $this->db->query($sql);

        return $result->result_array();
    }
}
