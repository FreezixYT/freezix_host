CREATE DATABASE freezix_host;
USE freezix_host;

-- Table: Compte
CREATE TABLE Compte (
    idCompte INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    MotDePasse VARCHAR(255) NOT NULL,
    DateCreation DATETIME NOT NULL,
    isAdmin TINYINT(1) NOT NULL
);

-- Table: Produit
CREATE TABLE Produit (
    idProduit INT AUTO_INCREMENT PRIMARY KEY,
    NomProduit VARCHAR(100) NOT NULL,
    TypeProduit VARCHAR(50) NOT NULL,
    PrixMensuel DECIMAL(10,2) NOT NULL,
    EspaceStockage INT NOT NULL,
    BandePassante INT NOT NULL,
    StatutProduit VARCHAR(50) NOT NULL
);

-- Table: Panier
CREATE TABLE Panier (
    idPanier INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT NOT NULL,
    idProduit INT NOT NULL,
    Quantite INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte),
    FOREIGN KEY (idProduit) REFERENCES Produit(idProduit)
);

-- Table: Commande
CREATE TABLE Commande (
    idCommande INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT NOT NULL,
    ProduitCommande VARCHAR(100) NOT NULL,
    Quantite INT NOT NULL,
    PrixUnitaire DECIMAL(10,2) NOT NULL,
    DateCommande DATETIME NOT NULL,
    StatutCommande VARCHAR(50) NOT NULL,
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte)
);

-- Table: Commentaire
CREATE TABLE Commentaire (
    idCommentaire INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT NOT NULL,
    Contenu TEXT NOT NULL,
    DateCommentaire DATETIME NOT NULL,
    Note INT NOT NULL,
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte)
);

-- Table: Paiement
CREATE TABLE Paiement (
    idPaiement INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT NOT NULL,
    Montant DECIMAL(10,2) NOT NULL,
    DatePaiement DATETIME NOT NULL,
    MethodePaiement VARCHAR(50) NOT NULL,
    StatutPaiement VARCHAR(50) NOT NULL,
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte)
);

-- Table: Reservation
CREATE TABLE Reservation (
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT NOT NULL,
    idEmplacement INT NOT NULL,
    DateDebutReservation DATETIME NOT NULL,
    DateFinReservation DATETIME NOT NULL,
    StatutReservation VARCHAR(50) NOT NULL,
    FOREIGN KEY (idUtilisateur) REFERENCES Compte(idCompte),
    FOREIGN KEY (idEmplacement) REFERENCES EmplacementStockage(idEmplacement)
);

-- Table: EmplacementStockage
CREATE TABLE EmplacementStockage (
    idEmplacement INT AUTO_INCREMENT PRIMARY KEY,
    NomEmplacement VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    CapaciteStockage INT NOT NULL,
    PrixLocationMensuel DECIMAL(10,2) NOT NULL,
    StatutEmplacement VARCHAR(50) NOT NULL
);

-- Table: Ticket
CREATE TABLE Ticket (
    idTicket INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATETIME NOT NULL,
    conteneu TEXT NOT NULL,
    resolue TINYINT(1) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Compte(idCompte)
);


