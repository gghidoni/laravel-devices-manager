<?php

namespace App\Http\Controllers;

use App\Models\Typology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response;


class TypologyController extends Controller
{

    public function create() {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('typology.create', [
            'typologies' => Typology::latest()->get(),
        ]);

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

    public function destroy(Typology $typology) {

   
        if(DB::table('devices')->where('typology_id', $typology->id)->exists()){
            return redirect('/typology/create')->with('message', 'Non è possibile eliminare la tipologia, sostituirla prima nei dispositivi.');
        } else {
            $typology->delete();
            return redirect('/typology/create')->with('success', 'Tipologia eliminata!');
        }

    }

}
