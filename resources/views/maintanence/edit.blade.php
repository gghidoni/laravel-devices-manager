@extends('layout')

@section('content')

    <div class="section-box">
        <div class="new-item">
            <h3>Modifica log manutenzione</h3>

            <form action="/devices/{{$device->serial}}/maintanence/{{$service->id}}/update" method="POST">
                @csrf
                @method('PATCH')

                <textarea name="description" cols="80" rows="10" required>{{ $service->description }}</textarea><br><br>
                @error('description')
                    <p style="color: red">{{$message}}</p>
                @enderror

                @php
                    
                @endphp
                <input type="checkbox" name="is_update" id="si" value="1" {{ $service->is_update == 1 ? 'checked' : '' }}><label class="check" for="si">Aggiornamento di sistema</label><br><br>


                <input type="submit" value="invia">


            </form>
        </div>
        
        
    </div>
    
    

@endsection