<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    
    public function index() {

        // visualizza tutti i post
        $devices = Device::latest()->get();
    
        return view('devices', [
            'devices' => $devices
        ]);
    
        }

}
