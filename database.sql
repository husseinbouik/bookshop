CREATE TABLE Members(
   Nickname VARCHAR(150),
   Firstname VARCHAR(150),
   Lastname VARCHAR(150),
   Password VARCHAR(150),
   Admin BOOLEAN,
   Address VARCHAR(100),
   Email VARCHAR(100),
   PhoneNumber VARCHAR(100),
   CIN VARCHAR(50),
   Occupation VARCHAR(50),
   Penalty_Count INT,
   Birth_Date DATE,
   Creation_Date DATE,
   PRIMARY KEY(Nickname)
);


CREATE TABLE Types(
   Type_Code INT AUTO_INCREMENT,
   Type_Name VARCHAR(50),
   pages_or_duration VARCHAR(50),
   PRIMARY KEY(Type_Code)
);

CREATE TABLE Collection(
   Collection_Code INT AUTO_INCREMENT ,
   Title VARCHAR(50),
   Author_Name VARCHAR(100),
   Cover_Image VARCHAR(100),
   State VARCHAR(100),
   Edition_Date DATE,
   Buy_Date DATE,
   Status VARCHAR(150),
   Type_Code INT NOT NULL,
   PRIMARY KEY(Collection_Code),
   FOREIGN KEY(Type_Code) REFERENCES Types(Type_Code)
);
INSERT INTO `Types` (`Type_Code`, `Type_Name`, `pages_or_duration`) VALUES
(1,'Book','421'),
(2,'Book','370'),
(3,'Book','336'),
(4,'Book','384'),
(5,'Book','373'),
(6,'Book','624'),
(7,'Book','400'),
(8,'Book','226'),
(9,'Book','584'),
(10,'Book','384'),
(11,'Book','224'),
(12,'Book','256'),
(13,'DVD','147'),
(14,'DVD','123'),
(15,'DVD','118');
INSERT INTO `Collection` (`Collection_Code`, `Title`, `Author_Name`, `Cover_Image`, `State`, `Edition_Date`, `Buy_Date`, `Status`, `Type_Code`) VALUES
(1,'Red,White & Royal blue ','Casey McQuiston','../images/Group 54.png','Good condition','2019-05-14', '2019-12-01','Available',1),
(2,'The Cruel Prince',' Holly Black','../images/Group 55.jpg','New','2017-01-02', '20-03-01','Available',2),
(3,'Rich Dad Poor Dad','Robert Kiyosaki&Sharon L. Lechter','../images/Group 53.png','New','2000-04-01', '2001-03-01','Available',3),
(4,'The Hating Game','Peter Hutchings','../images/Group 52.png','Acceptable','2021-12-10', '2022-04-11','Available',4),
(5,'Ugly Love','Colleen Hoover','../images/Group 49.png','Good condition','2014-08-05', '2015-05-21','Available',5),
(6,'The law of Human Nature','Robert Greene','../images/Group 50.png','New','2018-10-16', '2018-12-04','Available',6),
(7,'The Seven Husbands of Evelyn Hugo','Taylor Jenkins Reid','../images/Group 51.png','Good condition','2017-06-13', '2017-09-01','Available',7),
(8,'Ego is The Enemy','Ryan Holiday','../images/Group 61.jpg','Acceptable','2017-06-14', '2018-01-20','Available',8),
(9,'The Book Thief','Markus Zusak','../images/Group 56.webp','Quite worn','2006-03-01', '2007-11-10','Available',9),
(10,'They Both Die at the End','Adam Silvera','../images/Group 57.jpg','New','2017-09-05', '2018-12-21','Available',10),
(11,'The Subtle Art of Not Giving a F*ck','Mark Manson','../images/Group 47.png','Good condition','2016-09-13', '2017-05-11','Available',11),
(12,'Call me by your Name','André Aciman','../images/Group 48.png','Quite worn','2007-01-23', '2008-06-21','Available',12),
(13,'The School for Good and Evil',' Paul Feig','../images/Group 58.jpg','Acceptable','2022-10-18', '2023-01-01','Available',13),
(14,'Enola Holmes','Harry Bradbeer','../images/Group 59.jpg','Good condition','2020-09-23', '2020-12-11','Available',14),
(15,'Red Notice',' Rawson Marshall Thurber','../images/Group 60.jpg','Torn','2023-03-01','2021-11-04','Available',15);


CREATE TABLE Reservation(
   Reservation_Code INT AUTO_INCREMENT,
   Reservation_Date DATETIME,
   Reservation_Expiration_Date DATETIME,
   Collection_Code INT NOT NULL,
   Nickname VARCHAR(150) NOT NULL,
   PRIMARY KEY(Reservation_Code),
   FOREIGN KEY(Collection_Code) REFERENCES Collection(Collection_Code),
   FOREIGN KEY(Nickname) REFERENCES Members(Nickname)
);

CREATE TABLE Borrowings(
   Borrowing_Code INT AUTO_INCREMENT,
   Borrowing_Date DATETIME,
   Borrowing_Return_Date DATETIME,
   Collection_Code INT NOT NULL,
   Nickname VARCHAR(150) NOT NULL,
   Reservation_Code INT NOT NULL,
   PRIMARY KEY(Borrowing_Code),
   UNIQUE(Reservation_Code),
   FOREIGN KEY(Collection_Code) REFERENCES Collection(Collection_Code),
   FOREIGN KEY(Nickname) REFERENCES Members(Nickname),
   FOREIGN KEY(Reservation_Code) REFERENCES Reservation(Reservation_Code)
);


