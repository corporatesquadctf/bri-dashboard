<?php
	echo "Create Table MonitoringRm begin\n";
	$sql = <<<SQL

-- Drop table

-- DROP TABLE CPA_KORPORASI_DEV.dbo.MonitoringRm GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.MonitoringRm (
    MonitoringRmId int IDENTITY(1,1) NOT NULL,
    PersonalNumber varchar(10) COLLATE Latin1_General_CI_AS NOT NULL,
    RmName varchar(100) COLLATE Latin1_General_CI_AS NOT NULL,
    Division varchar(100) COLLATE Latin1_General_CI_AS NULL,
    LastActivity datetime NULL,
    [Year] varchar(4) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningTotal varchar(100) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningList varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningPublish varchar(10) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningWa varchar(10) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningDraft varchar(10) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningReject varchar(10) COLLATE Latin1_General_CI_AS NULL,
    AccountPlanningProgress decimal(13,2) NULL,
    CONSTRAINT PK_Monitori_7AE79EF1FA161085 PRIMARY KEY (MonitoringRmId)
) GO


SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}
	echo "Create Table MonitoringRm done\n";
?>