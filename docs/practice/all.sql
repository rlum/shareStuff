--
-- 	Database Table Creation
--
--		This file will create the tables for use with the book 
--  Database Management Systems by Raghu Ramakrishnan and Johannes Gehrke.
--  It is run automatically by the installation script.
--
--	Version 0.1.0.0 2002/04/05 by: David Warden.
--	Copyright (C) 2002 McGraw-Hill Companies Inc. All Rights Reserved.
--
--  First drop any existing tables. Any errors are ignored.
--
drop table student cascade constraints;
drop table faculty cascade constraints;
drop table class cascade constraints;
drop table enrolled cascade constraints;
drop table emp cascade constraints;
drop table works cascade constraints;
drop table dept cascade constraints;
drop table flights cascade constraints;
drop table aircraft cascade constraints;
drop table certified cascade constraints;
drop table employees cascade constraints;
drop table suppliers cascade constraints;
drop table parts cascade constraints;
drop table catalog cascade constraints;
drop table sailors cascade constraints;
drop table boats cascade constraints;
drop table reserves cascade constraints;
--
-- Now, add each table.
--
create table student(
	snum number(9,0) primary key,
	sname varchar2(30),
	major varchar2(25),
	standing varchar2(2),
	age number(3,0)
	);
create table faculty(
	fid number(9,0) primary key,
	fname varchar2(30),
	deptid number(2,0)
	);
create table class(
	name varchar2(40) primary key,
	meets_at varchar2(20),
	room varchar2(10),
	fid number(9,0),
	foreign key(fid) references faculty
	);
create table enrolled(
	snum number(9,0),
	cname varchar2(40),
	primary key(snum,cname),
	foreign key(snum) references student,
	foreign key(cname) references class(name)
	);
create table emp(
	eid number(9,0) primary key,
	ename varchar2(30),
	age number(3,0),
	salary number(10,2)
	);
create table dept(
	did number(2,0) primary key,
	dname varchar2(20),
	budget number(10,2),
	managerid number(9,0),
	foreign key(managerid) references emp(eid)
	);
create table works(
	eid number(9,0),
	did number(2,0),
	pct_time number(3,0),
	primary key(eid,did),
	foreign key(eid) references emp,
	foreign key(did) references dept
	);
create table flights(
	flno number(4,0) primary key,
	origin varchar2(20),
	destination varchar2(20),
	distance number(6,0),
	departs timestamp,
	arrives timestamp,
	price number(7,2)
	);
create table aircraft(
	aid number(9,0) primary key,
	aname varchar2(30),
	cruisingrange number(6,0)
	);
create table employees(
	eid number(9,0) primary key,
	ename varchar2(30),
	salary number(10,2)
	);
create table certified(
	eid number(9,0),
	aid number(9,0),
	primary key(eid,aid),
	foreign key(eid) references employees,
	foreign key(aid) references aircraft
	);
create table suppliers(
	sid number(9,0) primary key,
	sname varchar2(30),
	address varchar2(40)
	);
create table parts(
	pid number(9,0) primary key,
	pname varchar2(40),
	colour varchar2(15)
	);
create table catalog(
	sid number(9,0),
	pid number(9,0),
	cost number(10,2),
	primary key(sid,pid),
	foreign key(sid) references suppliers,
	foreign key(pid) references parts
	);

create table sailors (
	sid integer,
	sname varchar2(30),
	rating integer,
	age real,
	primary key (sid)
);

create table boats (
	bid integer,
	bname varchar2(30),
	colour varchar2(30),
	primary key (bid)
);
create table reserves (
	sid integer,
	bid integer,
	day date,
	primary key (sid, bid, day),
	foreign key (sid) references sailors,
	foreign key (bid) references boats
);



--
-- done adding all of the tables, now add in some tuples
--  first, add in the students
insert into student values(051135593,'Maria White','English','SR',21);
insert into student values(060839453,'Charles Harris','Architecture','SR',22);
insert into student values(099354543,'Susan Martin','Law','JR',20);
insert into student values(112348546,'Joseph Thompson','Computer Science','SO',19);
insert into student values(115987938,'Christopher Garcia','Computer Science','JR',20);
insert into student values(132977562,'Angela Martinez','History','SR',20);
insert into student values(269734834,'Thomas Robinson','Psychology','SO',18);
insert into student values(280158572,'Margaret Clark','Animal Science','FR',18);
insert into student values(301221823,'Juan Rodriguez','Psychology','JR',20);
insert into student values(318548912,'Dorthy Lewis','Finance','FR',18);
insert into student values(320874981,'Daniel Lee','Electrical Engineering','FR',17);
insert into student values(322654189,'Lisa Walker','Computer Science','SO',17);
insert into student values(348121549,'Paul Hall','Computer Science','JR',18);
insert into student values(351565322,'Nancy Allen','Accounting','JR',19);
insert into student values(451519864,'Mark Young','Finance','FR',18);
insert into student values(455798411,'Luis Hernandez','Electrical Engineering','FR',17);
insert into student values(462156489,'Donald King','Mechanical Engineering','SO',19);
insert into student values(550156548,'George Wright','Education','SR',21);
insert into student values(552455318,'Ana Lopez','Computer Engineering','SR',19);
insert into student values(556784565,'Kenneth Hill','Civil Engineering','SR',21);
insert into student values(567354612,'Karen Scott','Computer Engineering','FR',18);
insert into student values(573284895,'Steven Green','Kinesiology','SO',19);
insert into student values(574489456,'Betty Adams','Economics','JR',20);
insert into student values(578875478,'Edward Baker','Veterinary Medicine','SR',21);

