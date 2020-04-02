--ALTER TABLE CustomerKorporasi
--Add IsMain int;

IF OBJECT_ID ( 'transGroupSetMainCustomer', 'P' ) IS NOT NULL   
    DROP PROCEDURE transGroupSetMainCustomer;  
GO  

CREATE PROCEDURE transGroupSetMainCustomer(
	@p_groupId INT,
	@p_VCIF VARCHAR(10),
	@p_UserId VARCHAR(10)
) AS
BEGIN
	DECLARE @ErrorMessage NVARCHAR(4000)
	DECLARE @Jml INT
	DECLARE @Today DATETIME
	SET @Today = SYSDATETIME()

	BEGIN TRY
		BEGIN TRANSACTION

			SET @Jml = (
				SELECT COUNT(1) Jml 
				FROM CustomerKorporasi
				WHERE CustomerGroupId = @p_groupId AND VCIF = @p_VCIF
			)

			IF @Jml > 0 
			BEGIN
				UPDATE CustomerKorporasi SET IsMain = 0
				WHERE CustomerGroupId = @p_groupId

				UPDATE CustomerKorporasi SET IsMain = 1
				WHERE CustomerGroupId = @p_groupId AND VCIF = @p_VCIF

				INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, NewValue)
				VALUES('INFO', @Today, @p_UserId, 'Customer Group: Set Main Customer','Main Customer is set.', '{"GroupId":"'+CAST(@p_groupId AS VARCHAR)+'","VCIF":"'+@p_VCIF+'"}')
			END
			ELSE 
			BEGIN
				SET @ErrorMessage = 'Customer '+@p_VCIF+' is not a part of group '+CAST(@p_groupId AS VARCHAR)
				INSERT INTO Log(Level, LogDate, CreatedBy, Action, Message, Exception)
				VALUES('ERROR', @Today, @p_UserId, 'Customer Group: Set Main Customer', 'Set main customer group '+CAST(@p_groupId AS VARCHAR)+' to '+@p_VCIF+' is failed', @ErrorMessage)
			END

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
		VALUES('ERROR', @Today, @p_UserId, 'Customer Group: Set Main Customer', 'Set main customer group '+CAST(@p_groupId AS VARCHAR)+' to '+@p_VCIF+' is failed', @ErrorMessage)

	END CATCH
END;
GO