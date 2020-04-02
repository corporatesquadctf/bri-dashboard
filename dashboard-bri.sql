/*
Navicat SQL Server Data Transfer

Source Server         : SQL Server Local
Source Server Version : 100000
Source Host           : NB-RIZKYP\SQLEXPRESS:1433
Source Database       : dashboard-bri
Source Schema         : dbo

Target Server Type    : SQL Server
Target Server Version : 100000
File Encoding         : 65001

Date: 2018-03-15 11:23:37
*/


-- ----------------------------
-- Table structure for account_plannings
-- ----------------------------
DROP TABLE [dbo].[account_plannings]
GO
CREATE TABLE [dbo].[account_plannings] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[is_submitted] bit NULL DEFAULT ((0)) ,
[is_signed] bit NULL DEFAULT ((0)) ,
[is_approved] bit NULL DEFAULT ((0)) ,
[checker_id] int NULL ,
[signer_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO

-- ----------------------------
-- Records of account_plannings
-- ----------------------------
SET IDENTITY_INSERT [dbo].[account_plannings] ON
GO
SET IDENTITY_INSERT [dbo].[account_plannings] OFF
GO

-- ----------------------------
-- Table structure for banking_facilities
-- ----------------------------
DROP TABLE [dbo].[banking_facilities]
GO
CREATE TABLE [dbo].[banking_facilities] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[groupdetail_id] int NULL ,
[data_year] smallint NULL ,
[amount_idr] decimal(21,2) NULL ,
[amountidr_percent] decimal(4,2) NULL ,
[amount_valas] decimal(21,2) NULL ,
[amountvalas_percent] decimal(4,2) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[banking_facilities]', RESEED, 16)
GO

-- ----------------------------
-- Records of banking_facilities
-- ----------------------------
SET IDENTITY_INSERT [dbo].[banking_facilities] ON
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'1', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'1', N'2', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'1', N'13', N'2018', N'13387882289725.00', N'13.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'1', N'3', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'1', N'4', N'2018', N'59000000000.00', N'2.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'1', N'5', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'1', N'6', N'2018', N'450000000000.00', N'2.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'1', N'7', N'2018', N'593864000000.00', N'6.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'1', N'8', N'2018', N'2132016911873420.00', N'1.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'1', N'9', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'1', N'10', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'1', N'11', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'1', N'12', N'2018', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'1', N'14', N'2018', N'28056540837000.00', N'2.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'1', N'15', N'2018', N'7515231543000.00', N'2.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[banking_facilities] ([id], [customer_id], [groupdetail_id], [data_year], [amount_idr], [amountidr_percent], [amount_valas], [amountvalas_percent], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'1', N'16', N'2018', N'14567377422000.00', N'2.00', N'.00', N'.00', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[banking_facilities] OFF
GO

-- ----------------------------
-- Table structure for competition_analysis
-- ----------------------------
DROP TABLE [dbo].[competition_analysis]
GO
CREATE TABLE [dbo].[competition_analysis] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[groupdetail_id] int NULL ,
[data_year] smallint NULL ,
[competingbank1_id] int NULL ,
[competingbank2_id] int NULL ,
[competingbank3_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[competition_analysis]', RESEED, 19)
GO

-- ----------------------------
-- Records of competition_analysis
-- ----------------------------
SET IDENTITY_INSERT [dbo].[competition_analysis] ON
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'1', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'1', N'2', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'1', N'13', N'2017', N'3', null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'1', N'3', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'1', N'4', N'2017', N'3', null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'1', N'5', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'1', N'6', N'2017', N'3', N'1', N'2', N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'1', N'7', N'2017', N'3', null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'1', N'8', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'1', N'9', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'1', N'10', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'1', N'11', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'1', N'12', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'1', N'13', N'2017', null, null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'1', N'14', N'2017', N'3', N'1', N'2', N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'1', N'15', N'2017', N'3', N'1', N'2', N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'1', N'16', N'2017', N'3', N'1', N'2', N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'1', N'17', N'2017', N'3', N'1', N'2', N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[competition_analysis] ([id], [customer_id], [groupdetail_id], [data_year], [competingbank1_id], [competingbank2_id], [competingbank3_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'1', N'18', N'2017', N'3', null, null, N'1', N'2018-02-28 05:05:02.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[competition_analysis] OFF
GO

-- ----------------------------
-- Table structure for coverage_mappings
-- ----------------------------
DROP TABLE [dbo].[coverage_mappings]
GO
CREATE TABLE [dbo].[coverage_mappings] (
[id] int NOT NULL IDENTITY(1,1) ,
[client_name] varchar(100) NULL ,
[contact_person] varchar(20) NULL ,
[position_client] varchar(50) NULL ,
[other_information] varchar(50) NULL ,
[position_bank] varchar(50) NULL ,
[bankperson_name] varchar(100) NULL ,
[customer_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO

-- ----------------------------
-- Records of coverage_mappings
-- ----------------------------
SET IDENTITY_INSERT [dbo].[coverage_mappings] ON
GO
SET IDENTITY_INSERT [dbo].[coverage_mappings] OFF
GO

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE [dbo].[customers]
GO
CREATE TABLE [dbo].[customers] (
[id] int NOT NULL IDENTITY(1,1) ,
[virtual_cif] varchar(20) NOT NULL ,
[customer_name] varchar(100) NOT NULL ,
[address] text NULL ,
[city_id] int NULL ,
[parent_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL ,
[is_parent] bit NOT NULL DEFAULT ((1)) 
)


GO
DBCC CHECKIDENT(N'[dbo].[customers]', RESEED, 10)
GO

-- ----------------------------
-- Records of customers
-- ----------------------------
SET IDENTITY_INSERT [dbo].[customers] ON
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'1', N'TX14921', N'Tentara Nasional Indonesia Angkatan Darat', N'Jl. Merdeka Utara No. 2 Gambir Jakarta', N'33', null, N'1', N'2018-02-26 15:03:52.000', N'1', null, null, N'1')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'2', N'PLN1234', N'PT. Perusahaan Listrik Negara (PERSERO)', N'Jl. Trunojoyo Blok M 1 No. 135', N'34', null, N'1', N'2018-02-26 15:06:57.000', N'1', null, null, N'1')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'3', N'P020190', N'PT. Kereta Api Indonesia (PERSERO)', N'Jl. Perintis Kemerdekaan No.1', N'5', null, N'1', N'2018-02-26 15:09:41.000', N'1', null, null, N'1')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'4', N'FH90454', N'PT. Freeport Indonesia', N'Plaza 89, Lt. 5. Jl. HR. Rasuna Said Kav. X-7 No. 6', N'34', null, N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'1')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'5', N'TEST001', N'PT Astra Graphia', null, N'34', null, N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'1')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'6', N'TEST002', N'PT Astra Graphia IT', null, N'34', N'5', N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'0')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'7', N'TEST003', N'PT AGIT Junior', null, N'34', N'6', N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'0')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'8', N'TEST004', N'PT AG Solutions', null, N'34', N'5', N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'0')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'9', N'TEST005', N'PT XEROX Indonesia', null, N'34', N'5', N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'0')
GO
GO
INSERT INTO [dbo].[customers] ([id], [virtual_cif], [customer_name], [address], [city_id], [parent_id], [status], [addon], [addby], [modion], [modiby], [is_parent]) VALUES (N'10', N'TEST006', N'PT PINDAD', null, N'33', N'1', N'1', N'2018-02-26 15:12:42.000', N'1', null, null, N'0')
GO
GO
SET IDENTITY_INSERT [dbo].[customers] OFF
GO

