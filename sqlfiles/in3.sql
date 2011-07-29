
/** insert some people
*/

insert into person values('The One','',ora_hash('RedPill'),'','theOne@matrix.com')

insert into  person values ('Rafael Tovar','35433093','password','2 Center of the Universe', 'a9g7@ugrad.cs.ubc.ca') ;
insert into  person values ('Kevin Butto','49127087','password','3 Top of the World', 'p7x6@ugrad.cs.ubc.ca') ;
insert into  person values ('Yaphet F Kajatt Vaccari','39418090','password','4 Utopian Place', 'i7h4@ugrad.cs.ubc.ca') ;
insert into  person values ('Richard Lum','41671785',ora_hash('cygnus'),'1 Infinity Loop', 'i0r7@ugrad.cs.ubc.ca') ;

insert into  person values ('Barack Obama','1800Prez',ora_hash('cygnus'),'1600 Pennsylvania Ave NW.', 'president@us.gov') ;


select * from person;


/** insert a few books
	note, you cannot insert into views that are built on multiple tables.  We must
	insert into item, insert into book and then the combined data will appear in bookitem view

	We have to keep structure to keep relationships with items simple, otherwise we 
	have to create relationships to bookItem, cdItem, videoItem etc...
*/

insert into item values (default, 99.99, 'Assembly Language text book',default);
insert into book values (item_seq.currval, 'Assembly Lanugauge Programming for Intel based Computers', 'Kip Irvine', 'Text Book');
insert into  ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');

insert into item values (default, 1000.00, 'Hardcopy of Britney Spears Guide to SemiConductor Physics website- illustrated',default);
insert into book values (item_seq.currval, 'Britney Spears Guide to SemiConductor Physics','Britney Spears', 'Reference');
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');


insert into item values (default, 10000000, 'Book of Secrets',default);
insert into book values (item_seq.currval, 'Book of Secrets - handed down from president to president - missing page 47', 'Many Dead Presidents', 'reference');
insert into ownedby values (item_seq.currval, 'president@us.gov');


insert into item values (default, 100, 'Optimizing Acquaintance Selection, a guide to facebook',default);
insert into book values (item_seq.currval, 'Optimizing Acquaintance Selection, the relational optimization of your friends', 'Pachel Rottinger', 'reference');
insert into ownedby values (item_seq.currval, 'president@us.gov');


insert into item values (default, 100, 'Schema merging and mapping for fun and recreation ',default);
insert into book values (item_seq.currval, 'Schema merging and mapping for fun and recreation', 'Pachel Rottinger', 'reference');
insert into ownedby values (item_seq.currval, 'president@us.gov');


insert into item values (default, 100, 'Okay,Here we go!, a self help book for the lost',default);
insert into book values (item_seq.currval, 'OKay, Here we go!', 'Weve Stolfman', 'selfhelp');
insert into ownedby values (item_seq.currval, 'president@us.gov');


insert into item values (default, 100, 'In search of Faerie dust',default);
insert into book values (item_seq.currval, 'Where does Faerie dust come from', 'Rottinger-Stolfman', 'Research Paper');
insert into ownedby values (item_seq.currval, 'president@us.gov');
insert into item values(default, 29.99, 'Original Mona Lisa Painting.  Received when museum shipped wrong item.  Warning, the colours are faded and the image is not as sharp as the poster.',default);
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');

insert into item values( default, .99, 'clippy.  Barely used microsoft desktop assistant',default);
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');

insert into item values (default, 99999999, 'Le Coeur del Mer - as seen on Kate Winslet in Titanic.  Smells like salt water',default);
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');

insert into item values (default, 0, 'used itunes card - empty',default);
insert into ownedby  values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');

insert into item values (default, 1000000, 'unreleased album - can Geogorian Monks rap better than Eminem can chant?',default);
insert into CD values (item_seq.currval, 'Compilation', 'Monks vs Emenim,a vocal exchange', 'Gregorian Monks/Eminem');
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');

insert into item values (default, .50, 'USB thumbdrive - infected with stuxnet, early developer release',default);
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');


insert into item values (default, .50, 'Banana Peel, prototype used by Princess Peach during Mario Kart development. Rejected for not being slippery enough',default);
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');

insert into item values (default, 40000, 'Ferrari 308 GTB - actual vehicle used in Magnum PI.  Tom comes with the car.  Sorry, cant unbundle',default);
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');

insert into item values (default, 80000, 'Delorean DMC 12 - Needs towing.  Mr Fusion not working but flux capacitor in good shape',default);
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');


insert into item values (default, .01, 'Collection of Higgs Boson Particles - dont tell the guys at the LHC.',default);
insert into ownedby values (item_seq.currval, 'i7h4@ugrad.cs.ubc.ca');


insert into item values (default, .01, 'Text on why space flight will never work?','T');
insert into ownedby values (item_seq.currval, 'p7x6@ugrad.cs.ubc.ca');
insert into book values (item_seq.currval, 'Man was not made for space travel', 'Zefram Cochrane', 'reference');



insert into item values (default, 10, 'Best of Bread',default);
insert into CD values (item_seq.currval, 'Soft Pop', 'Best of Bread', 'Bread');
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');


insert into item values (default, 15, 'Beatles Abbey Road',default);
insert into CD values (item_seq.currval, 'Classic Pop', 'Abbey Road', 'The Beatles');
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');

insert into item values (default, 11, 'Wierd Al Yankovitch, Im fat',default);
insert into CD values (item_seq.currval, 'Humour', 'Im Fat', 'Wierd Al Yankovitch');
insert into ownedby values (item_seq.currval, 'a9g7@ugrad.cs.ubc.ca');



insert into item values (default, 400, 'Battle Star Galactica, the complete set',default);
insert into video values (item_seq.currval, 'SciFi', 'BluRay', 'BattleStar Galactica Collection');
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');

insert into item values (default, 100, 'Star Trek, the original series',default);
insert into video values (item_seq.currval, 'SciFi', 'VHS', 'Star Trek, Original Series');
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');


insert into item values (default, 1000, 'How to Excel at cs304 without really trying',default);
insert into video values (item_seq.currval, 'Educational', 'DVD', 'CS304 for Dummies, the Movie');
insert into ownedby values (item_seq.currval, 'i0r7@ugrad.cs.ubc.ca');

commit;
