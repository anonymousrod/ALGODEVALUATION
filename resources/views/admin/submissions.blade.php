<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBSOLUX - Gestion des Soumissions</title>
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
            max-width: 1400px;
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

        .export-links {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .export-links a {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(45, 111, 50, 0.3);
        }

        .export-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 111, 50, 0.5);
        }

        .success-message {
            background: rgba(40, 167, 69, 0.2);
            color: #d4edda;
            border: 1px solid rgba(40, 167, 69, 0.3);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            font-weight: 600;
            text-align: center;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        th, td {
            padding: 1rem 0.5rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            vertical-align: top;
        }

        th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 700;
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .flagged {
            background: rgba(220, 53, 69, 0.1) !important;
            border-left: 4px solid #dc3545;
        }

        .matched {
            background: rgba(40, 167, 69, 0.1) !important;
            border-left: 4px solid #28a745;
        }

        .status-pending {
            color: #ffc107;
            font-weight: 600;
        }

        .status-approved {
            color: #28a745;
            font-weight: 600;
        }

        .status-rejected {
            color: #dc3545;
            font-weight: 600;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.8rem;
            margin: 0.25rem;
            transition: all 0.3s ease;
        }

        .approve-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .approve-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.5);
        }

        .reject-btn {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .reject-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.5);
        }

        .pagination {
            margin-top: 2rem;
            text-align: center;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .pagination a:hover, .pagination .active {
            background: var(--accent);
            color: var(--dark);
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

            .table-container {
                padding: 1rem;
            }

            table {
                font-size: 0.8rem;
            }

            th, td {
                padding: 0.5rem 0.25rem;
            }

            .action-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <div class="container">
        <div class="header">
            <h1>Soumissions</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>

        <nav class="nav">
            <a href="{{ route('admin.dashboard') }}">Tableau de Bord</a>
            <a href="{{ route('admin.submissions') }}" class="active">Soumissions</a>
            <a href="{{ route('admin.agencies') }}">Agences</a>
            <a href="{{ route('admin.contributors') }}">Contributeurs</a>
        </nav>

        <div class="export-links">
            <a href="{{ route('admin.export.submissions') }}">Exporter CSV</a>
            <a href="{{ route('admin.export.submissions.pdf') }}">Exporter PDF</a>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contributeur</th>
                        <th>Agence Nom</th>
                        <th>Email</th>
                        <th>Tél</th>
                        <th>Siège</th>
                        <th>Score Matching</th>
                        <th>Agence Matchée</th>
                        <th>Check Internet</th>
                        <th>Flagged</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                    <tr class="{{ $submission->is_flagged ? 'flagged' : ($submission->matched_agency_id ? 'matched' : '') }}">
                        <td>{{ $submission->id }}</td>
                        <td>{{ $submission->contributor ? ($submission->contributor->is_anonymous ? 'Anonyme' : $submission->contributor->pseudo . ' (' . $submission->contributor->phone . ')') : 'Anonyme' }}</td>
                        <td>{{ $submission->agency_name }}</td>
                        <td>{{ $submission->agency_email }}</td>
                        <td>{{ $submission->agency_phone }}</td>
                        <td>{{ $submission->agency_siege }}</td>
                        <td>{{ $submission->match_score }}%</td>
                        <td>{{ $submission->matchedAgency ? $submission->matchedAgency->name : 'N/A' }}</td>
                        <td>{{ $submission->internet_check }}</td>
                        <td>{{ $submission->is_flagged ? 'Oui' : 'Non' }}</td>
                        <td>
                            @if($submission->status === 'pending')
                                <span class="status-pending">En attente</span>
                            @elseif($submission->status === 'approved')
                                <span class="status-approved">Approuvée</span>
                            @else
                                <span class="status-rejected">Rejetée</span>
                            @endif
                        </td>
                        <td>
                            @if($submission->status === 'pending')
                                <form method="POST" action="{{ route('admin.submissions.approve', $submission->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="action-btn approve-btn">Approuver</button>
                                </form>
                                <form method="POST" action="{{ route('admin.submissions.reject', $submission->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="action-btn reject-btn">Rejeter</button>
                                </form>
                            @else
                                Validée le {{ $submission->validated_at ? $submission->validated_at->format('d/m/Y H:i') : 'N/A' }}
                            @endif
                        </td>
                        <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $submissions->links() }}
        </div>
    </div>
</body>
</html>
