USE [CPA_KORPORASI_DEV]
GO
/****** Object:  Table [dbo].[Regional]    Script Date: 11/5/2019 11:17:29 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Regional](
	[RegionalId] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](100) NULL,
	[Description] [varchar](255) NULL,
	[IsActive] [int] NOT NULL,
	[CreatedDate] [datetime] NULL,
	[CreatedBy] [varchar](100) NULL,
	[ModifiedDate] [datetime] NULL,
	[ModifiedBy] [varchar](100) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Regional] ON 

INSERT [dbo].[Regional] ([RegionalId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (1, N'Pusat', N'Regional untuk role-role user di regional Pusat', 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Regional] ([RegionalId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (2, N'Wilayah', N'Regional untuk role-role user di regional Wilayah', 1, NULL, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Regional] OFF
