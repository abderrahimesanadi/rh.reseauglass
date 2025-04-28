@extends('layouts.app')

@section('content')
<div class="about-container">
    <!-- Hero Section -->
    <div class="about-hero" style="background: linear-gradient(135deg, rgb(63, 82, 63) 0%, rgb(48, 68, 49) 100%);">
        <div class="hero-content">
            <h1>À propos de <span>Formation.RG</span></h1>
            <p class="hero-subtitle">Formations Optimisées, Suivi Centralisé</p>
        </div>
        <div class="hero-pattern"></div>
    </div>

    <!-- Main Content -->
    <div class="about-content">
        <!-- Cards Section -->
        <div class="cards-grid">
            <!-- Mission Card -->
            <div class="about-card">
                <div class="card-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Notre Mission</h3>
                <p class="card-text">
                    Une plateforme centralisée pour planifier, suivre et évaluer les formations des agents, avec un encadrement assuré par les responsables.
                </p>
                <div class="card-wave"></div>
            </div>

            <!-- Vision Card -->
            <div class="about-card">
                <div class="card-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3>Notre Vision</h3>
                <p class="card-text">
                    Devenir la référence en matière de gestion de formation professionnelle, en proposant des outils adaptés aux besoins spécifiques de chaque organisation.
                </p>
                <div class="card-wave"></div>
            </div>

            <!-- Values Card -->
            <div class="about-card">
                <div class="card-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Nos Valeurs</h3>
                <p class="card-text">
                    Excellence, Innovation, Transparence et Accompagnement personnalisé sont au cœur de notre démarche pour vous offrir une gestion de fomation compléte.
                </p>
                <div class="card-wave"></div>
            </div>
        </div>

        <!-- History Timeline -->
       
        <!-- Team Section -->
        <div class="team-section">
            <h2 class="section-title">Notre Équipe</h2>
            <div class="team-grid">
                <!-- Membre 1 -->
                <div class="team-member">
                    <div class="member-info">
                        <h3>Meftah Souhaila</h3>
                        <p class="position">Stagiaire en développement</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Membre 2 -->
                <div class="team-member">
                    <div class="member-info">
                        <h3>Oussama</h3>
                        <p class="position">Chef de Projet</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Variables Couleurs */
    :root {
        --primary: #4CAF50;
        --primary-dark: #2E7D32;
        --secondary: #FFC107;
        --dark: #263238;
        --light: #f8f9fa;
        --accent: #FFC107;
    }

    /* Hero Section */
    .about-hero {
        position: relative;
        padding: 6rem 2rem;
        color: white;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
    }

    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .about-hero h1 span {
        color: var(--secondary);
    }

    .hero-subtitle {
        font-size: 1.5rem;
        opacity: 0.9;
    }

    .hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(rgba(255,255,255,0.1) 2px, transparent 2px);
        background-size: 32px 32px;
        z-index: 1;
    }

    /* Content */
    .about-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    /* Cards Grid */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .about-card {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        border-top: 4px solid var(--primary);
    }

    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        background: var(--accent);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .about-card h3 {
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .card-text {
        color: #555;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .card-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    /* Section Titles */
    .section-title {
        text-align: center;
        margin-bottom: 3rem;
        font-size: 2.2rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: var(--primary);
        margin: 1rem auto 0;
    }

    /* Timeline Section */
    .timeline-section {
        margin: 5rem 0;
        padding: 2rem;
        background-color: var(--light);
        border-radius: 12px;
    }

    .timeline {
        position: relative;
        padding-left: 30px;
        max-width: 800px;
        margin: 0 auto;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 2px;
        background: var(--primary);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        padding-left: 50px;
    }

    .timeline-date {
        position: absolute;
        left: -30px;
        top: 0;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--accent);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .timeline-content {
        padding: 1.5rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .timeline-content h3 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-size: 1.5rem;
        color: var(--dark);
    }

    /* Team Section */
    .team-section {
        padding: 4rem 2rem;
        background: var(--light);
        margin-top: 3rem;
        border-radius: 12px;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .team-member {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .team-member:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .member-info {
        padding: 1.5rem;
        text-align: center;
    }

    .member-info h3 {
        margin-top: 0;
        margin-bottom: 0.3rem;
        font-size: 1.5rem;
    }

    .position {
        color: #666;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 1rem;
    }

    .social-links a {
        width: 40px;
        height: 40px;
        background: var(--accent);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: var(--dark);
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2.5rem;
        }
        
        .cards-grid,
        .team-grid {
            grid-template-columns: 1fr;
        }
        
        .timeline-item {
            padding-left: 30px;
        }
    }
</style>
@endsection