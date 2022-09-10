@extends('layout')


@section('content')

    @foreach ($devices as $device)


        <div class="device">
            <div class="info">
                <div class="serial">
                    <img src="/icons/serial.svg" alt="serial">
                    <a href="/devices/{{$device->serial}}">{{$device->serial}}</a>
                </div>
                <div class="serial"></div>
                <div class="update">
                    <img src="/icons/update.svg" alt="">
                    @if ($device->lastUpdate == '')
                        <span>n.d.</span>
                    @else
                        @php
                            $date = new DateTime($device->lastUpdate);
                            $days = App\Http\Controllers\DeviceController::countDays($date->format('d-m-Y'), date('d-m-Y'));
                        @endphp
                        <time class="<?php if($days > 60){echo 'em-update';} ?>">{{$date->format('d-m-Y');}}</time>
                    @endif
                </div>
                <div class="description">
                    <a href="/devices/{{$device->serial}}"><b>{{$device->description}}</b></a>
                </div>
                <div class="typology">
                    <img src="/icons/{{$device->typology->name}}.svg" alt="">
                    <a href="/typologies/{{$device->typology->name}}">{{$device->typology->name}}</a>
                </div>
                <div class="department">
                    <img src="/icons/department.svg" alt="">
                    <a href="/departments/{{$device->department->name}}">{{$device->department->name}}</a>
                </div>
            </div>
            <a href="/" class="service-btn">
                <img src="/icons/service.svg" alt="">
                <span>Manutenzione</span>
            </a>
        </div>

    @endforeach


    
@endsection




