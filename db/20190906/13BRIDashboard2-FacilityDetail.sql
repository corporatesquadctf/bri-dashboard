USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[FacilityDetail]    Script Date: 9/5/2019 2:08:51 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[FacilityDetail](
	[FacilityDetailId] [int] IDENTITY(1,1) NOT NULL,
	[CIF] [varchar](10) NOT NULL,
	[FacilityId] [int] NOT NULL,
	[Plafond] [decimal](22, 2) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[FacilityDetailId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[FacilityDetail] ON 

INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (1, N'Y977480', 1, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (2, N'L558145', 3, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (3, N'H681321', 4, CAST(75000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (4, N'APP5552', 1, CAST(35000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (5, N'WJ41792', 2, CAST(40000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (6, N'KT86315', 3, CAST(45500000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (7, N'MJT8814', 4, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (8, N'NDD4676', 5, CAST(25800000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (9, N'AKE8615', 1, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (10, N'AKE8616', 2, CAST(10000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (11, N'AKE8617', 3, CAST(15000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (12, N'PY89761', 2, CAST(28000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (13, N'PY98631', 1, CAST(40000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (14, N'BL35201', 1, CAST(40000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (15, N'BL35202', 2, CAST(15000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (16, N'BL35203', 3, CAST(5000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (17, N'KFC5368', 1, CAST(34000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (18, N'PQ67041', 2, CAST(27900000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (19, N'PM27550', 1, CAST(38000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (20, N'SGCI595', 1, CAST(29800000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (21, N'MLS7543', 1, CAST(31000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (22, N'LB42113', 2, CAST(29000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (23, N'DES7480', 1, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (24, N'DES7481', 3, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (25, N'DES7500', 4, CAST(75000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (26, N'DES7483', 1, CAST(35000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (27, N'DES7484', 2, CAST(40000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (28, N'DES7485', 3, CAST(45500000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (29, N'DES7499', 4, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (30, N'DES7483', 5, CAST(25800000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (31, N'DES7488', 1, CAST(50000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (32, N'DES7496', 2, CAST(10000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (33, N'DES7490', 3, CAST(15000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (34, N'DES7491', 2, CAST(28000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (35, N'DES7492', 1, CAST(80000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (36, N'DES7493', 1, CAST(40000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (37, N'DES7494', 2, CAST(15000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (38, N'DES7496', 3, CAST(7000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (39, N'DES7496', 1, CAST(34000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (40, N'DES7497', 2, CAST(27900000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (41, N'DES7498', 1, CAST(77000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (42, N'DES7499', 1, CAST(55800000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (43, N'DES7500', 1, CAST(90000000000.00 AS Decimal(22, 2)))
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond]) VALUES (44, N'DES7501', 2, CAST(69000000000.00 AS Decimal(22, 2)))
SET IDENTITY_INSERT [dbo].[FacilityDetail] OFF
