USE [BRIDashboard10]
GO
/****** Object:  Table [dbo].[FacilityDetail]    Script Date: 9/12/2019 2:49:42 PM ******/
DROP TABLE [dbo].[FacilityDetail]
GO
/****** Object:  Table [dbo].[FacilityDetail]    Script Date: 9/12/2019 2:49:42 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[FacilityDetail](
	[FacilityDetailId] [int] IDENTITY(1,1) NOT NULL,
	[CIF] [varchar](10) NOT NULL,
	[FacilityId] [int] NOT NULL,
	[Plafond] [decimal](22, 2) NOT NULL
) ON [PRIMARY]
SET ANSI_PADDING ON
ALTER TABLE [dbo].[FacilityDetail] ADD [NoRekening] [varchar](255) NULL
PRIMARY KEY CLUSTERED 
(
	[FacilityDetailId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[FacilityDetail] ON 

INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (1, N'AKE8615', 1, CAST(50000000000.00 AS Decimal(22, 2)), N'20601100000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (2, N'AKE8616', 2, CAST(10000000000.00 AS Decimal(22, 2)), N'32501500000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (3, N'AKE8617', 3, CAST(15000000000.00 AS Decimal(22, 2)), N'3001020000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (4, N'APP5552', 1, CAST(35000000000.00 AS Decimal(22, 2)), N'40401000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (5, N'BL35201', 1, CAST(40000000000.00 AS Decimal(22, 2)), N'13001000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (6, N'BL35202', 2, CAST(15000000000.00 AS Decimal(22, 2)), N'9101010000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (7, N'BL35203', 3, CAST(5000000000.00 AS Decimal(22, 2)), N'216201000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (8, N'DES7480', 1, CAST(50000000000.00 AS Decimal(22, 2)), N'16801000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (9, N'DES7481', 3, CAST(50000000000.00 AS Decimal(22, 2)), N'221501000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (10, N'DES7483', 1, CAST(35000000000.00 AS Decimal(22, 2)), N'63201500000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (11, N'DES7483', 5, CAST(25800000000.00 AS Decimal(22, 2)), N'51201000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (12, N'DES7484', 2, CAST(40000000000.00 AS Decimal(22, 2)), N'216801000000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (13, N'DES7485', 3, CAST(45500000000.00 AS Decimal(22, 2)), N'12901500000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (14, N'DES7488', 1, CAST(50000000000.00 AS Decimal(22, 2)), N'30201500000000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (15, N'DES7490', 3, CAST(15000000000.00 AS Decimal(22, 2)), N'2391023912391')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (16, N'DES7491', 2, CAST(28000000000.00 AS Decimal(22, 2)), N'29310582383123')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (17, N'DES7492', 1, CAST(80000000000.00 AS Decimal(22, 2)), N'89342048239123')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (18, N'DES7493', 1, CAST(40000000000.00 AS Decimal(22, 2)), N'87213957392134')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (19, N'DES7494', 2, CAST(15000000000.00 AS Decimal(22, 2)), N'923723910000')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (20, N'DES7496', 2, CAST(10000000000.00 AS Decimal(22, 2)), N'82371923902311')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (21, N'DES7496', 3, CAST(7000000000.00 AS Decimal(22, 2)), N'6238931239423')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (22, N'DES7496', 1, CAST(34000000000.00 AS Decimal(22, 2)), N'9123793482391')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (23, N'DES7497', 2, CAST(27900000000.00 AS Decimal(22, 2)), N'9123627523513')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (24, N'DES7498', 1, CAST(77000000000.00 AS Decimal(22, 2)), N'52149852347821')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (25, N'DES7499', 4, CAST(50000000000.00 AS Decimal(22, 2)), N'98236891023485')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (26, N'DES7499', 1, CAST(55800000000.00 AS Decimal(22, 2)), N'9123723902572')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (27, N'DES7500', 4, CAST(75000000000.00 AS Decimal(22, 2)), N'12312371239123')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (28, N'DES7500', 1, CAST(90000000000.00 AS Decimal(22, 2)), N'9236823023923')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (29, N'DES7501', 2, CAST(69000000000.00 AS Decimal(22, 2)), N'82368593274523')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (30, N'H681321', 4, CAST(75000000000.00 AS Decimal(22, 2)), N'91237348859230')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (31, N'KFC5368', 1, CAST(34000000000.00 AS Decimal(22, 2)), N'712389123882')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (32, N'KT86315', 3, CAST(45500000000.00 AS Decimal(22, 2)), N'42389345235122')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (33, N'L558145', 3, CAST(50000000000.00 AS Decimal(22, 2)), N'62361237235423')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (34, N'LB42113', 2, CAST(29000000000.00 AS Decimal(22, 2)), N'81237213882636')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (35, N'MJT8814', 4, CAST(50000000000.00 AS Decimal(22, 2)), N'72361237712371')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (36, N'MLS7543', 1, CAST(31000000000.00 AS Decimal(22, 2)), N'12361238238238')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (37, N'NDD4676', 5, CAST(25800000000.00 AS Decimal(22, 2)), N'62138123812323')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (38, N'PM27550', 1, CAST(38000000000.00 AS Decimal(22, 2)), N'61238123921392')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (39, N'PQ67041', 2, CAST(27900000000.00 AS Decimal(22, 2)), N'15237238238123')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (40, N'PY89761', 2, CAST(28000000000.00 AS Decimal(22, 2)), N'66123812381238')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (41, N'PY98631', 1, CAST(40000000000.00 AS Decimal(22, 2)), N'71237123812382')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (42, N'SGCI595', 1, CAST(29800000000.00 AS Decimal(22, 2)), N'93459350123912')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (43, N'WJ41792', 2, CAST(40000000000.00 AS Decimal(22, 2)), N'812391239999123')
INSERT [dbo].[FacilityDetail] ([FacilityDetailId], [CIF], [FacilityId], [Plafond], [NoRekening]) VALUES (44, N'Y977480', 1, CAST(50000000000.00 AS Decimal(22, 2)), N'12312321383453')
SET IDENTITY_INSERT [dbo].[FacilityDetail] OFF
