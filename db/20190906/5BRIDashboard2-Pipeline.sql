USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[Pipeline]    Script Date: 9/5/2019 11:18:42 AM ******/
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
	[BulanRealisasi] [int] NULL,
	[SubmittedDate] [datetime] NULL,
	[CreatedBy] [varchar](10) NULL,
	[CreatedDate] [datetime] NOT NULL,
	[ModifiedBy] [varchar](10) NULL,
	[ModifiedDate] [datetime] NULL,
 CONSTRAINT [PK__Pipeline__DD42434FE69A7F55] PRIMARY KEY CLUSTERED 
(
	[PipelineId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Pipeline] ADD  CONSTRAINT [DF__PIPELINE__CREATE__5F7E2DAC]  DEFAULT (getdate()) FOR [CreatedDate]
GO
