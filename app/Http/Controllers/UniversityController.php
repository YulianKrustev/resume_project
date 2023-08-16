<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
     public function StoreUniversity(Request $request){

        $name = $request->u_name;
        $accreditation = $request->accreditation;
   
        $university = University::create([
            'name' => $name,
            'created_at' => Carbon::now()
        ]);
  
        $university->save();
    
        return redirect()->back();
    } //End Method
}
