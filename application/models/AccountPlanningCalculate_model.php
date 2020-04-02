<?php

class AccountPlanningCalculate_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
        $this->last_year = $today->format('Y')-1;
        $this->last2_year = $today->format('Y')-2;
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    public function getGroupIsMain($CustomerGroupId) {
        $sql = "
            SELECT A.AccountPlanningId, A.VCIF, B.[Year]
            FROM AccountPlanningCustomer A
            LEFT JOIN AccountPlanning B ON A.AccountPlanningId=B.AccountPlanningId
            WHERE A.VCIF = (
                SELECT c.VCIF FROM CustomerKorporasi c WHERE c.IsMain=1 AND c.CustomerGroupId=".$CustomerGroupId."
                )
            AND B.[Year]='".$this->current_year."'
        ";

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getGroupFHCalcDetails($AccountPlanningId){
        $sql = "
            SELECT
                CASE WHEN (
                        CASE WHEN (SalesMin2) = 0 Then 0
                        ELSE ((SalesMin2-COGSMin2)/SalesMin2) 
                        END
                    ) = 0 Then 0
                    ELSE (
                        (
                            CASE WHEN (SalesMin1) = 0 Then 0
                                ELSE ((SalesMin1-COGSMin1)/SalesMin1) 
                                END         
                        )/(
                            CASE WHEN (SalesMin2) = 0 Then 0
                                ELSE ((SalesMin2-COGSMin2)/SalesMin2) 
                                END         
                        )
                    ) 
                    END GMI
                , CASE WHEN (
                        CASE WHEN (SalesMin1) = 0 Then 0
                            ELSE ((SalesMin1-COGSMin1)/SalesMin1) 
                            END         
                    ) = 0 Then 0
                    ELSE (
                        (
                            CASE WHEN (SalesMin2) = 0 Then 0
                                ELSE ((SalesMin2-COGSMin2)/SalesMin2) 
                                END         
                        )/(
                            CASE WHEN (SalesMin1) = 0 Then 0
                                ELSE ((SalesMin1-COGSMin1)/SalesMin1) 
                                END         
                        )
                    ) 
                    END DSRI
                    , CASE WHEN SalesMin1 = 0 Then 0
                    ELSE (SalesMin2/SalesMin1) 
                    END SGI
                    , CASE WHEN (
                        CASE WHEN (SalesMin1) = 0 Then 0
                            ELSE ((SGAMin1)/SalesMin1) 
                            END         
                    ) = 0 Then 0
                    ELSE (
                        (
                            CASE WHEN (SalesMin2) = 0 Then 0
                                ELSE ((SGAMin2)/SalesMin2) 
                                END         
                        )/(
                            CASE WHEN (SalesMin1) = 0 Then 0
                                ELSE ((SGAMin1)/SalesMin1) 
                                END         
                        )
                    ) 
                    END SGAI
                    , CASE WHEN (
                        CASE WHEN (TotalAsetMin1) = 0 Then 0
                            ELSE ((TotalAsetMin1-PPEMin1-CurrentAsetMin1)/TotalAsetMin1) 
                            END         
                    ) = 0 Then 0
                    ELSE (
                        (
                            CASE WHEN (TotalAsetMin2) = 0 Then 0
                                ELSE ((TotalAsetMin2-PPEMin2-CurrentAsetMin2)/TotalAsetMin2) 
                                END         
                        )/(
                            CASE WHEN (TotalAsetMin1) = 0 Then 0
                                ELSE ((TotalAsetMin1-PPEMin1-CurrentAsetMin1)/TotalAsetMin1) 
                                END         
                        )
                    ) 
                    END AQI
                    , CASE WHEN (
                        CASE WHEN (DepreciationMin2+PPEMin2) = 0 Then 0
                            ELSE (DepreciationMin2/(DepreciationMin2+PPEMin2)) 
                            END         
                    ) = 0 Then 0
                    ELSE (
                        (
                            CASE WHEN (DepreciationMin1+PPEMin1) = 0 Then 0
                                ELSE (DepreciationMin1/(DepreciationMin1+PPEMin1)) 
                                END         
                        )/(
                            CASE WHEN (DepreciationMin2+PPEMin2) = 0 Then 0
                                ELSE (DepreciationMin2/(DepreciationMin2+PPEMin2)) 
                                END         
                        )
                    ) 
                    END DEPI
                    , CASE WHEN (
                        CASE WHEN (TotalAsetMin1) = 0 Then 0
                            ELSE ((LongTermMin1+ShortTermMin1)/TotalAsetMin1) 
                            END         
                    ) = 0 Then 0
                    ELSE (
                        (
                            CASE WHEN (TotalAsetMin2) = 0 Then 0
                                ELSE ((LongTermMin2+ShortTermMin2)/TotalAsetMin2) 
                                END         
                        )/(
                            CASE WHEN (TotalAsetMin1) = 0 Then 0
                                ELSE ((LongTermMin1+ShortTermMin1)/TotalAsetMin1) 
                                END         
                        )
                    ) 
                    END LIVIGI
                    , CASE WHEN (TotalAsetMin2) = 0 Then 0
                    ELSE ((NetProvitMin2-CashFlowMin2)/TotalAsetMin2)                     
                    END TATA
                FROM (
                    SELECT
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=7
                                    AND [Year]=".$this->last_year."             
                            ), 0
                        ) SalesMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=7
                                    AND [Year]=".$this->last2_year."         
                            ), 0
                        ) SalesMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=8
                                    AND [Year]=".$this->last_year."         
                            ), 0
                        ) COGSMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=8
                                    AND [Year]=".$this->last2_year."     
                            ), 0
                        ) COGSMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=29
                                    AND [Year]=".$this->last_year."    
                            ), 0
                        ) SGAMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=29
                                    AND [Year]=".$this->last2_year."    
                            ), 0
                        ) SGAMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=3
                                    AND [Year]=".$this->last_year."
                            ), 0
                        ) TotalAsetMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=3
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) TotalAsetMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=26
                                    AND [Year]=".$this->last_year."
                            ), 0
                        ) PPEMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=26
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) PPEMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=1
                                    AND [Year]=".$this->last_year."
                            ), 0
                        ) CurrentAsetMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=1
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) CurrentAsetMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=28
                                    AND [Year]=".$this->last_year."
                            ), 0
                        ) DepreciationMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=28
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) DepreciationMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=5
                                    AND [Year]=".$this->last_year."
                            ), 0
                        ) LongTermMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=5
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) LongTermMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=4
                                    AND [Year]=".$this->last_year."
                            ), 0
                        ) ShortTermMin1
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=4
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) ShortTermMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=11
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) NetProvitMin2
                        ,
                        ISNULL(
                            (
                                SELECT Amount FROM FinancialHighlight
                                WHERE AccountPlanningId=".$AccountPlanningId."
                                    AND FinancialHighlightItemId=27
                                    AND [Year]=".$this->last2_year."
                            ), 0
                        ) CashFlowMin2
                ) x    
        ";

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function countAccountPlanningPublishByClassification(){
        $sql = '
            SELECT 
            CASE WHEN (TotalPlatinum) = 0 Then 0
            ELSE ((PublishPlatinum/TotalPlatinum)*100) 
            END AS ProgressPlatinum
            , CASE WHEN (TotalGold) = 0 Then 0
            ELSE ((PublishGold/TotalGold)*100) 
            END AS ProgressGold
            FROM (
                SELECT
                    ISNULL(
                        (
                            SELECT COUNT(1) Total FROM(
                                SELECT A.AccountPlanningId
                                FROM AccountPlanning A
                                    , AccountPlanningOwner B
                                    , AccountPlanningCustomer C
                                    , CustomerKorporasi D
                                    , CustomerGroup F
                                    , AccountPlanningStatus G
                                WHERE A.AccountPlanningId=B.AccountPlanningId
                                    AND B.AccountPlanningId=C.AccountPlanningId
                                    AND C.VCIF=D.VCIF
                                    AND D.CustomerGroupId = F.CustomerGroupId
                                    AND F.ClassificationId=1
                                    AND B.IsActive=1
                                    AND C.IsMain=1 
                                    AND A.Year=\''.$this->current_year.'\'
                                    AND G.DocumentStatusId=4 AND G.AccountPlanningStatusId = ( 
                                        SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = A.AccountPlanningId
                                    )
                             ) Tbl
                        ), 0
                    ) AS "PublishPlatinum"
                    , 
                    ISNULL(
                        (                    
                            SELECT COUNT(1) Total FROM(
                                SELECT A.AccountPlanningId
                                FROM AccountPlanning A
                                    , AccountPlanningOwner B
                                    , AccountPlanningCustomer C
                                    , CustomerKorporasi D
                                    , CustomerGroup F 
                                WHERE A.AccountPlanningId=B.AccountPlanningId
                                    AND B.AccountPlanningId=C.AccountPlanningId
                                    AND C.VCIF=D.VCIF
                                    AND D.CustomerGroupId = F.CustomerGroupId
                                    AND F.ClassificationId=1
                                    AND B.IsActive=1
                                    AND C.IsMain=1 
                                    AND A.Year=\''.$this->current_year.'\'
                                ) Tbl                   
                        ), 0
                    ) AS "TotalPlatinum"
                    , 
                    ISNULL(
                        (
                            SELECT COUNT(1) Total FROM(
                                SELECT A.AccountPlanningId
                                FROM AccountPlanning A
                                    , AccountPlanningOwner B
                                    , AccountPlanningCustomer C
                                    , CustomerKorporasi D
                                    , CustomerGroup F
                                    , AccountPlanningStatus G
                                WHERE A.AccountPlanningId=B.AccountPlanningId
                                    AND B.AccountPlanningId=C.AccountPlanningId
                                    AND C.VCIF=D.VCIF
                                    AND D.CustomerGroupId = F.CustomerGroupId
                                    AND F.ClassificationId=2
                                    AND B.IsActive=1
                                    AND C.IsMain=1 
                                    AND A.Year=\''.$this->current_year.'\'
                                    AND G.DocumentStatusId=4 AND G.AccountPlanningStatusId = ( 
                                        SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = A.AccountPlanningId
                                    )
                             ) Tbl
                        ), 0
                    ) AS "PublishGold"
                    , 
                    ISNULL(
                        (                    
                            SELECT COUNT(1) Total FROM(
                                SELECT A.AccountPlanningId
                                FROM AccountPlanning A
                                    , AccountPlanningOwner B
                                    , AccountPlanningCustomer C
                                    , CustomerKorporasi D
                                    , CustomerGroup F 
                                WHERE A.AccountPlanningId=B.AccountPlanningId
                                    AND B.AccountPlanningId=C.AccountPlanningId
                                    AND C.VCIF=D.VCIF
                                    AND D.CustomerGroupId = F.CustomerGroupId
                                    AND F.ClassificationId=2
                                    AND B.IsActive=1
                                    AND C.IsMain=1 
                                    AND A.Year=\''.$this->current_year.'\'
                                ) Tbl                   
                        ), 0
                    ) AS "TotalGold"
              ) x
        ';

        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getCPAProjectionLabaRugiSum($AccountPlanningId, $USDExchange) {
        $sql = '
        SELECT 
        (IDRJasaTransaksi + ValasJasaTransaksi) AS TotalJasaTransaksi
        , (IDRJasaTransfer + ValasJasaTransfer) AS TotalJasaTransfer
        , (IDRProvision + ValasProvision) AS TotalProvision
        , (IDRAdministrasi + ValasAdministrasi) AS TotalAdministrasi
        , (IDROperasional + ValasOperasional) AS TotalOperasional
        , (IDRPersonalia + ValasPersonalia) AS TotalPersonalia
        , (IDRPpap + ValasPpap) AS TotalPpap
        , (IDRBiayaModal + ValasBiayaModal) AS TotalBiayaModal

            FROM (
                SELECT 
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 8 
                    ), 0
                ) AS "IDRJasaTransaksi"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 8 
                    ), 0
                ) AS "ValasJasaTransaksi"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 9 
                    ), 0
                ) AS "IDRJasaTransfer"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 9 
                    ), 0
                ) AS "ValasJasaTransfer"
                , 
                
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRProvision"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId IN (1, 2)
                            )   
                        ) + (   
                            SELECT ISNULL(sum("b"."IDRProvisionAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" IN (1, 2)
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    
                ) AS "IDRProvision"
                , 
                
                    (
                        ((
                            SELECT ISNULL(sum("a"."ValasProvision"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId IN (1, 2)
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasProvisionAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" IN (1, 2)
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )) * '.$USDExchange.'
                    
                ) AS "ValasProvision"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 10 
                    ), 0
                ) AS "IDRAdministrasi"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 10 
                    ), 0
                ) AS "ValasAdministrasi"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 11 
                    ), 0
                ) AS "IDROperasional"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 11 
                    ), 0
                ) AS "ValasOperasional"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 12 
                    ), 0
                ) AS "IDRPersonalia"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 12 
                    ), 0
                ) AS "ValasPersonalia"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 13 
                    ), 0
                ) AS "IDRPpap"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 13 
                    ), 0
                ) AS "ValasPpap"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 14 
                    ), 0
                ) AS "IDRBiayaModal"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 14 
                    ), 0
                ) AS "ValasBiayaModal"

            ) x
        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCPAProjectionPinjamanSum($AccountPlanningId, $USDExchange) {
        $sql = '
        SELECT 
        IDROutstanding, ValasOutstanding, (IDROutstanding + ValasOutstanding) AS TotalOutstanding
        , IDRDailyRatas, ValasDailyRatas, (IDRDailyRatas + ValasDailyRatas) AS TotalDailyRatas
        , IDRPlafond, ValasPlafond, (IDRPlafond + ValasPlafond) AS TotalPlafond
        , (IDRPlafond - IDROutstanding) AS IDRTarik, (ValasPlafond - ValasOutstanding) AS ValasTarik, ((IDRPlafond - IDROutstanding) + (ValasPlafond - ValasOutstanding)) AS TotalTarik
        , IDRFeeBasedPinjaman, ValasFeeBasedPinjaman, (IDRFeeBasedPinjaman + ValasFeeBasedPinjaman) AS TotalFeeBasedPinjaman
        , IDRIncomeExpense, ValasIncomeExpense, (IDRIncomeExpense + ValasIncomeExpense) AS TotalIncomeExpense
        , IDROutstandingTradeFinance, ValasOutstandingTradeFinance, (IDROutstandingTradeFinance + ValasOutstandingTradeFinance) AS TotalOutstandingTradeFinance
        , IDRFeeBasedTradeFinance, ValasFeeBasedTradeFinance, (IDRFeeBasedTradeFinance + ValasFeeBasedTradeFinance) AS TotalFeeBasedTradeFinance
        , IDRFeeBasedLain, ValasFeeBasedLain, (IDRFeeBasedLain + ValasFeeBasedLain) AS TotalFeeBasedLain
            FROM(
                SELECT 
                
                    (
                        (
                            SELECT ISNULL(sum("a"."IDROutstanding"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId IN (1, 2)
                            )   
                        )+ (   
                            SELECT ISNULL(sum("b"."IDROutstandingAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" IN (1, 2)
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    
                ) AS "IDROutstanding"
                , 
                
                    (
                        ((
                            SELECT ISNULL(sum("a"."ValasOutstanding"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId IN (1, 2)
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasOutstandingAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" IN (1, 2)
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )) * '.$USDExchange.'
                    
                ) AS "ValasOutstanding"
                , 
                
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRDailyRatas"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId IN (1, 2)
                            )   
                        )+ (   
                            SELECT ISNULL(sum("b"."IDRDailyRatasAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" IN (1, 2)
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    
                ) AS "IDRDailyRatas"
                , 
                
                    (
                        ((
                            SELECT ISNULL(sum("a"."ValasDailyRatas"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId IN (1, 2)
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasDailyRatasAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" IN (1, 2)
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )) * '.$USDExchange.'
                    
                ) AS "ValasDailyRatas"
                , 
                
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRPlafond"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = 1
                            )   
                        )+ (   
                            SELECT ISNULL(sum("b"."IDRPlafondAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = 1
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    
                ) AS "IDRPlafond"
                , 
                
                    (
                        ((
                            SELECT ISNULL(sum("a"."ValasPlafond"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = 1
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasPlafondAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = 1
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )) * '.$USDExchange.'
                    
                ) AS "ValasPlafond"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 2 
                    ), 0
                ) AS "IDRFeeBasedPinjaman"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 2 
                    ), 0
                ) AS "ValasFeeBasedPinjaman"
                , 
                
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRIncomeExpense"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = 1
                            )   
                        )+ (   
                            SELECT ISNULL(sum("b"."IDRIncomeExpenseAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = 1
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    
                ) AS "IDRIncomeExpense"
                , 
                
                    (
                        ((
                            SELECT ISNULL(sum("a"."ValasIncomeExpense"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = 1
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasIncomeExpenseAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = 1
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )) * '.$USDExchange.'
                    
                ) AS "ValasIncomeExpense"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 3 
                    ), 0
                ) AS "IDROutstandingTradeFinance"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 3 
                    ), 0
                ) AS "ValasOutstandingTradeFinance"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 4 
                    ), 0
                ) AS "IDRFeeBasedTradeFinance"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 4 
                    ), 0
                ) AS "ValasFeeBasedTradeFinance"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 5 
                    ), 0
                ) AS "IDRFeeBasedLain"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = 5 
                    ), 0
                ) AS "ValasFeeBasedLain"

            ) x

        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCPAProjectionSimpananSum($AccountPlanningId, $BankFacilityGroupId, $FeeTypeId, $USDExchange) {
        $sql = '
        SELECT IDRSaldo, ValasSaldo, (IDRSaldo + ValasSaldo) AS TotalSaldo
        , IDRRatas, ValasRatas, (IDRRatas + ValasRatas) AS TotalRatas
        , IDRFeeBased, ValasFeeBased, (IDRFeeBased + ValasFeeBased) AS TotalFeeBased
        , IDRBebanBunga, ValasBebanBunga, (IDRBebanBunga + ValasBebanBunga) AS TotalBebanBunga
            FROM(
                SELECT 
                (
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRPlafond"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                            )  
                        ) + (   
                            SELECT ISNULL(sum("b"."IDRPlafondAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    )
                ) AS "IDRSaldo"
                , 
                (
                    (
                        (
                            SELECT ISNULL(sum("a"."ValasPlafond"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasPlafondAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )
                    ) * '. $USDExchange .'
                ) AS "ValasSaldo"
                ,
                (
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRDailyRatas"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                            )   
                        ) + (   
                            SELECT ISNULL(sum("b"."IDRDailyRatasAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    )
                ) AS "IDRRatas"
                , 
                (
                    (
                        (
                            SELECT ISNULL(sum("a"."ValasDailyRatas"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasDailyRatasAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )
                    ) * '. $USDExchange .'
                ) AS "ValasRatas"
                ,
                ISNULL(
                    (
                        SELECT "a"."IDRAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = '. $FeeTypeId .' 
                    ), 0
                ) AS "IDRFeeBased"
                , 
                ISNULL(
                    (
                        SELECT "a"."ValasAmount"
                        FROM "CreditSimulationFee" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."FeeTypeId" = '. $FeeTypeId .' 
                    ), 0
                ) AS "ValasFeeBased"
                ,
                (
                    (
                        (
                            SELECT ISNULL(sum("a"."IDRBebanBunga"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                            )   
                        ) + (   
                            SELECT ISNULL(sum("b"."IDRBebanBungaAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )   
                        )
                    )
                ) AS "IDRBebanBunga"
                , 
                (
                    (
                        (
                            SELECT ISNULL(sum("a"."ValasBebanBunga"), 0)
                            FROM "CreditSimulation" "a"
                            WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "a"."BankFacilityItemId" IN (
                                SELECT BankFacilityItemId 
                                FROM BankFacilityItem 
                                WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                            )
                        ) + (   
                            SELECT ISNULL(sum("b"."ValasBebanBungaAddition"), 0)
                            FROM "CreditSimulationAddition" "b"
                            WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            AND "b"."BankFacilityItemAdditionId" IN (
                                SELECT "a"."BankFacilityItemAdditionId"
                                FROM "BankFacilityItemAddition" "a" 
                                WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                                AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                            )
                        )
                    ) * '. $USDExchange .'
                ) AS "ValasBebanBunga"

            ) x

        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCPAProjectionSimpananBebanBungaSum($AccountPlanningId, $BankFacilityGroupId) {
        $sql = '
        SELECT IDRAmount, ValasAmount, (IDRAmount + ValasAmount) AS TotalAmount
            FROM(
                SELECT 
                (
                    (
                        SELECT ISNULL(sum("a"."IDRBebanBunga"), 0)
                        FROM "CreditSimulation" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."BankFacilityItemId" IN (
                            SELECT BankFacilityItemId 
                            FROM BankFacilityItem 
                            WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                        )   
                    ) + (  
                        SELECT ISNULL(sum("b"."IDRBebanBungaAddition"), 0 )
                        FROM "CreditSimulationAddition" "b"
                        WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "b"."BankFacilityItemAdditionId" IN (
                            SELECT "a"."BankFacilityItemAdditionId"
                            FROM "BankFacilityItemAddition" "a" 
                            WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                            AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        )   
                    )
                ) AS "IDRAmount"
                , 
                (
                    (
                        SELECT ISNULL(sum("a"."ValasBebanBunga"), 0)
                        FROM "CreditSimulation" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."BankFacilityItemId" IN (
                            SELECT BankFacilityItemId 
                            FROM BankFacilityItem 
                            WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                        ) 
                    ) + (  
                        SELECT ISNULL(sum("b"."ValasBebanBungaAddition"), 0)
                        FROM "CreditSimulationAddition" "b"
                        WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "b"."BankFacilityItemAdditionId" IN (
                            SELECT "a"."BankFacilityItemAdditionId"
                            FROM "BankFacilityItemAddition" "a" 
                            WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                            AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        ) 
                    )
                ) AS "ValasAmount"
            ) x

        ';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getCPAProjectionSimpananFeeBasedSum($AccountPlanningId, $FeeTypeId) {
        $sql = '
        SELECT IDRAmount, ValasAmount, (IDRAmount + ValasAmount) AS TotalAmount
            FROM(
                SELECT 
                ISNULL((
                    SELECT "a"."IDRAmount"
                    FROM "CreditSimulationFee" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."FeeTypeId" = '. $FeeTypeId .' 
                ), 0) AS "IDRAmount"
                , 
                ISNULL((
                    SELECT "a"."ValasAmount"
                    FROM "CreditSimulationFee" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."FeeTypeId" = '. $FeeTypeId .' 
                ), 0) AS "ValasAmount"
            ) x
        ';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getCPAProjectionSimpananRatasSum($AccountPlanningId, $BankFacilityGroupId) {
        $sql = '
        SELECT IDRAmount, ValasAmount, (IDRAmount + ValasAmount) AS TotalAmount
            FROM(
                SELECT 
                (
                    ISNULL((
                        SELECT sum("a"."IDRDailyRatas")
                        FROM "CreditSimulation" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."BankFacilityItemId" IN (
                            SELECT BankFacilityItemId 
                            FROM BankFacilityItem 
                            WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                        )), 0     
                    ) + ISNULL((   
                        SELECT sum("b"."IDRDailyRatasAddition")
                        FROM "CreditSimulationAddition" "b"
                        WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "b"."BankFacilityItemAdditionId" IN (
                            SELECT "a"."BankFacilityItemAdditionId"
                            FROM "BankFacilityItemAddition" "a" 
                            WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                            AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        )), 0     
                    )
                ) AS "IDRAmount"
                , 
                (
                    ISNULL((
                        SELECT sum("a"."ValasDailyRatas")
                        FROM "CreditSimulation" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."BankFacilityItemId" IN (
                            SELECT BankFacilityItemId 
                            FROM BankFacilityItem 
                            WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                        )), 0  
                    ) + ISNULL((   
                        SELECT sum("b"."ValasDailyRatasAddition")
                        FROM "CreditSimulationAddition" "b"
                        WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "b"."BankFacilityItemAdditionId" IN (
                            SELECT "a"."BankFacilityItemAdditionId"
                            FROM "BankFacilityItemAddition" "a" 
                            WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                            AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        )), 0  
                    )
                ) AS "ValasAmount"
            ) x

        ';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getCPAProjectionSimpananSaldoSum($AccountPlanningId, $BankFacilityGroupId) {
        $sql = '
        SELECT IDRAmount, ValasAmount, (IDRAmount + ValasAmount) AS TotalAmount
            FROM(
                SELECT 
                (
                    ISNULL((
                        SELECT sum("a"."IDRPlafond")
                        FROM "CreditSimulation" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."BankFacilityItemId" IN (
                            SELECT BankFacilityItemId 
                            FROM BankFacilityItem 
                            WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                        )), 0   
                    ) + ISNULL((  
                        SELECT sum("b"."IDRPlafondAddition")
                        FROM "CreditSimulationAddition" "b"
                        WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "b"."BankFacilityItemAdditionId" IN (
                            SELECT "a"."BankFacilityItemAdditionId"
                            FROM "BankFacilityItemAddition" "a" 
                            WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                            AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        )), 0   
                    )
                ) AS "IDRAmount"
                , 
                (
                    ISNULL((
                        SELECT sum("a"."ValasPlafond")
                        FROM "CreditSimulation" "a"
                        WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "a"."BankFacilityItemId" IN (
                            SELECT BankFacilityItemId 
                            FROM BankFacilityItem 
                            WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                        )), 0
                    ) + ISNULL((   
                        SELECT sum("b"."ValasPlafondAddition")
                        FROM "CreditSimulationAddition" "b"
                        WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        AND "b"."BankFacilityItemAdditionId" IN (
                            SELECT "a"."BankFacilityItemAdditionId"
                            FROM "BankFacilityItemAddition" "a" 
                            WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                            AND "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                        )), 0
                    )
                ) AS "ValasAmount"
            ) x

        ';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getCreditSimulationPlafondSum($AccountPlanningId, $BankFacilityItemId) {
        $sql = '
        SELECT ISNULL(sum("a"."IDRTarget"), 0) AS "IDRPlafond", ISNULL(sum("a"."ValasTarget"), 0) AS "ValasPlafond"      
                FROM "EstimatedFinancial" "a"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "a"."BankFacilityItemId" = '. $BankFacilityItemId;

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCreditSimulationAdditionPlafondSum($AccountPlanningId, $BankFacilityItemAdditionId) {
        $sql = '
        SELECT ISNULL(sum("a"."IDRTargetAddition"), 0) AS "IDRPlafondAddition", ISNULL(sum("a"."ValasTargetAddition"), 0) AS "ValasPlafondAddition"      
                FROM "EstimatedFinancialAddition" "a"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "a"."BankFacilityItemAdditionId" = '. $BankFacilityItemAdditionId;
        // echo $sql;

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCreditSimulationFeeSimpananSum($AccountPlanningId, $BankFacilityGroupId) {
        $sql = '
            SELECT (
                ISNULL((
                    SELECT sum("a"."IDRFee")
                    FROM "CreditSimulation" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."BankFacilityItemId" IN (
                        SELECT BankFacilityItemId 
                        FROM BankFacilityItem 
                        WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                    )), 0  
                ) + ISNULL((   
                    SELECT sum("b"."IDRFeeAddition")
                    FROM "CreditSimulationAddition" "b"
                    WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "b"."BankFacilityItemAdditionId" IN (
                        SELECT "a"."BankFacilityItemAdditionId"
                        FROM "BankFacilityItemAddition" "a" 
                        WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                        AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    )), 0  
                )
            ) AS "IDRAmount"
            , (
                ISNULL((   
                    SELECT sum("a"."ValasFee")
                    FROM "CreditSimulation" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."BankFacilityItemId" IN (
                        SELECT BankFacilityItemId 
                        FROM BankFacilityItem 
                        WHERE BankFacilityGroupId = '. $BankFacilityGroupId .'
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("b"."ValasFeeAddition")
                    FROM "CreditSimulationAddition" "b"
                    WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "b"."BankFacilityItemAdditionId" IN (
                        SELECT "a"."BankFacilityItemAdditionId"
                        FROM "BankFacilityItemAddition" "a" 
                        WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .'
                        AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    )), 0  
                )
            ) AS "ValasAmount"

        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCreditSimulationFeePinjamanSum($AccountPlanningId) {
        $sql = '
            SELECT (
                ISNULL((
                    SELECT sum("a"."IDRFee")
                    FROM "CreditSimulation" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."BankFacilityItemId" IN (
                        SELECT BankFacilityItemId 
                        FROM BankFacilityItem 
                        WHERE BankFacilityGroupId IN (1, 2)
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("a"."IDRProvision")
                    FROM "CreditSimulation" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."BankFacilityItemId" IN (
                        SELECT BankFacilityItemId 
                        FROM BankFacilityItem 
                        WHERE BankFacilityGroupId IN (1, 2)
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("b"."IDRFeeAddition")
                    FROM "CreditSimulationAddition" "b"
                    WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "b"."BankFacilityItemAdditionId" IN (
                        SELECT "a"."BankFacilityItemAdditionId"
                        FROM "BankFacilityItemAddition" "a" 
                        WHERE "a"."BankFacilityGroupId" IN (1, 2)
                        AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("b"."IDRProvisionAddition")
                    FROM "CreditSimulationAddition" "b"
                    WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "b"."BankFacilityItemAdditionId" IN (
                        SELECT "a"."BankFacilityItemAdditionId"
                        FROM "BankFacilityItemAddition" "a" 
                        WHERE "a"."BankFacilityGroupId" IN (1, 2)
                        AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    )), 0  
                )
            ) AS "IDRAmount"
            , (
                ISNULL((
                    SELECT sum("a"."ValasFee")
                    FROM "CreditSimulation" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."BankFacilityItemId" IN (
                        SELECT BankFacilityItemId 
                        FROM BankFacilityItem 
                        WHERE BankFacilityGroupId IN (1, 2)
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("a"."ValasProvision")
                    FROM "CreditSimulation" "a"
                    WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "a"."BankFacilityItemId" IN (
                        SELECT BankFacilityItemId 
                        FROM BankFacilityItem 
                        WHERE BankFacilityGroupId IN (1, 2)
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("b"."ValasFeeAddition")
                    FROM "CreditSimulationAddition" "b"
                    WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "b"."BankFacilityItemAdditionId" IN (
                        SELECT "a"."BankFacilityItemAdditionId"
                        FROM "BankFacilityItemAddition" "a" 
                        WHERE "a"."BankFacilityGroupId" IN (1, 2)
                        AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    )), 0  
                ) + ISNULL((     
                    SELECT sum("b"."ValasProvisionAddition")
                    FROM "CreditSimulationAddition" "b"
                    WHERE "b"."AccountPlanningId" = '. $AccountPlanningId .' 
                    AND "b"."BankFacilityItemAdditionId" IN (
                        SELECT "a"."BankFacilityItemAdditionId"
                        FROM "BankFacilityItemAddition" "a" 
                        WHERE "a"."BankFacilityGroupId" IN (1, 2)
                        AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                    )), 0  
                )
            ) AS "ValasAmount"

        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

}

?>