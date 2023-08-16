<?php

namespace App\Models;

use App\Models\Skill;
use App\Models\Candidate;
use App\Models\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CV extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'cv';

    public function Candidate()
    {
        return $this->belongsToMany(Candidate::class, 'candidates', 'id');
    }

    public function University()
    {
        return $this->belongsToMany(University::class, 'universities', 'id');
    }

    public function Skills()
    {
        return $this->belongsToMany(Skill::class, 'cv_skill', 'cv_id', 'skill_id');
    }

    
}
