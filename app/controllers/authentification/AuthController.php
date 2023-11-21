<?php
require_once 'app/models/auth/AuthModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new AuthModel();
    }

    public function login($email, $password) {
        $user = $this->model->authenticate($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: /home");
        } else {
            // Afficher un message d'erreur
        }
    }
public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clientData = [
            'nom' => $_POST['nom'],
            'email' => $_POST['email'],
            'telephone' => $_POST['telephone'],
            'adresse' => $_POST['adresse'],
            'password' => $_POST['password'],
            'prenom' => $_POST['prenom'],
            'date_naissance' => $_POST['date_naissance'],
            'raison_sociale' => $_POST['raison_sociale'],
            'SIRET' => $_POST['SIRET']
        ];

        // Assurez-vous de hacher le mot de passe avant de l'insérer dans la base de données
        $clientData['password'] = password_hash($clientData['password'], PASSWORD_DEFAULT);

        // Déterminer le type de client
        $type = $_POST['type'];

        $this->model->register($clientData, $type);

        // Rediriger l'utilisateur vers la page de connexion après l'inscription
        header("Location: /login");
    }
}

}