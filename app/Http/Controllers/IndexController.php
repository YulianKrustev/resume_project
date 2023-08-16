<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\University;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function Index(){
        
        $universities = University::orderBy('name', 'ASC')->get();
        $skills = Skill::orderBy('name', 'ASC')->get();

        return view('home', compact('universities', 'skills'));
    } // End function
}
