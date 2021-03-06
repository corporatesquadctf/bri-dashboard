USE [dashboard-bri-old]
GO
/****** Object:  Table [dbo].[wallet_shares]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[wallet_shares](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[groupdetail_id] [int] NULL,
	[data_year] [smallint] NULL,
	[bri_share] [decimal](21, 2) NULL,
	[bri_percent] [decimal](5, 2) NULL,
	[otherbank_share] [decimal](21, 2) NULL,
	[otherbank_percent] [decimal](5, 2) NULL,
	[total_share] [decimal](21, 2) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[USERS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[USERS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[personal_number] [varchar](10) NOT NULL,
	[name] [varchar](50) NOT NULL,
	[email] [varchar](50) NOT NULL,
	[password] [varchar](100) NOT NULL,
	[token_id] [int] NOT NULL,
	[status] [bit] NOT NULL,
	[addon] [datetime] NOT NULL,
	[addby] [int] NOT NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
	[role_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TOKENS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TOKENS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[token_number] [varchar](100) NOT NULL,
	[expires] [int] NOT NULL,
	[status] [bit] NOT NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[SUB_ROLE]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[SUB_ROLE](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[SUBROLE_NAME] [varchar](50) NULL,
	[DESCRIPTION] [varchar](255) NULL,
	[STATUS] [bit] NULL,
	[ADDON] [datetime] NULL,
	[ADDBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODIBY] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[strategic_plans]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[strategic_plans](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[description] [varchar](255) NULL,
	[type] [bit] NULL,
	[division_id] [int] NULL,
	[customer_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[shareholders]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[shareholders](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[shareholder] [varchar](100) NULL,
	[share] [decimal](22, 2) NULL,
	[portion] [decimal](5, 2) NULL,
	[status] [bit] NULL,
	[customer_id] [int] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[services]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[services](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[data_year] [smallint] NULL,
	[service_name] [varchar](255) NULL,
	[division_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ROLE]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ROLE](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[ROLE_NAME] [varchar](50) NULL,
	[DESCRIPTION] [varchar](255) NULL,
	[ACCESS] [int] NULL,
	[STATUS] [bit] NULL,
	[ADDON] [datetime] NULL,
	[ADDBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODIBY] [int] NULL,
	[SUBROLE_ID] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PAR_VCIF]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PAR_VCIF](
	[VCIF] [char](7) NOT NULL,
	[NAME] [varchar](255) NULL,
	[ID] [int] IDENTITY(1,1) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PAR_SEGMEN]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PAR_SEGMEN](
	[SEGMEN] [int] NULL,
	[DESCRIPTION] [varchar](500) NULL,
	[SEGMEN_LV1] [int] NULL,
	[DESC_SEGMEN_LV1] [varchar](50) NULL,
	[SEGMEN_LV2] [int] NULL,
	[DESC_SEGMEN_LV2] [varchar](50) NULL,
	[SEGMEN_LV3] [int] NULL,
	[DESC_SEGMEN_LV3] [varchar](50) NULL,
	[PARENT] [char](1) NULL,
	[DIRECT] [char](1) NULL,
	[ISACTIVE] [char](1) NULL,
	[OWNER] [varchar](50) NULL,
	[JENIS_PENGG] [varchar](50) NULL,
	[1OBL] [varchar](10) NULL,
	[DIVISI] [varchar](6) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PAR_MAPPING_VCIF]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PAR_MAPPING_VCIF](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[VCIF] [char](7) NOT NULL,
	[NAMA] [varchar](100) NOT NULL,
	[CIF] [char](7) NOT NULL,
	[RELATION] [varchar](100) NOT NULL,
	[GROUP_NAME] [varchar](255) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PAR_JENIS_PENGGUNAAN]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PAR_JENIS_PENGGUNAAN](
	[CODE] [int] NULL,
	[DESCRIPTION] [varchar](500) NULL,
	[IS_ACTIVE] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PAR_GROUP_DETAIL_CIF]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PAR_GROUP_DETAIL_CIF](
	[ID_GROUP] [int] NOT NULL,
	[CIFNO] [varchar](10) NULL,
	[LAST_UPDATE] [datetime] NULL,
	[USER_UPDATE] [varchar](max) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PAR_GROUP]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PAR_GROUP](
	[ID_GROUP] [int] IDENTITY(1,1) NOT NULL,
	[NAMA_GROUP] [varchar](50) NOT NULL,
	[KETERANGAN] [varchar](255) NULL,
	[LAST_UPDATE] [datetime] NULL,
	[USER_UPDATE] [varchar](255) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[oauth_users]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[oauth_users](
	[username] [varchar](80) NOT NULL,
	[password] [varchar](80) NULL,
	[first_name] [varchar](80) NULL,
	[last_name] [varchar](80) NULL,
	[email] [varchar](80) NULL,
	[email_verified] [bit] NULL,
	[scope] [varchar](4000) NULL,
PRIMARY KEY CLUSTERED 
(
	[username] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[oauth_scopes]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[oauth_scopes](
	[scope] [varchar](80) NOT NULL,
	[is_default] [bit] NULL,
PRIMARY KEY CLUSTERED 
(
	[scope] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[oauth_refresh_tokens]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[oauth_refresh_tokens](
	[refresh_token] [varchar](40) NOT NULL,
	[client_id] [varchar](80) NOT NULL,
	[user_id] [varchar](80) NULL,
	[expires] [timestamp] NOT NULL,
	[scope] [varchar](4000) NULL,
PRIMARY KEY CLUSTERED 
(
	[refresh_token] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[oauth_clients]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[oauth_clients](
	[client_id] [varchar](80) NOT NULL,
	[client_secret] [varchar](80) NULL,
	[redirect_uri] [varchar](2000) NULL,
	[grant_types] [varchar](80) NULL,
	[scope] [varchar](4000) NULL,
	[user_id] [varchar](80) NULL,
PRIMARY KEY CLUSTERED 
(
	[client_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[oauth_authorization_codes]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[oauth_authorization_codes](
	[authorization_code] [varchar](40) NOT NULL,
	[client_id] [varchar](80) NOT NULL,
	[user_id] [varchar](80) NULL,
	[redirect_uri] [varchar](2000) NULL,
	[expires] [timestamp] NOT NULL,
	[scope] [varchar](4000) NULL,
	[id_token] [varchar](1000) NULL,
PRIMARY KEY CLUSTERED 
(
	[authorization_code] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[oauth_access_tokens]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[oauth_access_tokens](
	[access_token] [varchar](40) NOT NULL,
	[client_id] [varchar](80) NOT NULL,
	[user_id] [varchar](80) NULL,
	[expires] [timestamp] NOT NULL,
	[scope] [varchar](4000) NULL,
PRIMARY KEY CLUSTERED 
(
	[access_token] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[NEW_VCIF_MAPPING]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NEW_VCIF_MAPPING](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[VCIF] [char](7) NULL,
	[NAMA] [varchar](100) NULL,
	[CIF] [char](7) NULL,
	[RELATION] [varchar](100) NULL,
	[GROUP_NAME] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[NEW_VCIF]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NEW_VCIF](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[VCIF] [char](7) NOT NULL,
	[NAME] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[NEW_SUMMARY_LABA_RUGI]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NEW_SUMMARY_LABA_RUGI](
	[CIFNO] [varchar](7) NULL,
	[NAMA_NASABAH] [varchar](100) NULL,
	[BEBAN_FTP] [numeric](38, 6) NULL,
	[PROVISI] [numeric](38, 6) NULL,
	[PLAFON_EFEKTIF] [numeric](38, 2) NULL,
	[PLAFON_AWAL] [numeric](38, 2) NULL,
	[KELONGGARAN_TARIK] [numeric](38, 2) NULL,
	[BAKI_DEBET_ORIGINAL] [numeric](38, 2) NULL,
	[BAKI_DEBET] [numeric](38, 2) NULL,
	[BAKI_DEBET_RATAS] [numeric](38, 6) NULL,
	[PPAP] [numeric](38, 4) NULL,
	[BIAYA_PPAP_AKUMULASI] [numeric](38, 4) NULL,
	[PPAP_RATAS] [numeric](38, 6) NULL,
	[NILAI_TERCATAT] [numeric](38, 12) NULL,
	[NILAI_TERCATAT_RATAS] [numeric](38, 9) NULL,
	[CKPN] [numeric](38, 12) NULL,
	[PEND_BUNGA] [numeric](38, 2) NULL,
	[PEND_BUNGA_AKUMULASI] [numeric](38, 2) NULL,
	[JUMLAH_REK_KREDIT] [int] NULL,
	[NOMINAL_FEE_KREDIT] [numeric](38, 2) NULL,
	[NOMINAL_TRX_KREDIT] [numeric](38, 2) NULL,
	[TOTAL_TRX] [int] NULL,
	[AKUMULASI_NOMINAL_TRX] [numeric](38, 2) NULL,
	[AKUMULASI_NOMINAL_FEE] [numeric](38, 2) NULL,
	[AKUMULASI_JUMLAH_TRX] [int] NULL,
	[AKUMULASI_JUMLAH_TRX_KREDIT] [numeric](38, 6) NULL,
	[PROVISI_AKUMULASI_KREDIT] [numeric](38, 6) NULL,
	[SALDO_SIMPANAN] [numeric](38, 2) NULL,
	[AVRGSALDO_SIMPANAN] [numeric](38, 2) NULL,
	[JUMLAH_REK_SIMPANAN] [int] NULL,
	[NOMINAL_FEE_SIMPANAN] [numeric](38, 2) NULL,
	[NOMINAL_TRX_SIMPANAN] [numeric](38, 2) NULL,
	[TOTAL_TRX_SIMPANAN] [int] NULL,
	[AKUMULASI_NOMINAL_TRX_SIMPANAN] [numeric](38, 2) NULL,
	[AKUMULASI_NOMINAL_FEE_SIMPANAN] [numeric](38, 2) NULL,
	[AKUMULASI_JUMLAH_TRX_SIMPANAN] [int] NULL,
	[BEBAN_FTP_AKUMULASI] [numeric](38, 6) NULL,
	[BEBAN_BUNGA] [numeric](38, 2) NULL,
	[BEBAN_BUNGA_AKUMULASI] [numeric](38, 2) NULL,
	[PENDAPATAN_FTP] [float] NULL,
	[PENDAPATAN_FTP_AKUMULASI] [float] NULL,
	[AMOUNT_IDR_TF] [numeric](38, 2) NULL,
	[NOMINAL_FEE_TF] [numeric](38, 2) NULL,
	[NOMINAL_TRX_TF] [numeric](38, 2) NULL,
	[TOTAL_TRX_TF] [int] NULL,
	[AKUMULASI_NOMINAL_TRX_TF] [numeric](38, 2) NULL,
	[AKUMULASI_NOMINAL_FEE_TF] [numeric](38, 2) NULL,
	[AKUMULASI_JUMLAH_TRX_TF] [int] NULL,
	[JUMLAH_TF] [int] NULL,
	[NII] [numeric](38, 2) NULL,
	[NII_FTP] [float] NULL,
	[FEEBASED] [numeric](38, 2) NULL,
	[TOTAL_BIAYA_OPERASIONAL] [numeric](38, 6) NULL,
	[BIAYA_PPAP] [numeric](38, 4) NULL,
	[BIAYA_MODAL] [numeric](38, 6) NULL,
	[LABA_RUGI_SEBELUM_MODAL] [numeric](38, 2) NULL,
	[LABA_RUGI_SETELAH_MODAL] [float] NULL,
	[LABA_RUGI_FTP_SEBELUM_MODAL] [numeric](38, 2) NULL,
	[LABA_RUGI_FTP_SETELAH_MODAL] [float] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[NEW_KREDIT_CPA]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NEW_KREDIT_CPA](
	[CIFNO] [varchar](7) NULL,
	[FKSEGMEN] [int] NULL,
	[STATUS] [numeric](1, 0) NULL,
	[POSISI] [datetime] NULL,
	[OFFCR] [varchar](3) NULL,
	[PLAFON_EFEKTIF] [numeric](19, 2) NULL,
	[NAMA_DEBITUR] [varchar](100) NULL,
	[REKENING] [numeric](19, 0) NULL,
	[BRANCH] [numeric](5, 0) NULL,
	[MATA_UANG] [varchar](4) NULL,
	[PLAFOND_AWAL] [numeric](19, 2) NULL,
	[KELONGGARAN_TARIK] [numeric](19, 2) NULL,
	[KOLEKTIBILITAS] [numeric](1, 0) NULL,
	[KOLEKTIBILITAS_ADK] [numeric](1, 0) NULL,
	[BAKI_DEBET_ORIGINAL] [numeric](15, 2) NULL,
	[BAKI_DEBET] [numeric](19, 2) NULL,
	[BAKI_DEBET_RATAS] [numeric](38, 6) NULL,
	[PPAP] [numeric](22, 4) NULL,
	[BIAYA_PPAP] [numeric](23, 4) NULL,
	[BIAYA_PPAP_AKUMULASI] [numeric](23, 4) NULL,
	[PPAP_RATAS] [numeric](38, 6) NULL,
	[NLAI_TERCATAT] [numeric](30, 12) NULL,
	[NILAI_TERCATAT_RATAS] [numeric](38, 9) NULL,
	[CKPN] [numeric](30, 12) NULL,
	[PEND_BUNGA] [numeric](21, 2) NULL,
	[PEND_BUNGA_AKUMULASI] [numeric](21, 2) NULL,
	[PEND_FTP] [numeric](38, 6) NULL,
	[PEND_FTP_AKUMULASI] [numeric](38, 6) NULL,
	[PROVISI] [numeric](18, 6) NULL,
	[PROVISI_AKUMULASI] [numeric](18, 6) NULL,
	[PN_PENGELOLA] [varchar](20) NULL,
	[NAMA_PENGELOLA] [int] NULL,
	[SUKU_BUNGA] [numeric](7, 6) NULL,
	[DIVISI] [varchar](6) NULL,
	[SEKTOR_EKONOMI] [varchar](6) NULL,
	[TGL_PEMBUKAAN] [datetime] NULL,
	[TGL_JTUH_TEMPO] [datetime] NULL,
	[JENIS_PENGGUNAAN] [varchar](1) NULL,
	[ORIENTASI_PENGGUNAAN] [varchar](1) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[NEW_GROUP_DETAIL]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NEW_GROUP_DETAIL](
	[ID_GROUP] [int] NULL,
	[CIFNO] [varchar](10) NULL,
	[LAST_UPDATE] [datetime] NULL,
	[USER_UPDATE] [varchar](10) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[NEW_GROUP]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[NEW_GROUP](
	[ID_GROUP] [int] IDENTITY(1,1) NOT NULL,
	[NAMA_GROUP] [varchar](50) NOT NULL,
	[KETERANGAN] [varchar](255) NULL,
	[LAST_UPDATE] [datetime] NULL,
	[USER_UPDATE] [varchar](10) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[module]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[module](
	[id] [int] NULL,
	[modul_name] [varchar](50) NULL,
	[module_status] [varchar](50) NULL,
	[module_path] [varchar](100) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MASTER_QUARTERS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MASTER_QUARTERS](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[QUARTER_NAME] [varchar](10) NULL,
	[MONTH_NAME] [varchar](10) NULL,
	[STATUS] [bit] NULL,
	[ADDON] [datetime] NULL,
	[ADDBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODIBY] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MASTER_KURS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MASTER_KURS](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[MATA_UANG] [varchar](3) NOT NULL,
	[DESKRIPSI] [varchar](255) NULL,
	[STATUS] [bit] NOT NULL,
	[ADDON] [datetime] NULL,
	[ADDBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODIBY] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MASTER_DIVISIONS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MASTER_DIVISIONS](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[NAME] [varchar](100) NULL,
	[IS_PRODUCT] [bit] NULL,
	[STATUS] [bit] NULL,
	[ADDON] [datetime] NULL,
	[ADDBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODIBY] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MASTER_BANKS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MASTER_BANKS](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[NAME] [varchar](70) NULL,
	[DESCRIPTION] [varchar](255) NULL,
	[STATUS] [bit] NULL,
	[ADDON] [datetime] NULL,
	[ADDBY] [int] NULL,
	[MODION] [datetime] NULL,
	[MODIBY] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_lifecycles]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_lifecycles](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NULL,
	[description] [varchar](255) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_industrytrends]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_industrytrends](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](100) NULL,
	[description] [varchar](255) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_globalratings]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_globalratings](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NULL,
	[description] [varchar](255) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_financialgroups]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_financialgroups](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[group_name] [varchar](100) NOT NULL,
	[description] [varchar](255) NULL,
	[is_default] [bit] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_domesticratings]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_domesticratings](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NULL,
	[description] [varchar](255) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_divisions]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_divisions](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](100) NULL,
	[is_productspecialist] [bit] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_classifications]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_classifications](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NULL,
	[description] [varchar](255) NULL,
	[parameter] [decimal](22, 0) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_cities]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_cities](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](100) NULL,
	[description] [varchar](255) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_banks]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_banks](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](70) NULL,
	[description] [varchar](255) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[m_bankingfacilities]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[m_bankingfacilities](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[group_name] [varchar](100) NULL,
	[description] [varchar](255) NULL,
	[is_default] [bit] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[LOOKUP_PROVINSI]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[LOOKUP_PROVINSI](
	[PKLookup] [int] IDENTITY(1,1) NOT NULL,
	[FKLookupGroup] [int] NOT NULL,
	[Code] [nvarchar](10) NOT NULL,
	[Description] [nvarchar](max) NOT NULL,
	[IsActive] [bit] NOT NULL,
	[ViewOrder] [int] NOT NULL,
	[LastUpdated] [datetime] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[initiatives]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[initiatives](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[initiatives] [varchar](100) NULL,
	[description] [varchar](255) NULL,
	[quarter_id] [int] NULL,
	[month_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
	[customer_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[group_overviews]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[group_overviews](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[globalrating_id] [int] NULL,
	[domesticrating_id] [int] NULL,
	[industrytrend_id] [int] NULL,
	[lifecycle_id] [int] NULL,
	[organization_path] [varchar](255) NULL,
	[group_path] [varchar](255) NULL,
	[business_path] [varchar](255) NULL,
	[industry_type] [varchar](100) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[fundings]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[fundings](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[data_year] [smallint] NULL,
	[funding_need] [varchar](255) NULL,
	[time_period] [smallint] NULL,
	[nominal] [decimal](22, 0) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[financialgroup_details]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[financialgroup_details](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[group_name] [varchar](100) NOT NULL,
	[group_id] [int] NOT NULL,
	[is_default] [bit] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[financial_highlights]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[financial_highlights](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[groupdetail_id] [int] NULL,
	[data_year] [smallint] NULL,
	[data_value] [decimal](16, 2) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[FACT_SUMMARY_LABA_RUGI]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[FACT_SUMMARY_LABA_RUGI](
	[CIFNO] [varchar](7) NULL,
	[NAMA_NASABAH] [varchar](100) NULL,
	[BEBAN_FTP] [numeric](38, 6) NULL,
	[PROVISI] [numeric](38, 6) NULL,
	[PLAFON_EFEKTIF] [numeric](38, 2) NULL,
	[PLAFON_AWAL] [numeric](38, 2) NULL,
	[KELONGGARAN_TARIK] [numeric](38, 2) NULL,
	[BAKI_DEBET_ORIGINAL] [numeric](38, 2) NULL,
	[BAKI_DEBET] [numeric](38, 2) NULL,
	[BAKI_DEBET_RATAS] [numeric](38, 6) NULL,
	[PPAP] [numeric](38, 4) NULL,
	[BIAYA_PPAP_AKUMULASI] [numeric](38, 4) NULL,
	[PPAP_RATAS] [numeric](38, 6) NULL,
	[NILAI_TERCATAT] [numeric](38, 12) NULL,
	[NILAI_TERCATAT_RATAS] [numeric](38, 9) NULL,
	[CKPN] [numeric](38, 12) NULL,
	[PEND_BUNGA] [numeric](38, 2) NULL,
	[PEND_BUNGA_AKUMULASI] [numeric](38, 2) NULL,
	[JUMLAH_REK_KREDIT] [int] NULL,
	[NOMINAL_FEE_KREDIT] [numeric](38, 2) NULL,
	[NOMINAL_TRX_KREDIT] [numeric](38, 2) NULL,
	[TOTAL_TRX] [int] NULL,
	[AKUMULASI_NOMINAL_TRX] [numeric](38, 2) NULL,
	[AKUMULASI_NOMINAL_FEE] [numeric](38, 2) NULL,
	[AKUMULASI_JUMLAH_TRX] [int] NULL,
	[AKUMULASI_JUMLAH_TRX_KREDIT] [numeric](38, 6) NULL,
	[PROVISI_AKUMULASI_KREDIT] [numeric](38, 6) NULL,
	[SALDO_SIMPANAN] [numeric](38, 2) NULL,
	[AVRGSALDO_SIMPANAN] [numeric](38, 2) NULL,
	[JUMLAH_REK_SIMPANAN] [int] NULL,
	[NOMINAL_FEE_SIMPANAN] [numeric](38, 2) NULL,
	[NOMINAL_TRX_SIMPANAN] [numeric](38, 2) NULL,
	[TOTAL_TRX_SIMPANAN] [int] NULL,
	[AKUMULASI_NOMINAL_TRX_SIMPANAN] [numeric](38, 2) NULL,
	[AKUMULASI_NOMINAL_FEE_SIMPANAN] [numeric](38, 2) NULL,
	[AKUMULASI_JUMLAH_TRX_SIMPANAN] [int] NULL,
	[BEBAN_FTP_AKUMULASI] [numeric](38, 6) NULL,
	[BEBAN_BUNGA] [numeric](38, 2) NULL,
	[BEBAN_BUNGA_AKUMULASI] [numeric](38, 2) NULL,
	[PENDAPATAN_FTP] [float] NULL,
	[PENDAPATAN_FTP_AKUMULASI] [float] NULL,
	[AMOUNT_IDR_TF] [numeric](38, 2) NULL,
	[NOMINAL_FEE_TF] [numeric](38, 2) NULL,
	[NOMINAL_TRX_TF] [numeric](38, 2) NULL,
	[TOTAL_TRX_TF] [int] NULL,
	[AKUMULASI_NOMINAL_TRX_TF] [numeric](38, 2) NULL,
	[AKUMULASI_NOMINAL_FEE_TF] [numeric](38, 2) NULL,
	[AKUMULASI_JUMLAH_TRX_TF] [int] NULL,
	[JUMLAH_TF] [int] NULL,
	[NII] [numeric](38, 2) NULL,
	[NII_FTP] [float] NULL,
	[FEEBASED] [numeric](38, 2) NULL,
	[TOTAL_BIAYA_OPERASIONAL] [numeric](38, 6) NULL,
	[BIAYA_PPAP] [numeric](38, 4) NULL,
	[BIAYA_MODAL] [numeric](38, 6) NULL,
	[LABA_RUGI_SEBELUM_MODAL] [numeric](38, 2) NULL,
	[LABA_RUGI_SETELAH_MODAL] [float] NULL,
	[LABA_RUGI_FTP_SEBELUM_MODAL] [numeric](38, 2) NULL,
	[LABA_RUGI_FTP_SETELAH_MODAL] [float] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[FACT_SIMPANAN_CPA]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[FACT_SIMPANAN_CPA](
	[CIFNO] [varchar](7) NULL,
	[ACCTNO] [numeric](19, 0) NULL,
	[NASABAH] [varchar](200) NULL,
	[CURRENCY] [varchar](4) NULL,
	[PRODUK] [varchar](2) NULL,
	[DESC1] [varchar](50) NULL,
	[DESC2] [varchar](50) NULL,
	[DESC3] [int] NULL,
	[RATE] [numeric](7, 6) NULL,
	[RATE_FTP] [float] NULL,
	[SALDO] [numeric](19, 2) NULL,
	[AVRGSALDO] [numeric](19, 2) NULL,
	[BEBAN_BUNGA] [numeric](19, 2) NULL,
	[BEBAN_BUNGA_AKUMULASI] [numeric](19, 2) NULL,
	[BEBAN_BUNGA_FTP] [float] NULL,
	[BEBAN_BUNGA_FTP_AKUMULASI] [float] NULL,
	[DIVISI] [varchar](50) NULL,
	[STATUS] [numeric](1, 0) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[FACT_KREDIT_CPA]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[FACT_KREDIT_CPA](
	[CIFNO] [varchar](7) NULL,
	[FKSEGMEN] [int] NULL,
	[STATUS] [numeric](1, 0) NULL,
	[POSISI] [datetime] NULL,
	[OFFCR] [varchar](3) NULL,
	[PLAFON_EFEKTIF] [numeric](19, 2) NULL,
	[NAMA_DEBITUR] [varchar](100) NULL,
	[REKENING] [numeric](19, 0) NULL,
	[BRANCH] [numeric](5, 0) NULL,
	[MATA_UANG] [varchar](4) NULL,
	[PLAFOND_AWAL] [numeric](19, 2) NULL,
	[KELONGGARAN_TARIK] [numeric](19, 2) NULL,
	[KOLEKTIBILITAS] [numeric](1, 0) NULL,
	[KOLEKTIBILITAS_ADK] [numeric](1, 0) NULL,
	[BAKI_DEBET_ORIGINAL] [numeric](15, 2) NULL,
	[BAKI_DEBET] [numeric](19, 2) NULL,
	[BAKI_DEBET_RATAS] [numeric](38, 6) NULL,
	[PPAP] [numeric](22, 4) NULL,
	[BIAYA_PPAP] [numeric](23, 4) NULL,
	[BIAYA_PPAP_AKUMULASI] [numeric](23, 4) NULL,
	[PPAP_RATAS] [numeric](38, 6) NULL,
	[NLAI_TERCATAT] [numeric](30, 12) NULL,
	[NILAI_TERCATAT_RATAS] [numeric](38, 9) NULL,
	[CKPN] [numeric](30, 12) NULL,
	[PEND_BUNGA] [numeric](21, 2) NULL,
	[PEND_BUNGA_AKUMULASI] [numeric](21, 2) NULL,
	[PEND_FTP] [numeric](38, 6) NULL,
	[PEND_FTP_AKUMULASI] [numeric](38, 6) NULL,
	[PROVISI] [numeric](18, 6) NULL,
	[PROVISI_AKUMULASI] [numeric](18, 6) NULL,
	[PN_PENGELOLA] [varchar](20) NULL,
	[NAMA_PENGELOLA] [int] NULL,
	[SUKU_BUNGA] [numeric](7, 6) NULL,
	[DIVISI] [varchar](6) NULL,
	[SEKTOR_EKONOMI] [varchar](6) NULL,
	[TGL_PEMBUKAAN] [datetime] NULL,
	[TGL_JTUH_TEMPO] [datetime] NULL,
	[JENIS_PENGGUNAAN] [varchar](1) NULL,
	[ORIENTASI_PENGGUNAAN] [varchar](1) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[facilitygroup_details]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[facilitygroup_details](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](100) NOT NULL,
	[bankingfacilities_id] [int] NOT NULL,
	[is_default] [bit] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[estimated_financials]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[estimated_financials](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[facilitygroup_id] [int] NULL,
	[data_year] [smallint] NULL,
	[projection_idr] [decimal](22, 0) NULL,
	[projection_valas] [decimal](22, 0) NULL,
	[target_idr] [decimal](22, 0) NULL,
	[target_valas] [decimal](22, 0) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dataset1]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dataset1](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date] [datetime] NULL,
	[value1] [decimal](16, 2) NULL,
	[value2] [decimal](16, 2) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[customers]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[customers](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[virtual_cif] [varchar](20) NOT NULL,
	[customer_name] [varchar](100) NOT NULL,
	[address] [text] NULL,
	[city_id] [int] NULL,
	[parent_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
	[is_parent] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[coverage_mappings]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[coverage_mappings](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[client_name] [varchar](100) NULL,
	[contact_person] [varchar](20) NULL,
	[position_client] [varchar](50) NULL,
	[other_information] [varchar](50) NULL,
	[position_bank] [varchar](50) NULL,
	[bankperson_name] [varchar](100) NULL,
	[customer_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[competition_analysis]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[competition_analysis](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[groupdetail_id] [int] NULL,
	[data_year] [smallint] NULL,
	[competingbank1_id] [int] NULL,
	[competingbank2_id] [int] NULL,
	[competingbank3_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BANKS]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[BANKS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[bank_name] [varchar](100) NOT NULL,
	[bank_desc] [varchar](255) NULL,
	[status] [bit] NOT NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[banking_facilities]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[banking_facilities](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[groupdetail_id] [int] NULL,
	[data_year] [smallint] NULL,
	[amount_idr] [decimal](21, 2) NULL,
	[amountidr_percent] [decimal](4, 2) NULL,
	[amount_valas] [decimal](21, 2) NULL,
	[amountvalas_percent] [decimal](4, 2) NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[account_plannings]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[account_plannings](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[customer_id] [int] NULL,
	[is_submitted] [bit] NULL,
	[is_signed] [bit] NULL,
	[is_approved] [bit] NULL,
	[checker_id] [int] NULL,
	[signer_id] [int] NULL,
	[status] [bit] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[access_role]    Script Date: 03/26/2018 11:07:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[access_role](
	[ID_ROLE] [int] NULL,
	[ID_MODULE] [int] NULL,
	[ID_SIGNER_ROLE] [int] NULL,
	[addon] [datetime] NULL,
	[addby] [int] NULL,
	[modion] [datetime] NULL,
	[modiby] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Default [DF__account_p__is_su__7E6CC920]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[account_plannings] ADD  DEFAULT ((0)) FOR [is_submitted]
GO
/****** Object:  Default [DF__account_p__is_si__7F60ED59]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[account_plannings] ADD  DEFAULT ((0)) FOR [is_signed]
GO
/****** Object:  Default [DF__account_p__is_ap__00551192]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[account_plannings] ADD  DEFAULT ((0)) FOR [is_approved]
GO
/****** Object:  Default [DF__account_p__statu__014935CB]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[account_plannings] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__banking_f__statu__03317E3D]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[banking_facilities] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__BANKS__status__0519C6AF]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[BANKS] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__competiti__statu__07020F21]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[competition_analysis] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__coverage___statu__08EA5793]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[coverage_mappings] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__customers__statu__0AD2A005]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[customers] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__customers__is_pa__0BC6C43E]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[customers] ADD  DEFAULT ((1)) FOR [is_parent]
GO
/****** Object:  Default [DF__estimated__statu__0EA330E9]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[estimated_financials] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__facilityg__is_de__108B795B]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[facilitygroup_details] ADD  DEFAULT ((0)) FOR [is_default]
GO
/****** Object:  Default [DF__facilityg__statu__117F9D94]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[facilitygroup_details] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__financial__is_de__173876EA]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[financialgroup_details] ADD  DEFAULT ((0)) FOR [is_default]
GO
/****** Object:  Default [DF__financial__statu__182C9B23]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[financialgroup_details] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__fundings__status__1A14E395]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[fundings] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__initiativ__statu__1CF15040]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[initiatives] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_banking__is_de__1FCDBCEB]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_bankingfacilities] ADD  DEFAULT ((0)) FOR [is_default]
GO
/****** Object:  Default [DF__m_banking__statu__20C1E124]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_bankingfacilities] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_banks__status__22AA2996]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_banks] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_cities__status__24927208]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_cities] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_classif__statu__267ABA7A]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_classifications] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_divisio__is_pr__286302EC]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_divisions] ADD  DEFAULT ((0)) FOR [is_productspecialist]
GO
/****** Object:  Default [DF__m_divisio__statu__29572725]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_divisions] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_domesti__statu__2B3F6F97]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_domesticratings] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_globalr__statu__2E1BDC42]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_globalratings] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_industr__statu__300424B4]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_industrytrends] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__m_lifecyc__statu__31EC6D26]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[m_lifecycles] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__MASTER_BA__STATU__33D4B598]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[MASTER_BANKS] ADD  DEFAULT ((1)) FOR [STATUS]
GO
/****** Object:  Default [DF__MASTER_DI__IS_PR__35BCFE0A]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[MASTER_DIVISIONS] ADD  DEFAULT ((0)) FOR [IS_PRODUCT]
GO
/****** Object:  Default [DF__MASTER_DI__STATU__36B12243]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[MASTER_DIVISIONS] ADD  DEFAULT ((1)) FOR [STATUS]
GO
/****** Object:  Default [DF__MASTER_KU__STATU__38996AB5]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[MASTER_KURS] ADD  DEFAULT ((1)) FOR [STATUS]
GO
/****** Object:  Default [DF__MASTER_QU__STATU__3A81B327]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[MASTER_QUARTERS] ADD  DEFAULT ((1)) FOR [STATUS]
GO
/****** Object:  Default [DF__ROLE__STATUS__4D94879B]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[ROLE] ADD  DEFAULT ((1)) FOR [STATUS]
GO
/****** Object:  Default [DF__services__status__4F7CD00D]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[services] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__sharehold__statu__5165187F]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[shareholders] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__strategic___type__534D60F1]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[strategic_plans] ADD  DEFAULT ((1)) FOR [type]
GO
/****** Object:  Default [DF__strategic__statu__5441852A]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[strategic_plans] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__SUB_ROLE__STATUS__5629CD9C]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[SUB_ROLE] ADD  DEFAULT ((1)) FOR [STATUS]
GO
/****** Object:  Default [DF__TOKENS__status__5812160E]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[TOKENS] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__USERS__status__59FA5E80]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[USERS] ADD  DEFAULT ((1)) FOR [status]
GO
/****** Object:  Default [DF__wallet_sh__statu__5BE2A6F2]    Script Date: 03/26/2018 11:07:45 ******/
ALTER TABLE [dbo].[wallet_shares] ADD  DEFAULT ((1)) FOR [status]
GO
