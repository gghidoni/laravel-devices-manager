@extends('layout')

@section('content')

    <div class="section-box">
        <div class="new-item">
            <h3>Nuovo log manutenzione</h3>

            <form action="/devices/{{$device->serial}}/maintanence/create" method="POST">
                @csrf

                <textarea name="description" cols="80" rows="10" placeholder="Descrizione" value="{{ old('description') }}" required></textarea><br><br>
                @error('description')
                    <p style="color: red">{{$message}}</p>
                @enderror

                <input type="checkbox" name="is_update" id="si" value="1"><label class="check" for="si">Aggiornamento di sistema</label><br><br>

                <input type="submit" value="invia">


            </form>
        </div>
        
        
    </div>
    
    

@endsection