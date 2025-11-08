<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Agency;
use App\Models\Contributor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_submissions' => Submission::count(),
            'total_agencies' => Agency::count(),
            'total_contributors' => Contributor::count(),
            'recent_submissions' => Submission::with(['contributor', 'matchedAgency'])->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
    public function submissions()
    {
        $submissions = Submission::with(['contributor', 'matchedAgency'])->paginate(20);
        return view('admin.submissions', compact('submissions'));
    }

    public function agencies()
    {
        $agencies = Agency::paginate(20);
        return view('admin.agencies', compact('agencies'));
    }

    public function contributors()
    {
        $contributors = Contributor::paginate(20);
        return view('admin.contributors', compact('contributors'));
    }

    public function exportAgencies()
    {
        $agencies = Agency::all();
        $csv = "ID,Name,Email,Phone,Siege,Canonical,Created At\n";
        foreach ($agencies as $agency) {
            $csv .= "{$agency->id},\"{$agency->name}\",\"{$agency->email}\",\"{$agency->phone}\",\"{$agency->siege}\",{$agency->canonical},{$agency->created_at}\n";
        }
        return response($csv)->header('Content-Type', 'text/csv')->header('Content-Disposition', 'attachment; filename="agencies.csv"');
    }

    public function exportAgenciesPdf()
    {
        $agencies = Agency::all();
        $pdf = Pdf::loadView('admin.exports.agencies_pdf', compact('agencies'));
        return $pdf->download('agencies.pdf');
    }

    public function exportContributors()
    {
        $contributors = Contributor::all();
        $csv = "ID,Pseudo,Phone,Is Anonymous,Contributions Totales,Contributions Validées,Created At\n";
        foreach ($contributors as $contributor) {
            $csv .= "{$contributor->id},\"{$contributor->pseudo}\",\"{$contributor->phone}\",{$contributor->is_anonymous},{$contributor->contributions_count},{$contributor->valid_contributions_count},{$contributor->created_at}\n";
        }
        return response($csv)->header('Content-Type', 'text/csv')->header('Content-Disposition', 'attachment; filename="contributors.csv"');
    }

    public function exportSubmissions()
    {
        $submissions = Submission::with(['contributor', 'matchedAgency'])->get();
        $csv = "ID,Contributor ID,Agency Name,Agency Email,Agency Phone,Agency Siege,Matched Agency ID,Match Score,Internet Check,Is Flagged,Status,Validated At,Created At\n";
        foreach ($submissions as $submission) {
            $csv .= "{$submission->id},{$submission->contributor_id},\"{$submission->agency_name}\",\"{$submission->agency_email}\",\"{$submission->agency_phone}\",\"{$submission->agency_siege}\",{$submission->matched_agency_id},{$submission->match_score},{$submission->internet_check},{$submission->is_flagged},{$submission->status},{$submission->validated_at},{$submission->created_at}\n";
        }
        return response($csv)->header('Content-Type', 'text/csv')->header('Content-Disposition', 'attachment; filename="submissions.csv"');
    }

    public function exportSubmissionsPdf()
    {
        $submissions = Submission::with(['contributor', 'matchedAgency'])->get();
        $pdf = Pdf::loadView('admin.exports.submissions_pdf', compact('submissions'));
        return $pdf->download('submissions.pdf');
    }

    public function exportContributorsPdf()
    {
        $contributors = Contributor::all();
        $pdf = Pdf::loadView('admin.exports.contributors_pdf', compact('contributors'));
        return $pdf->download('contributors.pdf');
    }

    public function approveSubmission($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update([
            'status' => 'approved',
            'validated_at' => now(),
            'validated_by' => auth()->id()
        ]);

        // Créer l'agence si elle n'existe pas déjà
        $agency = Agency::firstOrCreate(
            ['name' => $submission->agency_name],
            [
                'email' => $submission->agency_email,
                'phone' => $submission->agency_phone,
                'siege' => $submission->agency_siege,
                'canonical' => true
            ]
        );

        return redirect()->route('admin.submissions')->with('success', 'Soumission approuvée et agence ajoutée.');
    }

    public function rejectSubmission($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update([
            'status' => 'rejected',
            'validated_at' => now(),
            'validated_by' => auth()->id()
        ]);

        return redirect()->route('admin.submissions')->with('success', 'Soumission rejetée.');
    }
}
