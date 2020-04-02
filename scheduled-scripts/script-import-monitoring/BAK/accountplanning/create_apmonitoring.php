<?php
	echo "Create Table MonitoringAccountPlanning begin\n";
	$sql = <<<SQL
			SET ANSI_NULLS ON

            SET QUOTED_IDENTIFIER ON

            SET ANSI_PADDING ON

            CREATE TABLE [dbo].[MonitoringAccountPlanning](
                [MonitoringAccountPlanningId] [int] IDENTITY(1,1) NOT NULL,
                [AccountPlanningId] [int] NOT NULL,
                [Vcif] [varchar](10) NOT NULL,
                [CustomerName] [varchar](100) NOT NULL,
                [SektorUsaha] [varchar](100) NULL,
                [Groupid] [varchar](10) NULL,
                [Cif] [varchar](max) NOT NULL,
                [GroupName] [varchar](100) NOT NULL,
                [Clasified] [varchar](100) NOT NULL,
                [DocumentStatusId] [int] NOT NULL,
                [Status] [varchar](100) NOT NULL,
                [AccountPlanningAddon] [datetime] NULL,
                [AccountPlanningPublish] [datetime] NULL,
                [IsMain] [bit] NULL,
                [CheckerPn] [varchar](max) NULL,
                [SignerPn] [varchar](max) NULL,
                [Year] [varchar](4) NOT NULL,
                [Uker] [int] NULL,
                [RmId] [varchar](10) NULL,
                [RMName] [varchar](255) NULL,
                [Member] [varchar](max) NULL,
                [ProgressCompanyInformation] [decimal] (13,2) NULL,
                [ProgressBriStartingPosition] [decimal] (13,2) NULL,
                [ProgressClientNeeds] [decimal] (13,2) NULL,
                [ProgressActionPlan] [decimal] (13,2) NULL,
                [ProgressSimulationsCpa] [decimal] (13,2) NULL,
                [ProgressTotal] [decimal] (13,2) NULL,
            PRIMARY KEY CLUSTERED 
            (
                [MonitoringAccountPlanningId] ASC
            )WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
            ) ON [PRIMARY]

            SET ANSI_PADDING OFF

SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}
	echo "Create Table MonitoringAccountPlanning done\n";
?>