-- ----------------------------
-- Table structure for dataset1
-- ----------------------------
DROP TABLE [dbo].[dataset1]
GO
CREATE TABLE [dbo].[dataset1] (
[id] int NOT NULL IDENTITY(1,1) ,
[date] datetime NULL ,
[value1] decimal(16,2) NULL ,
[value2] decimal(16,2) NULL 
)


GO

-- ----------------------------
-- Records of dataset1
-- ----------------------------
SET IDENTITY_INSERT [dbo].[dataset1] ON
GO
SET IDENTITY_INSERT [dbo].[dataset1] OFF
GO

-- ----------------------------
-- Table structure for estimated_financials
-- ----------------------------
DROP TABLE [dbo].[estimated_financials]
GO
CREATE TABLE [dbo].[estimated_financials] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[facilitygroup_id] int NULL ,
[data_year] smallint NULL ,
[projection_idr] decimal(22) NULL ,
[projection_valas] decimal(22) NULL ,
[target_idr] decimal(22) NULL ,
[target_valas] decimal(22) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[estimated_financials]', RESEED, 20)
GO

-- ----------------------------
-- Records of estimated_financials
-- ----------------------------
SET IDENTITY_INSERT [dbo].[estimated_financials] ON
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'1', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'1', N'2', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'1', N'13', N'2017', N'20955750000000', null, N'1676460000000', null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'1', N'3', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'1', N'4', N'2017', N'1200000000000', null, N'720000000000', null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'1', N'5', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'1', N'6', N'2017', N'11400000000000', null, N'4800000000', null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'1', N'7', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'1', N'8', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'1', N'9', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'1', N'10', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'1', N'11', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'1', N'12', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'1', N'14', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'1', N'15', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'1', N'16', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'1', N'17', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'1', N'18', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[estimated_financials] ([id], [customer_id], [facilitygroup_id], [data_year], [projection_idr], [projection_valas], [target_idr], [target_valas], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'1', N'19', N'2017', null, null, null, null, N'1', N'2018-02-28 05:35:05.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[estimated_financials] OFF
GO

-- ----------------------------
-- Table structure for facilitygroup_details
-- ----------------------------
DROP TABLE [dbo].[facilitygroup_details]
GO
CREATE TABLE [dbo].[facilitygroup_details] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(100) NOT NULL ,
[bankingfacilities_id] int NOT NULL ,
[is_default] bit NULL DEFAULT ((0)) ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[facilitygroup_details]', RESEED, 18)
GO

-- ----------------------------
-- Records of facilitygroup_details
-- ----------------------------
SET IDENTITY_INSERT [dbo].[facilitygroup_details] ON
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'KI', N'1', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'KMK', N'1', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Bank Guarantee', N'2', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'L/C', N'2', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'SKBDN', N'2', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'Current Account', N'3', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'Time Deposit', N'3', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'Payroll', N'4', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'CMS', N'4', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'EDC', N'4', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'Forex', N'4', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'EDC', N'4', N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'Briguna', N'1', N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'Belanja Pegawai', N'5', N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'Belanja Modal', N'5', N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'Belanja Barang', N'5', N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'Pengeluaran Non Anggaran', N'5', N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[facilitygroup_details] ([id], [name], [bankingfacilities_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'Penerimaan Negara Bukan Pajak', N'5', N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[facilitygroup_details] OFF
GO

-- ----------------------------
-- Table structure for financial_highlights
-- ----------------------------
DROP TABLE [dbo].[financial_highlights]
GO
CREATE TABLE [dbo].[financial_highlights] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[groupdetail_id] int NULL ,
[data_year] smallint NULL ,
[data_value] decimal(16,2) NULL ,
[status] bit NULL ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[financial_highlights]', RESEED, 72)
GO

-- ----------------------------
-- Records of financial_highlights
-- ----------------------------
SET IDENTITY_INSERT [dbo].[financial_highlights] ON
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'2', N'1', N'2014', N'85424.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'2', N'2', N'2014', N'440401.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'2', N'3', N'2014', N'539521.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'2', N'4', N'2014', N'85529.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'2', N'5', N'2014', N'266818.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'2', N'6', N'2014', N'187174.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'2', N'7', N'2014', N'292721.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'2', N'8', N'2014', N'223265.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'2', N'9', N'2014', N'69456.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'2', N'10', N'2014', N'18948.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'2', N'11', N'2014', N'14004.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'2', N'12', N'2014', N'99.88', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'2', N'13', N'2014', N'86.30', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'2', N'14', N'2014', N'106000000000.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'2', N'15', N'2014', N'19.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'2', N'16', N'2014', N'37.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'2', N'17', N'2014', N'46.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'2', N'18', N'2014', N'16.34', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'2', N'19', N'2014', N'4.78', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'20', N'2', N'20', N'2014', N'6.60', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'21', N'2', N'21', N'2014', N'188.25', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'22', N'2', N'22', N'2014', N'65.31', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'23', N'2', N'23', N'2014', N'336.64', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'24', N'2', N'24', N'2014', N'56016000000.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'25', N'2', N'1', N'2015', N'79345.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'26', N'2', N'2', N'2015', N'1187880.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'27', N'2', N'3', N'2015', N'1314371.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'28', N'2', N'4', N'2015', N'120139.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'29', N'2', N'5', N'2015', N'389441.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'30', N'2', N'6', N'2015', N'804791.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'31', N'2', N'7', N'2015', N'273900.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'32', N'2', N'8', N'2015', N'172756.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'33', N'2', N'9', N'2015', N'101144.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'34', N'2', N'10', N'2015', N'15913.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'35', N'2', N'11', N'2015', N'6027.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'36', N'2', N'12', N'2015', N'66.04', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'37', N'2', N'13', N'2015', N'56.54', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'38', N'2', N'14', N'2015', N'40794000000.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'39', N'2', N'15', N'2015', N'24.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'40', N'2', N'16', N'2015', N'33.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'41', N'2', N'17', N'2015', N'56.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'42', N'2', N'18', N'2015', N'27.10', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'43', N'2', N'19', N'2015', N'2.20', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'44', N'2', N'20', N'2015', N'1.83', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'45', N'2', N'21', N'2015', N'63.32', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'46', N'2', N'22', N'2015', N'38.77', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'47', N'2', N'23', N'2015', N'125.01', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'48', N'2', N'24', N'2015', N'49977000000.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'49', N'2', N'1', N'2016', N'100967.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'50', N'2', N'2', N'2016', N'1145529.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'51', N'2', N'3', N'2016', N'1274576.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'52', N'2', N'4', N'2016', N'121623.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'53', N'2', N'5', N'2016', N'272155.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'54', N'2', N'6', N'2016', N'880798.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'55', N'2', N'7', N'2016', N'163407.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'56', N'2', N'8', N'2016', N'139442.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'57', N'2', N'9', N'2016', N'23965.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'58', N'2', N'10', N'2016', N'15976.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'59', N'2', N'11', N'2016', N'10549.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'60', N'2', N'12', N'2016', N'83.02', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'61', N'2', N'13', N'2016', N'73.50', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'62', N'2', N'14', N'2016', N'20656000000.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'63', N'2', N'15', N'2016', N'22.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'64', N'2', N'16', N'2016', N'48.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'65', N'2', N'17', N'2016', N'56.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'66', N'2', N'18', N'2016', N'19.97', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'67', N'2', N'19', N'2016', N'3.72', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'68', N'2', N'20', N'2016', N'3.63', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'69', N'2', N'21', N'2016', N'44.71', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'70', N'2', N'22', N'2016', N'30.89', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'71', N'2', N'23', N'2016', N'333.86', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financial_highlights] ([id], [customer_id], [groupdetail_id], [data_year], [data_value], [status], [addon], [addby], [modion], [modiby]) VALUES (N'72', N'2', N'24', N'2016', N'62443000000.00', N'1', N'2018-02-27 11:55:58.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[financial_highlights] OFF
GO

-- ----------------------------
-- Table structure for financialgroup_details
-- ----------------------------
DROP TABLE [dbo].[financialgroup_details]
GO
CREATE TABLE [dbo].[financialgroup_details] (
[id] int NOT NULL IDENTITY(1,1) ,
[group_name] varchar(100) NOT NULL ,
[group_id] int NOT NULL ,
[is_default] bit NULL DEFAULT ((0)) ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[financialgroup_details]', RESEED, 31)
GO

-- ----------------------------
-- Records of financialgroup_details
-- ----------------------------
SET IDENTITY_INSERT [dbo].[financialgroup_details] ON
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Current Assets', N'1', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Fixed Assets', N'1', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Total Assets', N'1', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Short-term Liabilities', N'1', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Long-term Liabilities', N'1', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'Equity', N'1', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'Sales', N'2', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'COGS', N'2', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'Operating Profit', N'2', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'Gross Profit', N'2', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'Net Profit', N'2', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'Current Ratio', N'3', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'Quick Ratio', N'3', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'NWC', N'3', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'DOI', N'4', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'DOR', N'4', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'DOP', N'4', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'Operating Margin', N'5', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'Net Profit Margin', N'5', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'20', N'Return on Asset', N'5', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'21', N'Debt to Equity', N'6', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'22', N'Debt to Total Asset', N'6', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'23', N'Interest Coverage', N'6', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'24', N'EBITDA', N'6', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'25', N'DSCR', N'6', N'1', N'1', N'2018-02-27 11:46:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'26', N'Test 1', N'1', N'1', N'1', N'2018-03-08 11:00:24.000', N'2', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'27', N'Test 2', N'2', N'1', N'1', N'2018-03-08 11:11:48.000', N'2', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'28', N'Test 3', N'4', N'1', N'1', N'2018-03-08 11:14:03.000', N'2', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'29', N'Test 4', N'6', N'1', N'1', N'2018-03-08 11:17:01.000', N'2', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'30', N'Test 5', N'2', N'1', N'1', N'2018-03-08 11:20:50.000', N'2', null, null)
GO
GO
INSERT INTO [dbo].[financialgroup_details] ([id], [group_name], [group_id], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'31', N'Test 6', N'4', N'1', N'1', N'2018-03-08 11:24:27.000', N'2', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[financialgroup_details] OFF
GO

-- ----------------------------
-- Table structure for fundings
-- ----------------------------
DROP TABLE [dbo].[fundings]
GO
CREATE TABLE [dbo].[fundings] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[data_year] smallint NULL ,
[funding_need] varchar(255) NULL ,
[time_period] smallint NULL ,
[nominal] decimal(22) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[fundings]', RESEED, 3)
GO

-- ----------------------------
-- Records of fundings
-- ----------------------------
SET IDENTITY_INSERT [dbo].[fundings] ON
GO
INSERT INTO [dbo].[fundings] ([id], [customer_id], [data_year], [funding_need], [time_period], [nominal], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'2017', N'Potensi Briguna Anggota Prajurit dan PNS', N'180', N'20955750000000', N'1', N'2018-02-28 05:23:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[fundings] ([id], [customer_id], [data_year], [funding_need], [time_period], [nominal], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'1', N'2017', N'Potensi Bank Garansi dan LC Pembelian Pesawat Apache', N'60', N'20000000000000', N'1', N'2018-02-28 05:23:06.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[fundings] ([id], [customer_id], [data_year], [funding_need], [time_period], [nominal], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'1', N'2017', N'Potensi Pembiayaan KPR', N'240', N'1200000000000', N'1', N'2018-02-28 05:23:06.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[fundings] OFF
GO

-- ----------------------------
-- Table structure for group_overviews
-- ----------------------------
DROP TABLE [dbo].[group_overviews]
GO
CREATE TABLE [dbo].[group_overviews] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[globalrating_id] int NULL ,
[domesticrating_id] int NULL ,
[industrytrend_id] int NULL ,
[lifecycle_id] int NULL ,
[organization_path] varchar(255) NULL ,
[group_path] varchar(255) NULL ,
[business_path] varchar(255) NULL ,
[industry_type] varchar(100) NULL ,
[status] bit NULL ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO

-- ----------------------------
-- Records of group_overviews
-- ----------------------------
SET IDENTITY_INSERT [dbo].[group_overviews] ON
GO
INSERT INTO [dbo].[group_overviews] ([id], [customer_id], [globalrating_id], [domesticrating_id], [industrytrend_id], [lifecycle_id], [organization_path], [group_path], [business_path], [industry_type], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'2', N'1', N'3', N'2', null, null, null, null, N'1', N'2018-03-14 13:54:44.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[group_overviews] OFF
GO

-- ----------------------------
-- Table structure for initiatives
-- ----------------------------
DROP TABLE [dbo].[initiatives]
GO
CREATE TABLE [dbo].[initiatives] (
[id] int NOT NULL IDENTITY(1,1) ,
[initiatives] varchar(100) NULL ,
[description] varchar(255) NULL ,
[quarter_id] int NULL ,
[month_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL ,
[customer_id] int NULL 
)


GO

-- ----------------------------
-- Records of initiatives
-- ----------------------------
SET IDENTITY_INSERT [dbo].[initiatives] ON
GO
SET IDENTITY_INSERT [dbo].[initiatives] OFF
GO

-- ----------------------------
-- Table structure for m_bankingfacilities
-- ----------------------------
DROP TABLE [dbo].[m_bankingfacilities]
GO
CREATE TABLE [dbo].[m_bankingfacilities] (
[id] int NOT NULL IDENTITY(1,1) ,
[group_name] varchar(100) NULL ,
[description] varchar(255) NULL ,
[is_default] bit NULL DEFAULT ((0)) ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_bankingfacilities]', RESEED, 5)
GO

-- ----------------------------
-- Records of m_bankingfacilities
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_bankingfacilities] ON
GO
INSERT INTO [dbo].[m_bankingfacilities] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Direct Loan', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_bankingfacilities] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Indirect Loan', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_bankingfacilities] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Cash', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_bankingfacilities] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Transaction Banking', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_bankingfacilities] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Anggaran TNI AD 2018', null, N'0', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_bankingfacilities] OFF
GO

-- ----------------------------
-- Table structure for m_banks
-- ----------------------------
DROP TABLE [dbo].[m_banks]
GO
CREATE TABLE [dbo].[m_banks] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(70) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_banks]', RESEED, 67)
GO

-- ----------------------------
-- Records of m_banks
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_banks] ON
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Bank Mandiri', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Bank Negara Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Bank Rakyat Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Bank Tabungan Negara', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Bank BRI Argoniaga', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'Bank Anda', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'Bank Interpacific', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'Bank Bukopin', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'Bank Bumi Arta', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'Bank Capital Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'Bank Central Asia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'Bank CIMB Niaga', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'Bank Danamon Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'Bank Ekonomi Raharja', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'Bank Ganesha', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'Bank KEB Hana', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'Bank Woori Saudara', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'Bank ICBC Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'Bank Index Selindo', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'20', N'Bank Maybank Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'21', N'Bank Maspion', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'22', N'Bank Mayapada', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'23', N'Bank Mega', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'24', N'Bank Mestika Dharma', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'25', N'Bank Shinhan Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'26', N'Bank MNC Internasional', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'27', N'Bank J Trust Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'28', N'Bank Nusantara Parahyangan', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'29', N'Bank OCBC NISP', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'30', N'Bank of India Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'31', N'Panin Bank', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'32', N'Bank Permata', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'33', N'Bank QNB Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'34', N'Bank SBI Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'35', N'Bank Sinarmas', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'36', N'Bank UOB Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'37', N'Bank ANZ Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'38', N'Bank Commonwealth', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'39', N'Bank Agris', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'40', N'Bank BNP Paribas Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'41', N'Bank Chinatrust Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'42', N'Bank DBS Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'43', N'Bank Mizuho Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'44', N'Bank Rabobank International Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'45', N'Bank Resona Perdania', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'46', N'Bank Sumitomo Mitsui Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'47', N'Bank Windu Kentjana Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'48', N'Bank of America', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'49', N'Bangkok Bank', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'50', N'Bank of China', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'51', N'Citibank', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'52', N'Deutsche Bank', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'53', N'HSBC', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'54', N'JPMorgan Chase', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'55', N'Standard Chatered', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'56', N'The Bank of Tokyo', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'57', N'Bank BNI Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'58', N'Bank Mega Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'59', N'Bank Muamalat Indonesia', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'60', N'Bank Syariah Mandiri', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'61', N'Bank BCA Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'62', N'Bank BJB Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'63', N'Bank BRI Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'64', N'Panin Bank Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'65', N'Bank Syariah Bukopin', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'66', N'Bank Victoria Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_banks] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'67', N'BTPN Syariah', null, N'1', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_banks] OFF
GO

-- ----------------------------
-- Table structure for m_cities
-- ----------------------------
DROP TABLE [dbo].[m_cities]
GO
CREATE TABLE [dbo].[m_cities] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(100) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_cities]', RESEED, 99)
GO

