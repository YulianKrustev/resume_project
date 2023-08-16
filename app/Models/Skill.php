<?php

namespace App\Models;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setCatAttribute($value)
    {
        $this->attributes['skills'] = json_encode($value);
    }
  
    public function getCatAttribute($value)
    {
        return $this->attributes['skills'] = json_decode($value);
    }

}
