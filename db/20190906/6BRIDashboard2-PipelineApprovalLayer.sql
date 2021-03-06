USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[PipelineApprovalLayer]    Script Date: 9/5/2019 11:32:30 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PipelineApprovalLayer](
	[PipelineApprovalLayerId] [int] IDENTITY(1,1) NOT NULL,
	[RoleId] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[PipelineApprovalLayerId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[PipelineApprovalLayer] ON 

INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (1, 12)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (2, 13)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (3, 14)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (4, 15)
INSERT [dbo].[PipelineApprovalLayer] ([PipelineApprovalLayerId], [RoleId]) VALUES (5, 16)
SET IDENTITY_INSERT [dbo].[PipelineApprovalLayer] OFF
