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
drop table MakesTransaction;
drop table hasRating;
drop table Makes;
drop table Item;
drop table itemRating;
drop table person;
drop view bookitem;
drop view cditem;
drop view videoitem;
drop view bookOwnedby;
