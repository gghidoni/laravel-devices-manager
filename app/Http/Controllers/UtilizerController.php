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

        return view('utilizer.create', [
            'utilizers' => Utilizer::latest()->get()
        ]);

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


    public function destroy(Utilizer $utilizer) {

            $utilizer->delete();
            return redirect('/utilizer/create')->with('success', 'Utilizzatore eliminato!');

    }

}
