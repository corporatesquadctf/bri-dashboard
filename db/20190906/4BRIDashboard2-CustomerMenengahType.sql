USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[CustomerMenengahType]    Script Date: 9/5/2019 11:13:27 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[CustomerMenengahType](
	[CustomerMenengahTypeId] [int] IDENTITY(1,1) NOT NULL,
	[CustomerMenengahTypeName] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[CustomerMenengahTypeId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[CustomerMenengahType] ON 

INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (1, N'PT')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (2, N'CV')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (3, N'Firma')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (4, N'Perorangan')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (5, N'Koperasi')
SET IDENTITY_INSERT [dbo].[CustomerMenengahType] OFF
