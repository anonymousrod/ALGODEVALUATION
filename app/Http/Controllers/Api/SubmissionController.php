<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Contributor;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anonymous' => 'required|boolean',
            'pseudo' => 'nullable|string|min:3|max:30',
            'phone' => 'nullable|string|regex:/^[0-9+\-\s()]+$/',
            'agencies' => 'required|array|min:1',
            'agencies.*.name' => 'required|string|min:3',
            'agencies.*.email' => 'nullable|email',
            'agencies.*.phone' => 'nullable|string',
            'agencies.*.siege' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $contributor = null;

        if (!$data['anonymous']) {
            if (empty($data['pseudo']) || empty($data['phone'])) {
                return response()->json(['error' => 'Pseudo and phone required if not anonymous'], 422);
            }
            $contributor = Contributor::firstOrCreate(
                ['pseudo' => $data['pseudo'], 'phone' => $data['phone']],
                ['is_anonymous' => false, 'contributions_count' => 0]
            );
        } else {
            $contributor = Contributor::create([
                'is_anonymous' => true,
                'contributions_count' => 0
            ]);
        }

        $results = [];
        foreach ($data['agencies'] as $agencyData) {
            $match = $this->findBestMatch($agencyData);
            $submission = Submission::create([
                'contributor_id' => $contributor->id,
                'agency_name' => $agencyData['name'],
                'agency_email' => $agencyData['email'] ?? null,
                'agency_phone' => $agencyData['phone'] ?? null,
                'agency_siege' => $agencyData['siege'] ?? null,
                'matched_agency_id' => $match['agency'] ? $match['agency']->id : null,
                'match_score' => $match['score'],
                'internet_check' => 'unknown', // MVP: mark as unknown
                'is_flagged' => $match['score'] < 70,
            ]);

            $results[] = [
                'status' => 'ok',
                'match_score' => $match['score'],
                'matched' => $match['agency'] !== null,
                'message' => $match['agency'] ? "Correspondance: {$match['agency']->name}" : 'Nouvelle agence proposée',
            ];

            // Always increment contributions_count for each submission
            $contributor->increment('contributions_count');
        }

        // Add thank you message for non-anonymous contributors
        if (!$data['anonymous'] && $contributor) {
            $results[] = [
                'status' => 'info',
                'message' => 'Merci pour votre contribution ! Nous vous contacterons au ' . $contributor->phone . ' si vos informations sont validées.'
            ];
        }

        return response()->json($results);
    }

    private function findBestMatch($agencyData)
    {
        $agencies = Agency::all();
        $bestMatch = ['agency' => null, 'score' => 0];

        foreach ($agencies as $agency) {
            $nameScore = similar_text(strtolower($agencyData['name']), strtolower($agency->name)) / max(strlen($agencyData['name']), strlen($agency->name)) * 100;
            $phoneScore = (!empty($agencyData['phone']) && !empty($agency->phone) && $agencyData['phone'] === $agency->phone) ? 100 : 0;
            $emailScore = (!empty($agencyData['email']) && !empty($agency->email) && strtolower($agencyData['email']) === strtolower($agency->email)) ? 100 : 0;

            $totalScore = round($nameScore * 0.7 + $phoneScore * 0.2 + $emailScore * 0.1);

            if ($totalScore > $bestMatch['score']) {
                $bestMatch = ['agency' => $agency, 'score' => $totalScore];
            }
        }

        return $bestMatch;
    }
}
