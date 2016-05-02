##=========================================
##Nom de la base   :  GestionCrossAnnuel ==   
##Date de création :  07/03/2016  8h57   ==
##Copyright        :  REGNIER Valentin   ==
##Version          :  1                  ==
##=========================================

##===================================================
##Création de la base================================
##===================================================
drop database GestionCrossAnnuel;
create database GestionCrossAnnuel;
use GestionCrossAnnuel;

##===================================================
##Supression des tables==============================
##===================================================

##drop table GROUPE;
##drop table CLASSE;
##drop table TYPE_GROUPE;
##drop table UTILISATEUR;
##drop table POINT;




##===================================================
##Création de la table point=========================
##===================================================


create table POINT(id int NOT NULL AUTO_INCREMENT, libelle varchar(100), situation varchar(100),mini int, maxi int,
primary key (id));

##===================================================
##Création de la table type_groupe===================
##===================================================

create table TYPE_GROUPE(id int NOT NULL AUTO_INCREMENT, libelle varchar(100), marqueur varchar(100), point int,
primary key (id));

##===================================================
##Création de la table classe========================
##===================================================


create table CLASSE(id int NOT NULL AUTO_INCREMENT ,libelle varchar(100),effectif int, inscription varchar(100),
primary key (id));

##===================================================
##Création de la table groupe========================
##===================================================


create table GROUPE(id int NOT NULL AUTO_INCREMENT,id_classe int,nb_inscrits int,id_type_groupe int,
primary key (id,id_classe),
foreign key (id_classe) references CLASSE(id),
foreign key (id_type_groupe) references TYPE_GROUPE(id));


##===================================================
##Création de la table UTILISATEUR===================
##===================================================


create table UTILISATEUR(id int NOT NULL AUTO_INCREMENT,login varchar(100),mdp varchar(100),type_utilisateur varchar(100),prenom varchar(100),nom varchar(100),sexe varchar(20),date_naissance date, id_classe varchar(6),id_point int,id_groupe int,nb_points_malus int,nb_points_bonus int,
primary key (id));





##====================================================
##Ajout d une clé primaire sur la table classe========
##====================================================


alter table CLASSE add column id_prof int;
alter table CLASSE add foreign key(id_prof) references UTILISATEUR(id);
alter table UTILISATEUR add foreign key(id_classe) references CLASSE(id);
alter table UTILISATEUR add foreign key (id_point) references POINT(id);
alter table UTILISATEUR add foreign key (id_groupe) references GROUPE(id);





