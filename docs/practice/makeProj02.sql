/*
	20110529 UR -> IR Item rating, not user rating to align with schema
			added Item(I_Number) as part of MakesTransaction Primary key
			changed has to hasRating to align with schema
	20110526 Initial version of cs304 share stuff database
*/

drop table Book;
drop table CD;
drop table Video;
drop table InQueue;
drop table OwnedBy;
drop table MakesTransaction;
drop table hasRating;
drop table Makes;
drop table Item;
drop table itemRating;
drop table person;


CREATE TABLE person( 
Name CHAR(25),
Phone CHAR(10),
Password CHAR(20),
Address CHAR(30),
Email CHAR(30),
PRIMARY KEY (Email) 
);

CREATE TABLE Item( 
I_Number INTEGER,
Value REAL,
Description CHAR(1000),
Available CHAR(1),
PRIMARY KEY (I_Number)
);


CREATE TABLE itemRating( 
Rating INTEGER,
IR_ID CHAR(20),
itemComment CHAR(1000),
PRIMARY KEY (IR_ID)
);



CREATE TABLE Makes( 
Email CHAR(30),
IR_ID CHAR(20),
PRIMARY KEY (Email, IR_ID ),
FOREIGN KEY (Email) REFERENCES itemRating,
FOREIGN KEY (Email) REFERENCES person
);

CREATE TABLE hasRating( 
IR_ID CHAR(20) ,
I_Number INTEGER,
PRIMARY KEY (IR_ID, I_Number),
FOREIGN KEY (IR_ID) REFERENCES itemRating,
FOREIGN KEY (I_Number) REFERENCES Item
);

CREATE TABLE MakesTransaction(
TransactionID CHAR(20),
EndDate DATE,
StartDate DATE,
Item_Number INTEGER,
Type CHAR(12),
Email CHAR(30),
PRIMARY KEY (TransactionID, Email, Item_Number),
FOREIGN KEY (Email) REFERENCES person,
FOREIGN KEY (Item_Number) REFERENCES Item(I_Number)
);



CREATE TABLE OwnedBy( 
I_Number INTEGER,
Email CHAR(20) NOT NULL,
PRIMARY KEY (Email, I_Number),
FOREIGN KEY (I_Number) REFERENCES Item,
FOREIGN KEY (Email) REFERENCES person
);

CREATE TABLE InQueue( 
theDate DATE,
I_Number INTEGER,
Email CHAR(30),
PRIMARY KEY (Email, I_Number),
FOREIGN KEY (Email)    REFERENCES person,
FOREIGN KEY (I_Number) REFERENCES Item
);



CREATE TABLE Book( 
I_Number INTEGER ,
Title CHAR(100),
Author CHAR(40),
Type CHAR(20),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item
);

CREATE TABLE CD( 
I_Number INTEGER,
Genre CHAR(20),
AlbumName CHAR(40),
ArtistName CHAR(20),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item
);

CREATE TABLE Video( 
I_Number INTEGER,
Genre CHAR(20),
Format CHAR(10),
Title CHAR(40),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item 
);


insert into  person values ('Richard Lum','41671785','password','1 Infinity Loop', 'i0r7@ugrad.cs.ubc.ca') ;
insert into  person values ('Rafael Tovar','35433093','password','2 Center of the Universe', 'a9g7@ugrad.cs.ubc.ca') ;
insert into  person values ('Kevin Butto','49127087','password','3 Top of the World', 'p7x6@ugrad.cs.ubc.ca') ;
insert into  person values ('Yaphet F Kajatt Vaccari','39418090','password','4 Utopian Place', 'i7h4@ugrad.cs.ubc.ca') ;
select * from person;

