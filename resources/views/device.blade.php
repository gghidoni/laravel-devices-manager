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
            <span><img src="/icons/update.svg" alt="">{{$device->lastUpdate}}</span>
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
            <span class="title">Log Manutenzione</span>
            <div class="log-box">
                @foreach ($services as $service)
                    <div class="log">
                        <div class="left">
                            <div class="service-date"><span>{{$service->date}}</span></div>
                            <div class="service-description"><span>{{$service->description}}</span></div>
                        </div>
                        <div class="right">
                            <div class="service-user"><span>{{$service->user->name}}</span></div>
                            <div class="service-update">
                                <?php if($service->is_update == 1){ ?>
                                    <img src="/icons/update.svg" alt="">
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="btn-aside">
        <a href="/devices/{{$device->serial}}/edit" class="device-btn">
            <img src="/icons/edit.svg" alt="">
            <span>Edit</span>
        </a>
        <a href="/" class="device-btn">
            <img src="/icons/service.svg" alt="">
            <span>Manutenzione</span>
        </a>
    </div>

</div>


@endsection