-- ----------------------------
-- Records of m_cities
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_cities] ON
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Ambon', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Balikpapan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Banda Aceh', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Bandar Lampung', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Bandung', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'Banjar', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'Banjarbaru', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'Banjarmasin', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'Batam', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'Batu', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'Bau-Bau', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'Bekasi', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'Bengkulu', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'Bima', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'Binjai', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'Bitung', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'Blitar', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'Bogor', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'Bontang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'20', N'Bukittinggi', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'21', N'Cilegon', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'22', N'Cimahi', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'23', N'Cirebon', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'24', N'Denpasar', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'25', N'Depok', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'26', N'Dumai', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'27', N'Gorontalo', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'28', N'Jambi', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'29', N'Jayapura', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'30', N'Kediri', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'31', N'Kendari', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'32', N'Jakarta Barat', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'33', N'Jakarta Pusat', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'34', N'Jakarta Selatan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'35', N'Jakarta Timur', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'36', N'Jakarta Utara', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'37', N'Kotamobagu', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'38', N'Kupang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'39', N'Langsa', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'40', N'Lhokseumawe', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'41', N'Lubuklinggau', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'42', N'Madiun', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'43', N'Magelang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'44', N'Makassar', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'45', N'Malang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'46', N'Manado', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'47', N'Mataram', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'48', N'Medan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'49', N'Metro', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'50', N'Meulaboh', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'51', N'Mojokerto', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'52', N'Padang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'53', N'Padang Sidempuan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'54', N'Padangpanjang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'55', N'Pagaralam', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'56', N'Palangkaraya', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'57', N'Palembang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'58', N'Palopo', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'59', N'Palu', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'60', N'Pangkalpinang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'61', N'Parepare', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'62', N'Pariaman', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'63', N'Pasuruan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'64', N'Payakumbuh', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'65', N'Pekalongan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'66', N'Pekanbaru', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'67', N'Pematangsiantar', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'68', N'Pontianak', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'69', N'Prabumulih', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'70', N'Probolinggo', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'71', N'Purwokerto', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'72', N'Sabang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'73', N'Salatiga', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'74', N'Samarinda', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'75', N'Sawahlunto', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'76', N'Semarang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'77', N'Serang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'78', N'Sibolga', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'79', N'Singkawang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'80', N'Solok', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'81', N'Sorong', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'82', N'Subulussalam', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'83', N'Sukabumi', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'84', N'Sungai Penuh', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'85', N'Surabaya', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'86', N'Surakarta', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'87', N'Tangerang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'88', N'Tangerang Selatan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'89', N'Tanjungbalai', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'90', N'Tanjungpinang', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'91', N'Tarakan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'92', N'Tasikmalaya', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'93', N'Tebingtinggi', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'94', N'Tegal', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'95', N'Ternate', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'96', N'Tidore Kepulauan', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'97', N'Tomohon', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'98', N'Tual', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_cities] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'99', N'Yogyakarta', N'', N'1', N'2018-02-26 14:31:00.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_cities] OFF
GO

