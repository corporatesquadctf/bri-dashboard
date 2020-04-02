-- DB FOR BACKEND ACCOUNT PLANNING

CREATE DATABASE [BRIDashboard] ON PRIMARY 
	(NAME = N'BRIDashboard_Data', FILENAME = N'/home/danre/mssql/data/BRIDashboard_Data.mdf' , SIZE = 167872KB , MAXSIZE = UNLIMITED, FILEGROWTH = 16384KB )
 	LOG ON 
	(NAME = N'BRIDashboard_Log', FILENAME = N'/home/danre/mssql/log/BRIDashboard_Log.ldf' , SIZE = 2048KB , MAXSIZE = 2048GB , FILEGROWTH = 16384KB )
GO

Use [BRIDashboard]


CREATE TABLE [UnitKerjaType](
	UnitKerjaTypeId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_UnitKerjaType_CreatedByModifiedBy ON UnitKerjaType(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Segment](
	SegmentId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100),
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_Segment_CreatedByModifiedBy ON Segment(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [UnitKerja](
	UnitKerjaId INT PRIMARY KEY,
	UnitKerjaTypeId INT,
	SegmentId INT,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_UnitKerja_UnitKerjaType FOREIGN KEY(UnitKerjaTypeId) REFERENCES UnitKerjaType(UnitKerjaTypeId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_UnitKerja_Segment FOREIGN KEY(SegmentId) REFERENCES Segment(SegmentId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_UnitKerja_CreatedByModifiedBy ON UnitKerja(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [ModuleType] (
	ModuleTypeId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_ModuleType_CreatedByModifiedBy ON ModuleType(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [ModuleEnvironment](
	ModuleEnvironmentId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_ModuleEnvironment_CreatedByModifiedBy ON ModuleEnvironment(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Module](
	ModuleId INT IDENTITY(1,1) PRIMARY KEY,
	ModuleTypeId INT,
	ModuleEnvironmentId INT,
	Name VARCHAR(100) NOT NULL,
	[Path] VARCHAR(255) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_Module_ModuleType FOREIGN KEY(ModuleTypeId) REFERENCES ModuleType(ModuleTypeId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_Module_ModuleEnvironment FOREIGN KEY(ModuleEnvironmentId) REFERENCES ModuleEnvironment(ModuleEnvironmentId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_Module_CreatedByModifiedBy ON Module(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [SubRole] (
	SubRoleId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_SubRole_CreatedByModifiedBy ON SubRole(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Role](
	RoleId INT IDENTITY(1,1) PRIMARY KEY,
	SubRoleId INT,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
	CONSTRAINT FK_Role_SubRole FOREIGN KEY(SubRoleId) REFERENCES SubRole(SubRoleId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_Role_CreatedByModifiedBy ON [Role](IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [MapModuleRole](
	ModuleId INT,
	RoleId INT,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	CONSTRAINT PK_MapModuleRole PRIMARY KEY(ModuleId, RoleId),
	CONSTRAINT FK_MapModuleRole_Module FOREIGN KEY(ModuleId) REFERENCES Module(ModuleId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_MapModuleRole_Role FOREIGN KEY(RoleId) REFERENCES Role(RoleId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_MapModuleRole_CreatedBy ON MapModuleRole(CreatedDate, CreatedBy);

CREATE TABLE [Token](
	TokenId INT IDENTITY(1,1) PRIMARY KEY,
	TokenNumber VARCHAR(100) NOT NULL,
	Expires INT,
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_Token_CreatedByModifiedBy ON Token(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [User](
	UserId VARCHAR(10) PRIMARY KEY,
	UnitKerjaId INT,
	RoleId INT,
	Name VARCHAR(255) NOT NULL,
	Title VARCHAR(100),
	CorporateEmail VARCHAR(100),
	OtherEmail VARCHAR(100),
	PhoneNumber1 VARCHAR(25),
	PhoneNumber2 VARCHAR(25),
	ProfilePicture VARCHAR(100),
	Password VARCHAR(100),
	TokenId INT,
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
	CONSTRAINT FK_User_UnitKerja FOREIGN KEY(UnitKerjaId) REFERENCES UnitKerja(UnitKerjaId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_User_Role FOREIGN KEY(RoleId) REFERENCES Role(RoleId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_User_Token FOREIGN KEY(TokenId) REFERENCES Token(TokenId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_User_CreatedByModifiedBy ON [User](IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Classification] (
	ClassificationId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100),
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_Classificationn_CreatedByModifiedBy ON Classification(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [SektorUsaha](
	SektorUsahaId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100),
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_SektorUsaha_CreatedByModifiedBy ON SektorUsaha(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CustomerGroup](
	CustomerGroupId INT IDENTITY(1,1) PRIMARY KEY,
	SektorUsahaId INT,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CustomerGroup_SektorUsaha FOREIGN KEY(SektorUsahaId) REFERENCES SektorUsaha(SektorUsahaId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CustomerGroup_CreatedByModifiedBy ON [CustomerGroup](IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CustomerGroupClassification](
	CustomerGroupClassificationId INT IDENTITY(1,1) PRIMARY KEY,
	CustomerGroupId INT,
	ClassificationId INT,
	Year CHAR(4),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CustomerGroupClassification_Group FOREIGN KEY(CustomerGroupId) REFERENCES CustomerGroup(CustomerGroupId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_CustomerGroupClassification_Classification FOREIGN KEY(ClassificationId) REFERENCES Classification(ClassificationId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CustomerGroupClassification_CreatedByModifiedBy ON CustomerGroupClassification(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);
CREATE INDEX ix_CusomerGroupClassification_Year ON CustomerGroupClassification(Year);

CREATE TABLE [Customer](
	VCIF VARCHAR(10) PRIMARY KEY,
	CustomerGroupId INT,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_Customer_CustomerGroup FOREIGN KEY(CustomerGroupId) REFERENCES [CustomerGroup](CustomerGroupId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_Customer_CreatedByModifiedBy ON Customer(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CIF](
	CIFNo VARCHAR(10) PRIMARY KEY,
	VCIF VARCHAR(10),
	Name VARCHAR(100),
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CIF_Customer FOREIGN KEY(VCIF) REFERENCES Customer(VCIF) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CIF_CreatedByModifiedBy ON CIF(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [ProfileStat](
	ProfileStatId INT IDENTITY(1,1) PRIMARY KEY,
	UnitKerjaId INT,
	UserId VARCHAR(10),
	Comment VARCHAR(MAX),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_ProfileStat_CreatedByModifiedBy ON ProfileStat(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);
CREATE INDEX ix_ProfileStat_UnitKerjaUser ON ProfileStat(UnitKerjaId, UserId);

CREATE TABLE [DocumentStatus](
	DocumentStatusId INT PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_DocumentStatus_CreatedByModifiedBy ON DocumentStatus(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [DisposisiCustomerGroup](
	DisposisiCustomerGroupId INT IDENTITY(1,1) PRIMARY KEY,
	CustomerGroupId INT,
	UserId VARCHAR(10),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_DisposisiCustGrp_CustGrp FOREIGN KEY(CustomerGroupId) REFERENCES CustomerGroup(CustomerGroupId),
	CONSTRAINT FK_DisposisiCustGrp_User FOREIGN KEY(UserId) REFERENCES [User](UserId),
);
CREATE NONCLUSTERED INDEX ix_DisposisiCustGroup_ActivatedDeactivated ON DisposisiCustomerGroup(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [AccountPlanning](
	AccountPlanningId INT IDENTITY(1,1) PRIMARY KEY,
	Year CHAR(4) NOT NULL,
	Currency CHAR(5),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_AccountPlanning_CreatedByModifiedBy ON AccountPlanning(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);
CREATE INDEX ix_AccountPlanning_Year ON AccountPlanning(Year);

CREATE TABLE [AccountPlanningStatus](
	AccountPlanningStatusId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	DocumentStatusId INT,
	Comment VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	CONSTRAINT FK_AccountPlanningStatus_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_AccountPlanningStatus_DocumentStatus FOREIGN KEY(DocumentStatusId) REFERENCES DocumentStatus(DocumentStatusId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_AccountPlanningStatus_CreatedBy ON AccountPlanningStatus(CreatedDate, CreatedBy);

CREATE TABLE [AccountPlanningCustomer](
	AccountPlanningId INT,
	VCIF VARCHAR(10),
	IsMain INT NOT NULL DEFAULT 0,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	CONSTRAINT PK_AccountPlanningCustomer PRIMARY KEY(AccountPlanningId, VCIF),
	CONSTRAINT FK_AccountPlanningCustomer_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_AccountPlanningCustomer_Customer FOREIGN KEY(VCIF) REFERENCES Customer(VCIF) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_AccountPlanningCustomer_CreatedBy ON AccountPlanningCustomer(CreatedDate, CreatedBy);
CREATE INDEX ix_AccountPlanningCustomer_IsMain ON AccountPlanningCustomer(IsMain);

CREATE TABLE [AccountPlanningOwner] (
	AccountPlanningMakerId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	UserId VARCHAR(10),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_AccountPlanningOwner_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_AccountPlanningOwner_User FOREIGN KEY(UserId) REFERENCES [User](UserId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_AccountPlanningOwner_CreatedBy ON AccountPlanningOwner(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);


CREATE TABLE [AccountPlanningMember](
	AccountPlanningId INT,
	UserId VARCHAR(10),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	CONSTRAINT PK_AccountPlanningMember PRIMARY KEY(UserId, AccountPlanningId),
	CONSTRAINT FK_AccountPlanningMember_User FOREIGN KEY(UserId) REFERENCES [User](UserId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_AccountPlanningMember_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_AccountPlanningMember_CreatedBy ON AccountPlanningMember(CreatedDate, CreatedBy);

CREATE TABLE [AccountPlanningChecker](
	AccountPlanningChecker INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	UserId VARCHAR(10),
	IsApproved INT,
	Comment VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_AccountPlanningChecker_User FOREIGN KEY(UserId) REFERENCES [User](UserId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_AccountPlanningChecker_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_AccountPlanningChecker_CreatedByModifiedBy ON AccountPlanningChecker(IsApproved, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [AccountPlanningSigner](
	AccountPlanningSignerId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	UserId VARCHAR(10),
	IsApproved INT,
	Comment VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_AccountPlanningSigner_User FOREIGN KEY(UserId) REFERENCES [User](UserId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_AccountPlanningSigner_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_AccountPlanningSigner_CreatedByModifiedBy ON AccountPlanningSigner(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [LifeCycle](
	LifeCycleId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_LifeCycle_CreatedByModifiedBy ON [LifeCycle](IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Province](
	ProvinceId INT PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	ViewOrder INT,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_Province_CreatedByModifiedBy ON [Province](IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [GlobalRating](
	GlobalRatingId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_GlobalRating_CreatedByModifiedBy ON GlobalRating(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [DomesticRating](
	DomesticRatingId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_DomesticRating_CreatedByModifiedBy ON DomesticRating(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [IndustryTrend](
	IndustryTrendId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_IndustryTrend_CreatedByModifiedBy ON IndustryTrend(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [StructureType](
	StructureTypeId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_StructureType_CreatedByModifiedBy ON StructureType(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [FileStructure](
	FileStructureId INT IDENTITY(1,1) PRIMARY KEY,
	StructureTypeId INT,
	AccountPlanningId INT,
	FilePath VARCHAR(255),
	Size NUMERIC(18,2),
	Type VARCHAR(100),
	Description VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
	CONSTRAINT FK_FileStructure_StructureType FOREIGN KEY(StructureTypeId) REFERENCES StructureType(StructureTypeId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_FileStructure_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_FileStructure_CreatedByModifiedBy ON FileStructure(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Shareholder](
	ShareholderId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	Name VARCHAR(255) NOT NULL,
	Value NUMERIC(18,2),
	Portion NUMERIC(5,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
	CONSTRAINT FK_Shareholder_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_Shareholder_CreatedByModifiedBy ON Shareholder(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [StrategicPlanType](
	StrategicPlanTypeId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_StrategicPlanType_CreatedByModifiedBy ON StrategicPlanType(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [StrategicPlan](
	StrategicPlanId INT IDENTITY(1,1) PRIMARY KEY,
	StrategicPlanTypeId INT,
	AccountPlanningId INT,
	Name VARCHAR(255) NOT NULL,
	Description VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_StrategicPlan_StrategicPlanType FOREIGN KEY(StrategicPlanTypeId) REFERENCES StrategicPlanType(StrategicPlanTypeId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_StrategicPlan_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_StrategicPlan_CreatedByModifiedBy ON StrategicPlan(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CoverageMapping](
	CoverageMappingId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	ClientPosition VARCHAR(100),
	ClientName VARCHAR(100),
	ContactNumber VARCHAR(25),
	OtherInformation VARCHAR(255),
	BankPosition VARCHAR(100),
	BankPerson VARCHAR(100),
	Description VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CoverageMapping_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CoverageMapping_CreatedByModifiedBy ON CoverageMapping(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [GroupOverview](
	GroupOverviewId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	Address1 VARCHAR(255),
	Address2 VARCHAR(255),
	Address3 VARCHAR(255),
	ProvinceId INT,
	GlobalRatingId INT,
	GlobalRatingDesc VARCHAR(255),
	DomesticRatingId INT,
	IndustryName VARCHAR(255),
	IndustryTrendId INT,
	LifeCycleId INT,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_GroupOverview_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_GroupOverview_Province FOREIGN KEY(ProvinceId) REFERENCES Province(ProvinceId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_GroupOverview_GlobalRating FOREIGN KEY(GlobalRatingId) REFERENCES GlobalRating(GlobalRatingId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_GroupOverview_DomesticRating FOREIGN KEY(DomesticRatingId) REFERENCES DomesticRating(DomesticRatingId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_GroupOverview_IndustryTrend FOREIGN KEY(IndustryTrendId) REFERENCES IndustryTrend(IndustryTrendId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_GroupOverview_LifeCycle FOREIGN KEY(LifeCycleId) REFERENCES LifeCycle(LifeCycleId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_GroupOverview_CreatedByModifiedBy ON GroupOverview(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [FinancialHighlightGroup](
	FinancialHighlightGroupId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_FinancialHighlightGroup_CreatedByModifiedBy ON FinancialHighlightGroup(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [FinancialHighlightItem](
	FinancialHighlightItemId INT IDENTITY(1,1) PRIMARY KEY,
	FinancialHighlightGroupId INT,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_FHItem_FHGroup FOREIGN KEY(FinancialHighlightGroupId) REFERENCES FinancialHighlightGroup(FinancialHighlightGroupId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_FinancialHighlightItem_CreatedByModifiedBy ON FinancialHighlightItem(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Bank](
	BankId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_Bank_CreatedByModifiedBy ON Bank(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [BankFacilityGroup](
	BankFacilityGroupId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_BankFacilityGroup_CreatedByModifiedBy ON BankFacilityGroup(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [BankFacilityItem](
	BankFacilityItemId INT IDENTITY(1,1) PRIMARY KEY,
	BankFacilityGroupId INT,
	Name VARCHAR(100) NOT NULL,
	Description VARCHAR(255),
	IsDefault INT NOT NULL,
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_BankFacilityItem_BankFacilityGroup FOREIGN KEY(BankFacilityGroupId) REFERENCES BankFacilityGroup(BankFacilityGroupId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_BankFacilityItem_CreatedByModifiedBy ON BankFacilityItem(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [FinancialHighlight](
	FinancialHighlightId INT IDENTITY(1,1) PRIMARY KEY,
	FinancialHighlightItemId INT,
	AccountPlanningId INT,
	Year CHAR(4),
	Amount NUMERIC(18,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_FinancialHighlight_FHItem FOREIGN KEY(FinancialHighlightItemId) REFERENCES FinancialHighlightItem(FinancialHighlightItemId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_FinancialHighlight_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_FinancialHighlight_CreatedByModifiedBy ON FinancialHighlight(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);
CREATE INDEX ix_FinancialHighlight_Year ON FinancialHighlight(Year);

CREATE TABLE [BankFacility](
	BankFacilityId INT IDENTITY(1,1) PRIMARY KEY,
	BankFacilityItemId INT,
	AccountPlanningId INT,
	IDRNominal NUMERIC(18,2),
	IDRRate NUMERIC(5,2),
	ValasNominal NUMERIC(18,2),
	ValasRate NUMERIC(5,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_BankFacility_BankFacilityItem FOREIGN KEY(BankFacilityItemId) REFERENCES BankFacilityItem(BankFacilityItemId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_BankFacility_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_BankFacility_CreatedByModifiedBy ON BankFacility(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [WalletShare](
	WalletShareId INT IDENTITY(1,1) PRIMARY KEY,
	BankFacilityItemId INT,
	AccountPlanningId INT,
	BRINominal NUMERIC(18,2),
	BRIPortion NUMERIC(5,2),
	OtherNominal NUMERIC(18,2),
	OtherPortion NUMERIC(5,2),
	TotalAmount NUMERIC(18,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_WalletShare_BankFacilityItem FOREIGN KEY(BankFacilityItemId) REFERENCES BankFacilityItem(BankFacilityItemId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_WalletShare_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_WalletShare_CreatedByModifiedBy ON WalletShare(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CompetitionAnalysis](
	CompetitionAnalysisId INT IDENTITY(1,1) PRIMARY KEY,
	BankFacilityItemId INT,
	AccountPlanningId INT,
	BankId1 INT,
	BankId2 INT,
	BankId3 INT,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CompetitionAnalysis_BankFacilityItem FOREIGN KEY(BankFacilityItemId) REFERENCES BankFacilityItem(BankFacilityItemId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_CompetitionAnalysis_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CompetitionAnalysis_CreatedByModifiedBy ON CompetitionAnalysis(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Funding](
	FundingId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	FundingNeed VARCHAR(255) NOT NULL,
	TimePeriod INT,
	Amount NUMERIC(18,2),
	Description VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_Funding_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_Funding_CreatedByModifiedBy ON Funding(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [Service](
	ServiceId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	Name VARCHAR(255) NOT NULL,
	Description VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_Service_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_Service_CreatedByModifiedBy ON Service(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [TagServiceUnitKerja](
	ServiceId INT,
	UnitKerjaId INT,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	CONSTRAINT PK_TagServiceUnitKerja PRIMARY KEY(ServiceId, UnitKerjaId),
	CONSTRAINT FK_TagServiceUnitKerja_Service FOREIGN KEY(ServiceId) REFERENCES [Service](ServiceId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_TagServiceUnitKerja_UnitKerja FOREIGN KEY(UnitKerjaId) REFERENCES UnitKerja(UnitKerjaId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_TagServiceUnitKerja_CreatedBy ON TagServiceUnitKerja(CreatedDate, CreatedBy);	

CREATE TABLE [InitiativeAction](
	InitiativeActionId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	Name VARCHAR(100) NOT NULL,
	Period VARCHAR(10),
	Description VARCHAR(255),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_InitiativeAction_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_InitiativeAction_CreatedByModifiedBy ON InitiativeAction(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [EstimatedFinancial](
	EstimatedFinancialId INT IDENTITY(1,1) PRIMARY KEY,
	BankFacilityItemId INT,
	AccountPlanningId INT,
	IDRProjection NUMERIC(18,2),
	ValasProjection NUMERIC(18,2),
	IDRTarget NUMERIC(18,2),
	ValasTarget NUMERIC(18,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_EstimatedFinancial_BankFacilityItem FOREIGN KEY(BankFacilityItemId) REFERENCES BankFacilityItem(BankFacilityItemId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_EstimatedFinancial_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_EstimatedFinancial_CreatedByModifiedBy ON EstimatedFinancial(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CreditSimulationAssumption](
	CreditSimulationAssumptionId INT IDENTITY(1,1) PRIMARY KEY,
	AccountPlanningId INT,
	USDExchange NUMERIC(9,2),
	IDRFTPSimpanan NUMERIC(5,2),
	ValasFTPSimpanan NUMERIC(5,2),
	IDRFTPPinjaman NUMERIC(5,2),
	ValasFTPPinjaman NUMERIC(5,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CSAssumption_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CSAssumption_CreatedByModifiedBy ON CreditSimulationAssumption(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CreditSimulation](
	CreditSimulationId INT IDENTITY(1,1) PRIMARY KEY,
	BankFacilityItemId INT,
	AccountPlanningId INT,
	IDRPlafond NUMERIC(18,2),
	ValasPlafond NUMERIC(18,2),
	IDROutstanding NUMERIC(18,2),
	ValasOutstanding NUMERIC(18,2),
	IDRDailyRatas NUMERIC(18,2),
	ValasDailyRatas NUMERIC(18,2),
	IDRTenor NUMERIC(18,2),
	ValasTenor NUMERIC(18,2),
	IDRIndicativeRate NUMERIC(5,2),
	ValasIndicativeRate NUMERIC(5,2),
	IDRIncomeExpense NUMERIC(18,2),
	ValasIncomeExpense NUMERIC(18,2),
	IDRProvisionRate NUMERIC(5,2),
	ValasProvisionRate NUMERIC(5,2),
	IDRProvision NUMERIC(18,2),
	ValasProvision NUMERIC(18,2),
	IDRFee NUMERIC(18,3),
	ValasFee NUMERIC(18,3),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CreditSimulation_BankFacilityItem FOREIGN KEY(BankFacilityItemId) REFERENCES BankFacilityItem(BankFacilityItemId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_CreditSimulation_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CreditSimulation_CreatedByModifiedBy ON CreditSimulation(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [FeeType](
	FeeTypeId INT IDENTITY(1,1) PRIMARY KEY,
	Name VARCHAR(255) NOT NULL,
	Description VARCHAR(255),
	IsActive INT NOT NULL DEFAULT 1,
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10)
);
CREATE NONCLUSTERED INDEX ix_FeeType_CreatedByModifiedBy ON FeeType(IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);

CREATE TABLE [CreditSimulationFee](
	CreditSimulationFeeId INT IDENTITY(1,1) PRIMARY KEY,
	FeeTypeId INT,
	AccountPlanningId INT,
	IDRAmount NUMERIC(18,2),
	ValasAmount NUMERIC(18,2),
	CreatedDate DATETIME,
	CreatedBy VARCHAR(10),
	ModifiedDate DATETIME,
	ModifiedBy VARCHAR(10),
	CONSTRAINT FK_CreditSimulationFee_BankFacilityItem FOREIGN KEY(FeeTypeId) REFERENCES FeeType(FeeTypeId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_CreditSimulationFee_AccountPlanning FOREIGN KEY(AccountPlanningId) REFERENCES AccountPlanning(AccountPlanningId) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE NONCLUSTERED INDEX ix_CreditSimulationFee_CreatedByModifiedBy ON CreditSimulationFee(CreatedDate, CreatedBy, ModifiedDate, ModifiedBy);