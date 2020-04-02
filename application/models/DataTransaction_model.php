<?php

class DataTransaction_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
        $this->last_year = $today->format('Y')-1;
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    public function getPinjamanLastUpdateDate(){
        $result = array();
        $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
            FROM Summary_PinjamanDailyCif
            ";

        $query = $this->db->query($sql)->row_array();
        $result['total'] = $query['LastUpdateDate'];

        $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
            FROM Summary_PinjamanMonthlyCif
            ";

        $query = $this->db->query($sql)->row_array();
        $result['ratas'] = $query['LastUpdateDate'];

        return $result;
    }

    public function getSimpananLastUpdateDate(){
        $result = array();

        $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
            FROM Summary_SimpananDailyCif";
        $query = $this->db->query($sql)->row_array();
        $result['total'] = $query['LastUpdateDate'];
        
        $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
            FROM Summary_SimpananMonthlyCif";
        $query = $this->db->query($sql)->row_array();
        $result['ratas'] = $query['LastUpdateDate'];

        return $result;
    }

    public function getCpaLastUpdateDate(){
        $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
            FROM Summary_CpaCif";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataSimpananAllGroup($periode){
        $sql = "
        SELECT *FROM 
            (
                SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananDailyCustomer
                WHERE month(Periode)='".$periode['month']."' AND year(Periode)='".$periode['year']."'
            ) A,
            (
                SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
                FROM Summary_SimpananMonthlyCustomer
                WHERE month(Periode)='".$periode['month']."' AND year(Periode)='".$periode['year']."'
            ) B";

        // echo $sql."\n";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getActiveCustomerKorporasi() {
        $sql = 'SELECT VCIF FROM CustomerKorporasi WHERE IsActive=1';
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function getDataSimpananPerCustomer($VCIF=''){
        $sql = "
            SELECT CustomerLogo, CustomerName, GiroDaily, DepoDaily, GiroMonthly, DepoMonthly, EndOfLastYearSaldo, LastYearSaldo, CurrentSaldo
                , case when (EndOfLastYearSaldo) = 0 Then 0
                else (((CurrentSaldo-EndOfLastYearSaldo)/EndOfLastYearSaldo)*100) 
                END as YOD
                , case when (LastYearSaldo) = 0 Then 0
                else (((CurrentSaldo-LastYearSaldo)/LastYearSaldo)*100) 
                END as YOY
            FROM 
        ";

        $sql .= " 
            (
                SELECT Logo CustomerLogo 
                FROM CustomerGroup 
                WHERE CustomerGroupId = (SELECT CustomerGroupId FROM CustomerKorporasi WHERE VCIF = '".$VCIF."')
            ) CustomerLogo
            , (
                SELECT Name CustomerName 
                FROM CustomerKorporasi 
                WHERE VCIF = '".$VCIF."'
            ) CustomerName
            , (
                SELECT ISNULL(SUM(Saldo),0) GiroDaily 
                FROM Summary_SimpananMonthlyCustomer 
                WHERE Vcif = '".$VCIF."' AND Desc1 = 'GIRO'
            ) GiroDaily
            , (
                SELECT ISNULL(SUM(Saldo),0) DepoDaily 
                FROM Summary_SimpananMonthlyCustomer 
                WHERE Vcif = '".$VCIF."' AND Desc1 = 'DEPOSITO'
            ) DepoDaily
            , (
                SELECT ISNULL(AVG(AverageSaldo),0) GiroMonthly 
                FROM Summary_SimpananMonthlyCustomer 
                WHERE Vcif = '".$VCIF."' AND Desc1 = 'GIRO'
            ) GiroMonthly
            , (
                SELECT ISNULL(AVG(AverageSaldo),0) DepoMonthly 
                FROM Summary_SimpananMonthlyCustomer 
                WHERE Vcif = '".$VCIF."' AND Desc1 = 'DEPOSITO'
            ) DepoMonthly
            , (
                SELECT ISNULL(SUM(Saldo),0) EndOfLastYearSaldo
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif = '".$VCIF."' AND month(Periode)='12' AND year(Periode)='".date('Y', strtotime('-12 month'))."'
                -- WHERE Vcif = '".$VCIF."' AND month(Periode)='01' AND year(Periode)='2018'
            ) EndOfLastYearSaldo
            , (
                SELECT ISNULL(SUM(Saldo),0) LastYearSaldo
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif = '".$VCIF."' AND month(Periode)='".date('m')."' AND year(Periode)='".date('Y', strtotime('-12 month'))."'
                -- WHERE Vcif = '".$VCIF."' AND month(Periode)='03' AND year(Periode)='2018'
            ) LastYearSaldo
            , (
                SELECT ISNULL(SUM(Saldo),0) CurrentSaldo
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif = '".$VCIF."' AND month(Periode)='".date('m')."' AND year(Periode)='".date('Y')."'
                -- WHERE Vcif = '".$VCIF."' AND month(Periode)='09' AND year(Periode)='2018'
            ) CurrentSaldo
       ";

        $sql = substr($sql, 0, -1); 
        // echo $sql."<br>"; 
        // die();

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataSimpananAllGroups($max_periode){
        $sql = "
            SELECT *FROM 
        ";

        for ($i=$max_periode; $i > 0; $i--) {
            $sql .= " 
            (
                SELECT ISNULL(SUM(Saldo),0) TotalSimpanan".$i."
                FROM Summary_SimpananDailyCustomer
                WHERE month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) TotalSimpanan".$i.",
            (
                SELECT ISNULL(SUM(Saldo),0) DepoSimpanan".$i."
                FROM Summary_SimpananDailyCustomer
                WHERE Desc1 = 'DEPOSITO' AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) DepoSimpanan".$i.",
            (
                SELECT ISNULL(SUM(Saldo),0) GiroSimpanan".$i."
                FROM Summary_SimpananDailyCustomer
                WHERE Desc1 = 'GIRO' AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) GiroSimpanan".$i.",
            (
                SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan".$i."
                FROM Summary_SimpananMonthlyCustomer
                WHERE month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) RatasSimpanan".$i.",
            (
                SELECT ISNULL(AVG(AverageSaldo),0) DepoRatasSimpanan".$i."
                FROM Summary_SimpananMonthlyCustomer
                WHERE Desc1 = 'DEPOSITO' AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) DepoRatasSimpanan".$i.",
            (
                SELECT ISNULL(AVG(AverageSaldo),0) GiroRatasSimpanan".$i."
                FROM Summary_SimpananMonthlyCustomer
                WHERE Desc1 = 'GIRO' AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) GiroRatasSimpanan".$i.",";
        }

        $sql = substr($sql, 0, -1); 
        // echo $sql."\n";

        $result = $this->db->query($sql);

        return $result->result_array();
    }

    public function getDataCpaAllGroups($max_periode){
        $sql = "
            SELECT *FROM 
        ";
        for ($i=$max_periode; $i > 0; $i--) {
        $sql .= "
            (
                SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa".$i."
                FROM Summary_CpaCustomer
                WHERE month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) Cpa".$i.",";
        }
        $sql = substr($sql, 0, -1); 
        // echo $sql."\n";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataPinjamanAllGroups($max_periode){
        $sql = "
            SELECT *FROM 
        ";

        for ($i=$max_periode; $i > 0; $i--) {
        $sql .= "
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman".$i."
                FROM Summary_PinjamanDailyCustomer
                WHERE month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) TotalPinjaman".$i.",
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalKIPinjaman".$i."
                FROM Summary_PinjamanDailyCustomer
                WHERE JenisPenggunaan=1 AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) TotalKIPinjaman".$i.",
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalKMKPinjaman".$i."
                FROM Summary_PinjamanDailyCustomer
                WHERE JenisPenggunaan=2 AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) TotalKMKPinjaman".$i.",
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman".$i."
                FROM Summary_PinjamanMonthlyCustomer
                WHERE month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) RatasPinjaman".$i.",
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjamanKI".$i."
                FROM Summary_PinjamanMonthlyCustomer
                WHERE JenisPenggunaan=1 AND month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) RatasPinjamanKI".$i.",
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjamanKMK".$i."
                FROM Summary_PinjamanMonthlyCustomer
                WHERE JenisPenggunaan=2 AND  month(Periode)='".date('m', strtotime('-'.$i.' month'))."' AND year(Periode)='".date('Y', strtotime('-'.$i.' month'))."'
            ) RatasPinjamanKMK".$i.",";
        }
        $sql = substr($sql, 0, -1); 
        // echo $sql."\n";

        $result = $this->db->query($sql);

        return $result->result_array();
    }

    public function getDataPinjamanAllGroup($periode){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer
                WHERE month(Periode)='".trim($periode['month'])."' AND year(Periode)='".trim($periode['year'])."'
            ) A,
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjamanKI
                FROM Summary_PinjamanMonthlyCustomer
                WHERE JenisPenggunaan=1 AND month(Periode)='".trim($periode['month'])."' AND year(Periode)='".trim($periode['year'])."'
            ) B,
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjamanKMK
                FROM Summary_PinjamanMonthlyCustomer
                WHERE JenisPenggunaan=2 AND  month(Periode)='".trim($periode['month'])."' AND year(Periode)='".trim($periode['year'])."'
            ) C";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataCpaAllGroup($periode){
        $sql = "
            SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
            FROM Summary_CpaCustomer
            WHERE   month(Periode)='".trim($periode['month'])."' AND year(Periode)='".trim($periode['year'])."'
            ";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataPinjamanAllGroup(){
        $sql = "
            SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer
                WHERE Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
            ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataSimpananAllGroup(){
        $sql = "
            SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananDailyCustomer
                WHERE Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
            ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataPinjamanAllGroupByPeriode($param){
        $sql = "
            SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE month(Periode)='".$param['month']."' AND year(Periode)='".$param['year']."'
            ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataSimpananAllGroupByPeriode($param){
        $sql = "
            SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananMonthlyCustomer
                WHERE month(Periode)='".$param['month']."' AND year(Periode)='".$param['year']."'
            ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastUpdateDateCpaAllGroup(){
        $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
            FROM Summary_CpaCustomer";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataCpaAllGroup(){
        $sql = "SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
            FROM Summary_CpaCustomer
            WHERE Periode = (SELECT MAX(Periode) FROM Summary_CpaCustomer)";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataPinjamanGroup($groupId){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=".$groupId."
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=".$groupId."
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataSimpananGroup($groupId){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=".$groupId."
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=".$groupId."
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getRarocPerVCIF($VCIF){
        $result = array();
        $sql = "
        SELECT 
            CASE WHEN (AmountRaroc) = 0 Then 0
            ELSE ((CpaCustomer/AmountRaroc)*AmountEL) 
            END AS Raroc
            FROM 
            (
                SELECT ISNULL(LabaRugiFtpSetelahModal,0) CpaCustomer
                    FROM Summary_CpaCustomer
                    WHERE Vcif = '".$VCIF."'
                    AND Periode = (
                        SELECT MAX(Periode) FROM Summary_SectorEconomyRaroc WHERE SectorEconomyRaroc = (
                            SELECT SektorEkonomiRaroc FROM (
                                SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp
                                FROM Summary_CpaCustomer
                                WHERE Vcif = '".$VCIF."' AND SektorEkonomiRaroc > 0
                                GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC
                            ) a
                        )
                    )
            ) CpaCustomer
            , 
            (
            SELECT ISNULL(LabaRugiFtpSetelahModal,0) AmountRaroc
                FROM Summary_SectorEconomyRaroc
                WHERE SectorEconomyRaroc = (
                    SELECT TOP 1 B.SektorEkonomiRaroc FROM Summary_CpaCustomer B WHERE B.Vcif = '".$VCIF."' AND SektorEkonomiRaroc!=''
                )
                AND Periode = (
                    SELECT MAX(Periode) FROM Summary_SectorEconomyRaroc WHERE SectorEconomyRaroc = (
                        SELECT SektorEkonomiRaroc FROM (
                            SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp
                            FROM Summary_CpaCustomer
                            WHERE Vcif = '".$VCIF."' AND SektorEkonomiRaroc > 0
                            GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC
                        ) a
                    )
                )
            ) AmountRaroc
            , 
            (
            SELECT ISNULL(AmountEL,0) AmountEL
                FROM SektorEkonomiRaroc
                WHERE SektorEkonomiRarocId = (
                    SELECT TOP 1 B.SektorEkonomiRaroc FROM Summary_CpaCustomer B WHERE B.Vcif = '".$VCIF."' AND SektorEkonomiRaroc!=''
                )
                AND IsActive=1
            ) AmountEL
            ";
// echo $sql; die();

        $query = $this->db->query($sql)->row_array();
        $result = $query['Raroc'];

        return $result;
    }

    public function getRarocPerGroup($CustomerGroupId){
        $result = array();
        $sql = "
        SELECT 
            CASE WHEN (AmountRaroc) = 0 Then 0
            ELSE ((CpaCustomer/AmountRaroc)*AmountEL) 
            END AS Raroc
            FROM 
            (
                SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) CpaCustomer
                    FROM Summary_CpaCustomer
                    WHERE Vcif IN (
                        SELECT B.VCIF
                        FROM CustomerGroup A, CustomerKorporasi B
                        WHERE A.CustomerGroupId=B.CustomerGroupId
                            AND A.CustomerGroupId=".$CustomerGroupId."
                    )
                    AND Periode = (
                        SELECT MAX(Periode) FROM Summary_SectorEconomyRaroc WHERE SectorEconomyRaroc = (
                            SELECT SektorEkonomiRaroc FROM (
                                SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp
                                FROM Summary_CpaCustomer
                                WHERE Vcif IN (
                                    SELECT B.VCIF
                                    FROM CustomerGroup A, CustomerKorporasi B
                                    WHERE A.CustomerGroupId=B.CustomerGroupId
                                        AND A.CustomerGroupId=".$CustomerGroupId."
                                ) 
                                    AND SektorEkonomiRaroc > 0
                                GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC
                            ) a
                        )
                    )
            ) CpaCustomer
            , 
            (
                SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) AmountRaroc
                    FROM Summary_SectorEconomyRaroc
                    WHERE SectorEconomyRaroc = (
                        SELECT TOP 1 B.SektorEkonomiRaroc FROM Summary_CpaCustomer B 
                            WHERE Vcif IN (
                                SELECT B.VCIF
                                FROM CustomerGroup A, CustomerKorporasi B
                                WHERE A.CustomerGroupId=B.CustomerGroupId
                                    AND A.CustomerGroupId=".$CustomerGroupId."
                            ) AND SektorEkonomiRaroc!=''
                    )
                    AND Periode = (
                        SELECT MAX(Periode) FROM Summary_SectorEconomyRaroc WHERE SectorEconomyRaroc = (
                            SELECT SektorEkonomiRaroc FROM (
                                SELECT TOP 1 SektorEkonomiRaroc, SUM(LabaRugiFtpSetelahModal) AS LabaRugiFtp
                                FROM Summary_CpaCustomer
                                WHERE Vcif IN (
                                    SELECT B.VCIF
                                    FROM CustomerGroup A, CustomerKorporasi B
                                    WHERE A.CustomerGroupId=B.CustomerGroupId
                                        AND A.CustomerGroupId=".$CustomerGroupId."
                                ) 
                                    AND SektorEkonomiRaroc > 0
                                GROUP BY SektorEkonomiRaroc ORDER BY LabaRugiFtp DESC
                            ) a
                        )
                    )
           ) AmountRaroc
            , 
            (
                SELECT ISNULL(AmountEL,0) AmountEL
                    FROM SektorEkonomiRaroc
                    WHERE SektorEkonomiRarocId = (
                        SELECT TOP 1 B.SektorEkonomiRaroc FROM Summary_CpaCustomer B 
                            WHERE Vcif IN (
                                SELECT B.VCIF
                                FROM CustomerGroup A, CustomerKorporasi B
                                WHERE A.CustomerGroupId=B.CustomerGroupId
                                    AND A.CustomerGroupId=".$CustomerGroupId."
                            ) AND SektorEkonomiRaroc!=''
                    )
                    AND IsActive=1
            ) AmountEL
            ";

        $query = $this->db->query($sql)->row_array();
        $result = $query['Raroc'];

        return $result;
    }

    public function getLastDataCpaGroup($groupId){
        $sql = "SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
            FROM Summary_CpaCustomer
            WHERE Vcif IN (
                SELECT B.VCIF
                FROM CustomerGroup A, CustomerKorporasi B
                WHERE A.CustomerGroupId=B.CustomerGroupId
                    AND A.CustomerGroupId=".$groupId."
            )
                AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCustomer)";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataPinjamanPerRM($userId){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='".$userId."'
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='".$userId."'
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataSimpananPerRM($userId){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='".$userId."'
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT VCIF
                    FROM AccountPlanningCustomer
                    WHERE CreatedBy='".$userId."'
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataCpaPerRM($userId){
        $sql = "SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
            FROM Summary_CpaCustomer
            WHERE Vcif IN(
                SELECT VCIF
                FROM AccountPlanningCustomer
                WHERE CreatedBy='".$userId."'
            )
                AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCustomer)";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataPinjamanVcif($Vcif){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer
                WHERE Vcif = '".$Vcif."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif = '".$Vcif."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataSimpananVcif($Vcif){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif = '".$Vcif."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif = '".$Vcif."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getDataSimpananPerVcif($Vcif){
        $sql = "
        SELECT A.CIF, ISNULL(A.Saldo,0) TotalSimpanan
        , ISNULL(B.AverageSaldo) RatasSimpanan
            FROM Summary_SimpananDailyCif A, Summary_SimpananMonthlyCif B
            WHERE A.Cif IN(
                SELECT C.CIF
                    FROM DetailCustomerKorporasi C
                    WHERE C.VCIF='".$Vcif."'
            ) AND B.CIF IN(
                SELECT C.CIF
                    FROM DetailCustomerKorporasi C
                    WHERE C.VCIF='".$Vcif."'
            )
        ";

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getLastDataCpaVcif($Vcif){
        $sql = "SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
            FROM Summary_CpaCustomer
            WHERE Vcif = '".$Vcif."'
                AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCustomer)";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataSimpananAccountPlanning($accountPlanningId){
    	$sql = "
    		SELECT *FROM 
			(
			    SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
			    FROM Summary_SimpananDailyCustomer A, AccountPlanningCustomer B
			    WHERE A.Vcif = B.VCIF
			        AND B.AccountPlanningId=".$accountPlanningId."
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
			) A,
			(
			    SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
			    FROM Summary_SimpananMonthlyCustomer A, AccountPlanningCustomer B
			    WHERE A.Vcif = B.VCIF
			        AND B.AccountPlanningId=".$accountPlanningId."
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
			) B
    	";
    	$result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataPinjamanAccountPlanning($accountPlanningId){
        $sql = "SELECT *FROM 
            (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer A, AccountPlanningCustomer B
                WHERE A.Vcif = B.VCIF
                    AND B.AccountPlanningId=".$accountPlanningId."
                     AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
            ) A,
            (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman
                FROM Summary_PinjamanMonthlyCustomer A, AccountPlanningCustomer B
                WHERE A.Vcif = B.VCIF
                    AND B.AccountPlanningId=".$accountPlanningId."
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer)
            ) B";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getLastDataCpaAccountPlanning($accountPlanningId){
        $sql = "SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
            FROM Summary_CpaCustomer A, AccountPlanningCustomer B
            WHERE A.Vcif = B.VCIF
                AND B.AccountPlanningId=".$accountPlanningId."
                AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCustomer)";
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getCpaExisting($accountPlanningId){
        $sql = "SELECT SUM(BebanFtp) BebanFtp, SUM(Provisi) Provisi, SUM(PlafonEfektif) PlafonEfektif, 
                SUM(PlafonAwal) PlafonAwal, SUM(KelonggaranTarik) KelonggaranTarik, SUM(BakiDebetOriginal) BakiDebetOriginal, 
                SUM(BakiDebet) BakiDebet, SUM(BakiDebetRatas) BakiDebetRatas, SUM(Ppap) Ppap,
                SUM(BiayaPpapAkumulasi) BiayaPpapAkumulasi, SUM(PpapRatas) PpapRatas, SUM(NilaiTercatat) NilaiTercatat, 
                SUM(NilaiTercatatRatas) NilaiTercatatRatas, SUM(Ckpn) Ckpn, SUM(PendapatanBunga) PendapatanBunga,
                SUM(PendapatanBungaAkumulasi) PendapatanBungaAkumulasi, SUM(JumlahRekKredit) JumlahRekKredit, 
                SUM(NominalFeeKredit) NominalFeeKredit, SUM(NominalTrxKredit) NominalTrxKredit, SUM(TotalTrx) TotalTrx, 
                SUM(AkumulasiNominalTrx) AkumulasiNominalTrx, SUM(AkumulasiNominalFee) AkumulasiNominalFee, 
                SUM(AkumulasiJumlahTrx) AkumulasiJumlahTrx, SUM(AkumulasiJumlahTrxKredit) AkumulasiJumlahTrxKredit, 
                SUM(ProvisiAkumulasiKredit) ProvisiAkumulasiKredit, SUM(SaldoSimpanan) SaldoSimpanan, 
                SUM(AverageSaldoSimpanan) AverageSaldoSimpanan, SUM(JumlahRekSimpanan) JumlahRekSimpanan, 
                SUM(NominalFeeSimpanan) NominalFeeSimpanan, SUM(NominatTrxSimpanan) NominatTrxSimpanan, 
                SUM(TotalTrxSimpanan) TotalTrxSimpanan, SUM(AkumulasiNominalTrxSimpanan) AkumulasiNominalTrxSimpanan, 
                SUM(AkumulasiNominalFeeSimpanan) AkumulasiNominalFeeSimpanan, SUM(AkumulasiJumlahTrxSimpanan) AkumulasiJumlahTrxSimpanan,
                SUM(BebanFtpAkumulasi) BebanFtpAkumulasi, SUM(BebanBunga) BebanBunga, SUM(BebanBungaAkumulasi) BebanBungaAkumulasi, 
                SUM(PendapatanFtp) PendapatanFtp, SUM(PendapatanFtpAkumulasi) PendapatanFtpAkumulasi, SUM(AmountIdrTf) AmountIdrTf, 
                SUM(NominalFeeTf) NominalFeeTf, SUM(NominalTrxTf) NominalTrxTf, SUM(TotalTrxTf) TotalTrxTf,
                SUM(AkumulasiNominalTrxTf) AkumulasiNominalTrxTf, SUM(AkumulasiNominalFeeTf) AkumulasiNominalFeeTf, 
                SUM(AkumulasiJumlahTrxTf) AkumulasiJumlahTrxTf, SUM(JumlahTf) JumlahTf, SUM(Nilai) Nilai, SUM(NilaiFtp) NilaiFtp, 
                SUM(FeeBased) FeeBased, SUM(TotalBiayaOperasional) TotalBiayaOperasional, SUM(BiayaPpap) BiayaPpap,
                SUM(BiayaModal) BiayaModal, SUM(LabaRugiSebelumModal) LabaRugiSebelumModal, 
                SUM(LabaRugiSetelahModal) LabaRugiSetelahModal, SUM(LabaRugiFtpSeblumModal) LabaRugiFtpSeblumModal,
                SUM(LabaRugiFtpSetelahModal) LabaRugiFtpSetelahModal
            FROM Summary_CpaCif
            WHERE Cif IN(
                SELECT B.CIF
                    FROM AccountPlanningCustomer A, DetailCustomerKorporasi B
                    WHERE A.VCIF=B.VCIF 
                        AND AccountPlanningId=".$accountPlanningId."
            )
                AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCif) 
        ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getCpaExistingPerVCIF($VCIF){
        $sql = "SELECT SUM(BebanFtp) BebanFtp, SUM(Provisi) Provisi, SUM(PlafonEfektif) PlafonEfektif, 
                SUM(PlafonAwal) PlafonAwal, SUM(KelonggaranTarik) KelonggaranTarik, SUM(BakiDebetOriginal) BakiDebetOriginal, 
                SUM(BakiDebet) BakiDebet, SUM(BakiDebetRatas) BakiDebetRatas, SUM(Ppap) Ppap,
                SUM(BiayaPpapAkumulasi) BiayaPpapAkumulasi, SUM(PpapRatas) PpapRatas, SUM(NilaiTercatat) NilaiTercatat, 
                SUM(NilaiTercatatRatas) NilaiTercatatRatas, SUM(Ckpn) Ckpn, SUM(PendapatanBunga) PendapatanBunga,
                SUM(PendapatanBungaAkumulasi) PendapatanBungaAkumulasi, SUM(JumlahRekKredit) JumlahRekKredit, 
                SUM(NominalFeeKredit) NominalFeeKredit, SUM(NominalTrxKredit) NominalTrxKredit, SUM(TotalTrx) TotalTrx, 
                SUM(AkumulasiNominalTrx) AkumulasiNominalTrx, SUM(AkumulasiNominalFee) AkumulasiNominalFee, 
                SUM(AkumulasiJumlahTrx) AkumulasiJumlahTrx, SUM(AkumulasiJumlahTrxKredit) AkumulasiJumlahTrxKredit, 
                SUM(ProvisiAkumulasiKredit) ProvisiAkumulasiKredit, SUM(SaldoSimpanan) SaldoSimpanan, 
                SUM(AverageSaldoSimpanan) AverageSaldoSimpanan, SUM(JumlahRekSimpanan) JumlahRekSimpanan, 
                SUM(NominalFeeSimpanan) NominalFeeSimpanan, SUM(NominatTrxSimpanan) NominatTrxSimpanan, 
                SUM(TotalTrxSimpanan) TotalTrxSimpanan, SUM(AkumulasiNominalTrxSimpanan) AkumulasiNominalTrxSimpanan, 
                SUM(AkumulasiNominalFeeSimpanan) AkumulasiNominalFeeSimpanan, SUM(AkumulasiJumlahTrxSimpanan) AkumulasiJumlahTrxSimpanan,
                SUM(BebanFtpAkumulasi) BebanFtpAkumulasi, SUM(BebanBunga) BebanBunga, SUM(BebanBungaAkumulasi) BebanBungaAkumulasi, 
                SUM(PendapatanFtp) PendapatanFtp, SUM(PendapatanFtpAkumulasi) PendapatanFtpAkumulasi, SUM(AmountIdrTf) AmountIdrTf, 
                SUM(NominalFeeTf) NominalFeeTf, SUM(NominalTrxTf) NominalTrxTf, SUM(TotalTrxTf) TotalTrxTf,
                SUM(AkumulasiNominalTrxTf) AkumulasiNominalTrxTf, SUM(AkumulasiNominalFeeTf) AkumulasiNominalFeeTf, 
                SUM(AkumulasiJumlahTrxTf) AkumulasiJumlahTrxTf, SUM(JumlahTf) JumlahTf, SUM(Nilai) Nilai, SUM(NilaiFtp) NilaiFtp, 
                SUM(FeeBased) FeeBased, SUM(TotalBiayaOperasional) TotalBiayaOperasional, SUM(BiayaPpap) BiayaPpap,
                SUM(BiayaModal) BiayaModal, SUM(LabaRugiSebelumModal) LabaRugiSebelumModal, 
                SUM(LabaRugiSetelahModal) LabaRugiSetelahModal, SUM(LabaRugiFtpSeblumModal) LabaRugiFtpSeblumModal,
                SUM(LabaRugiFtpSetelahModal) LabaRugiFtpSetelahModal
            FROM Summary_CpaCif
            WHERE Cif IN(
                SELECT CIF FROM DetailCustomerKorporasi
                WHERE VCIF='".$VCIF."'
            )
                AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCif) 
        ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    function countDetailSimpananVcif($vcif){
        $sql = "SELECT count(A.CifSimpanan) NumRows
                FROM FACT_SimpananDaily A 
                LEFT JOIN FACT_SimpananMonthly B ON A.CifSimpanan=B.CifSimpanan AND A.NoRekeningSimpanan=B.NoRekeningSimpanan
                WHERE A.CifSimpanan IN(
                    SELECT CIF FROM DetailCustomerKorporasi
                    WHERE VCIF='".$vcif."'
                )
                AND A.Periode = (SELECT MAX(Periode) FROM FACT_SimpananDaily)
                AND B.Periode = (SELECT MAX(Periode) FROM FACT_SimpananMonthly)
        ";
        // echo $sql;
        $result = $this->db->query($sql);
        $error = $this->db->error();
        // var_dump($result); die();

        if ($result != false) {
            return $result->row_array();
        }
    }

    function getDetailSimpananVcif($vcif){
        $sql = "SELECT A.CifSimpanan Cif, A.NoRekeningSimpanan NoRek, A.Saldo TotalSimpanan, B.AverageSaldo RatasSimpanan
                FROM FACT_SimpananDaily A 
                LEFT JOIN FACT_SimpananMonthly B ON A.CifSimpanan=B.CifSimpanan AND A.NoRekeningSimpanan=B.NoRekeningSimpanan
                WHERE A.CifSimpanan IN(
                    SELECT CIF FROM DetailCustomerKorporasi
                    WHERE VCIF='".$vcif."'
                )
                AND A.Periode = (SELECT MAX(Periode) FROM FACT_SimpananDaily)
                AND B.Periode = (SELECT MAX(Periode) FROM FACT_SimpananMonthly)
        ";
        // echo $sql;
        $result = $this->db->query($sql);
        $error = $this->db->error();
        // var_dump($result); die();

        if ($result != false) {
            return $result->result_array();
        }
    }

    function getDetailPinjamanVcif($vcif){
        $sql = "SELECT A.CifKredit Cif, A.NoRekeningPinjaman NoRek, A.NilaiTercatat TotalPinjaman, B.NilaiTercatatRatas RatasPinjaman
                FROM FACT_KreditDaily A 
                LEFT JOIN FACT_KreditMonthly B ON A.CifKredit=B.CifKredit AND A.NoRekeningPinjaman=B.NoRekeningPinjaman
                WHERE A.CifKredit IN(
                    SELECT CIF FROM DetailCustomerKorporasi
                    WHERE VCIF='".$vcif."'
                )
                AND A.Periode = (SELECT MAX(Periode) FROM FACT_KreditDaily)
                AND B.Periode = (SELECT MAX(Periode) FROM FACT_KreditMonthly)
        ";
        // echo $sql;
        $result = $this->db->query($sql);
        $error = $this->db->error();
        // var_dump($result); die();

        if ($result != false) {
            return $result->result_array();
        }
    }


}

?>