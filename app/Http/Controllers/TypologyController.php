<?php

namespace App\Http\Controllers;

use App\Models\Typology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response;


class TypologyController extends Controller
{

    public function create() {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('typology.create');

    }

    public function store() {

        //validazione
        $attributes = request()->validate([
            'name' => ['required', ValidationRule::unique('typologies', 'name')]
        ]);

        Typology::create($attributes);

        // redirect con messaggio
        return back()->with('success', 'Tipologia dispositivo registrata con successo!');

    }

}
