USE [dashboard-bri]
GO
/****** Object:  Table [dbo].[CustomerMenengahType]    Script Date: 7/30/2019 9:42:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[CustomerMenengahType](
	[CustomerMenengahTypeId] [int] IDENTITY(1,1) NOT NULL,
	[CustomerMenengahTypeName] [varchar](50) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[CustomerMenengahType] ON 

INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (1, N'PT')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (2, N'CV')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (3, N'Firma')
INSERT [dbo].[CustomerMenengahType] ([CustomerMenengahTypeId], [CustomerMenengahTypeName]) VALUES (4, N'Perorangan')
SET IDENTITY_INSERT [dbo].[CustomerMenengahType] OFF