-- ----------------------------
-- Table structure for m_classifications
-- ----------------------------
DROP TABLE [dbo].[m_classifications]
GO
CREATE TABLE [dbo].[m_classifications] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(50) NULL ,
[description] varchar(255) NULL ,
[parameter] decimal(22) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_classifications]', RESEED, 4)
GO

-- ----------------------------
-- Records of m_classifications
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_classifications] ON
GO
INSERT INTO [dbo].[m_classifications] ([id], [name], [description], [parameter], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Platinum', N'test om', N'12345', N'1', N'2018-03-07 13:55:05.000', N'1', N'2018-03-08 04:07:12.000', N'2')
GO
GO
INSERT INTO [dbo].[m_classifications] ([id], [name], [description], [parameter], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Gold', null, null, N'1', N'2018-03-07 13:55:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_classifications] ([id], [name], [description], [parameter], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Silver', null, null, N'1', N'2018-03-07 13:55:05.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_classifications] ([id], [name], [description], [parameter], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Bronze', null, null, N'1', N'2018-03-07 13:55:05.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_classifications] OFF
GO

-- ----------------------------
-- Table structure for m_divisions
-- ----------------------------
DROP TABLE [dbo].[m_divisions]
GO
CREATE TABLE [dbo].[m_divisions] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(100) NULL ,
[is_productspecialist] bit NULL DEFAULT ((0)) ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_divisions]', RESEED, 7)
GO

