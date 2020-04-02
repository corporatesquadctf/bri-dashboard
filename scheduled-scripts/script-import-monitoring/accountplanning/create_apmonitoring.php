<?php
	echo "Create Table MonitoringAccountPlanning begin\n";
	$sql = <<<SQL

-- Drop table

-- DROP TABLE CPA_KORPORASI_DEV.dbo.MonitoringAccountPlanning GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.MonitoringAccountPlanning (
    MonitoringAccountPlanningId int IDENTITY(1,1) NOT NULL,
    AccountPlanningId int NOT NULL,
    Vcif varchar(10) COLLATE Latin1_General_CI_AS NOT NULL,
    CustomerName varchar(100) COLLATE Latin1_General_CI_AS NOT NULL,
    SektorUsaha varchar(100) COLLATE Latin1_General_CI_AS NULL,
    Groupid varchar(10) COLLATE Latin1_General_CI_AS NULL,
    GroupName varchar(100) COLLATE Latin1_General_CI_AS NOT NULL,
    Clasified varchar(100) COLLATE Latin1_General_CI_AS NOT NULL,
    AddBy varchar(10) COLLATE Latin1_General_CI_AS NOT NULL,
    Status varchar(100) COLLATE Latin1_General_CI_AS NOT NULL,
    DocumentStatusId int NOT NULL,
    AccountPlanningAddon datetime NULL,
    AccountPlanningPublish datetime NULL,
    IsMain bit NULL,
    CheckerPn varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
    SignerPn varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
    [Year] varchar(4) COLLATE Latin1_General_CI_AS NOT NULL,
    ProgressCompanyInformation decimal(13,2) NULL,
    ProgressBriStartingPosition decimal(13,2) NULL,
    ProgressClientNeeds decimal(13,2) NULL,
    ProgressActionPlan decimal(13,2) NULL,
    ProgressSimulationsCpa decimal(13,2) NULL,
    ProgressTotal decimal(13,2) NULL,
    RMName varchar(255) COLLATE Latin1_General_CI_AS NULL,
    [Member] varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
    VCIFList varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
    Uker int NULL,
    CONSTRAINT PK_Monitori_139242E87601D1A7 PRIMARY KEY (MonitoringAccountPlanningId)
) GO


SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}
	echo "Create Table MonitoringAccountPlanning done\n";
?>