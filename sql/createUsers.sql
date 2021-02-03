CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `NAME` VARCHAR(100) NOT NULL,
  `PHONE` VARCHAR(13) NOT NULL,
  `EMAIL` VARCHAR(100) NOT NULL,
  `LOGIN` VARCHAR(100) NOT NULL UNIQUE,
  `PASSWORD` VARCHAR(100) NOT NULL,
  `ROLE_ID` INT DEFAULT 2
);


