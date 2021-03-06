USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[PipelineDataSource]    Script Date: 9/5/2019 11:37:09 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PipelineDataSource](
	[PipelineDataSourceId] [int] IDENTITY(1,1) NOT NULL,
	[DataSourceName] [varchar](50) NULL,
	[IsActive] [bit] NULL,
	[CreatedDate] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineDataSourceId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[PipelineDataSource] ON 

INSERT [dbo].[PipelineDataSource] ([PipelineDataSourceId], [DataSourceName], [IsActive], [CreatedDate]) VALUES (1, N'Baru', 1, NULL)
INSERT [dbo].[PipelineDataSource] ([PipelineDataSourceId], [DataSourceName], [IsActive], [CreatedDate]) VALUES (2, N'Suplesi', 1, NULL)
INSERT [dbo].[PipelineDataSource] ([PipelineDataSourceId], [DataSourceName], [IsActive], [CreatedDate]) VALUES (3, N'Deplesi', 1, NULL)
SET IDENTITY_INSERT [dbo].[PipelineDataSource] OFF
