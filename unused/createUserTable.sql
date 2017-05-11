CREATE TABLE IF NOT EXISTS users (
  userid     	INT AUTO_INCREMENT PRIMARY KEY,
  userpw		VARCHAR (255)        DEFAULT NULL,
  firstname		VARCHAR (255)		 DEFAULT NULL,
  lastname      VARCHAR (255)        DEFAULT NULL,
  useremail     VARCHAR (255)        DEFAULT NULL,
  userimage 	VARCHAR (255)		 DEFAULT NULL,
  usertraits    VARCHAR (255)        DEFAULT NULL,
  userdesc		VARCHAR (400)        DEFAULT NULL,
  isbusiness	TINYINT(1)			 DEFAULT NULL,
  isactive		TINYINT(1)			 DEFAULT NULL
);