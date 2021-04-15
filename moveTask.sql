DELIMITER $$

USE `projectmanagementdb`$$

DROP PROCEDURE IF EXISTS `moveTasks`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `moveTasks`(
	IN TASK_ORDER INT,
	IN moveTo INT,
	IN dead_line VARCHAR(200)    
    )
BEGIN
	/*set current postion from rowstamp*/
	SELECT @currentPosition := taskorder FROM tbltask WHERE rowstamp = TASK_ORDER;
	/*MOVING OF TASKORDER IN BETWEEN OF CURRENT POSTION TO DESTIONATION*/	
	IF (@currentPosition > moveTo) THEN
		UPDATE tbltask SET taskorder = taskorder + 1 WHERE taskorder BETWEEN moveTo AND @currentPosition;
	ELSE
		UPDATE tbltask SET taskorder = taskorder - 1 WHERE taskorder BETWEEN @currentPosition AND moveTo;
	END IF;
	/*FOR THE MOVE OF EXACT TASK*/
	UPDATE tbltask SET taskorder = moveTo, movecount = movecount + 1, deadline = dead_line WHERE rowstamp = TASK_ORDER;
 
    END$$

DELIMITER ;