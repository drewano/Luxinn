Drop database if exists LuxinDB;
CREATE DATABASE IF NOT EXISTS LuxinDB;
USE LuxinDB;

-- Création de la table Clients

CREATE TABLE Client (
    ID_Client INT AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Telephone VARCHAR(15),
    Adresse TEXT,
    Mot_de_passe VARCHAR(255) NOT NULL,
    primary key (ID_Client)
);

CREATE TABLE prive (
    ID_Client INT NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Date_Naissance DATE NOT NULL,
    primary key (ID_Client),
    foreign key (ID_Client) references Client(ID_Client)
);

CREATE TABLE professionnel (
    ID_Client INT NOT NULL,
    raison_sociale VARCHAR(50) NOT NULL,
    SIRET VARCHAR(14) NOT NULL,
    primary key (ID_Client),
    foreign key (ID_Client) references Client(ID_Client)
);
-- Création de la table Chambres
CREATE TABLE Chambres (
    ID_Chambre INT AUTO_INCREMENT PRIMARY KEY,
    Numero VARCHAR(10) NOT NULL UNIQUE,
    Type VARCHAR(50) NOT NULL,
    Prix DECIMAL(10,2) NOT NULL,
    Description TEXT,
    Statut VARCHAR(50) NOT NULL
);

-- Création de la table Chambres
CREATE TABLE photo (
    id_photo INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(10) NOT NULL UNIQUE,
    id_chambre INT NOT NULL,
    foreign key (id_chambre) references Chambres(ID_Chambre)
);

-- Création de la table Réservations
CREATE TABLE Reservations (
    ID_Reservation INT AUTO_INCREMENT PRIMARY KEY,
    ID_Client INT NOT NULL,
    ID_Chambre INT NOT NULL,
    Date_Arrivee DATE NOT NULL,
    Date_Depart DATE NOT NULL,
    Nb_Invites INT NOT NULL,
    Prix_Total DECIMAL(10,2) NOT NULL,
    Statut VARCHAR(50) NOT NULL,
    FOREIGN KEY (ID_Client) REFERENCES Client(ID_Client),
    FOREIGN KEY (ID_Chambre) REFERENCES Chambres(ID_Chambre)
);

-- Création de la table Services
CREATE TABLE Services (
    ID_Service INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL,
    Description TEXT,
    Heures_Ouverture VARCHAR(50)
);

-- Création de la table Réservations_Services
CREATE TABLE Reservations_Services (
    ID_Reservation INT NOT NULL,
    ID_Service INT NOT NULL,
    Date DATE NOT NULL,
    Heure TIME NOT NULL,
    PRIMARY KEY (ID_Reservation, ID_Service),
    FOREIGN KEY (ID_Reservation) REFERENCES Reservations(ID_Reservation),
    FOREIGN KEY (ID_Service) REFERENCES Services(ID_Service)
);

-- Création de la table Paiements
CREATE TABLE Paiements (
    ID_Paiement INT AUTO_INCREMENT PRIMARY KEY,
    ID_Reservation INT NOT NULL,
    Montant DECIMAL(10,2) NOT NULL,
    Date DATE NOT NULL,
    Methode VARCHAR(50) NOT NULL,
    FOREIGN KEY (ID_Reservation) REFERENCES Reservations(ID_Reservation)
);

