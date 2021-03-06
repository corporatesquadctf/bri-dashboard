USE [dashboard-bri]
GO
/****** Object:  Table [dbo].[MODULE]    Script Date: 7/12/2019 11:43:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MODULE](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[MODULE_NAME] [nchar](50) NULL,
	[MODULE_PATH] [varchar](255) NULL,
	[MODULE_STATUS] [nchar](50) NULL,
	[MODULE_TYPE] [int] NULL,
	[STATUS] [bit] NULL,
	[ADDON] [datetime] NULL,
	[ADBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODYBY] [int] NULL,
	[ENVIRONMENT] [varchar](50) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[MODULE] ON 

INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (1, N'Executive Summary                                 ', N'performance/exec_summary', NULL, 1, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (2, N'Segment Client By Profit                          ', N'perform/segment', NULL, 1, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (3, N'Top and Bottom                                    ', N'performance/topbottom', NULL, 1, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (4, N'Customer Leaderboard                              ', N'perform/customerleaderboards', NULL, 1, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (5, N'RM Leaderboard                                    ', N'perform/rmleaderboards', NULL, 1, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (6, N'Monitoring                                        ', N'report/monitoring', NULL, 2, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (7, N'Timeseries                                        ', N'report/timeseries', NULL, 2, 1, NULL, NULL, NULL, NULL, N'both')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (8, N'User                                              ', N'admin/user_management/user', NULL, 3, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (9, N'Access Role                                       ', N'admin/user_management/access', NULL, 3, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (10, N'Role                                              ', N'admin/user_management/role', NULL, 3, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (11, N'Menu                                              ', N'admin/user_management/menu', NULL, 3, 0, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (12, N'Eskalasi                                          ', N'admin/configuration/escalation', NULL, 5, 0, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (13, N'Delegasi                                          ', N'admin/configuration/delegation', NULL, 5, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (14, N'Divisions                                         ', N'admin/divisions', NULL, 4, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (15, N'Banks                                             ', N'admin/banks', NULL, 4, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (16, N'Parameter                                         ', N'admin/classifications', NULL, 4, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (17, N'Financial Highlights                              ', N'admin/financialgroups', NULL, 4, 0, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (18, N'Banking Facilities                                ', N'admin/bankfacilities', NULL, 4, 0, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (19, N'Division Relation                                 ', N'admin/divisionrelation', NULL, 4, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (20, N'Customers                                         ', N'admin/customer', NULL, 4, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (21, N'Log                                               ', N'report/log', NULL, 2, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (22, N'Relationship Manager                              ', N'monitoring/rmmonitoring', NULL, 6, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (23, N'Account Planning                                  ', N'monitoring/apmonitoring', NULL, 6, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (24, N'Draft List                                        ', N'pipeline/draft_pipeline', NULL, 7, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (25, N'Submitted List                                    ', N'pipeline/submitted_pipeline', NULL, 7, 1, NULL, NULL, NULL, NULL, N'intranet')
INSERT [dbo].[MODULE] ([ID], [MODULE_NAME], [MODULE_PATH], [MODULE_STATUS], [MODULE_TYPE], [STATUS], [ADDON], [ADBY], [MODION], [MODYBY], [ENVIRONMENT]) VALUES (26, N'History                                           ', N'pipeline/history_pipeline', NULL, 7, 1, NULL, NULL, NULL, NULL, N'intranet')
SET IDENTITY_INSERT [dbo].[MODULE] OFF
