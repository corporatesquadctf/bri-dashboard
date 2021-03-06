USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[PipelineDetailSuplecyFacility]    Script Date: 9/5/2019 2:38:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PipelineDetailSuplecyFacility](
	[PipelineDetailSuplecyFacility] [int] IDENTITY(1,1) NOT NULL,
	[PipelineId] [int] NOT NULL,
	[FacilityId] [int] NOT NULL,
	[PlafondExisting] [decimal](22, 2) NOT NULL,
	[PlafondSuplecy] [decimal](22, 2) NOT NULL,
	[CreatedBy] [varchar](10) NOT NULL,
	[CreatedDate] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineDetailSuplecyFacility] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[PipelineDetailSuplecyFacility] ON 

INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (3, 5, 2, CAST(15000000000.00 AS Decimal(22, 2)), CAST(25000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800AD0304 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (6, 9, 2, CAST(40000000000.00 AS Decimal(22, 2)), CAST(40000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800AE3990 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (9, 10, 1, CAST(55800000000.00 AS Decimal(22, 2)), CAST(75000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800B225DC AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (10, 10, 4, CAST(50000000000.00 AS Decimal(22, 2)), CAST(60000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB800B225DC AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (11, 7, 2, CAST(40000000000.00 AS Decimal(22, 2)), CAST(40000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BAD86C AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (12, 4, 2, CAST(40000000000.00 AS Decimal(22, 2)), CAST(40000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BB6F98 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (14, 2, 4, CAST(75000000000.00 AS Decimal(22, 2)), CAST(75000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800BF25FC AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (15, 18, 2, CAST(27900000000.00 AS Decimal(22, 2)), CAST(27900000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB800F638D0 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (17, 23, 3, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900B2D928 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (18, 25, 4, CAST(75000000000.00 AS Decimal(22, 2)), CAST(75000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900B39E08 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (19, 27, 1, CAST(90000000000.00 AS Decimal(22, 2)), CAST(100000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900B417E8 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (20, 27, 4, CAST(75000000000.00 AS Decimal(22, 2)), CAST(30000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900B417E8 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (21, 28, 1, CAST(80000000000.00 AS Decimal(22, 2)), CAST(90000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB900BA0324 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (22, 30, 1, CAST(35000000000.00 AS Decimal(22, 2)), CAST(35000000000.00 AS Decimal(22, 2)), 256, CAST(0x0000AAB900EE0854 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (23, 31, 1, CAST(40000000000.00 AS Decimal(22, 2)), CAST(40000000000.00 AS Decimal(22, 2)), 255, CAST(0x0000AAB900EE2B7C AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (24, 20, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 268, CAST(0x0000AAB900FA5780 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (27, 35, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AAB901068E10 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (28, 37, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(40000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABC010434E4 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (30, 39, 1, CAST(34000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABC0109E45C AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (31, 38, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(30000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABD00B33CC4 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (33, 41, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE00C6DA40 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (34, 42, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE00F497A0 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (35, 43, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 239, CAST(0x0000AABE00F5E6C8 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (36, 44, 1, CAST(50000000000.00 AS Decimal(22, 2)), CAST(50000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE01003830 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (37, 45, 2, CAST(40000000000.00 AS Decimal(22, 2)), CAST(200000000000.00 AS Decimal(22, 2)), 238, CAST(0x0000AABE0101E644 AS DateTime))
INSERT [dbo].[PipelineDetailSuplecyFacility] ([PipelineDetailSuplecyFacility], [PipelineId], [FacilityId], [PlafondExisting], [PlafondSuplecy], [CreatedBy], [CreatedDate]) VALUES (38, 46, 1, CAST(35000000000.00 AS Decimal(22, 2)), CAST(40000000000.00 AS Decimal(22, 2)), 263, CAST(0x0000AABF00A61D00 AS DateTime))
SET IDENTITY_INSERT [dbo].[PipelineDetailSuplecyFacility] OFF
