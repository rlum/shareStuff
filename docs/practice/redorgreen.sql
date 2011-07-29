select s.name from sailors s, reserves r, boats b
where s.sid=r.sid and r.bid =b.bid and s.name 
in 
(select s1.name from sailors s1, reserves r1, boats b1
where s1.sid=r1.sid and r1.bid =b1.bid and
	b1.color='red') 
union
(select s2.name from sailors s2, reserves r2, boats b2
where s2.sid=r2.sid and r2.bid =b2.bid and
	b2.color='red') 
/
