<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CandidateController extends Controller
{
    public function StoreCandiate(Request $request){

    $request->validate([
        'firstName' => 'required|string|min:2|max:32',
        'secondName' => 'required|string|min:2|max:32',
        'lastName' => 'required|string|min:2|max:32',
        'skills' => 'required'
    ],[
        'skills.required' => 'Please select at least one skill.',
    ]);

    $firstName = $request->firstName;
    $secondName = $request->secondName;
    $lastName = $request->lastName;
    $name = "$firstName $secondName $lastName";

    $university = $request->university;
    $skills = $request->skills;

    $birthDayDate = Carbon::parse($request->date_picker)->format('Y-m-d');

    $candidate = Candidate::where('name', $name)->first();


    if ( ! isset($candidate)) {

        $candidate = Candidate::create([
                'name' => $name,
                'birthday_date' => $birthDayDate,
                'created_at' => Carbon::now()
    ]);

        $candidate->save();
    }
    
    
    $cv = CV::create([
                'candidate_id' => $candidate->id,
                'university_id' => $university,
                'created_at' => Carbon::now()
            ]);

    $cv->skills()->attach($skills);
    $cv->save();


    return redirect()->back();
        
    } //End Method
}
