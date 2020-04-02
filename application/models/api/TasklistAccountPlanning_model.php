<?php

class TasklistAccountPlanning_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->month_current = $today->format('m');
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    public function getAccountPlanningRecentActivities($AccountPlanningId)
    {
        $sql = "SELECT distinct Activity, Message, B.Name, convert(datetime,convert(varchar,A.CreatedDate, 100)) CreatedDate
                FROM AccountPlanningActivity A, [User] B
                WHERE A.CreatedBy=B.UserId AND AccountPlanningId=" . $AccountPlanningId . "  
                ORDER BY convert(datetime,convert(varchar,A.CreatedDate, 100)) DESC";

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getMyAccountPlanning($userId, $rowperpage, $rowno, $year = '', $docStatusId = '', $searchTxt = '')
    {
        $filter = '';
        $tblFilter = '';
        if (!empty($year) && $year <> 'all') {
            $filter .= " AND A.Year='" . $year . "'";
        }

        if (!empty($docStatusId) && $docStatusId <> 'all') {
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=" . $docStatusId . " AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningId = A.AccountPlanningId) ";
        }

        if (!empty($searchTxt)) {
            $filter .= " AND A.AccountPlanningId IN (
                    SELECT X.AccountPlanningId
                    FROM AccountPlanningCustomer X, CustomerKorporasi Y
                    WHERE X.VCIF=Y.VCIF
                        AND (Y.NAME LIKE '%" . $searchTxt . "%' OR Y.VCIF LIKE '%" . $searchTxt . "%')
                )";
        }

        if (!empty($userId)) {
            $filter .= " AND B.UserId='" . $userId . "'  ";
        }

        $sql = "
            SELECT A.AccountPlanningId, A.CreatedDate, A.CreatedBy, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo, F.Name company_group
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F " . $tblFilter . "
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 " . $filter . "
            ORDER BY A.CreatedDate DESC OFFSET " . $rowno . " ROWS FETCH NEXT " . $rowperpage . " ROWS ONLY
        ";

        $result = $this->db->query($sql);

        return $result->result_array();
    }


    public function getTotalMyAccountPlanning($userId, $year = '', $docStatusId = '', $searchTxt = '')
    {
        $filter = '';
        $tblFilter = '';
        if (!empty($year) && $year <> 'all') {
            $filter .= " AND A.Year='" . $year . "'";
        }

        if (!empty($docStatusId) && $docStatusId <> 'all') {
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=" . $docStatusId . " AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningId = A.AccountPlanningId) ";
        }

        if (!empty($searchTxt)) {
            $filter .= " AND A.AccountPlanningId IN (
                    SELECT X.AccountPlanningId
                    FROM AccountPlanningCustomer X, CustomerKorporasi Y
                    WHERE X.VCIF=Y.VCIF
                        AND (Y.NAME LIKE '%" . $searchTxt . "%' OR Y.VCIF LIKE '%" . $searchTxt . "%')
                )";
        }

        if (!empty($userId)) {
            $filter .= " AND B.UserId='" . $userId . "'  ";
        }

        $sql = "SELECT COUNT(1) Total FROM(
            SELECT A.AccountPlanningId, A.CreatedDate, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F " . $tblFilter . "
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 " . $filter . "
            ) Tbl
        ";

        $result = $this->db->query($sql)->row_array();

        return $result['Total'];
    }

    public function getAccountPlanningCoverageMapping($AccountPlanningId, $VCIF)
    {
        $sql = "SELECT ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description
                FROM CoverageMapping
                WHERE AccountPlanningId = " . $AccountPlanningId . " AND VCIF = '" . $VCIF . "'";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function getAccountPlanningGroupOverview($AccountPlanningId, $VCIF = NULL)
    {
        $whereClause = "";
        if ($VCIF != NULL) {
            $whereClause .= " AND a.VCIF = '" . $VCIF . "'";
        }
        $sql = 'SELECT "a".GroupOverviewId, "a"."Address1", "a"."Address2", "a"."Address3", "a"."Address1", "a"."IndustryName",
                    "b"."Name" AS "Province",
                    "c"."Name" AS "GlobalRatingName", "c"."Description" AS "GlobalRatingDescription", 
                    "d"."Name" AS "DomesticRating",
                    "e"."Name" AS "LifeCycle",
                    "f"."Name" AS "ChildCompanyName",
                    "g"."Name" AS "IndustryTrend"
                FROM "GroupOverview" "a"
                LEFT JOIN "Province" "b" on "a"."ProvinceId"="b"."ProvinceId" AND "b"."IsActive"=1
                LEFT JOIN "GlobalRating" "c" on "a"."GlobalRatingId"="c"."GlobalRatingId" AND "c"."IsActive"=1
                LEFT JOIN "DomesticRating" "d" on "a"."DomesticRatingId"="d"."DomesticRatingId" AND "d"."IsActive"=1
                LEFT JOIN "LifeCycle" "e" on "a"."LifeCycleId"="e"."LifeCycleId" AND "e"."IsActive"=1
                LEFT JOIN "CustomerKorporasi" "f" on "a"."VCIF"="f"."VCIF" 
                LEFT JOIN "IndustryTrend" "g" on "a"."IndustryTrendId"="g"."IndustryTrendId" AND "g"."IsActive"=1                
                WHERE "a"."AccountPlanningId" =' . $AccountPlanningId . $whereClause .
            'ORDER BY "a".CreatedDate DESC OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getPinjamanAccountPlanning($AccountPlanningId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(bakidebet),0) \'' . $d->format('m') . '\'
            FROM Summary_PinjamanMonthlyCustomer
            WHERE Vcif IN(
            SELECT VCIF FROM AccountPlanningCustomer
            WHERE AccountPlanningId=' . $AccountPlanningId . '
            ) AND month(periode)=' . $d->format('m') . ' AND YEAR(periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanAccountPlanningYoYoD($AccountPlanningId)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) bakidebetSekarang
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                )) ) A,

                ( SELECT ISNULL(SUM(bakidebet),0) bakidebetTahunLalu
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_PinjamanMonthlyCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCustomer 
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(bakidebet),0) bakidebetAkhirTahunLalu
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ))-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanAccountPlanningKIKMK($accountPlanningId)
    {
        $sql = "SELECT KI,KMK,(KI + KMK) as total, 
        case when (KI+KMK) = 0 Then 0
            else ((KI/(KI+KMK))*100) 
        END as KIPersen, 
        case when (KI+KMK) = 0 Then 0
            else ((KMK/(KI+KMK))*100) 
        END as KMKPersen FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) KI
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                            SELECT VCIF FROM AccountPlanningCustomer
                            WHERE AccountPlanningId=" . $accountPlanningId . "
                    ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                        WHERE Vcif IN(
                            SELECT VCIF FROM AccountPlanningCustomer
                            WHERE AccountPlanningId=" . $accountPlanningId . "
                        )) And JenisPenggunaan = 1 ) A,
        
                ( SELECT ISNULL(SUM(bakidebet),0) KMK
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                        SELECT VCIF FROM AccountPlanningCustomer
                        WHERE AccountPlanningId=" . $accountPlanningId . "
                    ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                        WHERE Vcif IN(
                            SELECT VCIF FROM AccountPlanningCustomer
                            WHERE AccountPlanningId=" . $accountPlanningId . "
                        )) And JenisPenggunaan = 2 ) B";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananGiroAccountPlanning($AccountPlanningId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(saldo),0) \'' . $d->format('m') . '\'
            FROM Summary_SimpananMonthlyCustomer
            WHERE Vcif IN(
            SELECT VCIF FROM AccountPlanningCustomer
            WHERE AccountPlanningId=' . $AccountPlanningId . '
            ) AND month(periode)=' . $d->format('m') . ' AND YEAR(periode) = ' . $d->format('Y') . ' AND Desc1 = \'GIRO\') "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananDepositoAccountPlanning($AccountPlanningId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(saldo),0) \'' . $d->format('m') . '\'
            FROM Summary_SimpananMonthlyCustomer
            WHERE Vcif IN(
            SELECT VCIF FROM AccountPlanningCustomer
            WHERE AccountPlanningId=' . $AccountPlanningId . '
            ) AND month(periode)=' . $d->format('m') . ' AND YEAR(periode) = ' . $d->format('Y') . ' AND Desc1 = \'DEPOSITO\') "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananAccountPlanningYoYoD($AccountPlanningId)
    {
        $sql = "SELECT *, CASE
                WHEN SaldoSekarang = 0 THEN 0
                ELSE ((SaldoAkhirGiro/SaldoSekarang)*100)
                END AS CASA FROM 
                ( SELECT ISNULL(SUM(saldo),0) SaldoSekarang
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                )) ) A,

                ( SELECT ISNULL(SUM(saldo),0) SaldoTahunLalu
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_SimpananMonthlyCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananMonthlyCustomer 
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(saldo),0) SaldoAkhirTahunLalu
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananMonthlyCustomer 
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ))-1 ) C,

                ( SELECT ISNULL(SUM(saldo),0) SaldoAkhirGiro
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                )) AND Desc1 = 'GIRO') SaldoAkhirGiro";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityAccountPlanning($AccountPlanningId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(labarugisetelahmodal),0) \'' . $d->format('m') . '\'
            FROM Summary_CpaCustomer
            WHERE Vcif IN(
            SELECT VCIF FROM AccountPlanningCustomer
            WHERE AccountPlanningId=' . $AccountPlanningId . '
            ) AND month(periode)=' . $d->format('m') . ' AND YEAR(periode) =  ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityAccountPlanningYoYoD($AccountPlanningId)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPASekarang
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                )) ) A,

                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPATahunLalu
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_CpaCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_CpaCustomer 
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPAAkhirTahunLalu
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_CpaCustomer 
                WHERE Vcif IN(
                    SELECT VCIF FROM AccountPlanningCustomer
                    WHERE AccountPlanningId=" . $AccountPlanningId . "
                ))-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananGroupMonthly($GroupId)
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
                SELECT B.VCIF
                FROM CustomerGroup A, CustomerKorporasi B
                WHERE A.CustomerGroupId=B.CustomerGroupId
                    AND A.CustomerGroupId= ' . $GroupId . '
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananGroupYoYoD($GroupId)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(Saldo),0) SaldoSekarang
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                )) ) A,

                ( SELECT ISNULL(SUM(Saldo),0) SaldoTahunLalu
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_SimpananDailyCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananDailyCustomer 
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(Saldo),0) SaldoAkhirTahunLalu
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananDailyCustomer 
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ))-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanGroupMonthly($GroupId)
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
                SELECT B.VCIF
                FROM CustomerGroup A, CustomerKorporasi B
                WHERE A.CustomerGroupId=B.CustomerGroupId
                    AND A.CustomerGroupId= ' . $GroupId . '
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanGroupYoYoD($GroupId)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) PinjamanSekarang
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                )) ) A,

                ( SELECT ISNULL(SUM(bakidebet),0) PinjamanTahunLalu
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_PinjamanMonthlyCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCustomer 
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(bakidebet),0) PinjamanAkhirTahunLalu
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCustomer 
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ))-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanGroupKIKMK($GroupId)
    {
        $sql = "SELECT KI,KMK,(KI + KMK) as total, 
        case when (KI+KMK) = 0 Then 0
            else ((KI/(KI+KMK))*100) 
        END as KIPersen, 
        case when (KI+KMK) = 0 Then 0
            else ((KMK/(KI+KMK))*100) 
        END as KMKPersen FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) KI
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                        SELECT B.VCIF
                        FROM CustomerGroup A, CustomerKorporasi B
                        WHERE A.CustomerGroupId=B.CustomerGroupId
                            AND A.CustomerGroupId= " . $GroupId . "
                    ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                        SELECT B.VCIF
                        FROM CustomerGroup A, CustomerKorporasi B
                        WHERE A.CustomerGroupId=B.CustomerGroupId
                            AND A.CustomerGroupId= " . $GroupId . "
                    )) And JenisPenggunaan = 1 ) A,
        
                ( SELECT ISNULL(SUM(bakidebet),0) KMK
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                        SELECT B.VCIF
                        FROM CustomerGroup A, CustomerKorporasi B
                        WHERE A.CustomerGroupId=B.CustomerGroupId
                            AND A.CustomerGroupId= " . $GroupId . "
                    ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif IN(
                        SELECT B.VCIF
                        FROM CustomerGroup A, CustomerKorporasi B
                        WHERE A.CustomerGroupId=B.CustomerGroupId
                            AND A.CustomerGroupId= " . $GroupId . "
                    )) And JenisPenggunaan = 2 ) B";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityGroupMonthly($GroupId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(labarugisetelahmodal),0) \'' . $d->format('m') . '\'
            FROM Summary_CpaCustomer
            WHERE Vcif IN(
                SELECT B.VCIF
                FROM CustomerGroup A, CustomerKorporasi B
                WHERE A.CustomerGroupId=B.CustomerGroupId
                    AND A.CustomerGroupId= ' . $GroupId . '
            ) AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityGroupYoYoD($GroupId)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPASekarang
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                )) ) A,

                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPATahunLalu
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_CpaCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_CpaCustomer 
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPAAkhirTahunLalu
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_CpaCustomer 
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId= " . $GroupId . "
                ))-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananVcifMonthly($Vcif)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(Saldo),0)  \'' . $d->format('m') . '\'
            FROM Summary_SimpananDailyCustomer
            WHERE Vcif = \'' . $Vcif . '\'
             AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananVcifYoYoD($Vcif)
    {
        $sql = 'SELECT * FROM 
                ( SELECT ISNULL(SUM(Saldo),0) SaldoSekarang
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif = \'' . $Vcif . '\'
                AND Periode = (SELECT Max(Periode) FROM Summary_SimpananDailyCustomer
                WHERE Vcif = \'' . $Vcif . '\') ) A,

                ( SELECT ISNULL(SUM(Saldo),0) SaldoTahunLalu
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif = \'' . $Vcif . '\'
                AND month(periode)=(SELECT Max(month(periode)) FROM Summary_SimpananDailyCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananDailyCustomer 
                WHERE Vcif = \'' . $Vcif . '\')-1 ) B,

                ( SELECT ISNULL(SUM(Saldo),0) SaldoAkhirTahunLalu
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif = \'' . $Vcif . '\' AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananDailyCustomer 
                WHERE Vcif = \'' . $Vcif . '\')-1 ) C';
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanVcifMonthly($Vcif)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(bakidebet),0)  \'' . $d->format('m') . '\'
            FROM Summary_PinjamanMonthlyCustomer
            WHERE Vcif = \'' . $Vcif . '\'
             AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanVcifYoYoD($Vcif)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) PinjamanSekarang
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif = '" . $Vcif . "'
                AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif = '" . $Vcif . "') ) A,

                ( SELECT ISNULL(SUM(bakidebet),0) PinjamanTahunLalu
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif = '" . $Vcif . "' 
                AND month(periode)=(SELECT Max(month(periode)) FROM Summary_PinjamanMonthlyCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCustomer 
                WHERE Vcif = '" . $Vcif . "')-1 ) B,

                ( SELECT ISNULL(SUM(bakidebet),0) PinjamanAkhirTahunLalu
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif = '" . $Vcif . "' 
                AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif = '" . $Vcif . "')-1 ) C";
        //  var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanVcifKIKMK($Vcif)
    {
        $sql = "SELECT KI,KMK,(KI + KMK) as total, 
        case when (KI+KMK) = 0 Then 0
            else ((KI/(KI+KMK))*100) 
        END as KIPersen, 
        case when (KI+KMK) = 0 Then 0
            else ((KMK/(KI+KMK))*100) 
        END as KMKPersen FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) KI
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif = '" . $Vcif . "' 
                    AND Periode = (
                        SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                        WHERE Vcif = '" . $Vcif . "' 
                    ) AND JenisPenggunaan = 1 ) A,
        
                ( SELECT ISNULL(SUM(bakidebet),0) KMK
                    FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif = '" . $Vcif . "' 
                    AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCustomer
                    WHERE Vcif = '" . $Vcif . "' 
                    ) AND JenisPenggunaan = 2 ) B";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityVcifMonthly($Vcif)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(labarugisetelahmodal),0) \'' . $d->format('m') . '\'
            FROM Summary_CpaCustomer
            WHERE Vcif = \'' . $Vcif . '\'
            AND month(Periode)=' . $d->format('m') . ' AND YEAR(Periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getProfitabilityVcifYoYoD($Vcif)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPASekarang
                FROM Summary_CpaCustomer
                WHERE Vcif = '" . $Vcif . "'
                AND Periode = (SELECT Max(Periode) FROM Summary_CpaCustomer
                WHERE Vcif = '" . $Vcif . "'
                ) ) A,

                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPATahunLalu
                FROM Summary_CpaCustomer
                WHERE Vcif = '" . $Vcif . "'
                AND month(periode)=(SELECT Max(month(periode)) FROM Summary_CpaCustomer)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_CpaCustomer 
                WHERE Vcif = '" . $Vcif . "'
                )-1 ) B,

                ( SELECT ISNULL(SUM(labarugisetelahmodal),0) CPAAkhirTahunLalu
                FROM Summary_CpaCustomer
                WHERE Vcif = '" . $Vcif . "'
                AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_CpaCustomer 
                WHERE Vcif = '" . $Vcif . "'
                )-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getRarocVcifMonthly($Vcif)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 6; $i--) {
            $sql .= "
            (SELECT 
	CASE WHEN (LabaRugiFtpRaroc) = 0 Then 0
    ELSE ((LabaRugiFtpCPA/LabaRugiFtpRaroc)*EL) 
    END AS \"" . $d->format('m') . "\" 
        FROM (
            SELECT 
                ISNULL(
                    ( 
                        SELECT TOP 1 LabaRugiFtpSetelahModal AS LabaRugiFtpCPA
                        FROM Summary_CpaCustomer
                        WHERE Vcif = '" . $Vcif . "'
                        AND month(Periode)=" . $d->format('m') . " AND YEAR(Periode) = " . $d->format('Y') . "
                        ORDER BY Periode DESC
                    )
                , 0) LabaRugiFtpCPA
                , ISNULL(
                    (
                        SELECT TOP 1 LabaRugiFtpSetelahModal AS LabaRugiFtpRaroc
                        FROM Summary_SectorEconomyRaroc
                        WHERE SectorEconomyRaroc = (
                            SELECT SektorEkonomiRaroc FROM (
                                SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp
                                FROM Summary_CpaCustomer
                                WHERE Vcif = '" . $Vcif . "' AND SektorEkonomiRaroc > 0
                                GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC
                            ) a
                        )
                        AND month(Periode)=" . $d->format('m') . " AND YEAR(Periode) = " . $d->format('Y') . "
                        ORDER BY Periode DESC
                    )
                , 0) LabaRugiFtpRaroc
                , ISNULL(
                    ( 
                        SELECT ISNULL(SUM(AmountEL),0) EL
                        FROM SektorEkonomiRaroc
                        WHERE SektorEkonomiRarocId = (
                            SELECT SektorEkonomiRaroc FROM (
                                SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp
                                FROM Summary_CpaCustomer WHERE Vcif = '" . $Vcif . "' AND SektorEkonomiRaroc > 0
                                GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC
                            ) b
                        )
                    ) 		
                , 0) EL
        ) \"" . $d->format('m') . "\") \"" . $d->format('m') . "\",";
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getRarocGroupMonthly($GroupId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 6; $i--) {
            $sql .= "( SELECT CASE WHEN LabaRugiFtpRaroc = 0 THEN 0
			ELSE (LabaRugiFtpCPA/LabaRugiFtpRaroc)*EL END \"" . $d->format('m') . "\" FROM 
                ( SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) LabaRugiFtpCPA
                FROM Summary_CpaCustomer a
                WHERE Vcif IN(
                                    SELECT B.VCIF
                                    FROM CustomerGroup A, CustomerKorporasi B
                                    WHERE A.CustomerGroupId=B.CustomerGroupId
                                        AND A.CustomerGroupId= " . $GroupId . "
                                ) and month(Periode)=" . $d->format('m') . " AND YEAR(Periode) = " . $d->format('Y') . "
                    and periode = (select max(periode)
                    from Summary_CpaCustomer b
                    where b.Vcif=a.Vcif
                    AND month(b.Periode)=month(a.Periode) AND YEAR(b.Periode) = YEAR(b.Periode)
                ))  A,

                ( SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) LabaRugiFtpRaroc
                FROM Summary_SectorEconomyRaroc a
                WHERE SectorEconomyRaroc = (SELECT SektorEkonomiRaroc FROM (SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp FROM Summary_CpaCustomer WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=" . $GroupId . "
                ) AND SektorEkonomiRaroc > 0 GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC) a)
                AND month(Periode)=" . $d->format('m') . " AND YEAR(Periode) =" . $d->format('Y') . "
                and periode = (select max(periode)
                        from Summary_SectorEconomyRaroc b
                        where b.SectorEconomyRaroc=a.SectorEconomyRaroc
                        AND month(b.Periode)=month(a.Periode) AND YEAR(b.Periode) = YEAR(b.Periode)
                    ) ) B,

                ( SELECT ISNULL(SUM(AmountEL),0) EL
                FROM SektorEkonomiRaroc
                WHERE SektorEkonomiRarocId = (SELECT SektorEkonomiRaroc FROM (SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp FROM Summary_CpaCustomer WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                    AND A.CustomerGroupId= " . $GroupId . "
                ) AND SektorEkonomiRaroc > 0 GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC) b)
                ) C ) \"" . $d->format('m') . "\",";
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getLastRarocGroup($GroupId)
    {
        
    }

    public function updateData($table, $data, $IDField, $IDValue)
    {

        $this->db->where($IDField, $IDValue);
        $str = $this->db->update($table, $data);
        // echo "<br>".$this->db->last_query(); 
        // die();

        $error = $this->db->error();

        if ($error['code'] <> 0) {
            $result = array(
                'status' => 'error',
                'message' => $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function insertData($table, $data_input)
    {

        $str = $this->db->insert($table, $data_input);
        // echo $this->db->last_query(); //die();
        $error = $this->db->error();
        // print_r($error); die();
        if ($error['code'] <> 0) {
            $result = array(
                'status' => 'error',
                'message' => $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function insertAccountPlanningActivity($accountPlanningId, $activity, $message, $userId)
    {
        $sql = "INSERT INTO AccountPlanningActivity(AccountPlanningId, Activity, Message, CreatedBy, CreatedDate)
                VALUES(" . $accountPlanningId . ", '" . $activity . "', '" . $message . "', '" . $userId . "', SYSDATETIME())";

        $result = $this->db->query($sql);

        return $result;
    }

    public function getSelectedCompanyOption($AccountPlanningId)
    {
        $this->db->select('t1.VCIF, t1.IsMain, t2.Name');
        $this->db->from('AccountPlanningCustomer t1');
        $this->db->join('CustomerKorporasi t2', 't1.VCIF = t2.VCIF', 'left');
        $this->db->where('t1.AccountPlanningId', $AccountPlanningId);
        $this->db->order_by("t1.IsMain DESC, t2.Name ASC");
        $result = $this->db->get()->result();
        return $result;
    }

    public function getAccountPlanningStrategicPlan($AccountPlanningId, $VCIF, $StrategicPlanTypeId = NULL)
    {
        $whereClause = '';
        if ($StrategicPlanTypeId != NULL) {
            $whereClause .= " AND StrategicPlanTypeId =" . $StrategicPlanTypeId;
        }
        $sql = "SELECT t1.StrategicPlanTypeId, t2.Name AS StrategicPlanTypeName, t1.Name
                FROM StrategicPlan t1
                LEFT JOIN StrategicPlanType t2 ON t1.StrategicPlanTypeId = t2.StrategicPlanTypeId
                WHERE t1.AccountPlanningId = " . $AccountPlanningId . "
                AND t1.VCIF = '" . $VCIF . "' " . $whereClause . " ORDER BY t1.StrategicPlanTypeId";

        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function getListCheckerSigner($limit_per_page, $rowno, $searchTxt)
    {
        $filter = '';
        if (!empty($searchTxt)) {
            $filter .= " AND Name LIKE '%" . $searchTxt . "%'";
        }

        $sql = "SELECT UserId, Name, RoleId, UnitKerjaId
                FROM [User]
                WHERE RoleId in (7,8,9) " . $filter . "
                ORDER BY UserId  
                OFFSET " . $rowno . " ROWS FETCH NEXT " . $limit_per_page . " ROWS ONLY";
        // var_dump($sql);
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function getTotalListCheckerSigner($searchTxt)
    {
        $filter = '';
        if (!empty($searchTxt)) {
            $filter .= " AND Name LIKE '%" . $searchTxt . "%'";
        }

        $sql = "SELECT COUNT(1) total
                FROM [User]
                WHERE RoleId in (7,8,9) " . $filter;
        // var_dump($sql);

        $result = $this->db->query($sql)->row_array();
        return $result['total'];
    }
    public function addNotif($UserFrom, $UserTo, $Subject, $Title, $Message, $URL) {
        $newData = [
          'CreatedDate' => date('Y-m-d H:i:s'),
          'UserFrom' => $UserFrom,
          'UserTo' => $UserTo,
          'Subject' => $Subject,
          'Title' => $Title,
          'Message' => $Message,
          'URL' => $URL
        ];
        // echo json_encode($newData);
        $updateData = $this->db->insert('Notification', $newData);
    }
    
    public function insertCheckerSignerPerRM($Table, $data) {

        $str = $this->db->insert($Table, $data);

        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }
        return $result;
    }

}
