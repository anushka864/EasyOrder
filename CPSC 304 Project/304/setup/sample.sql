drop table processorder;
drop table order_assign_take;
drop table bill_order_make;
drop table mytable;
drop table staff;
drop table fooditem;

create table fooditem(
	fname varchar(100) not null,
	price float null,
	primary key (fname)
);

grant select on fooditem to public;

create table staff(
	staffID integer not null,
	staffName varchar(100) null,
  password varchar(80) NOT NULL,
	primary key (staffID)
);

grant select on staff to public;

create table mytable(
	tableID integer not null,
	primary key (tableID)
);

grant select on mytable to public;

create table bill_order_make(
	bid integer not null,
	total float null,
	staffID integer not null,
	tableID integer not null,
	billPaid integer not null,
	primary key (bid),
	foreign key (staffID) references staff ON DELETE CASCADE,
	foreign key (tableID) references mytable ON DELETE CASCADE
);

grant select on bill_order_make to public;

create table order_assign_take(
	orderNumb integer not null,
	bid integer not null,
	sid integer not null,
	primary key (orderNumb, bid),
	foreign key (sid) references staff(staffID) ON DELETE CASCADE,
	foreign key (bid) references bill_order_make ON DELETE CASCADE
);

grant select on order_assign_take to public;

create table processorder(
	fname varchar(100) not null,
	orderNumb integer not null,
	noFood integer null,
	bid integer not null,
	primary key (orderNumb, bid, fname),
	foreign key (fname) references fooditem ON DELETE CASCADE,
	foreign key (orderNumb, bid) references order_assign_take ON DELETE CASCADE
);

grant select on processorder to public;

drop sequence staff_sequence;

create sequence staff_sequence
start with 100
increment by 1
minvalue 100
maxvalue 10000;

drop sequence food_item_sequence;

create sequence food_item_sequence
start with 1
increment by 1 
minvalue 1
maxvalue 10000;

drop sequence table_sequence;

create sequence table_sequence
start with 1 
increment by 1
minvalue 1 
maxvalue 10000;

--- food item ---
insert into fooditem
values ('Butterbeer', 5.00);

insert into fooditem
values ('Firewhiskey', 7.00);

insert into fooditem
values ('Pumpkin Juice', 3.00);

insert into fooditem
values ('Water', 1.50);

insert into fooditem
values ('Latte', 3.50);

insert into fooditem
values ('Coffee', 2.00);

insert into fooditem
values ('Tea', 2.00);

insert into fooditem
values ('Pumpkin Pie', 6.00);

insert into fooditem
values ('Cauldron Cake', 6.00);

insert into fooditem
values ('Rock Cake', 4.00);

insert into fooditem
values ('Lemon Drizzle Cake', 6.00);

insert into fooditem
values ('Treacle Tart', 5.50);

insert into fooditem
values ('Trifle', 5.00);

insert into fooditem
values ('Corned Beef Sandwich', 8.50);

insert into fooditem
values ('Hamburger', 8.00);

insert into fooditem
values ('Chicken and Ham Sandwich', 8.50);

insert into fooditem
values ('Veggie Burger', 7.70);

insert into fooditem
values ('Steak and Kidney Pie', 10.00);

insert into fooditem
values ('Vegetable Panini', 7.50);

insert into fooditem
values ('Butter Chicken', 9.00);

insert into fooditem
values ('Tomato Soup', 6.00);

insert into fooditem
values ('Mushroom Soup', 6.00);

insert into fooditem
values ('Nettle Soup', 6.50);

insert into fooditem
values ('French Onion Soup', 6.50);

insert into fooditem
values ('Fish and Chips', 7.00);

insert into fooditem
values ('Chips', 5.00);

insert into fooditem
values ('Bertie Botts Every Flavour Beans bowl', 5.00);

--- staff ---
insert into staff 
values (1, 'daniel', 'daniel');

insert into staff 
values (2, 'napon', 'napon');

insert into staff
values (3, 'bob', 'bob');

---  mytable ----
insert into mytable
values(1);

insert into mytable
values(2);

insert into mytable 
values(3);

insert into mytable 
values(4);

insert into mytable 
values(5);

--- bill_order_make ---
insert into bill_order_make 
values (1,  13.50, 1, 1, 0);

insert into bill_order_make 
values (2,  50.24, 1, 2, 0);

insert into bill_order_make 
values (3,  24.53, 2, 4, 0);

insert into bill_order_make 
values (4,  31.02, 1, 3, 0);

insert into bill_order_make 
values (5,  10.01, 3, 5, 0);

-- order_assign_take --- 
insert into order_assign_take 
values (1, 1, 1);

insert into order_assign_take 
values (2, 2, 1);

insert into order_assign_take 
values (3, 2, 3);

insert into order_assign_take 
values (4, 2, 1);

insert into order_assign_take 
values (5, 2, 1);

insert into order_assign_take 
values (6, 3, 2);

insert into order_assign_take 
values (7, 4, 2);

insert into order_assign_take 
values (8, 5, 3);

insert into order_assign_take 
values (9, 2, 3);

--- processorder ---
insert into processorder
values ('Fish and Chips', 1, 1, 1);

insert into processorder
values ('Fish and Chips', 9, 1, 2);

insert into processorder 
values ('French Onion Soup', 4, 1, 2);

insert into processorder
values ('Treacle Tart', 9, 1, 2);

insert into processorder
values ('Tea', 2, 2, 2);

insert into processorder
values ('Tea', 6, 2, 3);

insert into processorder
values ('Tea', 7, 2, 4);

insert into processorder
values ('Tea', 8, 2, 5);

insert into processorder
values ('Cauldron Cake', 8, 2, 5);

insert into processorder
values ('Veggie Burger', 7, 1, 4);

insert into processorder
values ('Nettle Soup', 6, 4, 3);

insert into processorder
values ('Bertie Botts Every Flavour Beans bowl', 2, 3, 2);

insert into processorder
values ('Bertie Botts Every Flavour Beans bowl', 8, 1, 5);

insert into processorder
values ('Butter Chicken', 2, 2, 2);
