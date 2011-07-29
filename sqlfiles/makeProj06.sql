/*
	20110529 UR -> UR changed to IR:  to align with schema
			added Item(I_Number) as part of MakesTransaction Primary key
			changed has to hasRating to align with schema
	20110526 Initial version of cs304 share stuff database
*/

drop table Book;
drop table CD;
drop table Video;
drop table InQueue;
drop table OwnedBy;
drop trigger makeTransactionTrigger;
drop table MakesTransaction;
drop trigger itemRatingTrigger;
drop table hasRating;
drop table Makes;
drop trigger itemIndexTrigger;
drop table Item;
drop table itemRating;
drop table person;
drop view bookItem;
drop view cdItem;
drop view videoItem;
drop sequence item_seq;
drop sequence ir_seq;
drop sequence  transaction_seq;

CREATE TABLE person( 
Name CHAR(25) NOT NULL,
Phone CHAR(10),
Password CHAR(20),
Address CHAR(30),
Email CHAR(30),
PRIMARY KEY (Email) 
);



CREATE TABLE Item( 
I_Number INTEGER ,
Value REAL,
Description CHAR(1000),
Available CHAR(1) Default 'F'
	check (Available in ('T','F')),
PRIMARY KEY (I_Number)
);
/**
  Create a sequence for inserting auto generated sequence numbers for i_number.
  use insert into item values (default, .....)  or insert into item( fn1, fn2 ,..)
  skipping the i_number field to allow auto insertion
**/
create sequence item_seq
  start with 100
  increment by 1
  nomaxvalue;

create trigger itemIndexTrigger
  before insert on item  
  for each row
  begin
  select item_seq.nextval into :new.i_number from dual;
  end;
/



CREATE TABLE itemRating( 
Rating INTEGER,
IR_ID CHAR(20),
itemComment CHAR(1000),
PRIMARY KEY (IR_ID)
);

/**
  Create a sequence for inserting auto generated sequence numbers for ir_id
  use insert into item values (default, .....)  or insert into item( fn1, fn2 ,..)
  skipping the i_number field to allow auto insertion
**/
create sequence ir_seq
  start with 100
  increment by 1
  nomaxvalue;

create trigger itemRatingTrigger
  before insert on itemRating
  for each row
  begin
  select item_seq.nextval into :new.ir_id  from dual;
  end;
/



CREATE TABLE Makes( 
Email CHAR(30),
IR_ID CHAR(20),
PRIMARY KEY (Email, IR_ID ) ,
FOREIGN KEY (Email) REFERENCES itemRating on delete cascade,
FOREIGN KEY (Email) REFERENCES person on delete cascade
);

CREATE TABLE hasRating( 
IR_ID CHAR(20) ,
I_Number INTEGER,
PRIMARY KEY (IR_ID, I_Number),
FOREIGN KEY (IR_ID) REFERENCES itemRating on delete cascade,
FOREIGN KEY (I_Number) REFERENCES Item on delete cascade
);

CREATE TABLE MakesTransaction(
TransactionID CHAR(20),
EndDate DATE,
StartDate DATE,
Item_Number INTEGER,
Type CHAR(12),
Email CHAR(30),
PRIMARY KEY (TransactionID, Email, Item_Number) ,
FOREIGN KEY (Email) REFERENCES person on delete cascade,
FOREIGN KEY (Item_Number) REFERENCES Item(I_Number) on delete cascade
);

/**
	auto index transactionid for makestransaction
**/
create sequence transaction_seq
  start with 100
  increment by 1
  nomaxvalue;

create trigger makeTransactionTrigger
  before insert on MakesTransaction  
  for each row
  begin
  select item_seq.nextval into :new.TransactionID from dual;
  end;
  /


CREATE TABLE OwnedBy( 
I_Number INTEGER,
Email CHAR(30) NOT NULL,
PRIMARY KEY (Email, I_Number),
FOREIGN KEY (I_Number) REFERENCES Item on delete cascade,
FOREIGN KEY (Email) REFERENCES person on delete cascade
);

CREATE TABLE InQueue( 
theDate DATE,
I_Number INTEGER,
Email CHAR(30),
PRIMARY KEY (Email, I_Number),
FOREIGN KEY (Email)    REFERENCES person on delete cascade,
FOREIGN KEY (I_Number) REFERENCES Item on delete cascade
);



CREATE TABLE Book( 
I_Number INTEGER ,
Title CHAR(100),
Author CHAR(40),
Type CHAR(20),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item on delete cascade
);

CREATE TABLE CD( 
I_Number INTEGER,
Genre CHAR(20),
AlbumName CHAR(40),
ArtistName CHAR(30),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item on delete cascade
);

CREATE TABLE Video( 
I_Number INTEGER,
Genre CHAR(20),
Format CHAR(10),
Title CHAR(40),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item  on delete cascade
);



create view bookitem
(i_number,title,author,type, value,description,available) as
select b.i_number,b.title,b.author,b.type,i.value,i.description,i.available
from book b, item i
where b.i_number=i.i_number;


create view cditem
(i_number,genre, albumName, artistName, value,description,available) as
select c.i_number,c.genre,c.albumname,c.artistname,i.value,i.description,i.available
from cd c, item i
where c.i_number=i.i_number;


create view videoitem
(i_number,genre, format,title, value,description,available) as
select v.i_number,v.genre,v.format,v.title,i.value,i.description,i.available
from video v , item i
where v.i_number=i.i_number;




