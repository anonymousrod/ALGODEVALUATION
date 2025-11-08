<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Soumissions PDF</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .flagged { background-color: #ffe6e6; }
        .matched { background-color: #e6ffe6; }
        .status-pending { color: orange; }
        .status-approved { color: green; }
        .status-rejected { color: red; }
    </style>
</head>
<body>
    <h1>Liste des Soumissions</h1>
    <p><strong>Date d'export:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Total des soumissions:</strong> {{ $submissions->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Contributeur</th>
                <th>Agence Nom</th>
                <th>Email</th>
                <th>Tél</th>
                <th>Siège</th>
                <th>Score</th>
                <th>Agence Matchée</th>
                <th>Check Internet</th>
                <th>Flagged</th>
                <th>Status</th>
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
                <td class="status-{{ $submission->status }}">
                    @if($submission->status === 'pending')
                        En attente
                    @elseif($submission->status === 'approved')
                        Approuvée
                    @else
                        Rejetée
                    @endif
                </td>
                <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
