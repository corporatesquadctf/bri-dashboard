USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[Facility]    Script Date: 9/5/2019 1:39:01 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Facility](
	[FacilityId] [int] IDENTITY(1,1) NOT NULL,
	[FacilityShortName] [varchar](10) NULL,
	[FacilityName] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[FacilityId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Facility] ON 

INSERT [dbo].[Facility] ([FacilityId], [FacilityShortName], [FacilityName]) VALUES (1, N'KMK', N'Kredit Modal Kerja')
INSERT [dbo].[Facility] ([FacilityId], [FacilityShortName], [FacilityName]) VALUES (2, N'KI', N'Kredit Investasi')
INSERT [dbo].[Facility] ([FacilityId], [FacilityShortName], [FacilityName]) VALUES (3, N'BG', N'Bank Garansi')
INSERT [dbo].[Facility] ([FacilityId], [FacilityShortName], [FacilityName]) VALUES (4, N'LC', N'Letter of Credit')
INSERT [dbo].[Facility] ([FacilityId], [FacilityShortName], [FacilityName]) VALUES (5, N'SKBDN', N'SKBDN')
SET IDENTITY_INSERT [dbo].[Facility] OFF
