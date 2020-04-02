
-- Drop table

DROP TABLE CPA_KORPORASI_DEV.dbo.CreditSimulationAddition GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.CreditSimulationAddition (
	CreditSimulationAdditionId int IDENTITY(1,1) NOT NULL,
	BankFacilityItemAdditionId int NULL,
	AccountPlanningId int NULL,
	IDRPlafondAddition numeric(18,2) NULL,
	ValasPlafondAddition numeric(18,2) NULL,
	IDROutstandingAddition numeric(18,2) NULL,
	ValasOutstandingAddition numeric(18,2) NULL,
	IDRDailyRatasAddition numeric(18,2) NULL,
	ValasDailyRatasAddition numeric(18,2) NULL,
	IDRTenorAddition numeric(18,2) NULL,
	ValasTenorAddition numeric(18,2) NULL,
	IDRIndicativeRateAddition numeric(5,2) NULL,
	ValasIndicativeRateAddition numeric(5,2) NULL,
	IDRIncomeExpenseAddition numeric(18,2) NULL,
	ValasIncomeExpenseAddition numeric(18,2) NULL,
	IDRProvisionRateAddition numeric(5,2) NULL,
	ValasProvisionRateAddition numeric(5,2) NULL,
	IDRProvisionAddition numeric(18,2) NULL,
	ValasProvisionAddition numeric(18,2) NULL,
	IDRFeeAddition numeric(18,3) NULL,
	ValasFeeAddition numeric(18,3) NULL,
	CreatedDate datetime NULL,
	CreatedBy varchar(10) COLLATE Latin1_General_CI_AS NULL,
	ModifiedDate datetime NULL,
	ModifiedBy varchar(10) COLLATE Latin1_General_CI_AS NULL,
	PRIMARY KEY (CreditSimulationAdditionId)
) GO