--now add in the faculty
insert into faculty values (142519864,'I. Teach',20);
insert into faculty values (242518965,'James Smith',68);
insert into faculty values (141582651,'Mary Johnson',20);
insert into faculty values (011564812,'John Williams',68);
insert into faculty values (254099823,'Patricia Jones',68);
insert into faculty values (356187925,'Robert Brown',12);
insert into faculty values (489456522,'Linda Davis',20);
insert into faculty values (287321212,'Michael Miller',12);
insert into faculty values (248965255,'Barbara Wilson',12);
insert into faculty values (159542516,'William Moore',33);
insert into faculty values (090873519,'Elizabeth Taylor',11);
insert into faculty values (486512566,'David Anderson',20);
insert into faculty values (619023588,'Jennifer Thomas',11);
insert into faculty values (489221823,'Richard Jackson',33);
insert into faculty values (548977562,'Ulysses Teach',20);
--now add in the classes
insert into class values('Data Structures','MWF 10','R128',489456522);
insert into class values('Database Systems','MWF 12:30-1:45','1320 DCL',142519864);
insert into class values('Operating System Design','TuTh 12-1:20','20 AVW',489456522 );
insert into class values('Psychology','','',619023588);
insert into class values('Archaeology of the Incas','MWF 3-4:15','R128',248965255);
insert into class values('Aviation Accident Investigation','TuTh 1-2:50','Q3',011564812);
insert into class values('Air Quality Engineering','TuTh 10:30-11:45','R15',011564812);
insert into class values('Introductory Latin','MWF 3-4:15','R12',248965255);
insert into class values('American Political Parties','TuTh 2-3:15','20 AVW',619023588);
insert into class values('Social Cognition','Tu 6:30-8:40','R15',159542516);
insert into class values('Perception','MTuWTh 3','Q3',489221823);
insert into class values('Multivariate Analysis','TuTh 2-3:15','R15',090873519);
insert into class values('Patent Law','F 1-2:50','R128',090873519);
insert into class values('Urban Economics','MWF 11','20 AVW',489221823);
insert into class values('Organic Chemistry','TuTh 12:30-1:45','R12',489221823);
insert into class values('Marketing Research','MW 10-11:15','1320 DCL',489221823);
insert into class values('Seminar in American Art','M 4','R15',489221823);
insert into class values('Orbital Mechanics','MWF 8','1320 DCL',011564812);
insert into class values('Dairy Herd Management','TuTh 12:30-1:45','R128',356187925);
insert into class values('Communication Networks','MW 9:30-10:45','20 AVW',141582651);
insert into class values('Optical Electronics','TuTh 12:30-1:45','R15',254099823);
insert into class values('Artificial Intelligence','','UP328',null);
insert into class values('Intoduction to Math','TuTh 8-9:30','R128',489221823);
--now add in the enrollments
insert into enrolled values (112348546,'Database Systems');
insert into enrolled values (115987938,'Database Systems');
insert into enrolled values (348121549,'Database Systems');
insert into enrolled values (322654189,'Database Systems');
insert into enrolled values (552455318,'Database Systems');
insert into enrolled values (455798411,'Operating System Design');
insert into enrolled values (552455318,'Operating System Design');
insert into enrolled values (567354612,'Operating System Design');
insert into enrolled values (112348546,'Operating System Design');
insert into enrolled values (115987938,'Operating System Design');
insert into enrolled values (322654189,'Operating System Design');
insert into enrolled values (567354612,'Data Structures');
insert into enrolled values (552455318,'Communication Networks');
insert into enrolled values (455798411,'Optical Electronics');
insert into enrolled values (455798411,'Organic Chemistry');
insert into enrolled values (301221823,'Perception');
insert into enrolled values (301221823,'Social Cognition');
insert into enrolled values (301221823,'American Political Parties');
insert into enrolled values (556784565,'Air Quality Engineering');
insert into enrolled values (099354543,'Patent Law');
insert into enrolled values (574489456,'Urban Economics');
--now add in the sailors, boats, and reserves

