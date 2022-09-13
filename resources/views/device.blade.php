@extends('layout')


@section('content')


<div class="single-device-page">

    <div class="single-device">
        <div class="serial info-box">
            <span class="title">Seriale</span>
            <span><img src="/icons/serial.svg" alt="">{{$device->serial}}</span>
        </div>
        <div class="update info-box">
            <span class="title">Ultimo aggiornamento</span>
            @if ($device->lastUpdate == '')
                        <span><img src="/icons/update.svg" alt="">n.d.</span>
                    @else
                        @php
                            $date = new DateTime($device->lastUpdate);
                            $days = App\Http\Controllers\DeviceController::countDays($date->format('d-m-Y'), date('d-m-Y'));
                        @endphp
                        <span class="<?php if($days > 60){echo 'em-update';} ?>"><img src="/icons/update.svg" alt="">{{$date->format('d-m-Y');}}</span>
                        
                    @endif
            
        </div>
        <div class="description info-box">
            <span class="title">Descrizione</span>
            <span>{{$device->description}}</span>
        </div>
        <div class="typology info-box">
            <span class="title">Tipologia</span>
            <span><img src="/icons/{{$device->typology->name}}.svg" alt="">{{$device->typology->name}}</span>
        </div>
        <div class="department info-box">
            <span class="title">Reparto</span>
            <span><img src="/icons/department.svg" alt="">{{$device->department->name}}</span>
        </div>
        <div class="utilizers info-box">
            <span class="title">Utilizzatori</span>
            <ul>
                @foreach ($device->utilizers as $utilizer)
                    <li>{{$utilizer->name}}</li>
                @endforeach
            </ul>
        </div>

        <div class="services">
            <div class="title-box">
                <span class="title">Log Manutenzione</span>
                <a href="/devices/{{$device->serial}}/maintanence/create" class="btn-service">
                    <img src="/icons/plus-green.svg" alt="">
                </a>
            </div>
            
            <div class="log-box">
                @foreach ($services as $service)
                    <div class="log">
                        <div class="left">
                            <div class="service-date"><span>{{$service->created_at}}</span></div>
                            <div class="service-description"><span>{{$service->description}}</span></div>
                        </div>
                        <div class="right">
                            <div class="service-user"><span>{{$service->user->name}}</span></div>
                            <div class="service-update">
                                <?php if($service->is_update == 1){ ?>
                                    <img src="/icons/update-green.svg" alt="">
                                <?php } ?>
                            </div>
                            <a href="/devices/{{$device->serial}}/maintanence/{{$service->id}}/edit" class="service-edit">
                                <img src="/icons/edit.svg" alt="EDIT">
                            </a>
                            <form action="/devices/{{$device->serial}}/maintanence/{{$service->id}}/destroy" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="delete-service" onclick="return confirm('Sei sicuro di voler eliminare questo log?')"><img src="/icons/delete.svg" alt="Delete"></button>
                            </form>
                          
                        </div> 
                        
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="btn-aside">
        <a href="/devices/{{$device->serial}}/edit" class="device-btn">
            <img src="/icons/edit.svg" alt="EDIT">
        </a>
        <form action="/devices/{{$device->serial}}/destroy" method="post">
            @csrf
            @method('DELETE')
            <button class="device-btn" onclick="return confirm('Sei sicuro di voler eliminare questo dispositivo?')">
                <img src="/icons/delete.svg" alt="EDIT">
            </button>
        </form>
    
    </div>

</div>


@endsection