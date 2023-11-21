<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="app/controllers/auth/AuthController" method="post">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="telephone">Téléphone:</label><br>
        <input type="text" id="telephone" name="telephone" required><br>
        <label for="adresse">Adresse:</label><br>
        <input type="text" id="adresse" name="adresse" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>