drop table book;
drop table item;
drop view bookitem;

CREATE TABLE Item( 
I_Number INTEGER ,
Value REAL,
Description CHAR(1000),
Available CHAR(1),
PRIMARY KEY (I_Number)
);


CREATE TABLE Book( 
I_Number INTEGER ,
Title CHAR(100),
Author CHAR(40),
Type CHAR(20),
PRIMARY KEY (I_Number),
FOREIGN KEY (I_Number) REFERENCES Item (I_Number)
);

create view bookitem
(i_number,title,author,type, value,description,available) as
select i.i_number,b.title,b.author,b.type,i.value,i.description,i.available
from book b, item i
where b.i_number=i.value;


insert into bookitem (i_number, title, value)
values (9876,'test',99.99);
