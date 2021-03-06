USE [dashboard-bri]
GO
/****** Object:  Table [dbo].[PipelineApprovalLayer]    Script Date: 7/30/2019 9:46:01 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PipelineApprovalLayer](
	[PipelineApprovalLayerId] [int] IDENTITY(1,1) NOT NULL,
	[RoleId] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineApprovalLayerId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[PipelineDataSource]    Script Date: 7/30/2019 9:46:01 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PipelineDataSource](
	[PipelineDataSourceId] [int] IDENTITY(1,1) NOT NULL,
	[DataSourceName] [varchar](50) NULL,
	[IsActive] [bit] NULL,
	[CreatedDate] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineDataSourceId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PipelineFacility]    Script Date: 7/30/2019 9:46:01 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PipelineFacility](
	[PipelineFacilityId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineFacilityShortName] [varchar](10) NULL,
	[PipelineFacilityName] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineFacilityId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PipelineStatus]    Script Date: 7/30/2019 9:46:01 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PipelineStatus](
	[PipelineStatusId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineStatusName] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineStatusId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[PipelineApprovalLayer] ON 

INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (1, 12)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (2, 13)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (3, 14)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (4, 15)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (5, 16)
SET IDENTITY_INSERT [dbo].[PipelineApprovalLayer] OFF
SET IDENTITY_INSERT [dbo].[PipelineDataSource] ON 

INSERT [dbo].[PipelineDataSource] ([PipelineDataSourceId], [DataSourceName], [IsActive], [CreatedDate]) VALUES (1, N'Baru', 1, NULL)
INSERT [dbo].[PipelineDataSource] ([PipelineDataSourceId], [DataSourceName], [IsActive], [CreatedDate]) VALUES (2, N'Suplesi', 1, NULL)
SET IDENTITY_INSERT [dbo].[PipelineDataSource] OFF
SET IDENTITY_INSERT [dbo].[PipelineFacility] ON 

INSERT [dbo].[PipelineFacility] ([PipelineFacilityId], [PipelineFacilityShortName], [PipelineFacilityName]) VALUES (1, N'KMK', N'Kredit Modal Kerja')
INSERT [dbo].[PipelineFacility] ([PipelineFacilityId], [PipelineFacilityShortName], [PipelineFacilityName]) VALUES (2, N'KI', N'Kredit Investasi')
INSERT [dbo].[PipelineFacility] ([PipelineFacilityId], [PipelineFacilityShortName], [PipelineFacilityName]) VALUES (3, N'BG', N'Bank Garansi')
INSERT [dbo].[PipelineFacility] ([PipelineFacilityId], [PipelineFacilityShortName], [PipelineFacilityName]) VALUES (4, N'LC', N'Letter of Credit')
INSERT [dbo].[PipelineFacility] ([PipelineFacilityId], [PipelineFacilityShortName], [PipelineFacilityName]) VALUES (5, N'SKBDN', N'SKBDN')
SET IDENTITY_INSERT [dbo].[PipelineFacility] OFF
SET IDENTITY_INSERT [dbo].[PipelineStatus] ON 

INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (1, N'Draft')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (2, N'Submitted')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (3, N'Waiting For Approval')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (4, N'Approved')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (5, N'Rejected')
SET IDENTITY_INSERT [dbo].[PipelineStatus] OFF
