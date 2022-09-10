<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    public function create() {

        return view('register.create');

    }

    public function store() {

        // sistema di validazione

        $attributes = request()->validate([
            'name' => 'required|min:3|max:100',
            //'username' => ['required', 'min:3', 'max:100', Rule::unique('users', 'username')],
            'username' => 'required|min:3|max:100|unique:users,username',
            'is_admin' => 'required',
            //'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:5|max:100'
        ]);

        // creazione di una nuovo user

        User::create($attributes);

        // messaggio

        session()->flash('success', 'Your account has been created');

        // login

        //auth()->login($user);

        // redirect con messaggio
        return back()->with('success', 'Manutentore registrato con successo!');

    }

}
