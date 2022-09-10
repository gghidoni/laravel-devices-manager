<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    
    public function create() {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('department.create');

    }

    public function store() {

        //validazione
        $attributes = request()->validate([
            'name' => ['required', ValidationRule::unique('departments', 'name')]
        ]);

        Department::create($attributes);

        // redirect con messaggio
        return back()->with('success', 'Reparto registrato con successo!');

    }

}
