USE [dashboard-bri]
GO
/****** Object:  Table [dbo].[PipelineFacilityValues]    Script Date: 7/30/2019 9:46:40 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PipelineFacilityValues](
	[PipelineFacilityValuesId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineId] [int] NULL,
	[PipelineFacilityId] [int] NULL,
	[PipelineFacilityValue] [decimal](22, 2) NULL,
	[CreatedBy] [int] NULL,
	[CreatedDate] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineFacilityValuesId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[PipelineLogActivity]    Script Date: 7/30/2019 9:46:40 AM ******/
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
	[CreatedBy] [int] NULL,
	[CreatedDate] [datetime] NULL,
 CONSTRAINT [PK__Pipeline__BA281D0074943FD1] PRIMARY KEY CLUSTERED 
(
	[PipelineLogActivityId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
