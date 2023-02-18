#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        iduser  Int  Auto_increment  NOT NULL ,
        nom     Varchar (50) NOT NULL ,
        email   Varchar (50) NOT NULL ,
        mdp     Varchar (64) NOT NULL ,
        adresse Varchar (50) NOT NULL ,
        role    Varchar (50) NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------

CREATE TABLE Client(
        iduser   Int NOT NULL ,
        prenom   Varchar (50) NOT NULL ,
	,CONSTRAINT Client_PK PRIMARY KEY (iduser)
	,CONSTRAINT Client_User_FK FOREIGN KEY (iduser) REFERENCES User(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Entreprise
#------------------------------------------------------------

CREATE TABLE Entreprise(
        iduser   Int NOT NULL ,
        siret    Varchar (50) NOT NULL ,
	,CONSTRAINT Entreprise_PK PRIMARY KEY (iduser)
	,CONSTRAINT Entreprise_User_FK FOREIGN KEY (iduser) REFERENCES User(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Categorie
#------------------------------------------------------------

CREATE TABLE Categorie(
        idcategorie Int  Auto_increment  NOT NULL ,
        libelle     Varchar (50) NOT NULL
	,CONSTRAINT Categorie_PK PRIMARY KEY (idcategorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        idarticle      Int  Auto_increment  NOT NULL ,
        nom            Varchar (50) NOT NULL ,
        description    Text NOT NULL ,
        prix           Float NOT NULL ,
        image          Varchar (50) NOT NULL ,
        stock          Int NOT NULL ,
        quantite       Int NOT NULL ,
        dateCalendrier Datetime NOT NULL ,
        idcategorie    Int NOT NULL ,
        iduser         Int NOT NULL
	,CONSTRAINT Article_PK PRIMARY KEY (idarticle)

	,CONSTRAINT Article_Categorie_FK FOREIGN KEY (idcategorie) REFERENCES Categorie(idcategorie)
	,CONSTRAINT Article_Entreprise0_FK FOREIGN KEY (iduser) REFERENCES User(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commande
#------------------------------------------------------------

CREATE TABLE Commande(
        idcommande   Int  Auto_increment  NOT NULL ,
        DateCommande Datetime NOT NULL ,
        iduser       Int NOT NULL
	,CONSTRAINT Commande_PK PRIMARY KEY (idcommande)
	,CONSTRAINT Commande_Client_FK FOREIGN KEY (iduser) REFERENCES Client(iduser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Panier
#------------------------------------------------------------

CREATE TABLE Panier(
        idpanier   Int  Auto_increment  NOT NULL ,
        idcommande Int NOT NULL
	,CONSTRAINT Panier_PK PRIMARY KEY (idpanier)
	,CONSTRAINT Panier_Commande_FK FOREIGN KEY (idcommande) REFERENCES Commande(idcommande)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commander
#------------------------------------------------------------

CREATE TABLE Commander(
        iduser    Int NOT NULL ,
        idarticle Int NOT NULL ,
        idpanier  Int NOT NULL ,
        quantite  Int NOT NULL
	,CONSTRAINT Commander_PK PRIMARY KEY (iduser,idarticle,idpanier)
	,CONSTRAINT Commander_Client_FK FOREIGN KEY (iduser) REFERENCES User(iduser)
	,CONSTRAINT Commander_Article0_FK FOREIGN KEY (idarticle) REFERENCES Article(idarticle)
	,CONSTRAINT Commander_Panier1_FK FOREIGN KEY (idpanier) REFERENCES Panier(idpanier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: relation5
#------------------------------------------------------------

CREATE TABLE Commenter (
    idcommentaire INT Auto_increment NOT NULL,
    description TEXT NOT NULL,
    iduser INT NOT NULL,
    idarticle INT NOT NULL,
	,CONSTRAINT Commenter_PK PRIMARY KEY (idcommentaire)
	,CONSTRAINT Commenter_Client_FK FOREIGN KEY (iduser) REFERENCES User(iduser)
	,CONSTRAINT Commenter_Entreprise0_FK FOREIGN KEY (iduser_1_Entreprise,iduser_Entreprise) REFERENCES Entreprise(iduser_1,iduser)
	,CONSTRAINT Commenter_Article1_FK FOREIGN KEY (idarticle_relation5) REFERENCES Article(idarticle)
)ENGINE=InnoDB;