-- ----------------------------
-- Records of m_divisions
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_divisions] ON
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Agribisnisadad', N'1', N'1', N'2018-02-26 16:13:39.000', N'1', N'2018-03-06 05:38:08.000', N'2')
GO
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Komersial dasdasdasdqwd', N'1', N'1', N'2018-02-26 16:13:39.000', N'1', N'2018-03-06 05:50:03.000', N'2')
GO
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'BUMN 1', N'1', N'0', N'2018-02-26 16:13:39.000', N'1', N'2018-03-06 05:55:49.000', N'2')
GO
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'BUMN 2', N'0', N'1', N'2018-02-26 16:13:39.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Sindikasi & Jasa Lembaga Keuangan', N'0', N'1', N'2018-02-26 16:13:39.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'HBL 1', N'0', N'1', N'2018-02-26 16:13:39.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_divisions] ([id], [name], [is_productspecialist], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'HBL 2', N'0', N'1', N'2018-02-26 16:13:39.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_divisions] OFF
GO

-- ----------------------------
-- Table structure for m_domesticratings
-- ----------------------------
DROP TABLE [dbo].[m_domesticratings]
GO
CREATE TABLE [dbo].[m_domesticratings] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(50) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_domesticratings]', RESEED, 9)
GO

-- ----------------------------
-- Records of m_domesticratings
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_domesticratings] ON
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'No Rating', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'idAAA', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'idAA', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'idA', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'idBBB', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'idBB', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'idB', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'idCCC', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_domesticratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'idD', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_domesticratings] OFF
GO

-- ----------------------------
-- Table structure for m_financialgroups
-- ----------------------------
DROP TABLE [dbo].[m_financialgroups]
GO
CREATE TABLE [dbo].[m_financialgroups] (
[id] int NOT NULL IDENTITY(1,1) ,
[group_name] varchar(100) NOT NULL ,
[description] varchar(255) NULL ,
[is_default] bit NULL ,
[status] bit NULL ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_financialgroups]', RESEED, 6)
GO

-- ----------------------------
-- Records of m_financialgroups
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_financialgroups] ON
GO
INSERT INTO [dbo].[m_financialgroups] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Balance Sheet', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_financialgroups] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Income Statement', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_financialgroups] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Liquidity', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_financialgroups] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Activity (days)', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_financialgroups] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Profitability', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_financialgroups] ([id], [group_name], [description], [is_default], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'Solvability', null, N'1', N'1', N'2018-02-27 14:16:26.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_financialgroups] OFF
GO

-- ----------------------------
-- Table structure for m_globalratings
-- ----------------------------
DROP TABLE [dbo].[m_globalratings]
GO
CREATE TABLE [dbo].[m_globalratings] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(50) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_globalratings]', RESEED, 67)
GO

