<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $fillable = ['pseudo', 'phone', 'is_anonymous', 'contributions_count'];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getValidContributionsCountAttribute()
    {
        return $this->submissions()->where('status', 'approved')->count();
    }
}
