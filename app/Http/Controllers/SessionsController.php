<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    
    
    public function create() {

        return view('sessions.create');

    }


    public function store() {

        // validazione attributi per login
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(!auth()->attempt($attributes)) {

            // login fallita
            throw ValidationException::withMessages(['username' => 'Your provided credentials could not be verified.']);
        }

        // Login avvenuta con successo

        // session fixation
        session()->regenerate();

        //redirect con successo
        return redirect('/')->with('success', 'Welcome Back!');

    }
    
    
    public function destroy() {

        // elimina user
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');

    }

}
