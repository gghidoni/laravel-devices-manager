<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Device;
use App\Models\Typology;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response;

class DeviceController extends Controller
{
    
    public function index() {

        // risultati filtrati per una ricerca
        //$devices = Device::latest()->filter(request(['search', 'es_tipologia']))->get(),
        // visualizza tutti i post
        
        $devices = Device::orderByRaw('ISNULL(lastUpdate), lastUpdate ASC')->get();
    
        return view('devices', [
            'devices' => $devices
        ]);
    
    }

    public function show(Device $device) {

        return view('device', [
            'device' => $device,
            'services' => $device->services
        ]);

    }

    public function create() {

        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('device.create');

    }

    public function store() {

        //validazione device
        $attributes = request()->validate([
            'serial' => ['required', ValidationRule::unique('devices', 'serial')],
            'description' => ['required', ValidationRule::unique('devices', 'description')],
            'typology_id' => ['required', ValidationRule::exists('typologies', 'id')],
            'department_id' => ['required', ValidationRule::exists('departments', 'id')],
            'lastUpdate' => 'nullable|date'
        ]);

        // creazione nuovo device
        $device = Device::create($attributes);

        // validazioni id utilizzatori inseriti
        $utilizers = request()->validate([
            'utilizer_id' => ['required', ValidationRule::exists('utilizers', 'id')]
        ]);

        // inserimento utilizzatori device appena creato
        foreach($utilizers['utilizer_id'] as $utilizer) {
            DB::table('device_utilizer')->insert([
                'device_id' => $device->id,
                'utilizer_id' => $utilizer
            ]);
        }

        // redirect con messaggio
        return back()->with('success', 'Dispositivo registrato con successo!');

    }

    public function typologiesFilter(Typology $typology) {

        return view('devices', [
            'devices' => $typology->devices
        ]);

    }

    public function departmentsFilter(Department $department) {

        return view('devices', [
            'devices' => $department->devices
        ]);

    }


    public static function countDays($data1,$data2){

        $d1 = explode("-",$data1);
        $d2 = explode("-",$data2);
        $timestamp1 = mktime(0, 0, 0, $d1[1], $d1[0], $d1[2]);
        $timestamp2 = mktime(0, 0, 0, $d2[1], $d2[0], $d2[2]);
        $seconds= $timestamp1 - $timestamp2;
        
        $days = abs(intval($seconds / 86400));
        return ($days);
    }

    public function edit(Device $device) {

        // pagina di edit device
        return view('device.edit', ['device' => $device]);
        
    }

    public function update(Device $device) {

        $attributes = request()->validate([
            'serial' => ['required', ValidationRule::unique('devices')->ignore($device)],
            'description' => ['required', ValidationRule::unique('devices')->ignore($device)],
            'typology_id' => ['required', ValidationRule::exists('typologies', 'id')],
            'department_id' => ['required', ValidationRule::exists('departments', 'id')],
            'lastUpdate' => 'nullable|date'
        ]);

        $device->update($attributes);

        // validazione utilizer id
        $utilizers = request()->validate([
            'utilizer_id' => ['required', ValidationRule::exists('utilizers', 'id')]
        ]);

        // verifica update utilizers
        // mi creo un array di utilizer_id precedenti all'update
        $oldUtilizers = [];
        foreach($device->utilizers as $objUtilizer){
            $oldUtilizers[] = $objUtilizer->id;
        }

        // itero i nuovi valori request utilizer, se non sono gia presenti creo un nuovo record nella tabella
        foreach($utilizers['utilizer_id'] as $utilizer) {
            if(!in_array($utilizer, $oldUtilizers)){
                DB::table('device_utilizer')->insert([
                    'device_id' => $device->id,
                    'utilizer_id' => $utilizer
                ]);
            }
        }

        // redirect con messaggio
        return redirect('/devices' . '/' . $device->serial )->with('success', 'Dispositivo aggiornato con successo.');



    }
}