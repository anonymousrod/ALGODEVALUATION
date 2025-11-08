<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBSOLUX - Collecte de Données d'Agences Immobilières</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2D6F32;
            --primary-light: #3d8f42;
            --accent: #9ACD32;
            --accent-light: #D5E5D6;
            --dark: #1a1a1a;
            --gray: #64748b;
            --light: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--dark) 0%, #2a2a2a 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 30% 50%, rgba(157, 205, 50, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(45, 111, 50, 0.08) 0%, transparent 50%);
            animation: bgMove 20s ease-in-out infinite;
        }

        @keyframes bgMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-50px, -50px); }
        }

        header {
            padding: 1rem 2rem;
            text-align: center;
            position: relative;
        }

        .admin-login {
            position: absolute;
            top: 1rem;
            right: 2rem;
            font-size: 0.9rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .admin-login:hover {
            opacity: 1;
        }

        .admin-login a {
            color: var(--accent);
            text-decoration: none;
        }

        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #fff 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2.5rem;
            line-height: 1.8;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            padding: 1.2rem 3rem;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            border: none;
            border-radius: 50px;
            color: var(--dark);
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 20px 50px rgba(157, 205, 50, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 25px 60px rgba(157, 205, 50, 0.5);
        }

        .features {
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.03);
            text-align: center;
        }

        .features h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--accent);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .feature-card {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 2rem 1rem;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .admin-login {
                position: static;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <header>
        <div class="admin-login">
            @auth
                <a href="{{ route('admin.dashboard') }}">Tableau de bord</a>
            @else
                <a href="{{ route('login') }}">Connexion Admin</a>
            @endauth
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Contribuez à enrichir notre base de données immobilières</h1>
            <p>Aidez-nous à construire la base de données la plus complète des agences immobilières. Votre contribution permet d'améliorer l'information pour tous les acteurs du secteur immobilier.</p>
            <a href="/submit" class="cta-button">Soumettre une agence</a>
        </div>
    </section>

    <section class="features">
        <h2>Pourquoi contribuer ?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Impact Communautaire</h3>
                <p>Votre contribution aide à créer une base de données fiable et complète pour le bénéfice de tous les professionnels de l'immobilier.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Données Vérifiées et Possibilité de Récompense</h3>
                <p>Chaque soumission est examinée par nos administrateurs pour garantir la qualité et l'exactitude des informations. Puis recevez une récompense si un nombre de donné de vos informations fournies sons vérifier</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Facilité d'Usage</h3>
                <p>Un formulaire simple et intuitif vous permet de soumettre plusieurs agences en quelques minutes.</p>
            </div>
        </div>
    </section>
</body>
</html>
