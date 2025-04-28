@extends('layouts.app')

@section('content')
<div class="welcome-container">
    <div class="welcome-message">
        <h1 class="title">Bienvenue sur la Plateforme Formation.RG</h1>
        <p class="subtitle">Gestion complète des Formations</p>
        <div class="features">
            <div class="feature-item">
                <i class="fas fa-users"></i>
                <span>Gestion des agents</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-chart-line"></i>
                <span>Création de sessions</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Suivi des formations</span>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
    
    .welcome-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 70px);
    background-color: #f5f5f5; /* Light gray background */
    /* Alternative: background-color: white; */
    padding: 0;
    overflow: hidden;
}

    .welcome-message {
        position: relative;
        text-align: center;
        background: rgba(255, 255, 255, 0.95);
        padding: 3rem 4rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        animation: fadeInUp 1s cubic-bezier(0.22, 1, 0.36, 1);
        max-width: 800px;
        width: 90%;
        transition: all 0.3s ease;
    }

    .welcome-message:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .title {
        font-size: 3rem;
        color: #333;
        margin-bottom: 1.5rem;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg,rgb(88, 105, 88), #59875b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
    }

    .subtitle {
        font-size: 1.4rem;
        color: #555;
        margin-bottom: 3rem;
        font-weight: 300;
    }

    .features {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        margin: 2rem 0;
        gap: 2rem;
    }

    .feature-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 150px;
        transition: transform 0.3s ease;
    }

    .feature-item i {
        font-size: 2.5rem;
        color:#FFC107;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .feature-item span {
        font-size: 1.1rem;
        color: #555;
    }

    .feature-item:hover {
        transform: translateY(-5px);
    }

    .feature-item:hover i {
        color: #7da17e;
        transform: scale(1.1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome-message {
            padding: 2rem;
        }

        .title {
            font-size: 2.5rem;
        }

        .subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .features {
            flex-direction: column;
            gap: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .title {
            font-size: 2rem;
        }

        .subtitle {
            font-size: 1rem;
        }

        .welcome-message {
            padding: 1.5rem;
        }
    }
</style>