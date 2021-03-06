USE [CPA_KORPORASI_DEV_7]
GO
ALTER TABLE [dbo].[FinancialHighlightItem] DROP CONSTRAINT [FK_FHItem_FHGroup]
GO
ALTER TABLE [dbo].[FinancialHighlightItem] DROP CONSTRAINT [DF__Financial__IsAct__00200768]
GO
/****** Object:  Table [dbo].[FinancialHighlightItem]    Script Date: 29/01/2020 12:29:32 PM ******/
DROP TABLE [dbo].[FinancialHighlightItem]
GO
/****** Object:  Table [dbo].[FinancialHighlightItem]    Script Date: 29/01/2020 12:29:32 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[FinancialHighlightItem](
	[FinancialHighlightItemId] [int] IDENTITY(1,1) NOT NULL,
	[FinancialHighlightGroupId] [int] NULL,
	[Name] [varchar](100) NOT NULL,
	[Description] [varchar](max) NULL,
	[IsActive] [int] NOT NULL,
	[CreatedDate] [datetime] NULL,
	[CreatedBy] [varchar](10) NULL,
	[ModifiedDate] [datetime] NULL,
	[ModifiedBy] [varchar](10) NULL,
 CONSTRAINT [PK__Financia__41BAEF93E40E9629] PRIMARY KEY CLUSTERED 
(
	[FinancialHighlightItemId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[FinancialHighlightItem] ON 

INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (1, 1, N'Current Assets', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (2, 1, N'Fixed Assets', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (3, 1, N'Total Assets', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (4, 1, N'Short-term Liabilities', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (5, 1, N'Long-term Liabilities', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (6, 1, N'Equity', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (7, 2, N'Sales', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (8, 2, N'COGS', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (9, 2, N'Operating Profit', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (10, 2, N'Gross Profit', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (11, 2, N'Net Profit', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (12, 3, N'Current Ratio (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (13, 3, N'Quick Ratio (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (14, 3, N'NWC', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (15, 4, N'DOI', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (16, 4, N'DOR', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (17, 4, N'DOP', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (18, 5, N'Operating Margin (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (19, 5, N'Net Profit Margin (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (20, 5, N'Return on Assets (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (21, 6, N'Debt to Equity Ratio (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (22, 6, N'Debt to Total Asset Ratio  (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (23, 6, N'Interest Coverage Ratio (%)', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (24, 6, N'EBITDA', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (25, 6, N'DSCR', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (26, 1, N'Property Plan Equipment', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (27, 1, N'Cash Flow From Operation', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (28, 1, N'Depreciation', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[FinancialHighlightItem] ([FinancialHighlightItemId], [FinancialHighlightGroupId], [Name], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (29, 2, N'SGA', NULL, 1, CAST(0x0000A8BE018A077C AS DateTime), NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[FinancialHighlightItem] OFF
ALTER TABLE [dbo].[FinancialHighlightItem] ADD  DEFAULT ((1)) FOR [IsActive]
GO
ALTER TABLE [dbo].[FinancialHighlightItem]  WITH CHECK ADD  CONSTRAINT [FK_FHItem_FHGroup] FOREIGN KEY([FinancialHighlightGroupId])
REFERENCES [dbo].[FinancialHighlightGroup] ([FinancialHighlightGroupId])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[FinancialHighlightItem] CHECK CONSTRAINT [FK_FHItem_FHGroup]
GO
