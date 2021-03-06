USE [dashboard-bri]
GO
/****** Object:  Table [dbo].[NOTIFICATION]    Script Date: 7/30/2019 9:43:57 AM ******/
DROP TABLE [dbo].[NOTIFICATION]
GO
/****** Object:  Table [dbo].[NOTIFICATION]    Script Date: 7/30/2019 9:43:57 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NOTIFICATION](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[USER_ID] [varchar](10) NULL,
	[PT] [varchar](300) NULL,
	[VCIF] [varchar](10) NULL,
	[COMMENT] [varchar](301) NULL,
	[READ] [bit] NULL,
	[DATA_YEAR] [varchar](4) NULL,
	[ModuleTypeId] [int] NULL,
	[Pages] [varchar](50) NULL,
	[ADDBY] [int] NULL,
	[ADDON] [datetime] NULL,
	[MODIBY] [int] NULL,
	[MODION] [datetime] NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