-- ----------------------------
-- Records of m_globalratings
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_globalratings] ON
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'No Rating', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Fitch_AAA', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Fitch_AA+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Fitch_AA', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Fitch_AA-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'Fitch_A+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'Fitch_A', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'Fitch_A-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'Fitch_BBB+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'Fitch_BBB', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'Fitch_BBB-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'Fitch_BB+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'Fitch_BB', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'Fitch_BB-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'Fitch_B+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'Fitch_B', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'Fitch_B-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'Fitch_CCC+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'19', N'Fitch_CCC', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'20', N'Fitch_CCC-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'21', N'Fitch_CC+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'22', N'Fitch_CC', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'23', N'Fitch_CC-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'24', N'Fitch_DDD', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'25', N'S&P_AAA', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'26', N'S&P_AA+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'27', N'S&P_AA', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'28', N'S&P_AA-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'29', N'S&P_A+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'30', N'S&P_A', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'31', N'S&P_A-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'32', N'S&P_BBB+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'33', N'S&P_BBB', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'34', N'S&P_BBB-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'35', N'S&P_BB+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'36', N'S&P_BB', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'37', N'S&P_BB-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'38', N'S&P_B+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'39', N'S&P_B', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'40', N'S&P_B-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'41', N'S&P_CCC+', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'42', N'S&P_CCC', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'43', N'S&P_CCC-', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'44', N'S&P_CC', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'45', N'S&P_C', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'46', N'S&P_D', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'47', N'Moody`s_Aaa', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'48', N'Moody`s_Aa1', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'49', N'Moody`s_Aa2', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'50', N'Moody`s_Aa3', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'51', N'Moody`s_A1', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'52', N'Moody`s_A2', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'53', N'Moody`s_A3', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'54', N'Moody`s_Baa1', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'55', N'Moody`s_Baa2', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'56', N'Moody`s_Baa3', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'57', N'Moody`s_Ba1', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'58', N'Moody`s_Ba2', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'59', N'Moody`s_Ba3', N'Investment Grade', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'60', N'Moody`s_B1', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'61', N'Moody`s_B2', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'62', N'Moody`s_B3', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'63', N'Moody`s_Caa1', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'64', N'Moody`s_Caa2', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'65', N'Moody`s_Caa3', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'66', N'Moody`s_Ca', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_globalratings] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'67', N'Moody`s_D', N'Junk', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_globalratings] OFF
GO

-- ----------------------------
-- Table structure for m_industrytrends
-- ----------------------------
DROP TABLE [dbo].[m_industrytrends]
GO
CREATE TABLE [dbo].[m_industrytrends] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(100) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_industrytrends]', RESEED, 5)
GO

-- ----------------------------
-- Records of m_industrytrends
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_industrytrends] ON
GO
INSERT INTO [dbo].[m_industrytrends] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Up-Turn', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_industrytrends] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Peak', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_industrytrends] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Boom', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_industrytrends] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Down-Turn', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_industrytrends] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Trough', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_industrytrends] OFF
GO

-- ----------------------------
-- Table structure for m_lifecycles
-- ----------------------------
DROP TABLE [dbo].[m_lifecycles]
GO
CREATE TABLE [dbo].[m_lifecycles] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(50) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_lifecycles]', RESEED, 4)
GO

-- ----------------------------
-- Records of m_lifecycles
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_lifecycles] ON
GO
INSERT INTO [dbo].[m_lifecycles] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Introduction', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_lifecycles] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Growth', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_lifecycles] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Mature', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_lifecycles] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Decline', N'', N'1', N'2018-02-26 14:53:31.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_lifecycles] OFF
GO

-- ----------------------------
-- Table structure for m_months
-- ----------------------------
DROP TABLE [dbo].[m_months]
GO
CREATE TABLE [dbo].[m_months] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(50) NULL ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_months]', RESEED, 12)
GO

-- ----------------------------
-- Records of m_months
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_months] ON
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'January', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'February', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'March', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'April', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'May', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'June', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'July', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'August', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'September', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'October', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'November', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_months] ([id], [name], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'December', N'2018-02-26 15:14:02.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_months] OFF
GO

-- ----------------------------
-- Table structure for m_quarters
-- ----------------------------
DROP TABLE [dbo].[m_quarters]
GO
CREATE TABLE [dbo].[m_quarters] (
[id] int NOT NULL IDENTITY(1,1) ,
[name] varchar(50) NULL ,
[description] varchar(255) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[m_quarters]', RESEED, 5)
GO

-- ----------------------------
-- Records of m_quarters
-- ----------------------------
SET IDENTITY_INSERT [dbo].[m_quarters] ON
GO
INSERT INTO [dbo].[m_quarters] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Q1', N'Quarter 1', N'1', N'2018-02-26 15:15:32.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_quarters] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Q2', N'Quarter 2', N'1', N'2018-02-26 15:15:32.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_quarters] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Q3', N'Quarter 3', N'1', N'2018-02-26 15:15:32.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_quarters] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'Q4', N'Quarter 4', N'1', N'2018-02-26 15:15:32.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[m_quarters] ([id], [name], [description], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'> 1 Year', N'More than 1 year', N'1', N'2018-02-26 15:15:32.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[m_quarters] OFF
GO

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE [dbo].[oauth_access_tokens]
GO
CREATE TABLE [dbo].[oauth_access_tokens] (
[access_token] varchar(40) NOT NULL ,
[client_id] varchar(80) NOT NULL ,
[user_id] varchar(80) NULL ,
[expires] timestamp NOT NULL ,
[scope] varchar(4000) NULL 
)


GO

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_authorization_codes
-- ----------------------------
DROP TABLE [dbo].[oauth_authorization_codes]
GO
CREATE TABLE [dbo].[oauth_authorization_codes] (
[authorization_code] varchar(40) NOT NULL ,
[client_id] varchar(80) NOT NULL ,
[user_id] varchar(80) NULL ,
[redirect_uri] varchar(2000) NULL ,
[expires] timestamp NOT NULL ,
[scope] varchar(4000) NULL ,
[id_token] varchar(1000) NULL 
)


GO

-- ----------------------------
-- Records of oauth_authorization_codes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE [dbo].[oauth_clients]
GO
CREATE TABLE [dbo].[oauth_clients] (
[client_id] varchar(80) NOT NULL ,
[client_secret] varchar(80) NULL ,
[redirect_uri] varchar(2000) NULL ,
[grant_types] varchar(80) NULL ,
[scope] varchar(4000) NULL ,
[user_id] varchar(80) NULL 
)


GO

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE [dbo].[oauth_refresh_tokens]
GO
CREATE TABLE [dbo].[oauth_refresh_tokens] (
[refresh_token] varchar(40) NOT NULL ,
[client_id] varchar(80) NOT NULL ,
[user_id] varchar(80) NULL ,
[expires] timestamp NOT NULL ,
[scope] varchar(4000) NULL 
)


