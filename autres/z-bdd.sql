-- Création de la base de données
CREATE DATABASE IF NOT EXISTS freezhost;

-- Table Compte pour les utilisateurs
CREATE TABLE IF NOT EXISTS Compte (
    idCompte INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Email VARCHAR(100) UNIQUE,
    MotDePasse VARCHAR(255),
    DateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,
    isAdmin BOOLEAN DEFAULT FALSE
);

-- Table Commentaire pour les commentaires des utilisateurs
CREATE TABLE IF NOT EXISTS Commentaire (
    idCommentaire INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT,
    Contenu TEXT,
    DateCommentaire DATETIME DEFAULT CURRENT_TIMESTAMP,
    Note INT,
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte)
);

-- Table Paiement pour les transactions financières
CREATE TABLE IF NOT EXISTS Paiement (
    idPaiement INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT,
    Montant DECIMAL(10, 2),
    DatePaiement DATETIME DEFAULT CURRENT_TIMESTAMP,
    MethodePaiement VARCHAR(50),
    StatutPaiement VARCHAR(50),
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte)
);

-- Table Commande pour les commandes d'emplacements de stockage
CREATE TABLE IF NOT EXISTS Commande (
    idCommande INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT,
    ProduitCommande VARCHAR(100),
    Quantite INT,
    PrixUnitaire DECIMAL(10, 2),
    DateCommande DATETIME DEFAULT CURRENT_TIMESTAMP,
    StatutCommande VARCHAR(50),
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte)
);

-- Table Produit pour les plans d'hébergement
CREATE TABLE IF NOT EXISTS Produit (
    idProduit INT AUTO_INCREMENT PRIMARY KEY,
    NomProduit VARCHAR(100),
    TypeProduit VARCHAR(50),
    PrixMensuel DECIMAL(10, 2),
    EspaceStockage INT,
    BandePassante INT,
    StatutProduit VARCHAR(50)
);

-- Table EmplacementStockage pour les emplacements disponibles
CREATE TABLE IF NOT EXISTS EmplacementStockage (
    idEmplacement INT AUTO_INCREMENT PRIMARY KEY,
    NomEmplacement VARCHAR(100),
    Description TEXT,
    CapaciteStockage INT,
    PrixLocationMensuel DECIMAL(10, 2),
    StatutEmplacement VARCHAR(50)
);

-- Table Reservation pour les réservations d'emplacements de stockage
CREATE TABLE IF NOT EXISTS Reservation (
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT,
    idEmplacement INT,
    DateDebutReservation DATETIME,
    DateFinReservation DATETIME,
    StatutReservation VARCHAR(50),
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte),
    FOREIGN KEY (idEmplacement) REFERENCES EmplacementStockage(idEmplacement)
);
