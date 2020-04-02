<?php

class DataLoadOption_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->todays = $today->format('Y-m-d H:i:s');
    }

    public function getKeyShareholderDataSource($accountPlanningId){
    	$sql = "SELECT TOP 1 CASE ISNULL(LoadFrom,3) 
				WHEN 1 THEN 'lastyear'
				WHEN 2 THEN 'datamart'
				WHEN 3 THEN 'manual'
			END LoadOpt
			FROM Shareholder
			WHERE AccountPlanningId=".$accountPlanningId."
			ORDER BY ModifiedDate DESC, CreatedDate DESC";

		$result = $this->db->query($sql)->row_array();
		if($result)
			return $result['LoadOpt'];
		else 
			return 'manual';
    }

    public function loadKeyShareholderLastYear($accountPlanningId){
    	$sql = "SELECT *FROM Shareholder
			WHERE AccountPlanningId = (
				SELECT DISTINCT A.AccountPlanningId
				FROM AccountPlanning A, AccountPlanningCustomer B
				WHERE A.AccountPlanningId=B.AccountPlanningId
					AND B.VCIF = (
						SELECT VCIF FROM AccountPlanningCustomer
						WHERE AccountPlanningId=".$accountPlanningId." AND IsMain=1
					)
					AND B.IsMain=1
					AND A.[Year]=YEAR(GETDATE())-1
			)";

		$result = $this->db->query($sql)->result_array();

		return $result;
    }

    public function saveKeyShareholderLastYear($accountPlanningId){
    	$sql = "DELETE FROM Shareholder
    		WHERE AccountPlanningId=".$accountPlanningId;
    	$this->db->query($sql);
    	
		$sql = "INSERT INTO Shareholder(AccountPlanningId, Name, Quantity, LoadFrom, CreatedDate, CreatedBy)
			SELECT ".$accountPlanningId.", Name, Quantity, 1, SYSDATETIME(), '".$_SESSION['USER_ID']."'
			FROM Shareholder
			WHERE AccountPlanningId = (
				SELECT DISTINCT A.AccountPlanningId
				FROM AccountPlanning A, AccountPlanningCustomer B
				WHERE A.AccountPlanningId=B.AccountPlanningId
					AND B.VCIF = (
						SELECT VCIF FROM AccountPlanningCustomer
						WHERE AccountPlanningId=".$accountPlanningId." AND IsMain=1
					)
					AND B.IsMain=1
					AND A.[Year]=YEAR(GETDATE())-1
			)";
		$this->db->query($sql);
    }

    public function getFinancialHighlightDataSource($accountPlanningId, $groupId){
    	$sql = "SELECT TOP 1 CASE ISNULL(LoadFrom,3) 
					WHEN 1 THEN 'lastyear'
					WHEN 2 THEN 'datamart'
					WHEN 3 THEN 'manual'
				END LoadOpt
				FROM FinancialHighlight
				WHERE AccountPlanningId=".$accountPlanningId."
					AND FinancialHighlightItemId IN (
						SELECT FinancialHighlightItemId
						FROM FinancialHighlightItem
						WHERE FinancialHighlightGroupId=".$groupId."
					)
					AND [Year] < (SELECT [Year] FROM AccountPlanning
						WHERE AccountPlanningId=".$accountPlanningId.")
				ORDER BY ModifiedDate DESC, CreatedDate DESC";

		$result = $this->db->query($sql)->row_array();
		if($result)
			return $result['LoadOpt'];
		else 
			return 'manual';
    }

    public function loadFinancialHighlightLastYear($accountPlanningId, $groupId){
    	$sql = "SELECT *
				FROM FinancialHighlight
				WHERE AccountPlanningId = (
					SELECT DISTINCT A.AccountPlanningId
					FROM AccountPlanning A, AccountPlanningCustomer B
					WHERE A.AccountPlanningId=B.AccountPlanningId
						AND B.VCIF = (
							SELECT VCIF FROM AccountPlanningCustomer
							WHERE AccountPlanningId=".$accountPlanningId." AND IsMain=1
						)
						AND B.IsMain=1
						AND A.[Year]=YEAR(GETDATE())-1
					) 
					AND FinancialHighlightItemId IN (
						SELECT FinancialHighlightItemId
						FROM FinancialHighlightItem
						WHERE FinancialHighlightGroupId=".$groupId."
					)
					AND [Year] BETWEEN (SELECT [Year]-3 FROM AccountPlanning
						WHERE AccountPlanningId=".$accountPlanningId."
					) AND
					(SELECT [Year] FROM AccountPlanning
						WHERE AccountPlanningId=".$accountPlanningId."
					)";

		$result = $this->db->query($sql)->result_array();

		return $result;
    }

    public function saveFinancialHighlightLastYear($accountPlanningId, $groupId){
    	$sql = "DELETE FROM FinancialHighlight
    		WHERE AccountPlanningId=".$accountPlanningId."
    			AND FinancialHighlightItemId IN (
					SELECT FinancialHighlightItemId
					FROM FinancialHighlightItem
					WHERE FinancialHighlightGroupId=".$groupId."
				)
				AND [Year] BETWEEN (SELECT [Year]-3 FROM AccountPlanning
					WHERE AccountPlanningId=".$accountPlanningId."
				) AND
				(SELECT [Year] FROM AccountPlanning
					WHERE AccountPlanningId=".$accountPlanningId."
				)";
    	$this->db->query($sql);
    	
		$sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
				SELECT FinancialHighlightItemId, ".$accountPlanningId.", [Year], Amount, 1, SYSDATETIME(), '".$_SESSION['USER_ID']."'
				FROM FinancialHighlight
				WHERE AccountPlanningId = (
					SELECT DISTINCT A.AccountPlanningId
					FROM AccountPlanning A, AccountPlanningCustomer B
					WHERE A.AccountPlanningId=B.AccountPlanningId
						AND B.VCIF = (
							SELECT VCIF FROM AccountPlanningCustomer
							WHERE AccountPlanningId=".$accountPlanningId." AND IsMain=1
						)
						AND B.IsMain=1
						AND A.[Year]=YEAR(GETDATE())-1
					) 
					AND FinancialHighlightItemId IN (
						SELECT FinancialHighlightItemId
						FROM FinancialHighlightItem
						WHERE FinancialHighlightGroupId=".$groupId."
					)
					AND [Year] < (SELECT [Year] FROM AccountPlanning
						WHERE AccountPlanningId=".$accountPlanningId."
					)";
		$this->db->query($sql);
    }

    public function getBankFacilityDataSource($accountPlanningId, $groupId, $vcif){
    	$sql = "SELECT TOP 1 CASE ISNULL(LoadFrom,3) 
					WHEN 1 THEN 'lastyear'
					WHEN 2 THEN 'datamart'
					WHEN 3 THEN 'manual'
				END LoadOpt
				FROM BankFacility
				WHERE AccountPlanningId=".$accountPlanningId."
					AND BankFacilityItemId IN(
						SELECT BankFacilityItemId
						FROM BankFacilityItem
						WHERE BankFacilityGroupId=".$groupId."
					)
					AND VCIF = '".$vcif."'
				ORDER BY ModifiedDate DESC, CreatedDate DESC";

		$result = $this->db->query($sql)->row_array();
		if($result)
			return $result['LoadOpt'];
		else 
			return 'manual';
    }

    public function loadBankFacilityLastYear($accountPlanningId, $groupId, $vcif){
    	$sql = "SELECT *
				FROM BankFacility
				WHERE AccountPlanningId = (
					SELECT DISTINCT A.AccountPlanningId
					FROM AccountPlanning A, AccountPlanningCustomer B
					WHERE A.AccountPlanningId=B.AccountPlanningId
						AND A.[Year]=YEAR(GETDATE())-1
						AND VCIF='".$vcif."'
					)
					AND BankFacilityItemId IN(
						SELECT BankFacilityItemId
						FROM BankFacilityItem
						WHERE BankFacilityGroupId=".$groupId."
					)
					AND VCIF='".$vcif."'";

		$result = $this->db->query($sql)->result_array();

		return $result;
    }

    public function saveBankFacilityLastYear($accountPlanningId, $groupId, $vcif){
    	$sql = "DELETE FROM BankFacility
    		WHERE AccountPlanningId=".$accountPlanningId."
    			AND BankFacilityItemId IN(
					SELECT BankFacilityItemId
					FROM BankFacilityItem
					WHERE BankFacilityGroupId=".$groupId."
				)
				AND VCIF='".$vcif."'";
    	$this->db->query($sql);

    	$sql = "DELETE FROM WalletShare
    		WHERE AccountPlanningId=".$accountPlanningId."
    			AND BankFacilityItemId IN(
					SELECT BankFacilityItemId
					FROM BankFacilityItem
					WHERE BankFacilityGroupId=".$groupId."
				)
				AND VCIF='".$vcif."'";
    	$this->db->query($sql);
    	
		$sql = "INSERT INTO BankFacility(BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount, IDRRate, 
				ValasAmount, ValasRate, LoadFrom, CreatedDate, CreatedBy)
				SELECT BankFacilityItemId, ".$accountPlanningId.", '".$vcif."', IDRAmount, IDRRate, 
					ValasAmount, ValasRate, 1, SYSDATETIME(), '".$_SESSION['USER_ID']."'
				FROM BankFacility
				WHERE AccountPlanningId = (
					SELECT DISTINCT A.AccountPlanningId
					FROM AccountPlanning A, AccountPlanningCustomer B
					WHERE A.AccountPlanningId=B.AccountPlanningId
						AND A.[Year]=YEAR(GETDATE())-1
						AND VCIF='".$vcif."'
					)
					AND BankFacilityItemId IN(
						SELECT BankFacilityItemId
						FROM BankFacilityItem
						WHERE BankFacilityGroupId=".$groupId."
					)
					AND VCIF='".$vcif."'";
		$this->db->query($sql);

		$sql = "INSERT INTO WalletShare(BankFacilityItemId, AccountPlanningId, VCIF, BRINominal, TotalAmount, CreatedDate, CreatedBy)
			SELECT BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount+ValasAmount BRINominal, IDRAmount+ValasAmount TotalAmount, SYSDATETIME() CreatedDate, '".$_SESSION['USER_ID']."' CreatedBy
			FROM BankFacility
			WHERE VCIF='".$vcif."' and AccountPlanningId=".$accountPlanningId."
				AND BankFacilityItemId IN(
					SELECT BankFacilityItemId
					FROM BankFacilityItem
					WHERE BankFacilityGroupId=".$groupId."
				)";
		$this->db->query($sql);
    }

    public function loadBankFacilityDataMart($accountPlanningId, $groupId, $vcif){
    	switch ($groupId) {
    		case 1:
    			$sql = "SELECT BankFacilityItemId, AccountPlanningId, VCIF, 
						SUM(IDRAmount), AVG(IDRRate), SUM(ValasAmount), AVG(ValasRate),
						2 LoadFrom, SYSDATETIME() CreatedDate, '".$_SESSION['USER_ID']."' CreatedBy
					FROM (
	    				SELECT JenisPenggunaan BankFacilityItemId, ".$accountPlanningId." AccountPlanningId, '".$vcif."' VCIF,
							CASE Currency
								WHEN 'IDR' THEN BakiDebet
								ELSE 0
							END IDRAmount,
							CASE Currency
								WHEN 'IDR' THEN RatePinjaman
								ELSE 0
							END IDRRate,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE BakiDebet
							END ValasAmount,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE RatePinjaman
							END ValasRate
						FROM Summary_PinjamanDailyCustomer
						where Periode=(SELECT MAX(Periode) from Summary_PinjamanDailyCustomer)
						and Vcif='".$vcif."'
						and JenisPenggunaan in(1,2)
					) Tbl1
					GROUP BY  BankFacilityItemId, AccountPlanningId, VCIF";

    			break;
    		case 3:
    			$sql = "
    				SELECT BankFacilityItemId, AccountPlanningId, VCIF, 
						SUM(IDRAmount), AVG(IDRRate), SUM(ValasAmount), AVG(ValasRate),
						2 LoadFrom, SYSDATETIME() CreatedDate, '".$_SESSION['USER_ID']."' CreatedBy
					FROM (
						SELECT CASE Desc1 
	    						WHEN 'DEPOSITO' THEN 6
	    						WHEN 'GIRO' THEN 7
	    					END BankFacilityItemId, 
	    					".$accountPlanningId." AccountPlanningId, '".$vcif."' VCIF,
							CASE Currency
								WHEN 'IDR' THEN AverageSaldo
								ELSE 0
							END IDRAmount,
							CASE Currency
								WHEN 'IDR' THEN RateSimpanan
								ELSE 0
							END IDRRate,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE AverageSaldo
							END ValasAmount,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE RateSimpanan
							END ValasRate
						FROM Summary_SimpananDailyCustomer
						where Periode=(SELECT MAX(Periode) from Summary_SimpananDailyCustomer)
						and Vcif='".$vcif."'
						and Desc1 in('DEPOSITO', 'GIRO')
					) tbl1
					GROUP BY BankFacilityItemId, AccountPlanningId, VCIF
    			";

    			break;
    		
    		default:
    			$sql = "SELECT 1 WHERE 1=0";
    			break;
    	}

		$result = $this->db->query($sql)->result_array();

		return $result;
    }

    public function saveBankFacilityDataMart($accountPlanningId, $groupId, $vcif){
    	$sql = "DELETE FROM BankFacility
    		WHERE AccountPlanningId=".$accountPlanningId."
    			AND BankFacilityItemId IN(
					SELECT BankFacilityItemId
					FROM BankFacilityItem
					WHERE BankFacilityGroupId=".$groupId."
				)
				AND VCIF='".$vcif."'";
    	$this->db->query($sql);

    	$sql = "DELETE FROM WalletShare
    		WHERE AccountPlanningId=".$accountPlanningId."
    			AND BankFacilityItemId IN(
					SELECT BankFacilityItemId
					FROM BankFacilityItem
					WHERE BankFacilityGroupId=".$groupId."
				)
				AND VCIF='".$vcif."'";
    	$this->db->query($sql);

		switch ($groupId) {
    		case 1:
    			$sql = "INSERT INTO BankFacility(BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount, IDRRate, 
				ValasAmount, ValasRate, LoadFrom, CreatedDate, CreatedBy)
					SELECT BankFacilityItemId, AccountPlanningId, VCIF, 
						SUM(IDRAmount), AVG(IDRRate), SUM(ValasAmount), AVG(ValasRate),
						2 LoadFrom, SYSDATETIME() CreatedDate, '".$_SESSION['USER_ID']."' CreatedBy
					FROM (
	    				SELECT JenisPenggunaan BankFacilityItemId, ".$accountPlanningId." AccountPlanningId, '".$vcif."' VCIF,
							CASE Currency
								WHEN 'IDR' THEN BakiDebet
								ELSE 0
							END IDRAmount,
							CASE Currency
								WHEN 'IDR' THEN RatePinjaman
								ELSE 0
							END IDRRate,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE BakiDebet
							END ValasAmount,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE RatePinjaman
							END ValasRate
						FROM Summary_PinjamanDailyCustomer
						where Periode=(SELECT MAX(Periode) from Summary_PinjamanDailyCustomer)
						and Vcif='".$vcif."'
						and JenisPenggunaan in(1,2)
					) Tbl1
					GROUP BY  BankFacilityItemId, AccountPlanningId, VCIF
				";

    			break;

    		case 3:
    			$sql = "
    				INSERT INTO BankFacility(BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount, IDRRate, 
						ValasAmount, ValasRate, LoadFrom, CreatedDate, CreatedBy)
					SELECT BankFacilityItemId, AccountPlanningId, VCIF, 
						SUM(IDRAmount), AVG(IDRRate), SUM(ValasAmount), AVG(ValasRate),
						2 LoadFrom, SYSDATETIME() CreatedDate, '".$_SESSION['USER_ID']."' CreatedBy
					FROM (
						SELECT CASE Desc1 
	    						WHEN 'DEPOSITO' THEN 6
	    						WHEN 'GIRO' THEN 7
	    					END BankFacilityItemId, 
	    					".$accountPlanningId." AccountPlanningId, '".$vcif."' VCIF,
							CASE Currency
								WHEN 'IDR' THEN AverageSaldo
								ELSE 0
							END IDRAmount,
							CASE Currency
								WHEN 'IDR' THEN RateSimpanan
								ELSE 0
							END IDRRate,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE AverageSaldo
							END ValasAmount,
							CASE Currency
								WHEN 'IDR' THEN 0
								ELSE RateSimpanan
							END ValasRate
						FROM Summary_SimpananDailyCustomer
						where Periode=(SELECT MAX(Periode) from Summary_SimpananDailyCustomer)
						and Vcif='".$vcif."'
						and Desc1 in('DEPOSITO', 'GIRO')
					) tbl1
					GROUP BY BankFacilityItemId, AccountPlanningId, VCIF
    			";

    			break;
    		
    		default:
    			# code...
    			break;
    	}
		$this->db->query($sql);

		$sql = "INSERT INTO WalletShare(BankFacilityItemId, AccountPlanningId, VCIF, BRINominal, TotalAmount, CreatedDate, CreatedBy)
			SELECT BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount+ValasAmount BRINominal, IDRAmount+ValasAmount TotalAmount, SYSDATETIME() CreatedDate, '".$_SESSION['USER_ID']."' CreatedBy
			FROM BankFacility
			WHERE VCIF='".$vcif."' and AccountPlanningId=".$accountPlanningId."
				AND BankFacilityItemId IN(
					SELECT BankFacilityItemId
					FROM BankFacilityItem
					WHERE BankFacilityGroupId=".$groupId."
				)";
		$this->db->query($sql);
    }

    public function loadKeyShareholderDataMart($accountPlanningId){
    	$sql = "SELECT *FROM FACT_Keyshareholder
			WHERE CifLas IN (
				SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
				WHERE AccountPlanningId=".$accountPlanningId." 
					AND IsMain=1 AND A.VCIF=B.VCIF
			)";

		$result = $this->db->query($sql)->result_array();

		return $result;
    }

    public function saveKeyShareholderDataMart($accountPlanningId){
    	$sql = "DELETE FROM Shareholder
    		WHERE AccountPlanningId=".$accountPlanningId;
    	$this->db->query($sql);
    	
		$sql = "INSERT INTO Shareholder(AccountPlanningId, Name, Quantity, LoadFrom, CreatedDate, CreatedBy)
			SELECT ".$accountPlanningId.", Shareholder, SUM(ShareValue), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
			FROM FACT_Keyshareholder a
			WHERE CifLas in (
				SELECT CIF FROM DetailCustomerKorporasi
				WHERE VCIF = (
					SELECT VCIF FROM AccountPlanningCustomer 
					WHERE AccountPlanningId=".$accountPlanningId." AND IsMain=1
				)
			)
			AND Periode = (
				SELECT MAX(Periode) from FACT_KeyShareHolder b
				WHERE CifLas in (
					SELECT CIF FROM DetailCustomerKorporasi
					WHERE VCIF = (
						SELECT VCIF FROM AccountPlanningCustomer 
						WHERE AccountPlanningId=".$accountPlanningId." AND IsMain=1
					)
				)
			)			
			GROUP BY Shareholder";
		$this->db->query($sql);
    }

    public function loadFinancialHighlightDataMart($accountPlanningId){
    	$sql = "SELECT *FROM FACT_FinancialHighlight
			WHERE CifLas IN (
				SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
				WHERE AccountPlanningId=".$accountPlanningId." 
					AND IsMain=1 AND A.VCIF=B.VCIF
			)
				AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
					WHERE AccountPlanningId=".$accountPlanningId."
				) AND
				(SELECT [Year] FROM AccountPlanning
					WHERE AccountPlanningId=".$accountPlanningId."
				)
			";

		$result = $this->db->query($sql)->result_array();

		return $result;
    }

    public function saveFinancialHighlightDataMart($accountPlanningId, $groupId){
    	$sql = "DELETE FROM FinancialHighlight
    		WHERE AccountPlanningId=".$accountPlanningId."
    			AND FinancialHighlightItemId IN (
					SELECT FinancialHighlightItemId
					FROM FinancialHighlightItem
					WHERE FinancialHighlightGroupId=".$groupId."
				)
				AND [Year] BETWEEN (SELECT [Year]-3 FROM AccountPlanning
					WHERE AccountPlanningId=".$accountPlanningId."
				) AND
				(SELECT [Year] FROM AccountPlanning
					WHERE AccountPlanningId=".$accountPlanningId."
				)";
    	$this->db->query($sql);

		switch ($groupId) {
    		case 1:
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 1, ".$accountPlanningId.", Year(Periode), SUM(AktivaLancar), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
				$this->db->query($sql);
				$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 2, ".$accountPlanningId.", Year(Periode), SUM(AktivaTetap), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
				$this->db->query($sql);
				$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 3, ".$accountPlanningId.", Year(Periode), SUM(TotalAktiva), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
				$this->db->query($sql);
				$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 4, ".$accountPlanningId.", Year(Periode), SUM(PinjamanJangkaPendek), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
				$this->db->query($sql);
				$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 5, ".$accountPlanningId.", Year(Periode), SUM(PinjamanJangkaPanjang), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
				$this->db->query($sql);
				$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 6, ".$accountPlanningId.", Year(Periode), SUM(Modal), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
				$this->db->query($sql);
    			break;

    		case 2:
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 7, ".$accountPlanningId.", Year(Periode), SUM(Penjualan), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 8, ".$accountPlanningId.", Year(Periode), SUM(Cogs), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 9, ".$accountPlanningId.", Year(Periode), SUM(LabaOperasional), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 10, ".$accountPlanningId.", Year(Periode), SUM(LabaKotor), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 11, ".$accountPlanningId.", Year(Periode), SUM(LabaBersih), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			break;

    		case 3:
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 12, ".$accountPlanningId.", Year(Periode), SUM(CurrentRatio), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 13, ".$accountPlanningId.", Year(Periode), SUM(QuickRatio), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 14, ".$accountPlanningId.", Year(Periode), SUM(Nwc), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			break;

    		case 4:
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 15, ".$accountPlanningId.", Year(Periode), SUM(Doi), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 16, ".$accountPlanningId.", Year(Periode), SUM(Dor), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 17, ".$accountPlanningId.", Year(Periode), SUM(Dop), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			break;

    		case 5:
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 18, ".$accountPlanningId.", Year(Periode), SUM(OperatingMargin), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 19, ".$accountPlanningId.", Year(Periode), SUM(NetProfitMargin), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 20, ".$accountPlanningId.", Year(Periode), SUM(ReturnOnAssets), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			break;

    		case 6:
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 21, ".$accountPlanningId.", Year(Periode), SUM(RasioHutangModal), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 22, ".$accountPlanningId.", Year(Periode), SUM(RasioHutangAset), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 23, ".$accountPlanningId.", Year(Periode), SUM(InterestCoverageRatio), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 24, ".$accountPlanningId.", Year(Periode), SUM(Ebitda), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			$sql = "
    				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, [Year], Amount, LoadFrom, CreatedDate, CreatedBy)
					SELECT 25, ".$accountPlanningId.", Year(Periode), SUM(Dscr), 2, SYSDATETIME(), '".$_SESSION['USER_ID']."'
					FROM FACT_FinancialHighlight
					WHERE CifLas IN (
						SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
						WHERE AccountPlanningId=".$accountPlanningId." 
							AND IsMain=1 AND A.VCIF=B.VCIF
					)
						AND Periode in(
							SELECT MAX(Periode)
							FROM FACT_FinancialHighlight
							WHERE CifLas IN (
								SELECT CIF FROM DetailCustomerKorporasi A, AccountPlanningCustomer B
								WHERE AccountPlanningId=".$accountPlanningId." 
									AND IsMain=1 AND A.VCIF=B.VCIF
							)
								AND YEAR(Periode) BETWEEN (SELECT [Year]-3 FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								) AND
								(SELECT [Year] FROM AccountPlanning
									WHERE AccountPlanningId=".$accountPlanningId."
								)
							GROUP BY Year(Periode)
						)
					GROUP BY Year(Periode)
    			";
    			$this->db->query($sql);
    			break;
    		
    		default:
    			# code...
    			break;
    	}
    }
}