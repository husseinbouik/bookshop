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
CREATE TABLE Reservation(
   Reservation_Code INT AUTO_INCREMENT,
   Reservation_Date DATE,
   Reservation_Expiration_Date DATE,
   Collection_Code INT NOT NULL,
   Nickname VARCHAR(150) NOT NULL,
   PRIMARY KEY(Reservation_Code),
   FOREIGN KEY(Collection_Code) REFERENCES Collection(Collection_Code),
   FOREIGN KEY(Nickname) REFERENCES Members(Nickname)
);

CREATE TABLE Borrowings(
   Borrowing_Code INT AUTO_INCREMENT,
   Borrowing_Date DATE,
   Borrowing_Return_Date DATE,
   Collection_Code INT NOT NULL,
   Nickname VARCHAR(150) NOT NULL,
   Reservation_Code INT NOT NULL,
   PRIMARY KEY(Borrowing_Code),
   UNIQUE(Reservation_Code),
   FOREIGN KEY(Collection_Code) REFERENCES Collection(Collection_Code),
   FOREIGN KEY(Nickname) REFERENCES Members(Nickname),
   FOREIGN KEY(Reservation_Code) REFERENCES Reservation(Reservation_Code)
);
