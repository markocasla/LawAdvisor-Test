/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.18-MariaDB : Database - projectmanagementdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`projectmanagementdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `projectmanagementdb`;

/*Table structure for table `tbltask` */

DROP TABLE IF EXISTS `tbltask`;

CREATE TABLE `tbltask` (
  `rowstamp` int(11) NOT NULL AUTO_INCREMENT,
  `taskid` int(11) NOT NULL,
  `task` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `deadline` varchar(50) NOT NULL,
  `movecount` int(11) NOT NULL,
  `taskorder` int(11) NOT NULL,
  PRIMARY KEY (`rowstamp`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbltask` */

insert  into `tbltask`(`rowstamp`,`taskid`,`task`,`details`,`status`,`deadline`,`movecount`,`taskorder`) values (1,1,'TAMS-POLICY','For computation of the late with grace period of 15mins.','PENDING','04/16/2021',1,1),(2,2,'EPORTAL-PAYSLIP','Customize employee portal payslip for the ABC Company.','ONGOING','04/20/2021',2,2),(3,3,'PAYROLL','Alhpalist payroll prcoessing module.','ONGOING','06/16/2021',1,3),(4,4,'HRIS','HRIS employee certification reports','PENDING','04/14/2021',4,4),(6,5,'REMS','VALIDATION OF COMMISION','PENDING','04/20/2021',1,5),(7,6,'FAMS - DEPRECIATION','DEPRECIATION CUSTOMIZATION','PENDING','05/05/2021',0,6),(8,7,'REMS','DOCUMENT REQUIREMENTS OF THE CLIENT','PENDING','05/02/2021',1,7),(9,8,'ACCOUNTING','LEDGER','PENDING','05/25/2021',0,8),(11,7,'REMS','DOCUMENT REQUIREMENTS OF THE CLIENT','PENDING','05/02/2021',1,9),(13,10,'SMTP','SMTP CUSTOMIZATION POLICY','ONGOING','04/30/2021',0,10),(14,14,'ID AUTOMATION','ID DETECTION CUSTOMIZATION FOR RFID','ONGOING','04/17/2021',10,11);

/* Procedure structure for procedure `moveTasks` */

/*!50003 DROP PROCEDURE IF EXISTS  `moveTasks` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `moveTasks`(
	IN TASK_ORDER INT,
	IN moveTo INT,
	IN dead_line varchar(200)    
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
 
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
