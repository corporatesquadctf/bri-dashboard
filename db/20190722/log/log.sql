USE [dashboard-bri]
GO

/****** Object:  Table [dbo].[LogImport]    Script Date: 22/07/2019 19:57:57 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[LogImport](
	[LogImportId] [int] IDENTITY(1,1) NOT NULL,
	[CreatedDate] [datetime] NOT NULL,
	[ProcedureName] [varchar](100) NOT NULL,
	[IsSuccess] [bit] NOT NULL,
	[LogTypeId] [int] NOT NULL,
	[ProcedureType] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[LogImportId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


/****** Object:  Table [dbo].[LogTypes]    Script Date: 22/07/2019 19:58:41 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[LogTypes](
	[LogTypesId] [int] IDENTITY(1,1) NOT NULL,
	[LogTypes] [varchar](100) NOT NULL,
	[IsActive] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[LogTypesId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


SET IDENTITY_INSERT [dbo].[LogImport] ON

INSERT INTO LogImport (LogImportId,CreatedDate,ProcedureName,IsSuccess,LogTypeId,ProcedureType) VALUES 
(1,'2019-07-22 14:16:27.000','Import Monitoring Account Planning',1,1,1)
,(2,'2019-07-22 14:16:29.000','Import Monitoring RM',1,2,1)
,(3,'2019-07-22 14:17:06.000','Import Monitoring Account Planning',1,1,1)
,(4,'2019-07-22 14:17:08.000','Import Monitoring RM',1,2,1)
,(5,'2019-07-22 14:19:14.000','Import Monitoring Account Planning',0,1,1)
,(6,'2019-07-22 14:19:17.000','Import Monitoring RM',1,2,1)
,(7,'2019-07-22 14:25:28.000','Import Monitoring Account Planning',1,1,1)
,(8,'2019-07-22 14:25:30.000','Import Monitoring RM',1,2,1)
,(9,'2019-07-22 14:40:45.000','Import Monitoring Account Planning',1,1,1)
,(10,'2019-07-22 14:40:47.000','Import Monitoring RM',1,2,1)
;
INSERT INTO LogImport (LogImportId,CreatedDate,ProcedureName,IsSuccess,LogTypeId,ProcedureType) VALUES 
(11,'2019-07-22 14:42:51.000','Import Monitoring Account Planning',1,1,1)
,(12,'2019-07-22 14:42:53.000','Import Monitoring RM',1,2,1)
;

SET IDENTITY_INSERT [dbo].[LogImport] OFF


SET IDENTITY_INSERT [dbo].[LogTypes] ON

INSERT INTO LogTypes (LogTypesId,LogTypes,IsActive) VALUES 
(1,'Import Account Planning',1)
,(2,'Import RM',1)
;

SET IDENTITY_INSERT [dbo].[LogImport] OFF

