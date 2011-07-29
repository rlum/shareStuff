drop table person;
drop table personRating;
drop table Item;
drop table Makes;
drop table Has;
drop table MakesTransaction;
drop table OwnedBy;
drop table InQueue;
drop table Book;
drop table CD;
drop table Video;

CREATE TABLE person( 
Name CHAR(20),
Phone CHAR(10),
Password CHAR(20),
Address CHAR(100),
Email CHAR(30),
PRIMARY KEY (Email) 
);

CREATE TABLE personRating( 
Rating INTEGER,
UR_ID CHAR(20),
Comment CHAR(1000),
PRIMARY KEY (UR_ID)
);

CREATE TABLE Item( 
I_Number INTEGER,
Value REAL,
Description CHAR(1000),
Available BOOLEAN),
PRIMARY KEY (I_Number)
);


