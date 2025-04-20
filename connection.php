<?php
session_start();
require 'config.php';

$error = ""; // Pour capturer les messages d'erreur

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Tables à vérifier
    $tables = ['patient', 'medecin', 'admin'];

    foreach ($tables as $table) {
        $requete = $pdo->prepare("SELECT * FROM `$table` WHERE email = :email");
        $requete->execute(['email' => $email]);

        if ($requete->rowCount() > 0) {
            $user = $requete->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['uid'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $table;

                // Redirection personnalisée
                switch ($table) {
                    case 'admin':
                        header("Location: admin/dashboard.php");
                        break;
                    case 'medecin':
                        header("Location: medecin/dashboard.php");
                        break;
                    case 'patient':
                        header("Location: patient/dashboard.php");
                        break;
                }
                exit();
            } else {
                $error = "Mot de passe incorrect.";
                break;
            }
        }
    }

    if (empty($error)) {
        $error = "Email introuvable dans toutes les catégories.";
    }

    echo $error;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <h1 class="text-3xl font-bold underline  text-center">CONNEXION</h1>

    <form action="" method="post" class="max-w-md mx-auto mt-8 bg-white p-6 rounded shadow">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">email</label>
            <input type="text" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">PASSWORD</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>


        <div class="md:w-2/3 text-center"> 
            <input type="submit" value="connexion" class="shadow bg-purple-700 hover:bg-purple-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
        </div>
        
        <div class="flex items-center justify-center space-x-7">
            <p>Pas encore de compte ? </p>
            <div class="justify">
            <a href="inscriptionPatient.php"  class="inline-flex justify-center py-2 px-4 text-base font-medium text-white rounded-lg bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-900">INSCRIVEZ-VOUS</a>
            </div>
            
        </div>
       
    </form>
</body>
</html>