ALTER TABLE CPA_KORPORASI_DEV_4.dbo.CustomerGroup ADD CustomerTypeId int NULL GO

-- Drop table

-- DROP TABLE CPA_KORPORASI_DEV_4.dbo.CustomerType GO

CREATE TABLE CPA_KORPORASI_DEV_4.dbo.CustomerType (
	CustomerTypeId int IDENTITY(1,1) NOT NULL,
	Name varchar(255) COLLATE Latin1_General_CI_AS NOT NULL,
	Description varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
	IsActive int NOT NULL,
	CreatedDate datetime NULL,
	CreatedBy varchar(10) COLLATE Latin1_General_CI_AS NULL,
	ModifiedDate datetime NULL,
	ModifiedBy varchar(10) COLLATE Latin1_General_CI_AS NULL,
	CONSTRAINT PK__CustomerType__D276A5A00C7583F3 PRIMARY KEY (CustomerTypeId)
) GO
 CREATE NONCLUSTERED INDEX ix_CustomerType_CreatedByModifiedBy ON dbo.CustomerType (  IsActive ASC  , CreatedDate ASC  , CreatedBy ASC  , ModifiedDate ASC  , ModifiedBy ASC  )  
	 WITH (  PAD_INDEX = OFF ,FILLFACTOR = 100  ,SORT_IN_TEMPDB = OFF , IGNORE_DUP_KEY = OFF , STATISTICS_NORECOMPUTE = OFF , ONLINE = OFF , ALLOW_ROW_LOCKS = ON , ALLOW_PAGE_LOCKS = ON  )
	 ON [PRIMARY ]  GO


	 INSERT INTO CPA_KORPORASI_DEV_4.dbo.CustomerType (Name,Description,IsActive,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy) VALUES 
		('BUMN',NULL,1,'2019-12-05 12:38:43.000',NULL,NULL,NULL)
		,('Institusi',NULL,1,'2019-12-05 12:38:43.000',NULL,NULL,NULL)
		,('Perusahaan Umum',NULL,1,'2019-12-05 12:38:43.000',NULL,NULL,NULL)
		,('Swasta',NULL,1,'2019-12-05 12:38:43.000',NULL,NULL,NULL)
		;
