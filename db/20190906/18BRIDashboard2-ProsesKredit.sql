USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[ProsesKredit]    Script Date: 9/6/2019 12:32:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ProsesKredit](
	[ProsesKreditId] [int] IDENTITY(1,1) NOT NULL,
	[PipelineId] [int] NULL,
	[StatusApplicationId] [int] NOT NULL,
	[StatusPutusan] [int] NOT NULL,
	[TanggalPutusan] [datetime] NULL,
	[IsAkad] [int] NOT NULL,
	[TanggalAkad] [datetime] NULL,
	[NamaNotaris] [varchar](255) NULL,
	[Keterangan] [varchar](255) NULL,
	[CreatedBy] [varchar](10) NOT NULL,
	[CreatedDate] [datetime] NULL,
	[ModifiedBy] [varchar](10) NULL,
	[ModifiedDate] [datetime] NULL,
 CONSTRAINT [PK__ProsesKr__710376B643511411] PRIMARY KEY CLUSTERED 
(
	[ProsesKreditId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
