#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

drop database if exists gestion_EcoSport;
create database gestion_EcoSport;
use gestion_EcoSport;

#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        iduser  Int (5) Auto_increment  NOT NULL ,
        nom     Varchar (50) NOT NULL ,
        email   Varchar (50) NOT NULL ,
        mdp     Varchar (64) NOT NULL ,
        adresse Varchar (50) NOT NULL ,
        role    enum ("Client", "Entreprise", "Admin") NOT NULL ,
        PRIMARY KEY (iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------

CREATE TABLE Client(
        iduser   Int(5) NOT NULL ,
        tel Varchar(50) NOT NULL,
        prenom   Varchar (50) NOT NULL
	,PRIMARY KEY (iduser)
	,FOREIGN KEY (iduser) REFERENCES User(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Entreprise
#------------------------------------------------------------

CREATE TABLE Entreprise(
        iduser   Int(5) NOT NULL ,
        siret    Varchar (50) NOT NULL
	,PRIMARY KEY (iduser)
	,FOREIGN KEY (iduser) REFERENCES User(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Categorie
#------------------------------------------------------------

CREATE TABLE Categorie(
        idcategorie Int(3)  Auto_increment  NOT NULL ,
        image Varchar(50) NOT NULL,
        libelle     Varchar (50) NOT NULL,
	PRIMARY KEY (idcategorie)
)ENGINE=InnoDB;

insert into Categorie (image, libelle) values ("logochauss.png", 'chaussure'), ("logovet.png", 'vetement');
INSERT INTO `categorie` (`idcategorie`, `image`, `libelle`) VALUES (NULL, 'accessoire.png', 'Accessoire');
#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        idarticle      Int(5)  Auto_increment  NOT NULL ,
        nom            Varchar (50) NOT NULL ,
        description    Text NOT NULL ,
        prix           Float NOT NULL ,
        image          Varchar (50) NOT NULL ,
        stock          Int NOT NULL ,
        idcategorie    Int(5) NOT NULL 
	,PRIMARY KEY (idarticle)
	,FOREIGN KEY (idcategorie) REFERENCES Categorie(idcategorie)
)ENGINE=InnoDB;

insert into Article (nom, description, prix, image, stock, idcategorie) values ('Airforce', 'Paire de chaussure tendance', 120, 'airforce.png', 30, 1 );
insert into Article (nom, description, prix, image, stock, idcategorie) values ('Nike tn', 'Paire de chaussure tendance','180 €', 'tn.png', 30, 1);
insert into Article (nom, description, prix, image, stock, idcategorie) values ('Tee-shirt', 'Tee-shirt d été','35 €', 'Tee-shirt.png', 30,2);
insert into Article (nom, description, prix, image, stock, idcategorie) values ('Survetement ', 'survetement nike tendance', 80, 'survet.png', 30, 2 );
insert into Article (nom, description, prix, image, stock, idcategorie) values ('Tee-shirt', 'Tee-shirt Nike', 15, 'Tee-shirt2.png', 30, 2 );
insert into Article (nom, description, prix, image, stock, idcategorie) values ('Jogging', 'Pantalon de survêtement Jogging Adidas Hoodie, jogging, fermeture à glissière', 25, 'pontalon.png', 30, 2 );
insert into Article (nom, description, prix, image, stock, idcategorie) values ('Jogging', 'Pantalon de jogging Nike Femme Vêtements nike blanc,', 25, 'pontalon2.png', 30, 2 );

#------------------------------------------------------------
# Table: Commande
#------------------------------------------------------------

CREATE TABLE Commande(
        idcommande   Int(5)  Auto_increment  NOT NULL ,
        DateCommande Datetime NOT NULL ,
        iduser       Int(5) NOT NULL
	,PRIMARY KEY (idcommande)
	,FOREIGN KEY (iduser) REFERENCES Client(iduser)
)ENGINE=InnoDB;




#------------------------------------------------------------
# Table: Commenter
#------------------------------------------------------------

CREATE TABLE Commenter (
    idcommentaire INT(5) Auto_increment NOT NULL,
    description TEXT NOT NULL,
    iduser INT(5) NOT NULL,
    idarticle INT(5) NOT NULL
        ,PRIMARY KEY (idcommentaire)
        ,FOREIGN KEY (iduser) REFERENCES User(iduser)
        ,FOREIGN KEY (idarticle) REFERENCES Article(idarticle)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Panier
#------------------------------------------------------------

CREATE TABLE Panier(
        IdCommande   Int NOT NULL ,
        idArticle  Int NOT NULL,
        quantite int(3),
        CONSTRAINT Panier_PK PRIMARY KEY (IdCommande,idArticle),
        CONSTRAINT Panier_Commande_FK FOREIGN KEY (idcommande) REFERENCES Commande(idcommande),
        CONSTRAINT Panier_Article_FK FOREIGN KEY (idArticle) REFERENCES Article(idArticle)
)ENGINE=InnoDB;

-- procedure pour insertion d'un clietn 

DROP PROCEDURE IF EXISTS insertClient;
delimiter $
create procedure insertClient (IN c_nom varchar(50), IN c_email varchar(50), IN c_mdp varchar(50), 
IN c_adresse varchar(50), IN c_role varchar(50), IN c_tel varchar(50), IN c_prenom varchar(50)) 
Begin 
        Declare c_iduser int(5); 
        
        insert into user values (null, c_nom, c_email, c_mdp, c_adresse, c_role ); 
        select iduser into c_iduser 
        from user 
        where nom = c_nom and email =c_email and mdp=c_mdp and adresse = c_adresse; 
        insert into Client values (c_iduser, c_tel, c_prenom);
End $
delimiter  ;


-- procedure pour insertion d'une entreprise 

DROP PROCEDURE IF EXISTS insertEntreprise;
delimiter $
create procedure insertEntreprise (IN c_nom varchar(50), IN c_email varchar(50), IN c_mdp varchar(50), 
IN c_adresse varchar(50), IN c_role varchar(50), IN c_siret varchar(50)) 
Begin 
        Declare c_iduser int(5); 
        
        insert into user values (null, c_nom, c_email, c_mdp, c_adresse, c_role); 
        select iduser into c_iduser 
        from user 
        where nom = c_nom and email =c_email and mdp=c_mdp and adresse = c_adresse; 
        insert into Entreprise values (c_iduser, c_siret);
End $
delimiter  ;

-- on appelle la procedure insertion client
call insertClient("a", "a", "a", "a", "Client", "a", "a");

-- on appelle la procedure insertion entreprise
call insertEntreprise("e", "e", "e", "e", "Entreprise", "e");


-- vue client
drop view if exists vueClients;
create view vueClients as (
	select u.iduser, u.nom, u.email, u.adresse, c.tel, c.prenom
	from User u, Client c
	where u.iduser = c.iduser
);

-- vue entreprise
drop view if exists vueEntreprise;
create view vueEntreprise as (
	select u.iduser, u.nom, u.email, u.adresse, e.siret
	from User u, Entreprise e
	where u.iduser = e.iduser
);

-- Une vue repertoriant les infos de User, et ce qu'il a comme articles dans son panier. 
drop view if exists UserPanierArticle;
create view UserPanierArticle as(
    select u.iduser, p.idcommande, a.idarticle, a.Nom, a.image, a.description, a.prix, p.quantite, c.DateCommande
    from user u, panier p, article a, commande c
    where c.iduser=u.iduser 
    and p.idcommande=c.idcommande 
    and p.idarticle=a.idarticle
);

