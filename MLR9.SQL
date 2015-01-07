DROP DATABASE IF EXISTS PopCornTheque;

CREATE DATABASE IF NOT EXISTS PopCornTheque;
USE PopCornTheque;
# -----------------------------------------------------------------------------
#       TABLE : SUPPORT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SUPPORT
 (
   SUP_ID INTEGER(10) NOT NULL AUTO_INCREMENT ,
   FILM_ID BIGINT(5) NOT NULL  ,
   UTI_ID VARCHAR(30) NOT NULL  ,
   SUP_NOM ENUM('Autre', 'Blu-Ray', 'Bobine', 'DVD', 'Support Virtuel', 'VHS') NOT NULL  ,
   SUP_LIBRE BOOL NOT NULL  
   , PRIMARY KEY (SUP_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ARTISTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARTISTE
 (
   ART_ID BIGINT(5) NOT NULL AUTO_INCREMENT ,
   ART_NOM CHAR(30) NOT NULL  ,
   ART_PRENOM CHAR(20) NOT NULL  
   , PRIMARY KEY (ART_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EMPRUNT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMPRUNT
 (
   EMPR_ID INTEGER(5) NOT NULL AUTO_INCREMENT ,
   UTI_ID VARCHAR(30) NOT NULL  ,
   SUP_ID INTEGER(10) NOT NULL  ,
   EMPR_DATE DATE NOT NULL  ,
   EMPR_RETOUR_THEORIQUE DATE NOT NULL  ,
   EMPR_RETOUR_REEL DATETIME NULL  ,
   EMPR_DUREE INTEGER(2) NULL  ,
   EMPR_RENDU BOOL NOT NULL  
   , PRIMARY KEY (EMPR_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMMENTAIRES_UT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMMENTAIRES_UT
 (
   COMU_ID INTEGER(5) NOT NULL AUTO_INCREMENT ,
   UTI_ID VARCHAR(30) NOT NULL  ,
   UTI_ID_COMMENTER_NOTER_UT VARCHAR(30) NOT NULL  ,
   COMU_CONTENU TEXT NULL  ,
   COMU_NOTE SMALLINT(2) NOT NULL  ,
   COMU_DATE DATETIME NOT NULL  
   , PRIMARY KEY (COMU_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMMENTAIRES_FILM
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMMENTAIRES_FILM
 (
   COMF_ID INTEGER(5) NOT NULL AUTO_INCREMENT ,
   FILM_ID BIGINT(5) NOT NULL  ,
   UTI_ID VARCHAR(30) NOT NULL  ,
   COMF_CONTENU TEXT NULL  ,
   COMF_NOTE SMALLINT(2) NOT NULL  ,
   COMF_DATE DATETIME NOT NULL  
   , PRIMARY KEY (COMF_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : FILM
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FILM
 (
   FILM_ID BIGINT(5) NOT NULL AUTO_INCREMENT ,
   FILM_TITRE VARCHAR(64) NOT NULL  ,
   FILM_SYNOPSIS TEXT NOT NULL  ,
   FIM_DATE_SORTIE DATE NOT NULL  ,
   FILM_AFFICHE VARCHAR(256) NULL  ,
   FILM_NOTE SMALLINT(2) NULL  ,
   FILM_AGE_MIN VARCHAR(10) NULL  ,
   FILM_IMDB_ID VARCHAR(12) NOT NULL  
   , PRIMARY KEY (FILM_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEURS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEURS
 (
   UTI_ID VARCHAR(30) NOT NULL  ,
   UTI_MOT_DE_PASSE VARCHAR(40) NOT NULL  ,
   UTI_NOM VARCHAR(30) NOT NULL  ,
   UTI_PRENOM VARCHAR(20) NOT NULL  ,
   UTI_DATE_NAISSANCE DATE NOT NULL  ,
   UTI_RUE VARCHAR(100) NOT NULL  ,
   UTI_CODE_POSTAL BIGINT(5) NOT NULL  ,
   UTI_VILLE VARCHAR(50) NOT NULL  ,
   UTI_MAIL VARCHAR(50) NOT NULL  
   , PRIMARY KEY (UTI_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : REALISER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS REALISER
 (
   ART_ID BIGINT(5) NOT NULL  ,
   FILM_ID BIGINT(5) NOT NULL  
   , PRIMARY KEY (ART_ID,FILM_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ETRE_AMI
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ETRE_AMI
 (
   UTI_ID_CIBLE VARCHAR(30) NOT NULL  ,
   UTI_ID_SOURCE VARCHAR(30) NOT NULL  
   , PRIMARY KEY (UTI_ID_CIBLE,UTI_ID_SOURCE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : DEMANDE_EMPRUNT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DEMANDE_EMPRUNT
 (
   UTI_ID VARCHAR(30) NOT NULL  ,
   SUP_ID INTEGER(10) NOT NULL  
   , PRIMARY KEY (UTI_ID,SUP_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : AVOIR_JOUE_DANS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AVOIR_JOUE_DANS
 (
   FILM_ID BIGINT(5) NOT NULL  ,
   ART_ID BIGINT(5) NOT NULL  
   , PRIMARY KEY (FILM_ID,ART_ID) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE SUPPORT 
  ADD FOREIGN KEY FK_SUPPORT_FILM (FILM_ID)
      REFERENCES FILM (FILM_ID) ;


ALTER TABLE SUPPORT 
  ADD FOREIGN KEY FK_SUPPORT_UTILISATEURS (UTI_ID)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE EMPRUNT 
  ADD FOREIGN KEY FK_EMPRUNT_UTILISATEURS (UTI_ID)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE EMPRUNT 
  ADD FOREIGN KEY FK_EMPRUNT_SUPPORT (SUP_ID)
      REFERENCES SUPPORT (SUP_ID) ;


ALTER TABLE COMMENTAIRES_UT 
  ADD FOREIGN KEY FK_COMMENTAIRES_UT_UTILISATEURS (UTI_ID)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE COMMENTAIRES_UT 
  ADD FOREIGN KEY FK_COMMENTAIRES_UT_UTILISATEURS1 (UTI_ID_COMMENTER_NOTER_UT)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE COMMENTAIRES_FILM 
  ADD FOREIGN KEY FK_COMMENTAIRES_FILM_FILM (FILM_ID)
      REFERENCES FILM (FILM_ID) ;


ALTER TABLE COMMENTAIRES_FILM 
  ADD FOREIGN KEY FK_COMMENTAIRES_FILM_UTILISATEURS (UTI_ID)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE REALISER 
  ADD FOREIGN KEY FK_REALISER_ARTISTE (ART_ID)
      REFERENCES ARTISTE (ART_ID) ;


ALTER TABLE REALISER 
  ADD FOREIGN KEY FK_REALISER_FILM (FILM_ID)
      REFERENCES FILM (FILM_ID) ;


ALTER TABLE ETRE_AMI 
  ADD FOREIGN KEY FK_ETRE_AMI_UTILISATEURS (UTI_ID_CIBLE)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE ETRE_AMI 
  ADD FOREIGN KEY FK_ETRE_AMI_UTILISATEURS1 (UTI_ID_SOURCE)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE DEMANDE_EMPRUNT 
  ADD FOREIGN KEY FK_DEMANDE_EMPRUNT_UTILISATEURS (UTI_ID)
      REFERENCES UTILISATEURS (UTI_ID) ;


ALTER TABLE DEMANDE_EMPRUNT 
  ADD FOREIGN KEY FK_DEMANDE_EMPRUNT_SUPPORT (SUP_ID)
      REFERENCES SUPPORT (SUP_ID) ;


ALTER TABLE AVOIR_JOUE_DANS 
  ADD FOREIGN KEY FK_AVOIR_JOUE_DANS_FILM (FILM_ID)
      REFERENCES FILM (FILM_ID) ;


ALTER TABLE AVOIR_JOUE_DANS 
  ADD FOREIGN KEY FK_AVOIR_JOUE_DANS_ARTISTE (ART_ID)
      REFERENCES ARTISTE (ART_ID) ;

