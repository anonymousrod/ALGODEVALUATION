<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBSOLUX - Tableau de Bord Administrateur</title>
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .header h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 900;
            background: linear-gradient(135deg, #fff 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logout-btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            border-radius: 50px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(220, 53, 69, 0.5);
        }

        .nav {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .nav a {
            padding: 1rem 2rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .nav a:hover, .nav a.active {
            background: var(--accent);
            color: var(--dark);
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent);
        }

        .stat-number {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 900;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .recent-submissions {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
        }

        .recent-submissions h2 {
            color: var(--accent);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 700;
            color: white;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .nav {
                justify-content: center;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <div class="container">
        <div class="header">
            <h1>Tableau de Bord Administrateur</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>

        <nav class="nav">
            <a href="{{ route('admin.dashboard') }}" class="active">Tableau de Bord</a>
            <a href="{{ route('admin.submissions') }}">Soumissions</a>
            <a href="{{ route('admin.agencies') }}">Agences</a>
            <a href="{{ route('admin.contributors') }}">Contributeurs</a>
        </nav>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_submissions'] }}</div>
                <div class="stat-label">Total Soumissions</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_agencies'] }}</div>
                <div class="stat-label">Total Agences</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_contributors'] }}</div>
                <div class="stat-label">Total Contributeurs</div>
            </div>
        </div>

        <div class="recent-submissions">
            <h2>Dernières Soumissions</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Agence</th>
                        <th>Contributeur</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_submissions'] as $submission)
                    <tr>
                        <td>{{ $submission->id }}</td>
                        <td>{{ $submission->agency_name }}</td>
                        <td>{{ $submission->contributor ? ($submission->contributor->pseudo ?: 'Anonyme') : 'Anonyme' }}</td>
                        <td>{{ $submission->match_score }}%</td>
                        <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
