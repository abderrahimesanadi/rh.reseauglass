<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ma Plateforme RH - @yield('title', 'Accueil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
        $(document).ready(function() {
            $('#agent_ids').select2({
                placeholder: "Choisir des agents",
                allowClear: true
            });
        });
    </script>
    @yield('styles')
    @yield('scripts')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color:rgb(125, 161, 126);
            color: white;
            padding: 15px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-top {
            display: flex;
            gap: 20px;
        }
        
        .nav-top a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }
        
        .nav-top a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #333;
            color: white;
            position: fixed;
            left: 0;
            top: 70px;
            padding-top: 20px;
            z-index: 900;
        }
        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li {
            padding: 0;
            cursor: pointer;
        }
        .sidebar-menu li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
        }
        .sidebar-menu li:hover {
            background-color: #444;
        }
        .content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 20px;
        }
        
        /* Styles spécifiques pour le dropdown */
        .dropdown-menu {
            display: none;
            width: 100%;
            background-color: #444;
            padding: 0;
            margin: 0;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .dropdown-item {
            color: white;
            padding: 10px 25px;
            display: block;
        }
        
        .dropdown-item:hover {
            background-color: #555;
        }
        
        .dropdown-toggle::after {
            content: " ▼";
            float: right;
        }
        
        /* Styles pour la page de connexion */
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .login-form .form-group {
            margin-bottom: 20px;
        }
        
        .login-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .login-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .login-form button {
            background-color: rgb(125, 161, 126);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        
        .login-form button:hover {
            background-color: rgb(105, 141, 106);
        }
        
        .login-page .content {
            margin-left: 0;
        }
        .title-rg {
    font-family: 'Poppins', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: white;
    background-color:rgb(89, 135, 91);
    padding: 5px 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    display: inline-block;
    letter-spacing: 1px;
    transition: transform 0.3s;
}

.title-rg span {
    color: #f0f0f0;
}

.title-rg:hover {
    transform: scale(1.03);
}
.user-profile {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 250px;
    background-color: #2a2a2a;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-top: 1px solid #444;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background-color: #f1f1f1;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #333;
}

.user-name {
    color: white;
    font-size: 16px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.nav-link-styled {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: white !important;
    background-color: rgb(89, 135, 91);
    padding: 8px 15px !important;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    display: inline-block;
    letter-spacing: 0.5px;
    transition: transform 0.3s, background-color 0.3s;
    text-decoration: none;
    margin-left: 10px;
}

.nav-link-styled:hover {
    transform: scale(1.03);
    background-color: rgb(75, 120, 77);
}
/* Styles pour le sidebar réduit */
.sidebar.collapsed {
    width: 70px;
    overflow: hidden;
}

.sidebar.collapsed .dropdown-toggle::after {
    display: none;
}

.sidebar.collapsed .dropdown-item span {
    display: none;
}

.sidebar.collapsed .user-name,
.sidebar.collapsed .user-avatar span {
    display: none;
}

.sidebar.collapsed .user-avatar {
    width: 30px;
    height: 30px;
    margin: 0 auto;
}

.sidebar.collapsed .user-profile {
    justify-content: center;
    padding: 10px;
    width: 70px;
}

.sidebar.collapsed .dropdown-item {
    padding: 10px;
    text-align: center;
}

.sidebar.collapsed .dropdown-item i {
    font-size: 1.2rem;
    margin-right: 0;
}

.content.expanded {
    margin-left: 70px;
}
.sidebar.collapsed .dropdown-menu {
    display: none !important;
}
.sidebar.collapsed .sidebar-menu li a {
    text-align: center;
    padding: 15px 0;
}

.sidebar.collapsed .sidebar-menu li a i {
    display: block;
    font-size: 1.3rem;
}




    </style>
</head>
<body class="@guest login-page @endguest">
    <div class="header">
    <h1 class="title-rg">🎓 Formation<span>.RG</span></h1>
    <div class="nav-top">
    <a href="{{ route('home') }}" class="nav-link-styled">Accueil</a>
    <a href="{{ route('about') }}" class="nav-link-styled">
        <i class="fas fa-info-circle me-2"></i> À propos
    </a>
    @guest
        <a href="{{ route('login.show') }}" class="nav-link-styled">Connexion</a>
        <a href="{{ route('register.show') }}" class="nav-link-styled">Inscription</a>
    @else 
        <a href="{{ route('logout') }}" class="nav-link-styled"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Déconnexion
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endguest
</div>
    </div>
    
    @auth
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a class="dropdown-toggle" href="#" id="formationDropdown"><i class="fas fa-graduation-cap"></i>  Formation</a>
                <ul class="dropdown-menu show" id="formationMenu">
    <li><a class="dropdown-item" href="{{ route('agents.index') }}"><i class="fas fa-user"></i>   Agents</a></li>
    <li><a class="dropdown-item" href="{{ route('modules.index') }}"><i class="fas fa-book"></i>  Modules</a></li>
    <li><a class="dropdown-item" href="{{ route('session.index') }}"><i class="fas fa-calendar-alt"></i>   Session</a></li>
    <li><a class="dropdown-item" href="{{ route('suivi-formation.index') }}"><i class="fas fa-chalkboard-teacher"></i>    Suivi de Formation</a></li>
    <li><a class="dropdown-item" href="{{ route('suivi-qualite.index') }}"><i class="fas fa-star"></i>    Suivi Qualité</a></li>
</ul>
<div class="user-profile">
    <div class="user-avatar">
        <span>{{ Auth::user()->name[0] }}</span>
    </div>
    <div class="user-name">
        {{ Auth::user()->name }}
    </div>
</div>

            </li>
        </ul>
    </div>
    @endauth
    
    <div class="content @guest full-width @endguest">
        @yield('content')
    </div>
    <script>
    $(document).ready(function() {
        $('#formationDropdown').on('click', function(e) {
            e.preventDefault();
            $('.sidebar').toggleClass('collapsed');
            $('.content').toggleClass('expanded');
        });
    });
</script>

</body>
</html>