-- Active: 1663831858627@@127.0.0.1@8889@CVVEN
CREATE Table Hebergement(
    Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Logement VARCHAR(50) NOT NULL, /*type de logement*/
    Chambres INT NOT NULL,
    Chambres_Doubles INT NOT NULL,
    Logement_PMR INT NOT NULL,
    Menage INT NOT NULL,
        Constraint CHK_Menage check(Menage = 0 or Menage = 1)
);

CREATE TABLE Client(
    Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Phone VARCHAR(255) NOT NULL UNIQUE,
    Passwords VARCHAR(255) NOT NULL,
    Adresse VARCHAR(255) DEFAULT NULL,
    Hote int NOT NULL,
        Constraint CHK_Hote check(Hote = 0 or Hote = 1),

    DateCreation DATETIME NOT NULL,
    DateModification DATETIME NOT NULL
);

CREATE Table Reservation(
    Client_Id int,
        Constraint FK_ReservationClient FOREIGN KEY(Client_Id) REFERENCES Client(Id),
    Hebergement_Id int,
        Constraint FK_ReservationHebergement FOREIGN KEY(Hebergement_Id) REFERENCES Hebergement(Id),
    DateDebut DATETIME NOT NULL,
    DateFin DATETIME NOT NULL,
    PRIMARY KEY(Client_Id, Hebergement_Id)
);


INSERT INTO Client (Nom, Prenom, Email, Phone, Passwords, Adresse, Hote, DateCreation, DateModification) VALUES ('Bernard', "Jérémie", "bernard.jeremie@gmail.com", "06.12.34.56.78", "password", "7 rue de Toto", 1, "2022-11-12", "2022-11-16");

ALTER TABLE Client 
ADD etat int not null;