GO

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_scopes
-- ----------------------------
DROP TABLE [dbo].[oauth_scopes]
GO
CREATE TABLE [dbo].[oauth_scopes] (
[scope] varchar(80) NOT NULL ,
[is_default] bit NULL 
)


GO

-- ----------------------------
-- Records of oauth_scopes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_users
-- ----------------------------
DROP TABLE [dbo].[oauth_users]
GO
CREATE TABLE [dbo].[oauth_users] (
[username] varchar(80) NOT NULL ,
[password] varchar(80) NULL ,
[first_name] varchar(80) NULL ,
[last_name] varchar(80) NULL ,
[email] varchar(80) NULL ,
[email_verified] bit NULL ,
[scope] varchar(4000) NULL 
)


GO

-- ----------------------------
-- Records of oauth_users
-- ----------------------------

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE [dbo].[services]
GO
CREATE TABLE [dbo].[services] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[data_year] smallint NULL ,
[service_name] varchar(255) NULL ,
[division_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[services]', RESEED, 4)
GO

-- ----------------------------
-- Records of services
-- ----------------------------
SET IDENTITY_INSERT [dbo].[services] ON
GO
INSERT INTO [dbo].[services] ([id], [customer_id], [data_year], [service_name], [division_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'2017', N'Pelayanan Elektronik Kartu Identinas Prajurit Multiguna (e-KIP) (Kartu Combo)', N'3', N'1', N'2018-02-28 05:28:34.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[services] ([id], [customer_id], [data_year], [service_name], [division_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'1', N'2017', N'Service Layanan Kartu Kredit Coorporate Card dan Prioritas Untuk Perwira Tinggi Bintang (Jendral)', N'3', N'1', N'2018-02-28 05:28:34.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[services] ([id], [customer_id], [data_year], [service_name], [division_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'1', N'2017', N'Penyaluran CSR BRI melalui TNI AD', N'3', N'1', N'2018-02-28 05:28:34.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[services] ([id], [customer_id], [data_year], [service_name], [division_id], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'1', N'2017', N'Potensi Agen Brilink di Koperasi Satker TNI AD', N'3', N'1', N'2018-02-28 05:28:34.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[services] OFF
GO

-- ----------------------------
-- Table structure for shareholders
-- ----------------------------
DROP TABLE [dbo].[shareholders]
GO
CREATE TABLE [dbo].[shareholders] (
[id] int NOT NULL IDENTITY(1,1) ,
[shareholder] varchar(100) NULL ,
[share] decimal(22,2) NULL ,
[portion] decimal(5,2) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[customer_id] int NULL ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[shareholders]', RESEED, 5)
GO

-- ----------------------------
-- Records of shareholders
-- ----------------------------
SET IDENTITY_INSERT [dbo].[shareholders] ON
GO
INSERT INTO [dbo].[shareholders] ([id], [shareholder], [share], [portion], [status], [customer_id], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'Pemerintah Republik Indonesia', N'1.00', N'100.00', N'1', N'1', N'2018-02-26 16:56:12.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[shareholders] ([id], [shareholder], [share], [portion], [status], [customer_id], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'Republic of Indonesia', N'439000000000000.00', N'100.00', N'1', N'2', N'2018-02-26 16:57:56.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[shareholders] ([id], [shareholder], [share], [portion], [status], [customer_id], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'Republic of Indonesia', N'6668743.00', N'100.00', N'1', N'3', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[shareholders] ([id], [shareholder], [share], [portion], [status], [customer_id], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'PT. Freeport -McMoRan Copper & Gold Inc.', N'206197.00', N'90.64', N'1', N'4', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[shareholders] ([id], [shareholder], [share], [portion], [status], [customer_id], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'Pemerintah Indonesia', N'21293.00', N'9.36', N'1', N'4', N'2018-02-26 16:37:11.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[shareholders] OFF
GO

-- ----------------------------
-- Table structure for strategic_plans
-- ----------------------------
DROP TABLE [dbo].[strategic_plans]
GO
CREATE TABLE [dbo].[strategic_plans] (
[id] int NOT NULL IDENTITY(1,1) ,
[description] varchar(255) NULL ,
[type] bit NULL DEFAULT ((1)) ,
[division_id] int NULL ,
[customer_id] int NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO

-- ----------------------------
-- Records of strategic_plans
-- ----------------------------
SET IDENTITY_INSERT [dbo].[strategic_plans] ON
GO
SET IDENTITY_INSERT [dbo].[strategic_plans] OFF
GO

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE [dbo].[users]
GO
CREATE TABLE [dbo].[users] (
[id] int NOT NULL IDENTITY(1,1) ,
[username] varchar(50) NOT NULL ,
[name] varchar(100) NOT NULL ,
[email] varchar(100) NOT NULL ,
[password] varchar(255) NOT NULL ,
[remember_token] varchar(255) NOT NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[users]', RESEED, 2)
GO

-- ----------------------------
-- Records of users
-- ----------------------------
SET IDENTITY_INSERT [dbo].[users] ON
GO
INSERT INTO [dbo].[users] ([id], [username], [name], [email], [password], [remember_token], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'superuser', N'Super User', N'superuser@localhost.com', N'21232f297a57a5a743894a0e4a801fc3', N'21232f297a57a5a743894a0e4a801fc3', N'1', N'2018-02-28 12:48:20.000', null, null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[users] OFF
GO

-- ----------------------------
-- Table structure for wallet_shares
-- ----------------------------
DROP TABLE [dbo].[wallet_shares]
GO
CREATE TABLE [dbo].[wallet_shares] (
[id] int NOT NULL IDENTITY(1,1) ,
[customer_id] int NULL ,
[groupdetail_id] int NULL ,
[data_year] smallint NULL ,
[bri_share] decimal(21,2) NULL ,
[bri_percent] decimal(5,2) NULL ,
[otherbank_share] decimal(21,2) NULL ,
[otherbank_percent] decimal(5,2) NULL ,
[total_share] decimal(21,2) NULL ,
[status] bit NULL DEFAULT ((1)) ,
[addon] datetime NULL ,
[addby] int NULL ,
[modion] datetime NULL ,
[modiby] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[wallet_shares]', RESEED, 18)
GO

-- ----------------------------
-- Records of wallet_shares
-- ----------------------------
SET IDENTITY_INSERT [dbo].[wallet_shares] ON
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'1', N'1', N'1', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'2', N'1', N'2', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'3', N'1', N'13', N'2018', N'13387882289725.00', N'100.00', N'.00', N'.00', N'13387882289725.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'4', N'1', N'3', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'5', N'1', N'4', N'2018', N'59000000000.00', N'100.00', N'.00', N'.00', N'59000000000.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'6', N'1', N'5', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'7', N'1', N'6', N'2018', N'450000000000.00', N'47.37', N'500000000000.00', N'52.63', N'950000000000.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'8', N'1', N'7', N'2018', N'593864000000.00', N'100.00', N'.00', N'.00', N'593864000000.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'9', N'1', N'8', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'10', N'1', N'9', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'11', N'1', N'10', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'12', N'1', N'11', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'13', N'1', N'12', N'2018', N'.00', N'.00', N'.00', N'.00', N'.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'14', N'1', N'14', N'2018', N'23634797207253.00', N'99.01', N'236879683000.00', N'.99', N'23871676890253.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'15', N'1', N'15', N'2018', N'6087919785588.00', N'99.99', N'334505703.00', N'.01', N'6088254291291.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'16', N'1', N'16', N'2018', N'6284895159128.00', N'90.49', N'660407476652.00', N'9.51', N'6945302635780.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'17', N'1', N'17', N'2018', N'239878875083.00', N'99.93', N'162916000.00', N'.07', N'240041791083.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
INSERT INTO [dbo].[wallet_shares] ([id], [customer_id], [groupdetail_id], [data_year], [bri_share], [bri_percent], [otherbank_share], [otherbank_percent], [total_share], [status], [addon], [addby], [modion], [modiby]) VALUES (N'18', N'1', N'18', N'2018', N'3427200.00', N'100.00', N'.00', N'.00', N'3427200.00', N'1', N'2018-02-28 04:22:13.000', N'1', null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[wallet_shares] OFF
GO

-- ----------------------------
-- Indexes structure for table account_plannings
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table account_plannings
-- ----------------------------
ALTER TABLE [dbo].[account_plannings] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table banking_facilities
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table banking_facilities
-- ----------------------------
ALTER TABLE [dbo].[banking_facilities] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table competition_analysis
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table competition_analysis
-- ----------------------------
ALTER TABLE [dbo].[competition_analysis] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table coverage_mappings
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table coverage_mappings
-- ----------------------------
ALTER TABLE [dbo].[coverage_mappings] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table customers
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table customers
-- ----------------------------
ALTER TABLE [dbo].[customers] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table dataset1
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table dataset1
-- ----------------------------
ALTER TABLE [dbo].[dataset1] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table estimated_financials
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table estimated_financials
-- ----------------------------
ALTER TABLE [dbo].[estimated_financials] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table facilitygroup_details
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table facilitygroup_details
-- ----------------------------
ALTER TABLE [dbo].[facilitygroup_details] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table financial_highlights
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table financial_highlights
-- ----------------------------
ALTER TABLE [dbo].[financial_highlights] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table financialgroup_details
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table financialgroup_details
-- ----------------------------
ALTER TABLE [dbo].[financialgroup_details] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table fundings
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table fundings
-- ----------------------------
ALTER TABLE [dbo].[fundings] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table group_overviews
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table group_overviews
-- ----------------------------
ALTER TABLE [dbo].[group_overviews] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table initiatives
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table initiatives
-- ----------------------------
ALTER TABLE [dbo].[initiatives] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_bankingfacilities
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_bankingfacilities
-- ----------------------------
ALTER TABLE [dbo].[m_bankingfacilities] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_banks
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_banks
-- ----------------------------
ALTER TABLE [dbo].[m_banks] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_cities
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_cities
-- ----------------------------
ALTER TABLE [dbo].[m_cities] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_classifications
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_classifications
-- ----------------------------
ALTER TABLE [dbo].[m_classifications] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_divisions
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_divisions
-- ----------------------------
ALTER TABLE [dbo].[m_divisions] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_domesticratings
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_domesticratings
-- ----------------------------
ALTER TABLE [dbo].[m_domesticratings] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_financialgroups
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_financialgroups
-- ----------------------------
ALTER TABLE [dbo].[m_financialgroups] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_globalratings
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_globalratings
-- ----------------------------
ALTER TABLE [dbo].[m_globalratings] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_industrytrends
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_industrytrends
-- ----------------------------
ALTER TABLE [dbo].[m_industrytrends] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_lifecycles
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_lifecycles
-- ----------------------------
ALTER TABLE [dbo].[m_lifecycles] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_months
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_months
-- ----------------------------
ALTER TABLE [dbo].[m_months] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table m_quarters
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table m_quarters
-- ----------------------------
ALTER TABLE [dbo].[m_quarters] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table oauth_access_tokens
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table oauth_access_tokens
-- ----------------------------
ALTER TABLE [dbo].[oauth_access_tokens] ADD PRIMARY KEY ([access_token])
GO

-- ----------------------------
-- Indexes structure for table oauth_authorization_codes
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table oauth_authorization_codes
-- ----------------------------
ALTER TABLE [dbo].[oauth_authorization_codes] ADD PRIMARY KEY ([authorization_code])
GO

-- ----------------------------
-- Indexes structure for table oauth_clients
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table oauth_clients
-- ----------------------------
ALTER TABLE [dbo].[oauth_clients] ADD PRIMARY KEY ([client_id])
GO

-- ----------------------------
-- Indexes structure for table oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table oauth_refresh_tokens
-- ----------------------------
ALTER TABLE [dbo].[oauth_refresh_tokens] ADD PRIMARY KEY ([refresh_token])
GO

-- ----------------------------
-- Indexes structure for table oauth_scopes
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table oauth_scopes
-- ----------------------------
ALTER TABLE [dbo].[oauth_scopes] ADD PRIMARY KEY ([scope])
GO

-- ----------------------------
-- Indexes structure for table oauth_users
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table oauth_users
-- ----------------------------
ALTER TABLE [dbo].[oauth_users] ADD PRIMARY KEY ([username])
GO

-- ----------------------------
-- Indexes structure for table services
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table services
-- ----------------------------
ALTER TABLE [dbo].[services] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table shareholders
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table shareholders
-- ----------------------------
ALTER TABLE [dbo].[shareholders] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table strategic_plans
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table strategic_plans
-- ----------------------------
ALTER TABLE [dbo].[strategic_plans] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table users
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE [dbo].[users] ADD PRIMARY KEY ([id])
GO

-- ----------------------------
-- Indexes structure for table wallet_shares
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table wallet_shares
-- ----------------------------
ALTER TABLE [dbo].[wallet_shares] ADD PRIMARY KEY ([id])
GO
