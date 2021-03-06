USE [CPA_KORPORASI_DEV_7]
GO
/****** Object:  Table [dbo].[Role]    Script Date: 27/12/2019 11:27:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Role](
	[RoleId] [int] IDENTITY(1,1) NOT NULL,
	[SubRoleId] [int] NULL,
	[Name] [varchar](100) NOT NULL,
	[Description] [varchar](max) NULL,
	[IsActive] [int] NOT NULL,
	[CreatedDate] [datetime] NULL,
	[CreatedBy] [varchar](10) NULL,
	[ModifiedDate] [datetime] NULL,
	[ModifiedBy] [varchar](10) NULL,
	[SegmentId] [int] NULL,
 CONSTRAINT [PK__Role__8AFACE1A01BD1E9F] PRIMARY KEY CLUSTERED 
(
	[RoleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Role] ADD  DEFAULT ((1)) FOR [IsActive]
GO
ALTER TABLE [dbo].[Role]  WITH CHECK ADD  CONSTRAINT [FK_Role_SubRole] FOREIGN KEY([SubRoleId])
REFERENCES [dbo].[SubRole] ([SubRoleId])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Role] CHECK CONSTRAINT [FK_Role_SubRole]
GO
