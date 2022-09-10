@extends('layout')

@section('content')

    <div class="form">
        <h1>Nuovo Dispositivo</h1>

        <form action="/device/create" method="POST">
            @csrf

            <input type="text" name="serial" placeholder="Seriale" value="{{old('serial')}}" required><br><br>
            @error('serial')
                <p style="color: red">{{$message}}</p>
            @enderror

            <input type="text" name="description" placeholder="Descrizione" value="{{old('description')}}" required><br><br>
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
                    <option value="{{$typology->id}}">{{ ucwords($typology->name) }}</option>
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
                    <option value="{{$department->id}}">{{ ucwords($department->name) }}</option>
                @endforeach
            </select><br><br>
            @error('department_id')
                <p style="color: red">{{$message}}</p>
            @enderror

            

            <span><strong>Utilizzatori:</strong></span>
           
                @php
                    $utilizers = \App\Models\Utilizer::all();
                @endphp
                @foreach ($utilizers as $utilizer)
                    <input type="checkbox" name="utilizer_id[]" id="{{$utilizer->id}}" value="{{$utilizer->id}}"><label for="{{$utilizer->id}}">{{ ucwords($utilizer->name) }}</label>
                @endforeach
                <br><br>
            @error('utilizer_id')
                <p style="color: red">{{$message}}</p>
            @enderror


            <span><strong>Ultimo aggiornamento:</strong></span>
            <input type="date" name="lastUpdate" placeholder="Ultimo aggiornamento" value="{{old('lastUpdate')}}"><br><br>
            @error('lastUpdate')
                <p style="color: red">{{$message}}</p>
            @enderror


            <input type="submit" value="Pubblica">


        </form>
    </div>

    


@endsection