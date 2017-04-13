CREATE TABLE IF NOT EXISTS users (
  userId     INT AUTO_INCREMENT PRIMARY KEY,
  userName        VARCHAR (255)        DEFAULT NULL,
  userPass		  VARCHAR (255)		   DEFAULT NULL,
  userImage       VARCHAR (255)        DEFAULT NULL,
  userEmail       VARCHAR (255)        DEFAULT NULL,
  userTraits      VARCHAR (255)        DEFAULT NULL,
  userDescription VARCHAR (400)        DEFAULT NULL
);