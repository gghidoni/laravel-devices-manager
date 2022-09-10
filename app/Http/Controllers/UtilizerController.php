<?php

namespace App\Http\Controllers;

use App\Models\Utilizer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response;

class UtilizerController extends Controller
{
    

    public function create() {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('utilizer.create');

    }

    public function store() {

        //validazione
        $attributes = request()->validate([
            'name' => ['required', ValidationRule::unique('utilizers', 'name')]
        ]);

        Utilizer::create($attributes);

        // redirect con messaggio
        return back()->with('success', 'Utilizzatore registrato con successo!');

    }

}
