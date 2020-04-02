
-- Drop table

-- DROP TABLE CPA_KORPORASI_DEV.dbo.RecentActivities GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.RecentActivities (
	RecentActivitiesId int IDENTITY(1,1) NOT NULL,
	Title varchar(100) COLLATE Latin1_General_CI_AS NOT NULL,
	Description varchar(MAX) COLLATE Latin1_General_CI_AS NULL,
	IsActive int NOT NULL,
	CreatedDate datetime NULL,
	CreatedBy varchar(10) COLLATE Latin1_General_CI_AS NULL,
	ModifiedDate datetime NULL,
	ModifiedBy varchar(10) COLLATE Latin1_General_CI_AS NULL,
	PRIMARY KEY (RecentActivitiesId)
) GO
