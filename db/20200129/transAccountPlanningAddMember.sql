ALTER PROCEDURE transAccountPlanningAddMember(
	@p_AccountPlanningId INT, 
	@p_UserId VARCHAR(10), 
	@p_CreatedBy VARCHAR(10)
) AS
BEGIN
	DECLARE @Today DATETIME
	DECLARE @CustName VARCHAR(255)
	SET @Today = SYSDATETIME()

	BEGIN TRY
		BEGIN TRANSACTION
			SET @CustName = (
				SELECT B.Name
				FROM AccountPlanningCustomer A, CustomerKorporasi B
				WHERE A.IsMain=1 AND AccountPlanningId=@p_AccountPlanningId
					AND A.VCIF=B.VCIF
			)

			INSERT INTO AccountPlanningMember(AccountPlanningId, UserId, CreatedDate, CreatedBy, PrivilegeTab)
			VALUES(@p_AccountPlanningId, @p_UserId, @Today, @p_CreatedBy, 3)

			INSERT INTO Notification(CreatedDate, UserFrom, UserTo, Subject, Title, Message, URL)
			VALUES(@Today, @p_CreatedBy, @p_UserId, 'Account Planning', 'Add Account Planning Member','You are added as a member of account planning "'+@CustName+'"','tasklist/AccountPlanningCst/View')

			INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, NewValue)
			VALUES('INFO', @Today, @p_CreatedBy, 'Account Planning: Add Member', 'Member is added', '{"AccountPlanningId":"'+CAST(@p_AccountPlanningId AS VARCHAR)+'","UserId":"'+@p_UserId+'"}')
		COMMIT TRANSACTION
	END TRY		

	BEGIN CATCH
		DECLARE @ErrorMessage NVARCHAR(4000)
	    DECLARE @ErrorSeverity INT
	    DECLARE @ErrorState INT
	  
	    SELECT   
	        @ErrorMessage = ERROR_MESSAGE(),  
	        @ErrorSeverity = ERROR_SEVERITY(),  
	        @ErrorState = ERROR_STATE()

		ROLLBACK TRANSACTION
		RAISERROR (@ErrorMessage, @ErrorSeverity, @ErrorState)

		INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, Exception)
		VALUES('ERROR', @Today, @p_CreatedBy, 'Account Planning: Add Member', 'Error adding member', @ErrorMessage)
	END CATCH
END
 GO
