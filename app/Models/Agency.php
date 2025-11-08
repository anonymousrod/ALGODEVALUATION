<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'siege', 'canonical'];

    public function matchedSubmissions()
    {
        return $this->hasMany(Submission::class, 'matched_agency_id');
    }
}
