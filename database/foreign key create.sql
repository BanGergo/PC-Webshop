-- drop table if exists loyalty;
-- drop table if exists rendeles_tetel;
-- drop table if exists rendeles_torzs;
-- drop table if exists tulajdonsag_nev;
-- drop table if exists termek;
-- drop table if exists review;
-- fk
-- drop table if exists tulajdonsag;
-- drop table if exists billing;
-- drop table if exists ranks;
-- drop table if exists user;
-- drop table if exists image;
-- drop table if exists gyarto;
-- drop table if exists kategoria;
-- drop table if exists guest;


create table user(
user_id int auto_increment primary key,
nev varchar(255) not null,
email varchar(255) not null unique,
password varchar(255) not null,
irszam varchar(255) not null,
varos varchar(255) not null,
uha varchar(255) not null,
megj text not null,
created_at date not null,
updated_at date not null,
status bool
);

create table loyalty(
loyalty_id int primary key auto_increment,
user_id int not null,
rank_id int not null,
currentft int not null
);

create table ranks(
rank_id int primary key not null,
rankname varchar(255),
discount tinyint not null,
minft int not null
);

create table review(
review_id int auto_increment primary key,
user_id int not null,
cikkszam int not null,
review text not null,
created_at datetime not null
);

create table termek(
cikkszam int primary key auto_increment,
nev varchar(255) not null unique,
keszlet int not null default 0,
netto int not null,
kedv tinyint not null default 0,
kat_id int not null,
gyarto_id int not null
)auto_increment = 100000;

create table image(
img_id int auto_increment primary key,
cikkszam int not null,
url varchar(255) not null
);

create table kategoria(
kat_id int primary key auto_increment,
nev varchar(255) not null
);

create table gyarto(
gyarto_id int auto_increment primary key,
nev varchar(255) not null
);

create table rendeles_tetel(
order_id int auto_increment primary key,
rendt_id int not null,
cikkszam int not null,
menny int not null,
netto int not null,
afa tinyint not null default 27
);

create table rendeles_torzs(
rendt_id int primary key auto_increment,
user_id int not null,
guest_id int not null,
billing_id int not null unique,
ossz int not null,
paymentmethod enum("előre utalás", "utánvétel")
);

create table guest(
guest_id int auto_increment primary key,
nev varchar(255) not null,
email varchar(255) not null unique,
telefon int not null unique,
irszam varchar(255) not null,
varos varchar(255) not null,
uha varchar(255) not null,
megj text not null
);

create table billing(
billing_id int auto_increment primary key,
billingdate date not null,
deliverydate date not null,
paymentstatus enum("kifizetendő", "kifizetve"),
deliverystatus enum("kiszállítandó", "kiszállítva")
);

create table tulajdonsag_nev(
tul_nev_id int primary key auto_increment,
cikkszam int not null,
tul_nev varchar(255) not null
);

create table tulajdonsag(
tul_nev_id int not null,
tulajdonsag varchar(255)
);

-- alter table tablenev
-- add constraint fk_
-- foreign key (table_id) references othertable(id);

alter table loyalty
add foreign key (rank_id) references ranks(rank_id);

alter table loyalty
add foreign key (user_id) references user(user_id);

alter table review
add foreign key (user_id) references user(user_id);

alter table rendeles_torzs
add foreign key (user_id) references user(user_id);

alter table tulajdonsag
add foreign key (tul_nev_id) references tulajdonsag_nev(tul_nev_id);

alter table tulajdonsag_nev
add foreign key (cikkszam) references termek(cikkszam);

alter table rendeles_tetel
add foreign key (cikkszam) references termek(cikkszam);

alter table review
add foreign key (cikkszam) references termek(cikkszam);

alter table image
add foreign key (cikkszam) references termek(cikkszam);

alter table termek
add foreign key (kat_id) references kategoria(kat_id);

alter table termek
add foreign key (gyarto_id) references gyarto(gyarto_id);

alter table rendeles_torzs
add foreign key (billing_id) references billing(billing_id);

alter table rendeles_torzs
add foreign key (guest_id) references guest(guest_id);

alter table rendeles_tetel
add foreign key (rendt_id) references rendeles_torzs(rendt_id);