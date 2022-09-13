@extends('layout')


@section('content')

<div class="section-box">
    <div class="new-item">
        <h3>Registra un nuovo utilizzatore</h3>
        <form action="/utilizer/create" method="POST">

            @csrf

            
            <input type="text" name="name" placeholder="Nome" value="{{old('name')}}" required>
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror

            <input type="submit" value="Registra">

        </form>
    </div>
    <div class="items-list">
        <h3>Utilizzatori</h3>
        @foreach ($utilizers as $utilizer)
            <div class="item">
                
                <span>{{$utilizer->name}}</span>
                <form action="/utilizer/{{$utilizer->id}}/destroy" method="post">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Sei sicuro di voler eliminare questo utilizzatore?')">
                        <img src="/icons/delete.svg" alt="delete">
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
    
@endsection