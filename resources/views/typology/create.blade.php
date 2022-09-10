@extends('layout')


@section('content')

    <div class="form">
        <h1>Nuova tipologia</h1>

        <form action="/typology/create" method="POST">

            @csrf

            <input type="text" name="name" placeholder="Nome" value="{{old('name')}}" required><br><br>
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror

            <input type="submit" value="Registra">

        </form>
    </div>

    
@endsection