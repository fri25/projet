<?php
require 'config.php';

$error = ""; // Variable pour afficher les erreurs

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et nettoyage des données
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $datenais = trim($_POST['datenais']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Vérification que tous les champs sont remplis
    if (empty($nom) || empty($prenom) || empty($datenais) || empty($email) || empty($contact) || empty($password) || empty($confirm_password)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $checkUser = $pdo->prepare("SELECT * FROM medecin WHERE email = ?");
        $checkUser->execute([$email]);

        if ($checkUser->rowCount() > 0) {
            $error = "Cet e-mail est déjà utilisé.";
        } else {
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertion dans la base de données
            $requete = $pdo->prepare("INSERT INTO medecin (nom, prenom, datenais, email, contact, password) VALUES (?, ?, ?, ?, ?, ?)");
            if ($requete->execute([$nom, $prenom, $datenais, $email, $contact, $hashedPassword])) {
                header("Location: connection.php");
                exit;
            } else {
                $error = "Une erreur s'est produite lors de l'inscription.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-3xl font-bold underline text-center">Inscription</h1>


    <form action="" method="POST" class="max-w-md mx-auto mt-8 bg-white p-6 rounded shadow">
        <?php if (!empty($error)): ?>
            <div class="mb-4 p-2 bg-red-100 text-red-700 border border-red-400 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <button class="shadow bg-purple-500 hover:bg-purple-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-2 rounded"> <a href="#">Patient</a> </button>

        <button class="shadow bg-purple-500 hover:bg-purple-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-2 rounded"> <a href="inscriptionMedecin.php">Medecin</a> </button>

        <button class="shadow bg-purple-500 hover:bg-purple-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-2 rounded"> <a href="inscriptionAdmin.php">Administrateur</a> </button> 

        <div class="mb-4"> <br>
            <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
            <input type="text" name="nom" id="nom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">prenom</label>
            <input type="text" name="prenom" id="prenom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="datenais" class="block text-gray-700 text-sm font-bold mb-2">datenais</label>
            <input type="date" name="datenais" id="datenais" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">email</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">contact</label>
            <input type="contact" name="contact" id="contact" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
            <input type="password" name="confirm_password" id="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

       

        <div class="text-center">
            <input type="submit" value="S'inscrire" class="shadow bg-purple-700 hover:bg-purple-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
        </div> <br>

        <div class="flex items-center justify-center space-x-2">
            <p>Avez-vous un compte ?</p>
            <a href="connection.php" class="inline-flex justify-center py-2 px-4 text-base font-medium text-white rounded-lg bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-900">
                  CONNECTEZ-VOUS
            </a>
</div>

    </form>
</body>
</html>
