<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Contributeurs PDF</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .anonymous { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Liste des Contributeurs</h1>
    <p><strong>Date d'export:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Total des contributeurs:</strong> {{ $contributors->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Téléphone</th>
                <th>Anonyme</th>
                <th>Contributions Totales</th>
                <th>Contributions Validées</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contributors as $contributor)
            <tr class="{{ $contributor->is_anonymous ? 'anonymous' : '' }}">
                <td>{{ $contributor->id }}</td>
                <td>{{ $contributor->pseudo ?: 'N/A' }}</td>
                <td>{{ $contributor->phone ?: 'N/A' }}</td>
                <td>{{ $contributor->is_anonymous ? 'Oui' : 'Non' }}</td>
                <td>{{ $contributor->contributions_count }}</td>
                <td>{{ $contributor->valid_contributions_count }}</td>
                <td>{{ $contributor->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
