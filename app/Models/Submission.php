<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'contributor_id', 'agency_name', 'agency_email', 'agency_phone', 'agency_siege',
        'matched_agency_id', 'match_score', 'internet_check', 'is_flagged',
        'status', 'validated_at', 'validated_by'
    ];

    protected $casts = [
        'validated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }

    public function matchedAgency()
    {
        return $this->belongsTo(Agency::class, 'matched_agency_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
