<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function index(){
        // $applicants = Application::latest('id')->get();
        // return view('index', compact('applicants'));
        return view ('application');
    }
    public function create(Request $request) {
        return view ('application');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email|unique:application']);

        if ($validator->fails()) {
            return response()->json([ 'error' => $validator->errors() ]);
        }

        $result = Application::create($request->all());
        
        return response()->json(['success' => 'Form submitted successfully.']);
    }
}
