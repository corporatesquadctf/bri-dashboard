USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[PipelineDetailNewFacility]    Script Date: 9/5/2019 2:39:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PipelineDetailNewFacility](
	[PipelineDetailNewFacilityId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineId] [int] NULL,
	[FacilityId] [int] NULL,
	[Plafond] [decimal](22, 2) NULL,
	[CreatedBy] [varchar](10) NULL,
	[CreatedDate] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineDetailNewFacilityId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[PipelineDetailNewFacility] ON 

INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (1, 1, 2, CAST(200000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800AB4104 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (2, 1, 3, CAST(50000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800AB4104 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (3, 1, 1, CAST(75000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800AB4104 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (6, 3, 1, CAST(50000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AC8348 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (7, 3, 3, CAST(25000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AC8348 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (9, 5, 1, CAST(45000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AD0304 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (11, 6, 1, CAST(75000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AD8D4C AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (12, 6, 4, CAST(50000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AD8D4C AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (14, 8, 1, CAST(55000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AE1B18 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (15, 8, 5, CAST(15000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AE1B18 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (16, 9, 3, CAST(50000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800AE3990 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (19, 11, 2, CAST(80000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800B595F0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (20, 11, 1, CAST(15000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800B595F0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (23, 13, 1, CAST(80000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800B8ABC8 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (24, 7, 2, CAST(100000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BAD86C AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (25, 4, 3, CAST(50000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BB6F98 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (28, 2, 1, CAST(10000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BF25FC AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (29, 2, 2, CAST(5000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BF25FC AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (44, 16, 1, CAST(26000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800EE4D78 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (45, 16, 3, CAST(8500000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800EE4D78 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (46, 16, 2, CAST(1000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800EE4D78 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (47, 12, 1, CAST(10000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800EF6460 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (48, 12, 2, CAST(16000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800EF6460 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (49, 17, 3, CAST(55000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800F15090 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (50, 18, 1, CAST(40000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800F638D0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (51, 18, 3, CAST(5000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800F638D0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (54, 19, 1, CAST(50000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB900AF0C80 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (55, 19, 3, CAST(10000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB900AF0C80 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (58, 22, 1, CAST(100000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900B21DA8 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (59, 23, 2, CAST(75000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900B2D928 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (60, 24, 1, CAST(70000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900B2E4E0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (61, 25, 3, CAST(25000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900B39E08 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (62, 26, 1, CAST(40000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900B3A63C AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (63, 26, 2, CAST(20000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900B3A63C AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (64, 28, 2, CAST(10000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB900BA0324 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (65, 29, 3, CAST(15000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB900BD33F0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (66, 29, 1, CAST(45000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB900BD33F0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (67, 30, 2, CAST(5000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB900EE0854 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (68, 31, 2, CAST(35000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900EE2B7C AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (70, 33, 1, CAST(100000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900F15090 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (73, 32, 1, CAST(50000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB900F55DAC AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (75, 34, 1, CAST(75000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900F6F0CC AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (76, 20, 3, CAST(25000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900FA5780 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (79, 35, 3, CAST(10000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB901068E10 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (80, 40, 1, CAST(50000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABD009FCAA4 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (81, 21, 3, CAST(50000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AABD010F47A8 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (83, 41, 1, CAST(1000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE00C6DA40 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (84, 42, 1, CAST(9000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE00F497A0 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (85, 44, 1, CAST(90909090900.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE01003830 AS DateTime))
INSERT [dbo].[PipelineDetailNewFacility] ([PipelineDetailNewFacilityId], [PipelineId], [FacilityId], [Plafond], [CreatedBy], [CreatedDate]) VALUES (86, 46, 2, CAST(10000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AABF00A61D00 AS DateTime))
SET IDENTITY_INSERT [dbo].[PipelineDetailNewFacility] OFF
