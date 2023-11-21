<?php
require_once 'config/database.php';

class ClientModel extends Database {
    public function insertClient($clientData) {
        $sql = "INSERT INTO Clients (Nom, Prenom, Email, Telephone, Adresse, Mot_de_passe) VALUES (:Nom, :Prenom, :Email, :Telephone, :Adresse, :Mot_de_passe)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($clientData);
    }

    public function updateClient($id, $clientData) {
        $sql = "UPDATE Clients SET Nom = :Nom, Prenom = :Prenom, Email = :Email, Telephone = :Telephone, Adresse = :Adresse, Mot_de_passe = :Mot_de_passe WHERE ID_Client = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_merge(['id' => $id], $clientData));
    }

    public function deleteClient($id) {
        $sql = "DELETE FROM Clients WHERE ID_Client = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function getClient($id) {
        $sql = "SELECT * FROM Clients WHERE ID_Client = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAllClients() {
        $sql = "SELECT * FROM Clients";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}