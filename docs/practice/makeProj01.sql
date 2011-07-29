drop table user;
drop table item;
drop table userrating;


CREATE TABLE User( 
Name CHAR(20),
Phone CHAR(10),
Password CHAR(20),
Address CHAR(100),
Email CHAR(30),
PRIMARY KEY (Email)
);


CREATE TABLE Item( 
I_Number INTEGER,
Value REAL,
Description CHAR(1000),
Available BOOLEAN),
PRIMARY KEY (I_Number)
);

CREATE TABLE UserRating( 
Rating INTEGER,
UR_ID CHAR(20),
Comment CHAR(1000),
PRIMARY KEY (UR_ID)
);


