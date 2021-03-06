USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[PipelineStatus]    Script Date: 9/5/2019 11:34:30 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PipelineStatus](
	[PipelineStatusId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineStatusName] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineStatusId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[PipelineStatus] ON 

INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (1, N'Draft')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (2, N'Disubmit')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (3, N'Menunggu Persetujuan')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (4, N'Disetujui')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (5, N'Ditolak')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (6, N'Diproses')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (7, N'Dibatalkan')
INSERT [dbo].[PipelineStatus] ([PipelineStatusId], [PipelineStatusName]) VALUES (8, N'Ditunda')
SET IDENTITY_INSERT [dbo].[PipelineStatus] OFF
