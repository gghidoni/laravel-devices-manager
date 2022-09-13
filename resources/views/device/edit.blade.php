@extends('layout')

@section('content')

<div class="section-box">
    <div class="new-item">
        <h3>Modifica dispositivo</h3>

    <form action="/devices/{{$device->serial}}/update" method="POST">
        @csrf
        @method('PATCH')

        <input type="text" name="serial" value="{{$device->serial}}" required><br><br>
        @error('serial')
            <p style="color: red">{{$message}}</p>
        @enderror

        <input type="text" name="description" value="{{$device->description}}" required><br><br>
        @error('description')
            <p style="color: red">{{$message}}</p>
        @enderror

        <label for="typology_id"><strong>Tipologia: </strong></label>
        <select name="typology_id">
            <!-- Richiamo tutte le tipologie per formare il select -->
            @php
                $typologies = \App\Models\Typology::all();
            @endphp
            @foreach ($typologies as $typology)
                <option value="{{$typology->id}}" {{ $device->typology_id == $typology->id ? 'selected' : '' }}>{{ ucwords($typology->name) }}</option>
            @endforeach
        </select><br><br>
        @error('typology_id')
            <p style="color: red">{{$message}}</p>
        @enderror

        <label for="department_id"><strong>Reparto: </strong></label>
        <select name="department_id">
            
            @php
                $departments = \App\Models\Department::all();
            @endphp
            @foreach ($departments as $department)
                <option value="{{$department->id}}" {{ $device->department_id == $department->id ? 'selected' : '' }}>{{ ucwords($department->name) }}</option>
            @endforeach
        </select><br><br>
        @error('department_id')
            <p style="color: red">{{$message}}</p>
        @enderror

        <span><strong>Utilizzatori:</strong></span>
        @php
            $utilizers = \App\Models\Utilizer::all();
            $utilizersDevice = [];
            foreach ($device->utilizers as $objUtilizer) {
                $utilizersDevice[] = $objUtilizer->id;
            }
        @endphp
        @foreach ($utilizers as $utilizer)
            <input type="checkbox" name="utilizer_id[]" id="{{$utilizer->id}}" value="{{$utilizer->id}}" {{ in_array($utilizer->id, $utilizersDevice) ? 'checked' : '' }}><label class="check" for="{{$utilizer->id}}">{{ ucwords($utilizer->name) }}</label>
        @endforeach
        <br><br>
        @error('utilizer_id')
            <p style="color: red">{{$message}}</p>
        @enderror

        <span><strong>Ultimo aggiornamento:</strong></span>
        <input type="date" name="lastUpdate" value="{{$device->lastUpdate}}"><br><br>
        @error('lastUpdate')
            <p style="color: red">{{$message}}</p>
        @enderror

        <input type="submit" value="Update">

    </form>

    </div>
    

</div>


@endsection