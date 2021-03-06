USE [dashboard-bri]
GO
/****** Object:  Table [dbo].[CustomerMenengah]    Script Date: 7/30/2019 9:41:29 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[CustomerMenengah](
	[CustomerMenengahId] [int] IDENTITY(1,1) NOT NULL,
	[CIF] [varchar](10) NULL,
	[CustomerMenengahTypeId] [int] NULL,
	[CustomerName] [varchar](50) NULL,
	[NPWP] [varchar](50) NULL,
	[Address] [varchar](255) NULL,
	[ContactPerson] [varchar](50) NULL,
	[PhoneNumber] [varchar](50) NULL,
	[EWSStatus] [int] NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[CustomerMenengah] ON 

INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber], [EWSStatus]) VALUES (1, N'CIF00001', 1, N'Adaro Indonesia', N'99.054.841.1-524.00', N'Jalan Panjang No. 50', N'Sapto', N'081239123', 1)
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber], [EWSStatus]) VALUES (2, N'CIF00002', 2, N'Trimegah Sekuritas Indonesia', N'97.052.843.2-523.01', N'Jalan Pendek No. 25', N'Demy', N'01923129', 2)
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber], [EWSStatus]) VALUES (3, N'CIF00003', 3, N'Jasaraharja Putera', N'95.050.840.3-522.02', N'Jalan Sedang No. 30', N'Budi', N'03484303', 3)
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber], [EWSStatus]) VALUES (4, N'CIF00004', 4, N'Abiputera Bina Inter', N'93.053.842.4-521.03', N'Jalan Kebon Bawang No. 1', N'Felix', N'012392381', 1)
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber], [EWSStatus]) VALUES (5, N'CIF00005', 1, N'Pabrik Kertas Tjiwi Kimia', N'91.051.844.5-520.04', N'Jalan Kebon Kacang No.10', N'Felix', N'03458345345', 2)
SET IDENTITY_INSERT [dbo].[CustomerMenengah] OFF
