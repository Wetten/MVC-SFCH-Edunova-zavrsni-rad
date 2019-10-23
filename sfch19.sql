/*CMD SIPANJE NA LOKALNI SERVER

C:\xampp\mysql\bin>mysql -uroot --default_character_set=utf8 <"D:\PP19Workspace\localhost.hr\sfch19.sql"

alter database erinije_sfch19 default character set utf8 collate=utf8_croatian_ci;

*/

drop database if exists sfch19;
create database sfch19
Default character set utf8 collate=utf8_croatian_ci;
use sfch19;


create table osoba(
id int not null primary key auto_increment,
korisnicko_ime varchar (50) not null,
ime varchar(50),
prezime varchar(50),
email varchar(100) not null,
lozinka char(60) not null,
datum_izrade_racuna date not null,
uloga varchar(20) not null
);

create table proizvod(
id int not null primary key auto_increment,
naziv varchar(50) not null,
opis varchar(255),
kolicina varchar(20),
osoba int not null 
);

create table post(
id int not null primary key auto_increment,
naslov varchar(100) not null,
sadrzaj text not null,
datum_objave datetime not null,
osoba int not null 
);


alter table proizvod add foreign key (osoba) references osoba (id);

alter table post add foreign key (osoba) references osoba (id);


insert into osoba
(id,korisnicko_ime,ime,prezime,email,lozinka,datum_izrade_racuna,uloga)
values
(null,'BlackAngel','Borna','Vetengl','bvetengl@gmail.com','$2y$12$X0yKjpolYgznro6Fg7dhS.2Hv0vyQAfpNCmIUnv7fb5.UNB8mahJq','2019-09-30','admin'),
(null,'Wettey','Lobel','Vetengl','vetengl.lobel@gmail.com','$2y$12$X0yKjpolYgznro6Fg7dhS.2Hv0vyQAfpNCmIUnv7fb5.UNB8mahJq','2019-10-13','editor');
 

insert into proizvod
(id,naziv,opis,kolicina,osoba)
values
(null,'Čista kava','Pretty clean','1dcl',1),
(null,'Wall Street','Dosta slatka','3dcl',2),
(null,'Lješnjak Latte','Manje slatka','3dcl',2),
(null,'Kava s mlijekom','Nije mlijeko s kavom!','2dcl',1);

insert into post
(id,naslov,sadrzaj,datum_objave,osoba)
values
(null,'Nova Terasa!','Napkon nova terasa za Vas!','2019-10-13',1),
(null,'Test','čćžšpćčćčdžđščć_@123','2019-10-13',1);
