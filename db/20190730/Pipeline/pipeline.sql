USE [dashboard-bri]
GO
ALTER TABLE [dbo].[Pipeline] DROP CONSTRAINT [DF__PIPELINE__CREATE__5F7E2DAC]
GO
/****** Object:  Table [dbo].[Pipeline]    Script Date: 7/30/2019 9:45:14 AM ******/
DROP TABLE [dbo].[Pipeline]
GO
/****** Object:  Table [dbo].[Pipeline]    Script Date: 7/30/2019 9:45:14 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Pipeline](
	[PipelineId] [int] IDENTITY(1,1) NOT NULL,
	[DataSourceId] [int] NULL,
	[CIFId] [varchar](10) NULL,
	[CustomerMenengahTypeId] [int] NULL,
	[CustomerName] [varchar](50) NULL,
	[NPWP] [varchar](50) NULL,
	[Address] [varchar](255) NULL,
	[ContactPerson] [varchar](50) NULL,
	[PhoneNumber] [varchar](50) NULL,
	[EWSStatus] [int] NULL,
	[BusinessType] [varchar](50) NULL,
	[BusinessSector] [int] NULL,
	[EconomySubSector] [int] NULL,
	[LPGStatus] [int] NULL,
	[CustomerStatusId] [int] NULL,
	[Plafond] [numeric](19, 2) NULL,
	[CustomerResouceId] [int] NULL,
	[TDBResourceId] [int] NULL,
	[LayerStatusId] [int] NULL,
	[StatusId] [int] NULL,
	[SubmittedDate] [datetime] NULL,
	[CreatedBy] [int] NULL,
	[CreatedDate] [datetime] NOT NULL,
	[ModifiedBy] [int] NULL,
	[ModifiedDate] [datetime] NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Pipeline] ADD  CONSTRAINT [DF__PIPELINE__CREATE__5F7E2DAC]  DEFAULT (getdate()) FOR [CreatedDate]
GO
