ALTER TABLE TYPE_GROUPE  AUTO_INCREMENT=0;
Insert into TYPE_GROUPE values (NULL,"coureur",5);
Insert into TYPE_GROUPE values (NULL,"marcheur",3);
Insert into TYPE_GROUPE values (NULL,"organisateur",2);


ALTER TABLE POINT AUTO_INCREMENT=0;
Insert into POINT  values (NULL, "virage 1", "proche", 3, 1);
Insert into POINT  values (NULL, "champ 1", "proche", 5, 1);
Insert into POINT  values (NULL, "carrefour 1", "proche", 4, 1);
Insert into POINT  values (NULL, "virage 3", "éloigner", 4, 1);
Insert into POINT  values (NULL, "carrefour 2", "proche", 5, 1);
Insert into POINT  values (NULL, "départ", "proche", 5, 1);
Insert into POINT  values (NULL, "arrivé", "éloigner", 5, 1);
Insert into POINT  values (NULL, "virage 2", "proche", 3, 1);
Insert into POINT  values (NULL, "champ 2"," proche", 2, 1);
Insert into POINT  values (NULL, "virage 4", "éloigner", 3, 1);


ALTER TABLE CLASSE AUTO_INCREMENT=0;
Insert into CLASSE values (NULL, "TSTMG", 18, 0, NULL);
Insert into CLASSE values (NULL, "TS1", 32, 0, NULL);
Insert into CLASSE values (NULL, "2NDE4", 30, 0, NULL);
Insert into CLASSE values (NULL, "TES2", 28, 0, NULL);
Insert into CLASSE values (NULL, "TST2S", 20, 0, NULL);
Insert into CLASSE values (NULL, "1L", 30, 0, NULL);
Insert into CLASSE values (NULL, "2NDE6", 33, 0, NULL);
Insert into CLASSE values (NULL, "1ES1", 27, 0, NULL);
Insert into CLASSE values (NULL, "1S2", 38, 0, NULL);
Insert into CLASSE values (NULL, "BTS2", 16, 0, NULL);


ALTER TABLE GROUPE AUTO_INCREMENT=0;
Insert into GROUPE values (NULL,4 ,1,1);
Insert into GROUPE values (NULL,1,1,2);
Insert into GROUPE values (NULL,4,2,3);
Insert into GROUPE values (NULL,4,3,2);
Insert into GROUPE values (NULL,3,2,3);
Insert into GROUPE values (NULL,4,2,1);
Insert into GROUPE values (NULL,4,3,3);
Insert into GROUPE values (NULL,2,1,2);
Insert into GROUPE values (NULL,4,1,1);
Insert into GROUPE values (NULL,4,3,1);


ALTER TABLE UTILISATEUR AUTO_INCREMENT=0;
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Abil","Osman",'h','1998-1-5',1,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Achiary","Tristan",'h','1998-2-25',3,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Ahdjila","Caroline",'f','1999-8-14',4,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Akabo","Armance",'f','1998-8-25',5,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Ako","Doriane",'f','1997-12-8',6,NULL,NULL,NULL,NULL);	
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Allain","Lucas",'h','1996-8-6',10,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Allouche","Victoria",'f','1997-10-7',2,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Alouache","Margot",'f','1998-8-16',5,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,NULL,NULL,0,"Alvergne","Adrian",'h','1998-1-5',8,NULL,NULL,NULL,NULL);
INSERT INTO UTILISATEUR VALUES (NULL,"AMMARF","nsiop53zz",1,"Ammar","Fethi",'h','1970-1-6',10,NULL,NULL,NULL,NULL);

UPDATE CLASSE SET prof_id = '10';