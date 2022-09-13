<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ServiceController extends Controller
{

    public function create(Device $device) {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('maintanence.create', [
            'device' => $device,
        ]);

    }


    public function store(Device $device) {

        $attributes = request()->validate([
            'description' => 'required|max:255',
        ]);

        //$attributes['date'] = date('d-m-Y h:i:s');
        $attributes['user_id'] = auth()->id();
        $attributes['device_id'] = $device->id;

        if(request()->has('is_update')){
            $attributes['is_update'] = 1;
            $service = Service::create($attributes);
            $device->update(['lastUpdate' => $service->created_at]);
        } else {
            $attributes['is_update'] = 0;
            Service::create($attributes);
        }

        return redirect('/devices' . '/' . $device->serial)->with('success', 'Log inserito.');

    }

    public function edit(Device $device, Service $service){

        return view('maintanence.edit', [
            'device' => $device,
            'service' => $service
        ]);

    }

    public function update(Device $device, Service $service) {

        $attributes = request()->validate([
            'description' => 'required|max:255',
        ]);

        if(request()->has('is_update')){
            $attributes['is_update'] = 1;
            $service->update($attributes);
            $device->update(['lastUpdate' => $service->created_at]);
        } else {
            $attributes['is_update'] = 0;
            $service->update($attributes);
        }

        return redirect('/devices' . '/' . $device->serial)->with('success', 'Log aggiornato.');

    }

    public function destroy(Device $device, Service $service) {

        // elimina post
        $service->delete();

        // redirect con messaggio
        return back()->with('success', 'Log eliminato!');

    }

}
