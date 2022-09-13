<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    
    public function create() {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('department.create', [
            'departments' => Department::latest()->get(),
        ]);

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

    public function destroy(Department $department) {

   
        if(DB::table('devices')->where('department_id', $department->id)->exists()){
            return redirect('/department/create')->with('message', 'Non è possibile eliminare il reparto, sostituirlo prima nei dispositivi.');
        } else {
            $department->delete();
            return redirect('/department/create')->with('success', 'Reparto eliminato!');
        }

    }

}
