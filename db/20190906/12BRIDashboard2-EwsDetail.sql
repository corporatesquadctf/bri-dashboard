USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[EwsDetail]    Script Date: 9/5/2019 2:05:19 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[EwsDetail](
	[EwsDetailId] [int] IDENTITY(1,1) NOT NULL,
	[CIF] [varchar](10) NOT NULL,
	[EwsId] [varchar](10) NULL,
PRIMARY KEY CLUSTERED 
(
	[EwsDetailId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[EwsDetail] ON 

INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (1, N'Y977480', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (2, N'L558145', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (3, N'H681321', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (4, N'APP5552', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (5, N'WJ41792', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (6, N'KT86315', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (7, N'MJT8814', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (8, N'NDD4676', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (9, N'AKE8615', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (10, N'PY89761', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (11, N'PY98631', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (12, N'BL35201', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (13, N'KFC5368', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (14, N'PQ67041', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (15, N'PM27550', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (16, N'SGCI595', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (17, N'MLS7543', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (18, N'LB42113', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (19, N'DES7480', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (20, N'DES7481', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (21, N'DES7500', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (22, N'DES7483', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (23, N'DES7484', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (24, N'DES7485', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (25, N'DES7499', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (26, N'DES7488', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (27, N'DES7496', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (28, N'DES7490', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (29, N'DES7491', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (30, N'DES7492', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (31, N'DES7493', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (32, N'DES7494', N'2')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (33, N'DES7497', N'1')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (34, N'DES7498', N'3')
INSERT [dbo].[EwsDetail] ([EwsDetailId], [CIF], [EwsId]) VALUES (35, N'DES7501', N'3')
SET IDENTITY_INSERT [dbo].[EwsDetail] OFF
