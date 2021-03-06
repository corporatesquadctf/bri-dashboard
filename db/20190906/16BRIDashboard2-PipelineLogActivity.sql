USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[PipelineLogActivity]    Script Date: 9/5/2019 2:47:32 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PipelineLogActivity](
	[PipelineLogActivityId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineId] [int] NULL,
	[PipelineLayerStatusId] [int] NULL,
	[PipelineStatusId] [int] NULL,
	[Comment] [varchar](255) NULL,
	[CreatedBy] [varchar](10) NULL,
	[CreatedDate] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineLogActivityId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
