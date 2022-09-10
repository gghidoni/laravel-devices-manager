@extends('layout')


@section('content')

    <div class="form">
        <h1>Nuovo utilizzatore</h1>

        <form action="/utilizer/create" method="POST">

            @csrf

            <input type="text" name="name" placeholder="Nome" value="{{old('name')}}" required><br><br>
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror

            <input type="submit" value="Registra">

        </form>
    </div>

    
@endsection