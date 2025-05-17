<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - CampusLost</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: all 0.3s;
        }
        .active-nav {
            background-color: #EFF6FF;
            color: #1D4ED8;
            border-left: 4px solid #1D4ED8;
        }
        .profile-section {
            transition: all 0.3s;
            max-height: 0;
            overflow: hidden;
        }
        .profile-section.open {
            max-height: 500px;
            padding: 1rem 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white shadow-sm hidden md:block">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="text-xl font-bold">CampusLost</span>
                </div>
            </div>
            <nav class="p-4">
                <div class="space-y-1">
                    <a href="#" class="block px-4 py-2 text-sm font-medium rounded-md active-nav">
                        Tableau de bord
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-md">
                        Objets perdus/trouvés
                    </a>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-md">
                        Gestion utilisateurs
                    </a>
                    @endif
                    <div>
                        <a href="#" id="settings-toggle" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-md flex justify-between items-center">
                            Paramètres
                            <svg class="h-4 w-4 transform transition-transform" id="settings-arrow" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div id="settings-menu" class="profile-section ml-4 pl-2 border-l-2 border-gray-200">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Profil
        </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-white shadow-sm">
                <div class="px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center md:hidden">
                        <button id="menu-toggle" class="text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative group">
                            <div class="flex items-center space-x-2 cursor-pointer">
                                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                <svg class="h-4 w-4 text-gray-500 group-hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        Profil
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Déconnexion
        </button>
    </form>
</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4">
                <div class="max-w-7xl mx-auto">
                    <!-- Welcome card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-100">
                        <div class="flex items-start justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">
                                    Bonjour !, {{ auth()->user()->name }}
                                </h1>
                                <p class="text-gray-600 mt-2">
                                    @if(auth()->user()->role === 'admin')
                                    Vous êtes connecté en tant qu'administrateur
                                    @else
                                    Vous êtes connecté en tant qu'étudiant
                                    @endif
                                </p>
                            </div>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Admin specific content -->
                    @if(auth()->user()->role === 'admin')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Users card -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-medium text-gray-800">Gestion des utilisateurs</h2>
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">Gérez les comptes utilisateurs et les permissions</p>
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                Accéder au panneau
                            </a>
                        </div>

                        <!-- Stats card -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-medium text-gray-800">Statistiques</h2>
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Utilisateurs</p>
                                    <p class="text-2xl font-bold">124</p>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Objets</p>
                                    <p class="text-2xl font-bold">56</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Recent activity -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                        <h2 class="text-lg font-medium text-gray-800 mb-4">Activité récente</h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Nouvel utilisateur inscrit</p>
                                    <p class="text-xs text-gray-500">Il y a 2 heures</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Objet retrouvé</p>
                                    <p class="text-xs text-gray-500">Il y a 1 jour</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle mobile menu
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

        // Toggle settings menu
        document.getElementById('settings-toggle').addEventListener('click', function(e) {
            e.preventDefault();
            const menu = document.getElementById('settings-menu');
            const arrow = document.getElementById('settings-arrow');
            
            menu.classList.toggle('open');
            arrow.classList.toggle('rotate-180');
        });
    </script>
</body>
</html>