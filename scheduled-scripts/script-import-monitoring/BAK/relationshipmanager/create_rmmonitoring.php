<?php
	echo "Create Table MonitoringRm begin\n";
	$sql = <<<SQL
			SET ANSI_NULLS ON

            SET QUOTED_IDENTIFIER ON

            SET ANSI_PADDING ON

            CREATE TABLE [dbo].[MonitoringRm](
                [MonitoringRmId] [int] IDENTITY(1,1) NOT NULL,
                [PersonalNumber] [varchar](10) NOT NULL,
                [RmName] [varchar](100) NOT NULL,
                [Division] [varchar](100) NULL,
                [LastActivity] [datetime] NULL,
                [Year] [varchar](4) NULL,
                [AccountPlanningTotal] [varchar](100) NULL,
                [AccountPlanningList] [varchar](max) NULL,
                [AccountPlanningPublish] [varchar](10) NULL,
                [AccountPlanningWa] [varchar](10) NULL,
                [AccountPlanningDraft] [varchar](10) NULL,
                [AccountPlanningReject] [varchar](10) NULL,
                [AccountPlanningProgress] [decimal](13,2) NULL,
            PRIMARY KEY CLUSTERED 
            (
                [MonitoringRmId] ASC
            )WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
            ) ON [PRIMARY]

            SET ANSI_PADDING OFF

SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}
	echo "Create Table MonitoringRm done\n";
?>