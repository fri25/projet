<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <div class="grid grid-cols-6 min-h-screen">
    <!-- bar -->
    <aside class="col-span-1 bg-green-700 text-white p-6 flex flex-col justify-between">
      <div>
        <!-- Logo & App Name -->
        <div class="flex items-center space-x-2 mb-8">
          <img src="https://via.placeholder.com/40" alt="Logo" class="rounded-full w-10 h-10">
          <h1 class="text-2xl font-bold">MedConfort</h1>
        </div>

        <div class="border-t border-white/30 my-4"></div>


        <!-- User Info -->
        <div class="mb-6">
          <p class="font-semibold text-lg">👩 Elfrida YEMADJE</p>
        </div>

        <div class="border-t border-white/30 my-4"></div>


        <!-- Navigation -->
        <nav>
          <ul class="space-y-4">
            <li><a href="#" class="hover:text-yellow-300">🏠 Tableau de bord</a></li>
            <li><a href="#" class="hover:text-yellow-300">📅 Rendez-vous</a></li>
            <li><a href="#" class="hover:text-yellow-300">🧑‍⚕️ Carnet de santé</a></li>
            <li><a href="#" class="hover:text-yellow-300">📝 Pharmacie</a></li>
            <li><a href="#" class="hover:text-yellow-300">📝 Médecin</a></li>
            <li><a href="#" class="hover:text-yellow-300">📝 Ordonnace</a></li>
          </ul>
        </nav>
      </div>

      <!-- Déconnexion -->
      <div>
        <li><a href="#" class="hover:text-yellow-300">Profil</a></li>
        <a href="#" class="text-sm text-red-300 hover:text-white">🚪 Déconnexion</a>
      </div>
    </aside>

    <!-- Contenu principal -->
    <main class="col-span-5 bg-white p-8">
      <h2 class="text-3xl font-bold mb-6">Bienvenue sur votre tableau de bord</h2>
      <div class="grid grid-cols-2 gap-6">
        <div class="bg-blue-100 p-6 rounded-xl shadow">📈 Statistiques</div>
        <div class="bg-green-100 p-6 rounded-xl shadow">📋 Derniers rendez-vous</div>
        <div class="bg-yellow-100 p-6 rounded-xl shadow">🧾 Dossiers récents</div>
        <div class="bg-purple-100 p-6 rounded-xl shadow">💬 Messages</div>
      </div>
    </main>
  </div>

</body>
</html>
