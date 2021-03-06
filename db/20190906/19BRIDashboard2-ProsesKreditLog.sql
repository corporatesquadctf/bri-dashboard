USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[ProsesKreditLog]    Script Date: 9/6/2019 12:34:43 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ProsesKreditLog](
	[ProsesKreditLogId] [int] IDENTITY(1,1) NOT NULL,
	[ProsesKreditId] [int] NOT NULL,
	[IsApproved] [int] NULL,
	[StatusApplicationId] [int] NULL,
	[Comment] [varchar](255) NULL,
	[CreatedBy] [varchar](10) NOT NULL,
	[CreatedDate] [datetime] NOT NULL,
 CONSTRAINT [PK__ProsesKr__D47D91BF92FFF74E] PRIMARY KEY CLUSTERED 
(
	[ProsesKreditLogId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
