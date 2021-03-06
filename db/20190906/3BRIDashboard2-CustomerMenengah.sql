USE [BRIDashboard2]
GO
/****** Object:  Table [dbo].[CustomerMenengah]    Script Date: 9/5/2019 11:12:36 AM ******/
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
PRIMARY KEY CLUSTERED 
(
	[CustomerMenengahId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[CustomerMenengah] ON 

INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (1, N'Y977480', 1, N'YASANDA', N'99.054.841.1-524.00', N'Jalan Panjang No. 50', N'ILHAM MAHATIR       ', N'81239123')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (2, N'L558145', 1, N'LESTARIWIRA AGRAPRIM', N'97.052.843.2-523.01', N'Jalan Pendek No. 25', N'NANA RUSNAWI        ', N'1923129')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (3, N'H681321', 4, N'UJANG WAHYUDIN', N'95.050.840.3-522.02', N'Jalan Sedang No. 30', N'KHAIRUR RAZAK ALFATA', N'3484303')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (4, N'APP5552', 1, N'ARTHA ALAM LESTARI  ', N'93.053.842.4-521.03', N'Jalan Kebon Bawang No. 1', N'FAISAL              ', N'12392381')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (5, N'WJ41792', 1, N'Wahana Tritunggal Cemerlang', N'91.051.844.5-520.04', N'Jalan Kebon Kacang No.10', N'YUNIANTO ARI WIBOWO ', N'3458345345')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (6, N'KT86315', 1, N'KOPEGTEL JAYA       ', N'99.051.844.1-514.60', N'Jalan Waru 7 Jakarta Barat', N'MOCHAMAD ANDYK KURNI', N'8999988870')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (7, N'MJT8814', 1, N'MIRAH SEGAR         ', N'95.050.840.3-580.02', N'Jalan Barito Raya No.176 Jakarta Selatan', N'YADI CAHYADI        ', N'878884435')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (8, N'NDD4676', 1, N'NIRWANA KANDARA     ', N'93.053.943.4-521.70', N'Jalan Selir 4 No.90 Bekasi', N'HENDRI YUWONO       ', N'218909800')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (9, N'AKE8615', 1, N'ANEKA BINA MAKMUR   ', N'91.051.782.5-520.04', N'Jalan mujair 8 No.9 Bekasi', N'BAKTI UTAMA         ', N'8219988700')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (10, N'PY89761', 1, N'NAJIHA SALTIKA   ', N'90.050.840.9-580.02', N'Jl.Kumbang Raya Nomor 6 jakarta selatan', N'BUDI SANTOSO        ', N'8978877610')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (11, N'PY98631', 1, N'CITRA TRI HUSADA ', N'93.053.789.4-521.70', N'Jl.sepat 9 Nomor 167 Tangerang', N'YANUAR RAMDANI      ', N'218839849')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (12, N'BL35201', 2, N'BABEL MART          ', N'91.051.782.5-760.04', N'Jl.Dahlia Mekar 8 nomor 175 Jakarta pusat', N'NANDA PRATAMA JUANGG', N'81324792039')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (13, N'KFC5368', 1, N'KEYSTONE INDONESIA  ', N'99.054.891.1-904.00', N'Jl.Katalia Raya nomor 75 Tomang, jakarta barat', N'SUKMONO HADI        ', N'218848738')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (14, N'PQ67041', 1, N'TERRYHAM PROPLAS INDONESIA           ', N'97.052.843.2-520.20', N'Perumahan Pondok Indah Raya Kav.9 Jakarta Selatan', N'PEBRIYANTO GINTING  ', N'2198434008')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (15, N'PM27550', 1, N'PELAYARAN MITRA ', N'95.050.009.3-801.02', N'Komplek Ruko Permata 9 Kav 20 Bekasi Timur', N'ARWAN ASRIB         ', N'8143487398')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (16, N'SGCI595', 1, N'SUMBER BATU', N'90.053.908.4-087.03', N'Jl.Gurame Raya Timur No.8 Jakarta Timur', N'HENDRI USMAN W      ', N'2194732498')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (17, N'MLS7543', 3, N'MUARA PERDANA       ', N'91.051.840.3-590.04', N'Komplek Pertokoan Roxy Jaya Kav 201 Jakarta Barat', N'YOYOK SUGIARTO      ', N'8134459473')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (18, N'LB42113', 1, N'Ludin Industry Invest', N'99.051.854.1-520.09', N'Jalan Komando jaya No.9 Cipinang Jakarta Timur', N'UPAH                ', N'8199027372')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (19, N'DES7480', 1, N'Ultraman Gingga', N'99.053.841.1-824.00', N'Jalan Angsa No. 50', N'Bombom', N'87704663')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (20, N'DES7481', 1, N'Ultraman Seven', N'99.053.841.1-824.01', N'Jalan Belukar No. 48', N'Agus', N'8122673999')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (21, N'DES7500', 3, N'Belial', N'99.053.841.1-824.02', N'Jalan Angkasa No. 52', N'Sumantri', N'87704665')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (22, N'DES7483', 1, N'Ultarman Taro', N'93.053.841.1-824.03', N'Jalan Tut Wuri No. 38', N'Dhani ', N'87704666')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (23, N'DES7484', 1, N'Ultraman Orbs', N'99.053.841.1-824.04', N'Jalan Angsa II No. 54', N'Eka', N'8112611014')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (24, N'DES7485', 1, N'Ultra Jaya', N'99.053.841.1-824.05', N'Jalan Merdeka No. 55', N'Saputra', N'87704668')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (25, N'DES7499', 1, N'Zabogar', N'94.053.841.1-824.06', N'Jalan Putting Beliung No. 111', N'Almighty', N'87754225')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (26, N'DES7488', 4, N'Gaban', N'99.053.841.1-824.07', N'Jalan Krakatau No. 57', N'Gaban', N'87704670')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (27, N'DES7496', 1, N'Sariban', N'99.053.841.1-824.08', N'Jalan Puri Kencana No. 1', N'Reza', N'87704671')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (28, N'DES7490', 1, N'Google V', N'99.053.841.1-824.09', N'Jalan Waringin No. 59', N'Citra', N'87704672')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (29, N'DES7491', 1, N'Megaloman', N'99.053.841.1-824.10', N'Jalan Bendungan Wlahar No. 77', N'Andri', N'811262784')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (30, N'DES7492', 2, N'Putra Petir', N'99.053.841.1-824.11', N'Jalan Buntu No. 61', N'Lulu', N'87704674')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (31, N'DES7493', 1, N'Superman', N'99.053.841.1-824.12', N'Jalan Patriot No. 62', N'tatang', N'87704675')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (32, N'DES7494', 4, N'Wiro Sableng', N'99.053.841.1-824.13', N'Jalan Masjid No. 222', N'Wiro Sableng', N'81548875513')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (33, N'DES7497', 1, N'Wonder Woman', N'99.053.841.1-824.14', N'Jalan Sudirman No. 25', N'Ricky', N'87704677')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (34, N'DES7498', 1, N'Guardian Of Galaxy', N'99.053.841.1-824.15', N'Jalan Melati No. 23', N'Puteri', N'87704678')
INSERT [dbo].[CustomerMenengah] ([CustomerMenengahId], [CIF], [CustomerMenengahTypeId], [CustomerName], [NPWP], [Address], [ContactPerson], [PhoneNumber]) VALUES (35, N'DES7501', 1, N'Captaian Seat', N'99.053.841.1-824.16', N'Jalan Perkutut No. 5', N'Yoshua', N'87704679')
SET IDENTITY_INSERT [dbo].[CustomerMenengah] OFF
