USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[Ews]    Script Date: 9/5/2019 10:45:53 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Ews](
	[EwsId] [int] IDENTITY(1,1) NOT NULL,
	[EwsName] [varchar](50) NOT NULL,
	[EwsColorCode] [varchar](10) NULL,
PRIMARY KEY CLUSTERED 
(
	[EwsId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Ews] ON 

INSERT [dbo].[Ews] ([EwsId], [EwsName], [EwsColorCode]) VALUES (1, N'Merah', N'E74545')
INSERT [dbo].[Ews] ([EwsId], [EwsName], [EwsColorCode]) VALUES (2, N'Kuning', N'FFEF9D')
INSERT [dbo].[Ews] ([EwsId], [EwsName], [EwsColorCode]) VALUES (3, N'Hijau', N'62D159')
SET IDENTITY_INSERT [dbo].[Ews] OFF
