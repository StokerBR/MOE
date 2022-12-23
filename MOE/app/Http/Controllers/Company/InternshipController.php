<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller {

    public function index(Request $request) {

        $internships = Internship::paginate(10);

        $data = [
            'internships' => $internships,
        ];

        return view('company.internship.index', $data);

    }

}
