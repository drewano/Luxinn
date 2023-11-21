<?php
require_once 'config/database.php';
/**
 * Class AuthModel
 * Cette classe étend la classe Database et fournit des méthodes pour l'authentification et l'inscription des utilisateurs.
 */
class AuthModel extends Database {
       /**
     * Authentifier un utilisateur avec l'email et le mot de passe donnés.
     *
     * @param string $email L'email de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     * @return array|bool Les données de l'utilisateur si l'email et le mot de passe correspondent à un utilisateur existant, false sinon.
     */
    public function authenticate($email, $password) {
        $sql = "SELECT * FROM Client WHERE Email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Mot_de_passe'])) {
            return $user;
        }

        return false;
    }
    /**
     * Inscrire un nouvel utilisateur avec les données et le type donnés.
     *
     * @param array $clientData Les données de l'utilisateur à inscrire.
     * @param string $type Le type de l'utilisateur à inscrire ('prive' ou 'professionnel').
     */
    public function register($clientData, $type) {
    // Insérer dans la table Client
    $sql = "INSERT INTO Client (Nom, Email, Telephone, Adresse, Mot_de_passe) VALUES (:nom, :email, :telephone, :adresse, :password)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($clientData);

    // Récupérer l'ID du client inséré
    $idClient = $this->conn->lastInsertId();

    // Insérer dans la table Prive ou Professionnel en fonction du type
    if ($type == 'prive') {
        $sql = "INSERT INTO Prive (ID_Client, Prenom, Date_Naissance) VALUES (:idClient, :prenom, :date_naissance)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idClient' => $idClient, 'prenom' => $clientData['prenom'], 'date_naissance' => $clientData['date_naissance']]);
    } else if ($type == 'professionnel') {
        $sql = "INSERT INTO Professionnel (ID_Client, raison_sociale, SIRET) VALUES (:idClient, :raison_sociale, :SIRET)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idClient' => $idClient, 'raison_sociale' => $clientData['raison_sociale'], 'SIRET' => $clientData['SIRET']]);
    }
}


}
