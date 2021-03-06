USE [CPA_KORPORASI_DEV_7]
GO
ALTER TABLE [dbo].[Module] DROP CONSTRAINT [FK_Module_ModuleEnvironment]
GO
ALTER TABLE [dbo].[Module] DROP CONSTRAINT [DF__Module__IsActive__2BFE89A6]
GO
/****** Object:  Table [dbo].[Module]    Script Date: 21/01/2020 14:58:07 ******/
DROP TABLE [dbo].[Module]
GO
/****** Object:  Table [dbo].[Module]    Script Date: 21/01/2020 14:58:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Module](
	[ModuleId] [int] IDENTITY(1,1) NOT NULL,
	[ModuleTypeId] [int] NULL,
	[ModuleEnvironmentId] [int] NULL,
	[Name] [varchar](100) NOT NULL,
	[Path] [varchar](255) NOT NULL,
	[Description] [varchar](max) NULL,
	[IsActive] [int] NOT NULL,
	[CreatedDate] [datetime] NULL,
	[CreatedBy] [varchar](10) NULL,
	[ModifiedDate] [datetime] NULL,
	[ModifiedBy] [varchar](10) NULL,
 CONSTRAINT [PK__Module__2B7477A79008ACB6] PRIMARY KEY CLUSTERED 
(
	[ModuleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Module] ON 

INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (0, 4, 1, N'Value Chain', N'admin/value_chain', NULL, 1, CAST(0x0000AB2F00000000 AS DateTime), N'admin', NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (1, 1, 3, N'Executive Summary                                 ', N'performance/exec_summary', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (2, 1, 3, N'Segment Client By Profit                          ', N'perform/segment', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (3, 1, 3, N'Top and Bottom                                    ', N'performance/topbottom', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (4, 1, 3, N'Customer Leaderboard                              ', N'perform/customerleaderboards', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (5, 1, 3, N'RM Leaderboard                                    ', N'perform/rmleaderboards', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (6, 2, 3, N'Monitoring                                        ', N'report/monitoring', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (7, 2, 3, N'Timeseries                                        ', N'report/timeseries', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (8, 3, 1, N'User                                              ', N'admin/user_management/user', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (9, 3, 1, N'Access Role                                       ', N'admin/user_management/access', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (10, 3, 1, N'Role                                              ', N'admin/user_management/role', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (11, 3, 1, N'Menu                                              ', N'admin/user_management/menu', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (12, 5, 1, N'Eskalasi                                          ', N'admin/configuration/escalation', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (13, 5, 1, N'Delegasi                                          ', N'admin/configuration/delegation', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (14, 4, 1, N'Divisions                                         ', N'admin/divisions', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (15, 4, 1, N'Banks                                             ', N'admin/banks', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (16, 4, 1, N'Parameter                                         ', N'admin/classifications', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (17, 4, 1, N'Financial Highlights                              ', N'admin/financialgroups', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (18, 4, 1, N'Banking Facilities                                ', N'admin/bankfacilities', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (19, 4, 1, N'Division Relation                                 ', N'admin/divisionrelation', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (20, 4, 1, N'Customers                                         ', N'admin/customer', NULL, 0, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (21, 8, 1, N'Application Log', N'report/log', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (22, 6, 1, N'Relationship Manager                              ', N'monitoring/RelationshipManager', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (23, 6, 1, N'Account Planning                                  ', N'monitoring/AccountPlanning', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (24, 7, 1, N'Draft', N'pipeline/draft', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (25, 7, 1, N'Submitted', N'pipeline/submitted', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (26, 7, 1, N'History                                           ', N'pipeline/history', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (27, 1, 1, N'Customer Leaderboard', N'performance/CustomerLeaderboard', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (28, 8, 1, N'Account Planning Performance Scheduler', N'log/ImportAccountPlanning', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (29, 8, 1, N'Relationship Manager Performance Scheduler', N'log/ImportRm', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (30, 10, 1, N'Disposisi Customer Group', N'tasklist/disposisi', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (31, 9, 1, N'Manage Account Planning', N'tasklist/AccountPlanning', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (32, 9, 1, N'Create Account Planning', N'tasklist/MyTask', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (33, 7, 1, N'Approved', N'pipeline/approved', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (34, 6, 1, N'Proses Kredit', N'monitoring/proseskredit', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (35, 12, 1, N'Account Planning Checker', N'confirmation/Checker', NULL, 1, CAST(0x0000AACF00000000 AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (36, 12, 1, N'Account Planning Signer', N'confirmation/Signer', NULL, 1, CAST(0x0000AACF00000000 AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (37, 9, 1, N'Input Account Planning (CST)', N'tasklist/AccountPlanningCst', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (38, 15, 1, N'Group Company', N'utility/Group', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (39, 15, 1, N'VCIF', N'utility/Vcif', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (40, 15, 1, N'CIF', N'utility/Cif', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (41, 1, 1, N'RM Leaderboard', N'performance/RmLeaderboard', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (42, 1, 1, N'View Account Planning', N'performance/AccountPlanning', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (43, 11, 1, N'Portofolio RM', N'portofolio/portofolioRm', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (44, 10, 1, N'Disposisi Customer Menengah', N'disposisi/account_planning_menengah/disposisi_customer', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (45, 17, 1, N'Create Account Planning Menengah', N'tasklist/account_planning_menengah/create_account_planning', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (46, 17, 1, N'Manage Account Planning Menengah', N'tasklist/account_planning_menengah/manage_account_planning', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (47, 12, 1, N'Account Planning Menengah Approver', N'confirmation/approver', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (48, 4, 1, N'Customer Menengah', N'admin/customer_menengah', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (49, 16, 1, N'Ekonomi Research', N'macro_economy/economy_research', NULL, 1, NULL, NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (52, 1, 1, N'Classified Customer', N'performance/ClassifiedCustomer/view', NULL, 1, NULL, NULL, NULL, N'')
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (53, 18, 1, N'FTP Position', N'ftp/ftp_position', NULL, 1, CAST(0x0000AAEF00000000 AS DateTime), N'admin', NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (54, 19, 1, N'Delegate Account Planning', N'tasklist/delegate', NULL, 1, CAST(0x0000AB1900F5D1B0 AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (55, 4, 1, N'Value Chain', N'admin/value_chain', NULL, 1, CAST(0x0000AB2F00000000 AS DateTime), N'admin', NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (56, 6, 1, N'Portofolio Kredit', N'monitoring/portofolio_kredit', NULL, 1, CAST(0x0000AB2F00000000 AS DateTime), N'admin', NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (57, 4, 1, N'Loan Segment', N'admin/LoanSegment', NULL, 1, CAST(0x0000AB3700000000 AS DateTime), NULL, NULL, NULL)
INSERT [dbo].[Module] ([ModuleId], [ModuleTypeId], [ModuleEnvironmentId], [Name], [Path], [Description], [IsActive], [CreatedDate], [CreatedBy], [ModifiedDate], [ModifiedBy]) VALUES (58, 1, 1, N'Top and Bottom Customer', N'performance/CustomerTopBottom/view', NULL, 1, NULL, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Module] OFF
ALTER TABLE [dbo].[Module] ADD  DEFAULT ((1)) FOR [IsActive]
GO
ALTER TABLE [dbo].[Module]  WITH CHECK ADD  CONSTRAINT [FK_Module_ModuleEnvironment] FOREIGN KEY([ModuleEnvironmentId])
REFERENCES [dbo].[ModuleEnvironment] ([ModuleEnvironmentId])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Module] CHECK CONSTRAINT [FK_Module_ModuleEnvironment]
GO
