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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <!-- Dans la section head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- À la fin du body, après jQuery mais avant la fermeture du body -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Scripts spécifiques à l'application -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/fr.js"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (doit être avant Select2 JS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Ajoutez avant vos scripts personnalisés -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>

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
   /* Base styles */
body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', Arial, sans-serif;
    box-sizing: border-box;
}

/* Header styles */
.header {
    background-color: rgb(125, 161, 126);
    color: white;
    padding: 10px 20px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.nav-top {
    display: flex;
    gap: 20px;
    align-items: center;
}

.nav-top a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.nav-top a:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

/* Sidebar styles */
.sidebar {
    height: calc(100% - 70px);
    width: 250px;
    background-color: #333;
    color: white;
    position: fixed;
    left: 0;
    top: 70px;
    padding-top: 20px;
    z-index: 900;
    overflow-y: auto;
    transition: width 0.3s ease;
}

.sidebar.collapsed {
    width: 70px;
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
    transition: background-color 0.3s;
}

.sidebar-menu li:hover {
    background-color: #444;
}

/* Dropdown styles */
.dropdown-menu {
    display: none;
    width: 100%;
    background-color: #444;
    padding: 0;
    margin: 0;
    list-style-type: none;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-item {
    color: white;
    padding: 10px 25px;
    display: block;
    text-decoration: none;
    transition: background-color 0.3s;
}

.dropdown-item:hover {
    background-color: #555;
}

.dropdown-toggle::after {
    content: " ▼";
    float: right;
}

/* Content area */
.content {
    margin-left: 250px;
    margin-top: 70px;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

.content.expanded {
    margin-left: 70px;
}

/* Login page styles */
.login-container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    box-sizing: border-box;
}

.login-form button {
    background-color: rgb(125, 161, 126);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

.login-form button:hover {
    background-color: rgb(105, 141, 106);
}

.login-page .content {
    margin-left: 0;
}

/* Title styles */
.title-rg {
    font-family: 'Poppins', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: white;
    background-color: rgb(89, 135, 91);
    padding: 5px 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

/* User profile styles */
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
    transition: width 0.3s ease;
}

.sidebar.collapsed .user-profile {
    width: 70px;
    justify-content: center;
    padding: 10px;
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

.sidebar.collapsed .user-avatar {
    width: 30px;
    height: 30px;
    margin: 0 auto;
}

.user-name {
    color: white;
    font-size: 16px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.sidebar.collapsed .user-name,
.sidebar.collapsed .user-avatar span {
    display: none;
}

/* Navigation link styles */
.nav-link-styled {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: white !important;
    background-color: rgb(89, 135, 91);
    padding: 8px 15px !important;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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

/* Collapsed sidebar specific styles */
.sidebar.collapsed .dropdown-toggle::after {
    display: none;
}

.sidebar.collapsed .dropdown-item span {
    display: none;
}

.sidebar.collapsed .dropdown-menu {
    display: none !important;
}

.sidebar.collapsed .sidebar-menu li a {
    text-align: center;
    padding: 10px 0;
}

.sidebar.collapsed .sidebar-menu li a i {
    display: block;
    font-size: 1.2rem;
    margin-right: 0;
}

.sidebar.collapsed .dropdown-item {
    padding: 10px;
    text-align: center;
}

.sidebar.collapsed .dropdown-item i {
    font-size: 1.2rem;
    margin-right: 0;
}

/* Dropdown styles for RH and Formation */
#formationDropdown, #RHDropdown {
    color: white !important;
    background-color: rgb(89, 135, 91) !important;
    padding: 8px 15px !important;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    margin: 5px 0;
    display: block;
    transition: transform 0.3s, background-color 0.3s;
}

#formationDropdown:hover, #RHDropdown:hover {
    background-color: rgb(75, 120, 77) !important;
    transform: scale(1.03);
}

#formationDropdown i, #RHDropdown i {
    margin-right: 8px;
}

/* Media queries for responsive design */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        transform: translateX(-100%);
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
    .content {
        margin-left: 0;
    }
    
    .user-profile {
        width: 100%;
    }
}

    </style>
</head>
<body class="@guest login-page @endguest">
    <div class="header">
    <h1 class="title-rg">🎓 RH<span>.ReseauGlass</span></h1>
    <div class="nav-top">
    <a href="{{ route('about') }}" class="nav-link-styled">
         Accueil
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
    <a class="dropdown-toggle" href="#" id="RHDropdown"><i class="fas fa-users"></i>  RH</a>
    <li><a class="dropdown-item" href="{{ route('gestion-rib.index') }}"><i class="fas fa-money-check-alt"></i>    Gestion RIB</a></li>
    <li><a href="{{ route('suivi-conge.index') }}" ><i class="nav-icon fas fa-calendar"></i>       Suivi Absences </a></li>
    <li><a href="{{ route('employees.index') }}" ><i class="nav-icon fas fa-calendar"></i>       Suivi CP </a></li>
    </a>
</ul>


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Vos scripts personnalisés -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
</body>

</body>
</html>