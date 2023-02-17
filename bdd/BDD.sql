#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------


drop database if exists gestion_EcoSport;
create database gestion_EcoSport;
use gestion_EcoSport;


CREATE TABLE user(
        iduser      Int  Auto_increment  NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        email       Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL ,
        role enum('Client', 'Admin') NOT NULL ,
	CONSTRAINT user_PK PRIMARY KEY (iduser)
)ENGINE=InnoDB;



#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------
#Table fille de la table User
CREATE TABLE Client(
        iduser      Int NOT NULL ,
        siret       Varchar (50) NOT NULL ,
        adresse     Varchar (50) NOT NULL ,
        telephone   Varchar (50) NOT NULL ,

	CONSTRAINT Client_PK PRIMARY KEY (iduser),

	CONSTRAINT Client_user_FK FOREIGN KEY (iduser) REFERENCES user(iduser)
)ENGINE=InnoDB;



#------------------------------------------------------------
# Table: Admin
#------------------------------------------------------------
#Autre table fille de la table User
CREATE TABLE Admin(
        iduser          Int NOT NULL ,
        qualification   Varchar (30) NOT NULL ,
        anneeexperience Date NOT NULL ,

	CONSTRAINT Admin_PK PRIMARY KEY (iduser),

	CONSTRAINT Admin_user_FK FOREIGN KEY (iduser) REFERENCES user(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commande
#------------------------------------------------------------

CREATE TABLE Commande(
        IdCommande   Int  Auto_increment  NOT NULL ,
        DateCommande Datetime NOT NULL ,
        iduser       Int NOT NULL
	,CONSTRAINT Commande_PK PRIMARY KEY (IdCommande)

	,CONSTRAINT Commande_Client_FK FOREIGN KEY (iduser) REFERENCES Client(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Categorie
#------------------------------------------------------------

CREATE TABLE Categorie(
        idcategorie Int  Auto_increment  NOT NULL ,
        libelle     Varchar (50) NOT NULL,
        NomImage     Varchar (50)
	,CONSTRAINT Categorie_PK PRIMARY KEY (idcategorie)
)ENGINE=InnoDB;

insert into Categorie (libelle) values ('chaussure'), ('vetement');

#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
       idArticle   Int  Auto_increment  NOT NULL ,
        Nom         Varchar (50) ,
        NomImage varchar(50),
        Description text,
        prix        Varchar (100),
        idcategorie Int NOT NULL
	,CONSTRAINT Article_PK PRIMARY KEY (idArticle)

	,CONSTRAINT Article_Categorie_FK FOREIGN KEY (idcategorie) REFERENCES Categorie(idcategorie)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Insertion : article
#------------------------------------------------------------
insert into Article (Nom, NomImage, Description, prix, idcategorie) values ('Airforce', 'airforce.png','Paire de chaussure tendance', '120 €', 1);
insert into Article (Nom, NomImage, Description, prix, idcategorie) values ('Nike tn', 'tn.png','Paire de chaussure tendance', '180 €', 1);
insert into Article (Nom, NomImage, Description, prix, idcategorie) values ('Tee-shirt', 'Tee-shirt.png','Tee-shirt d été', '35 €', 2);




#------------------------------------------------------------
# Table: TypeOperations
#------------------------------------------------------------

//CREATE TABLE TypeOperations(
        idtype  Int  Auto_increment  NOT NULL ,
        libelle Varchar (50) NOT NULL
	,CONSTRAINT TypeOperations_PK PRIMARY KEY (idtype)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Operation
#------------------------------------------------------------

//CREATE TABLE Operation(
        idoperation    Int  Auto_increment  NOT NULL ,
        dateoperation  Date NOT NULL ,
        descriptionop  Varchar (200) NOT NULL ,
        motif          Varchar (30) NOT NULL ,
        couleur        Varchar (20) NOT NULL ,
        iduser         Int NOT NULL ,
        idArticle      Int NOT NULL ,
        idtype         Int NOT NULL
	,CONSTRAINT Operation_PK PRIMARY KEY (idoperation)

	,CONSTRAINT Operation_Admin_FK FOREIGN KEY (iduser) REFERENCES Admin(iduser)
	,CONSTRAINT Operation_Article0_FK FOREIGN KEY (idArticle) REFERENCES Article(idArticle)
	,CONSTRAINT Operation_TypeOperations1_FK FOREIGN KEY (idtype) REFERENCES TypeOperations(idtype)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Panier
#------------------------------------------------------------

CREATE TABLE Panier(
        IdPanier   Int  Auto_increment  NOT NULL ,
        iduser     Int NOT NULL
	,CONSTRAINT Panier_PK PRIMARY KEY (IdPanier)

    ,CONSTRAINT Panier_user_FK FOREIGN KEY (iduser) REFERENCES user(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
-- # Procedure d'insertion client et création de son panier
#------------------------------------------------------------

drop procedure  if exists insertClient;
delimiter $
create procedure insertClient(IN p_nom varchar(50), IN p_prenom varchar(50), IN p_email varchar(50), IN p_mdp varchar(50), IN p_role varchar(50), IN p_siret varchar(50), IN p_adresse varchar(50), IN p_telephone varchar(50) )
Begin
    declare p_iduser int(3);
    insert into user values (null, p_nom, p_prenom, p_email, p_mdp, p_role);
    select iduser into p_iduser from user where nom=p_nom and prenom= p_prenom and email=p_email and mdp=p_mdp and role=p_role;
    insert into client values (p_iduser, p_siret, p_adresse, p_telephone);
    insert into panier values (null, p_iduser);
End $
delimiter ; 

#------------------------------------------------------------
# Table: commenter
#------------------------------------------------------------

//CREATE TABLE commenter(
        idArticle Int NOT NULL ,
        iduser    Int NOT NULL ,
        contenu   Text NOT NULL ,
        note      Int NOT NULL
	,CONSTRAINT commenter_PK PRIMARY KEY (idArticle,iduser)

	,CONSTRAINT commenter_Article_FK FOREIGN KEY (idArticle) REFERENCES Article(idArticle)
	,CONSTRAINT commenter_Client0_FK FOREIGN KEY (iduser) REFERENCES Client(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commander
#------------------------------------------------------------


#Un user ajoute un article à son panier
CREATE TABLE ArticlePanier(
        IdPanier   Int NOT NULL ,
        idArticle  Int NOT NULL,
        quantite int(3),
        CONSTRAINT Commander_PK PRIMARY KEY (IdPanier,idArticle),
        CONSTRAINT Commander_Panier_FK FOREIGN KEY (IdPanier) REFERENCES Panier(IdPanier),
        CONSTRAINT Commander_Article0_FK FOREIGN KEY (idArticle) REFERENCES Article(idArticle)
)ENGINE=InnoDB;

-- Une commande possède plusieurs articles, et les articles se retrouvent dans plusieurs commandes
CREATE TABLE commandearticle(
        idarticle  Int NOT NULL,
        idcommande Int NOT NULL,
        quantite int(3)
    ,CONSTRAINT commandearticle_PK PRIMARY KEY (idarticle,idcommande)
    ,CONSTRAINT commandearticle_Article_FK FOREIGN KEY (idarticle) REFERENCES Article(idarticle)
    ,CONSTRAINT commandearticle_Commande0_FK FOREIGN KEY (idcommande) REFERENCES Commande(idcommande)
)ENGINE=InnoDB;


-- Une vue repertoriant les infos de User, et ce qu'il a comme articles dans son panier. 
drop view if exists UserPanierArticle;
create view UserPanierArticle as(
    select u.iduser, p.idpanier, ap.idarticle, a.Nom, a.nomImage, a.description, a.prix, ap.quantite from user u, panier p, articlepanier ap, article a where p.iduser=u.iduser and p.idpanier=ap.idpanier and ap.idarticle=a.idarticle
);

drop view if exists vueCommandes;
create view vueCommandes as(
    select c.*, ca.idarticle, ca.quantite from commande c, commandearticle ca where c.idcommande=ca.idcommande
);


CREATE TABLE contenucommande(
        idcommande    Int NOT NULL,
        idarticle     Int NOT NULL,
        quantite      Int NOT NULL,
        prixunitaire  Decimal (10,2) NOT NULL,
        CONSTRAINT contenucommande_PK PRIMARY KEY (idcommande, idarticle),
        CONSTRAINT contenucommande_Commande_FK FOREIGN KEY (idcommande) REFERENCES Commande(IdCommande),
        CONSTRAINT contenucommande_Article_FK FOREIGN KEY (idarticle) REFERENCES Article(idArticle)
) ENGINE=InnoDB;

CREATE VIEW vue_contenucommande AS
SELECT c.idcommande, c.idarticle, a.Nom, c.quantite, c.prixunitaire
FROM contenucommande c
INNER JOIN Article a ON c.idarticle = a.idArticle;


INSERT into user values(Null, "a", "a", "a@gmail.com", "123", "Admin");
INSERT into user values(Null, "b", "b", "b@gmail.com", "123", "Client");