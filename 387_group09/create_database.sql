-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-03-28 16:15:20.014

-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-03-28 16:15:20.014

-- tables
-- Table: Applications
SET foreign_key_checks = 0;
drop table if exists Applications, Favorites, Listings, Users, Positions, Ratings;
SET foreign_key_checks = 1;


CREATE TABLE Applications (
    ListingID INT NOT NULL,
    UserID INT NOT NULL,
    Resume TEXT NOT NULL,
    CONSTRAINT Applications_pk PRIMARY KEY (ListingID , UserID)
);

-- Table: Favorites
CREATE TABLE Favorites (
    UserID int  NOT NULL,
    ListingID int  NOT NULL,
    CONSTRAINT Favorites_pk PRIMARY KEY (ListingID,UserID)
);

-- Table: Listings
CREATE TABLE Listings (
    ListingID int  NOT NULL AUTO_INCREMENT,
    Name varchar(100)  NOT NULL,
    PosterID int  NOT NULL,
    PositionID int  NOT NULL,
    PostDate date  NOT NULL,
    StartDate date NOT NULL,
    EndDate date NOT NULL,
    Location varchar(100) NOT NULL,
    Salary double(15,2)  NOT NULL,
    url varchar(100)  NULL DEFAULT "blank",
    Description text  NOT NULL,
    recurring bool  NOT NULL,
    reports int NULL DEFAULT 0,
    archived bool NULL DEFAULT 0,
    CONSTRAINT Listings_pk PRIMARY KEY (ListingID)
);

-- Table: Positions
CREATE TABLE Positions (
    PositionID int  NOT NULL AUTO_INCREMENT,
    PositionName varchar(50)  NOT NULL,
    PositionDescription text  NOT NULL,
    CONSTRAINT Positions_pk PRIMARY KEY (PositionID)
);

-- Table: Ratings
CREATE TABLE Ratings (
    ListingID int  NOT NULL,
    UserID int  NOT NULL,
    Rating float  NOT NULL,
    Description text  NULL,
    CONSTRAINT Ratings_pk PRIMARY KEY (ListingID,UserID)
);

-- Table: Users
CREATE TABLE Users (
    UserID int  NOT NULL AUTO_INCREMENT,
    Username varchar(50)  NOT NULL,
    Role varchar(10)  NULL,
    Password varchar(100)  NOT NULL,
    Email varchar(50)  NOT NULL,
    CONSTRAINT Users_pk PRIMARY KEY (UserID)
);

-- foreign keys
-- Reference: Applications_Listings (table: Applications)
ALTER TABLE Applications ADD CONSTRAINT Applications_Listings FOREIGN KEY Applications_Listings (ListingID)
    REFERENCES Listings (ListingID) ON DELETE CASCADE;

-- Reference: Favorites_Users (table: Favorites)
ALTER TABLE Favorites ADD CONSTRAINT Favorites_Users FOREIGN KEY Favorites_Users (UserID)
    REFERENCES Users (UserID)  ON DELETE CASCADE;
ALTER TABLE Favorites ADD CONSTRAINT Favorites_Listings FOREIGN KEY Favorites_Listings (ListingID)
    REFERENCES Listings (ListingID)  ON DELETE CASCADE;

-- Reference: Listings_Positions (table: Listings)
ALTER TABLE Listings ADD CONSTRAINT Listings_Positions FOREIGN KEY Listings_Positions (PositionID)
    REFERENCES Positions (PositionID)  ON DELETE CASCADE;

-- Reference: Listings_Users (table: Listings)
ALTER TABLE Listings ADD CONSTRAINT Listings_Users FOREIGN KEY Listings_Users (PosterID)
    REFERENCES Users (UserID)  ON DELETE CASCADE;

-- Reference: Ratings_Listings (table: Ratings)
ALTER TABLE Ratings ADD CONSTRAINT Ratings_Listings FOREIGN KEY Ratings_Listings (ListingID)
    REFERENCES Listings (ListingID)  ON DELETE CASCADE;
ALTER TABLE Ratings ADD CONSTRAINT Ratings_User FOREIGN KEY Ratings_User (UserID)
    REFERENCES Users (UserID)  ON DELETE CASCADE;



Insert into Positions (PositionName, PositionDescription) Values ("Internship", "Internship Description"),
                                                                 ("Job", "get that money"),
                                                                 ("Research", "get that science");
Insert into Users Values (1, "admin", 'admin', "$2y$10$gpocfEgs7kcbA.hjxJTwCuduGxOp7HsQu/zLbmIX1.TxApDcq0ofO", "admin@admin");
-- End of file.