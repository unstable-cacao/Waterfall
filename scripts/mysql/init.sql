CREATE DATABASE IF NOT EXISTS `waterfall` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `waterfall`;


CREATE TABLE IF NOT EXISTS `Payload` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Data` text NOT NULL,
  
  PRIMARY KEY (`ID`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Name` varchar(128) NOT NULL,
  
  PRIMARY KEY (`ID`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Webhook` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `URL` varchar(2048) NOT NULL,
  `WebhookKey` varchar(128) NULL,
  `Secret` varchar(64) NOT NULL,
  `State` enum('active','disabled','paused') NOT NULL,
  `MaxRetries` int(11) NOT NULL,
  `OnFail` enum('abort','continue','pause') NOT NULL,
  
  PRIMARY KEY (`ID`),
  
  UNIQUE KEY `WebhookKey` (`WebhookKey`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `WebhookPayload` (
  `WebhookID` int(11) NOT NULL,
  `PayloadID` int(11) NOT NULL,
  `State` enum('pending','skip','processed') NOT NULL,
  `IsProcessing` tinyint(1) NOT NULL,
  `Retries` int(11) NOT NULL,
  
  PRIMARY KEY (`WebhookID`,`PayloadID`),
  
  KEY `k_WebhookPayload_PayloadID` (`PayloadID`),
  
  CONSTRAINT `fk_WebhookPayload_PayloadID`
    FOREIGN KEY (`PayloadID`)
    REFERENCES `Payload` (`ID`)
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_WebhookPayload_WebhookID` 
    FOREIGN KEY (`WebhookID`)
    REFERENCES `Webhook` (`ID`)
    ON DELETE CASCADE ON UPDATE CASCADE
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `WebhookSubject` (
  `WebhookID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  
  PRIMARY KEY (`WebhookID`,`SubjectID`),
  
  KEY `k_WebhookSubject_SubjectID` (`SubjectID`),
  
  CONSTRAINT `fk_WebhookSubject_SubjectID`
    FOREIGN KEY (`SubjectID`)
    REFERENCES `Subject` (`ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_WebhookSubject_WebhookID`
    FOREIGN KEY (`WebhookID`)
    REFERENCES `Webhook` (`ID`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;