insert into sailors values(22, 'dustin',7,45.0);
insert into sailors values(31, 'lubber',8,55.5);
insert into sailors values(58, 'rusty', 10, 35.0);
insert into boats values(101, 'interlake', 'blue');
insert into boats values(102, 'interlake', 'red');
insert into boats values(103, 'clipper', 'green');
insert into boats values(104, 'marien', 'red');
insert into reserves values(22,101,'10-OCT-1998');
insert into reserves values(22,102,'10-OCT-1998');
insert into reserves values(22,103,'8-OCT-1998');
insert into reserves values(22,104,'10-JUL-1998');
insert into reserves values(31,102,'10-NOV-1998');
insert into reserves values(31,103,'6-NOV-1998');
insert into reserves values(31,104,'12-NOV-1998');
insert into reserves values(58,102,'8-NOV-1998');
insert into reserves values(58,103,'12-NOV-1998');



-- now add in the flights and such
insert into flights values(99,'Los Angeles','Washington D.C.',2308,to_timestamp('2005/04/12 09:30', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 21:40', 'YYYY/MM/DD HH24 MI'),235.98);
insert into flights values(13,'Los Angeles','Chicago',1749,to_timestamp('2005/04/12 08:45', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 20:45', 'YYYY/MM/DD HH24 MI'),220.98);
insert into flights values(346,'Los Angeles','Dallas',1251,to_timestamp('2005/04/12 11:50', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 19:05', 'YYYY/MM/DD HH24 MI'),225.43);
insert into flights values(387,'Los Angeles','Boston',2606,to_timestamp('2005/04/12 07:03', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 17:03', 'YYYY/MM/DD HH24 MI'),261.56);
insert into flights values(7,'Los Angeles','Sydney',7487,to_timestamp('2005/04/12 22:30', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/14 06:10', 'YYYY/MM/DD HH24 MI'),1278.56);
insert into flights values(2,'Los Angeles','Tokyo',5478,to_timestamp('2005/04/12 12:30', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/13 15:55', 'YYYY/MM/DD HH24 MI'),780.99);
insert into flights values(33,'Los Angeles','Honolulu',2551,to_timestamp('2005/04/12 09:15', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 11:15', 'YYYY/MM/DD HH24 MI'),375.23);
insert into flights values(34,'Los Angeles','Honolulu',2551,to_timestamp('2005/04/12 12:45', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 15:18', 'YYYY/MM/DD HH24 MI'),425.98);
insert into flights values(76,'Chicago','Los Angeles',1749,to_timestamp('2005/04/12 08:32', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 10:03', 'YYYY/MM/DD HH24 MI'),220.98);
insert into flights values(68,'Chicago','New York',802,to_timestamp('2005/04/12 09:00', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 12:02', 'YYYY/MM/DD HH24 MI'),202.45);
insert into flights values(7789,'Madison','Detroit',319,to_timestamp('2005/04/12 06:15', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 08:19', 'YYYY/MM/DD HH24 MI'),120.33);
insert into flights values(701,'Detroit','New York',470,to_timestamp('2005/04/12 08:55', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 10:26', 'YYYY/MM/DD HH24 MI'),180.56);
insert into flights values(702,'Madison','New York',789,to_timestamp('2005/04/12 07:05', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 10:12', 'YYYY/MM/DD HH24 MI'),202.34);
insert into flights values(4884,'Madison','Chicago',84,to_timestamp('2005/04/12 22:12', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 23:02', 'YYYY/MM/DD HH24 MI'),112.45);
insert into flights values(2223,'Madison','Pittsburgh',517,to_timestamp('2005/04/12 08:02', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 10:01', 'YYYY/MM/DD HH24 MI'),189.98);
insert into flights values(5694,'Madison','Minneapolis',247,to_timestamp('2005/04/12 08:32', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 09:33', 'YYYY/MM/DD HH24 MI'),120.11);
insert into flights values(304,'Minneapolis','New York',991,to_timestamp('2005/04/12 10:00', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 13:39', 'YYYY/MM/DD HH24 MI'),101.56);
insert into flights values(149,'Pittsburgh','New York',303,to_timestamp('2005/04/12 09:42', 'YYYY/MM/DD HH24 MI'),to_timestamp('2005/04/12 12:09', 'YYYY/MM/DD HH24 MI'),116.50);
insert into aircraft values(1,'Boeing 747-400',8430);
insert into aircraft values(2,'Boeing 737-800',3383);
insert into aircraft values(3,'Airbus A340-300',7120);
insert into aircraft values(4,'British Aerospace Jetstream 41',1502);
insert into aircraft values(5,'Embraer ERJ-145',1530);
insert into aircraft values(6,'SAAB 340',2128);
insert into aircraft values(7,'Piper Archer III',520);
insert into aircraft values(8,'Tupolev 154',4103);
insert into aircraft values(16,'Schwitzer 2-33',30);
insert into aircraft values(9,'Lockheed L1011',6900);
insert into aircraft values(10,'Boeing 757-300',4010);
insert into aircraft values(11,'Boeing 777-300',6441);
insert into aircraft values(12,'Boeing 767-400ER',6475);
insert into aircraft values(13,'Airbus A320',2605);
insert into aircraft values(14,'Airbus A319',1805);
insert into aircraft values(15,'Boeing 727',1504);
insert into employees values(242518965,'James Smith',120433);
insert into employees values(141582651,'Mary Johnson',178345);
insert into employees values(011564812,'John Williams',153972);
insert into employees values(567354612,'Lisa Walker',256481);
insert into employees values(552455318,'Larry West',101745);
insert into employees values(550156548,'Karen Scott',205187);
insert into employees values(390487451,'Lawrence Sperry',212156);
insert into employees values(274878974,'Michael Miller',99890);
insert into employees values(254099823,'Patricia Jones',24450);
insert into employees values(356187925,'Robert Brown',44740);
insert into employees values(355548984,'Angela Martinez',212156 );
insert into employees values(310454876,'Joseph Thompson',212156);
insert into employees values(489456522,'Linda Davis',127984);
insert into employees values(489221823,'Richard Jackson',23980);
insert into employees values(548977562,'William Ward',84476);
insert into employees values(310454877,'Chad Stewart',33546);
insert into employees values(142519864,'Betty Adams',227489);
insert into employees values(269734834,'George Wright',289950);
insert into employees values(287321212,'Michael Miller',48090);
insert into employees values(552455348,'Dorthy Lewis',92013);
insert into employees values(248965255,'Barbara Wilson',43723);
insert into employees values(159542516,'William Moore',48250);
insert into employees values(348121549,'Haywood Kelly',32899);
insert into employees values(090873519,'Elizabeth Taylor',32021);
insert into employees values(486512566,'David Anderson',743001);
insert into employees values(619023588,'Jennifer Thomas',54921);
insert into employees values(015645489,'Donald King',18050);
insert into employees values(556784565,'Mark Young',205187);
insert into employees values(573284895,'Eric Cooper',114323);
insert into employees values(574489456,'William Jones',105743);
insert into employees values(574489457,'Milo Brooks',20);
insert into certified values(567354612,1);
insert into certified values(567354612,2);
insert into certified values(567354612,10);
insert into certified values(567354612,11);
insert into certified values(567354612,12);
insert into certified values(567354612,15);
insert into certified values(567354612,7);
insert into certified values(567354612,9);
insert into certified values(567354612,3);
insert into certified values(567354612,4);
insert into certified values(567354612,5);
insert into certified values(552455318,2);
insert into certified values(552455318,14);
insert into certified values(550156548,1);
insert into certified values(550156548,12);
insert into certified values(390487451,3);
insert into certified values(390487451,13);
insert into certified values(390487451,14);
insert into certified values(274878974,10);
insert into certified values(274878974,12);
insert into certified values(355548984,8);
insert into certified values(355548984,9);
insert into certified values(310454876,8);
insert into certified values(310454876,9);
insert into certified values(548977562,7);
insert into certified values(142519864,1);
insert into certified values(142519864,11);
insert into certified values(142519864,12);
insert into certified values(142519864,10);
insert into certified values(142519864,3);
insert into certified values(142519864,2);
insert into certified values(142519864,13);
insert into certified values(142519864,7);
insert into certified values(269734834,1);
insert into certified values(269734834,2);
insert into certified values(269734834,3);
insert into certified values(269734834,4);
insert into certified values(269734834,5);
insert into certified values(269734834,6);
insert into certified values(269734834,7);
insert into certified values(269734834,8);
insert into certified values(269734834,9);
insert into certified values(269734834,10);
insert into certified values(269734834,11);
insert into certified values(269734834,12);
insert into certified values(269734834,13);
insert into certified values(269734834,14);
insert into certified values(269734834,15);
insert into certified values(552455318,7);
insert into certified values(556784565,5);
insert into certified values(556784565,2);
insert into certified values(556784565,3);
insert into certified values(573284895,3);
insert into certified values(573284895,4);
insert into certified values(573284895,5);
insert into certified values(574489456,8);
insert into certified values(574489456,6);
insert into certified values(574489457,7);
insert into certified values(242518965,2);
insert into certified values(242518965,10);
insert into certified values(141582651,2);
insert into certified values(141582651,10);
insert into certified values(141582651,12);
insert into certified values(011564812,2);
insert into certified values(011564812,10);
insert into certified values(356187925,6);
insert into certified values(159542516,5);
insert into certified values(159542516,7);
insert into certified values(090873519,6);