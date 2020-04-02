CREATE PROCEDURE transAccountPlanningDuplicate(
	@p_AccountPlanningId INT,
	@p_UserId VARCHAR(10),
	@p_Year VARCHAR(4)
) AS
BEGIN
	DECLARE @new_AccountPlanningId VARCHAR(10)
	DECLARE @Jml INT
	DECLARE @ErrorMessage NVARCHAR(4000)
	DECLARE @Today DATETIME
	SET @Today = SYSDATETIME()

	SET @Jml = (
		SELECT COUNT(1) JML
		FROM AccountPlanningCustomer A, AccountPlanning B
		WHERE A.AccountPlanningId=B.AccountPlanningId
			AND A.VCIF = (
				SELECT VCIF FROM AccountPlanningCustomer
				WHERE AccountPlanningId=@p_AccountPlanningId AND IsMain=1
			)
			AND B.YEAR >= @p_Year 
	)

	IF @Jml > 0 
	BEGIN
		SET @ErrorMessage = 'Cannot duplicate account planning. Main customer already have account planning for next year'
		RAISERROR (@ErrorMessage, 16, 1)
		
		INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, Exception)
		VALUES('ERROR', @Today, @p_UserId, 'Account Planning: Clone', 'Account planning clone failed', @ErrorMessage)
	END
	ELSE
	BEGIN
		BEGIN TRY
			BEGIN TRANSACTION

			INSERT INTO AccountPlanning(Year, CreatedDate, CreatedBy)
			VALUES(@p_Year, @Today, @p_UserId)

			SET @new_AccountPlanningId = (
				SELECT SCOPE_IDENTITY()
			)

			UPDATE AccountPlanning
			SET FinancialHighlightCurrency = (
				SELECT FinancialHighlightCurrency FROM AccountPlanning
				WHERE AccountPlanningId = @p_AccountPlanningId
			)
			WHERE AccountPlanningId = @new_AccountPlanningId

			INSERT INTO AccountPlanningCustomer(AccountPlanningId, VCIF, IsMain, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, VCIF, IsMain, @Today, @p_UserId
			FROM AccountPlanningCustomer
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO AccountPlanningMember(AccountPlanningId, UserId, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, UserId, @Today, @p_UserId
			FROM AccountPlanningMember
			WHERE AccountPlanningId=@p_AccountPlanningId			

			INSERT INTO AccountPlanningOwner(AccountPlanningId, UserId, IsActive, StartDate, CreatedBy)
			SELECT @new_AccountPlanningId, UserId, IsActive, @Today, @p_UserId
			FROM AccountPlanningOwner
			WHERE AccountPlanningId=@p_AccountPlanningId AND IsActive=1

			INSERT INTO AccountPlanningStatus(AccountPlanningId, DocumentStatusId, CreatedDate, CreatedBy)
			VALUES(@new_AccountPlanningId, 0, @Today, @p_UserId)
			INSERT INTO AccountPlanningStatus(AccountPlanningId, DocumentStatusId, CreatedDate, CreatedBy)
			VALUES(@new_AccountPlanningId, 1, @Today, @p_UserId)

			INSERT INTO AccountPlanningActivity(AccountPlanningId, Activity, Message, CreatedDate, CreatedBy)
			VALUES(@new_AccountPlanningId, 'Clone', 'Cloning account planning', @Today, @p_UserId)

			INSERT INTO BankFacility(BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount, IDRRate, ValasAmount, ValasRate, CreatedDate, CreatedBy, LoadFrom)
			SELECT BankFacilityItemId, @new_AccountPlanningId, VCIF, IDRAmount, IDRRate, ValasAmount, ValasRate, @Today, @p_UserId, 1
			FROM BankFacility
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO CompetitionAnalysis(BankFacilityItemId, AccountPlanningId, BankId1, BankId2, BankId3, CreatedDate, CreatedBy)
			SELECT BankFacilityItemId, @new_AccountPlanningId, BankId1, BankId2, BankId3, @Today, @p_UserId
			FROM CompetitionAnalysis
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO CoverageMapping(AccountPlanningId, VCIF, ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, VCIF, ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description, @Today, @p_UserId
			FROM CoverageMapping
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO CreditSimulation(BankFacilityItemId, AccountPlanningId, IDRPlafond, ValasPlafond, IDROutstanding, ValasOutstanding, IDRDailyRatas, ValasDailyRatas, IDRTenor, ValasTenor, IDRIndicativeRate, 
				ValasIndicativeRate, IDRIncomeExpense, ValasIncomeExpense, IDRProvisionRate, ValasProvisionRate, IDRProvision, ValasProvision, IDRFee, ValasFee, CreatedDate, CreatedBy)
			SELECT BankFacilityItemId, @new_AccountPlanningId, IDRPlafond, ValasPlafond, IDROutstanding, ValasOutstanding, IDRDailyRatas, ValasDailyRatas, IDRTenor, ValasTenor, IDRIndicativeRate, 
				ValasIndicativeRate, IDRIncomeExpense, ValasIncomeExpense, IDRProvisionRate, ValasProvisionRate, IDRProvision, ValasProvision, IDRFee, ValasFee, @Today, @p_UserId
			FROM CreditSimulation
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO CreditSimulationAssumption(AccountPlanningId, USDExchange, IDRFTPSimpanan, ValasFTPSimpanan, IDRFTPPinjaman, ValasFTPPinjaman, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, USDExchange, IDRFTPSimpanan, ValasFTPSimpanan, IDRFTPPinjaman, ValasFTPPinjaman, @Today, @p_UserId
			FROM CreditSimulationAssumption
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO CreditSimulationFee(FeeTypeId, AccountPlanningId, IDRAmount, ValasAmount, CreatedDate, CreatedBy)
			SELECT FeeTypeId, @new_AccountPlanningId, IDRAmount, ValasAmount, @Today, @p_UserId
			FROM CreditSimulationFee
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO EstimatedFinancial(BankFacilityItemId, AccountPlanningId, VCIF, IDRProjection, ValasProjection, IDRTarget, ValasTarget, CreatedDate, CreatedBy)
			SELECT BankFacilityItemId, @new_AccountPlanningId, VCIF, IDRProjection, ValasProjection, IDRTarget, ValasTarget, @Today, @p_UserId
			FROM EstimatedFinancial
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO FileStructure(StructureTypeId, AccountPlanningId, VCIF, FilePath, Size, [Type], Description, CreatedDate, CreatedBy)
			SELECT StructureTypeId, @new_AccountPlanningId, VCIF, FilePath, Size, [Type], Description, @Today, @p_UserId
			FROM FileStructure
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy, LoadFrom)
			SELECT FinancialHighlightItemId, @new_AccountPlanningId, Year, Amount, @Today, @p_UserId, 1
			FROM FinancialHighlight
			WHERE AccountPlanningId=@p_AccountPlanningId
				AND (Year = @p_Year-2 OR Year= @p_Year-3)

			/*SET @Jml = (
				SELECT COUNT(1) JML
				FROM FinancialHighlight
				WHERE AccountPlanningId = @p_AccountPlanningId
			)

			IF @Jml > 0
			BEGIN
				INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, CreatedDate, CreatedBy, LoadFrom)
				SELECT FinancialHighlightItemId, @new_AccountPlanningId, CAST(@p_Year-1 AS VARCHAR), @Today, @p_UserId, 1
				FROM FinancialHighlight
				WHERE AccountPlanningId=@p_AccountPlanningId
					AND Year = @p_Year-2
			END*/

			INSERT INTO Funding(AccountPlanningId, VCIF, FundingNeed, TimePeriod, Amount, Description, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, VCIF, FundingNeed, TimePeriod, Amount, Description, @Today, @p_UserId
			FROM Funding
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO GroupOverview(AccountPlanningId, VCIF, Address1, Address2, Address3, ProvinceId, GlobalRatingId, DomesticRatingId, IndustryName, IndustryTrendId, LifeCycleId, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, VCIF, Address1, Address2, Address3, ProvinceId, GlobalRatingId, DomesticRatingId, IndustryName, IndustryTrendId, LifeCycleId, @Today, @p_UserId
			FROM GroupOverview
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO InitiativeAction(AccountPlanningId, VCIF, Name, Period, Description, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, VCIF, Name, Period, Description, @Today, @p_UserId
			FROM InitiativeAction
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO Service(AccountPlanningId, VCIF, Name, Target, Description, CreatedDate, CreatedBy)
			SELECT @new_AccountPlanningId, VCIF, Name, Target, Description, @Today, @p_UserId
			FROM Service
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO Shareholder(AccountPlanningId, Name, Quantity, CreatedDate, CreatedBy, LoadFrom)
			SELECT @new_AccountPlanningId, Name, Quantity, @Today, @p_UserId, 1
			FROM Shareholder
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO StrategicPlan(StrategicPlanTypeId, AccountPlanningId, VCIF, Name, Description, CreatedDate, CreatedBy)
			SELECT StrategicPlanTypeId, @new_AccountPlanningId, VCIF, Name, Description, @Today, @p_UserId
			FROM StrategicPlan
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO WalletShare(BankFacilityItemId, AccountPlanningId, VCIF, BRINominal, BRIPortion, OtherNominal, OtherPortion, TotalAmount, CreatedDate, CreatedBy)
			SELECT BankFacilityItemId, @new_AccountPlanningId, VCIF, BRINominal, BRIPortion, OtherNominal, OtherPortion, TotalAmount, @Today, @p_UserId
			FROM WalletShare
			WHERE AccountPlanningId=@p_AccountPlanningId

			INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, NewValue)
			VALUES('INFO', @Today, @p_UserId, 'Account Planning: Clone','Account planning is cloned', '{"AccountPlanningId":"'+CAST(@p_AccountPlanningId AS VARCHAR)+'","UserId":"'+@p_UserId+'"}')

			COMMIT TRANSACTION
		END TRY
		BEGIN CATCH
		    DECLARE @ErrorSeverity INT
		    DECLARE @ErrorState INT
		  
		    SELECT   
		        @ErrorMessage = ERROR_MESSAGE(),  
		        @ErrorSeverity = ERROR_SEVERITY(),  
		        @ErrorState = ERROR_STATE()

			ROLLBACK TRANSACTION
			RAISERROR (@ErrorMessage, @ErrorSeverity, @ErrorState)

			INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, Exception)
			VALUES('ERROR', @Today, @p_UserId, 'Account Planning: Clone', 'Account planning clone failed', @ErrorMessage)

		END CATCH
	END
END
