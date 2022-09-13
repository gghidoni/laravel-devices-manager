@extends('layout')


@section('content')



<div class="section-box">
    <div class="new-item">
        <h3>Registra una nuova tipologia</h3>
        <form action="/typology/create" method="POST">

            @csrf

            
            <input type="text" name="name" placeholder="Nome" value="{{old('name')}}" required>
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror

            <input type="submit" value="Registra">

        </form>
    </div>
    <div class="items-list">
        <h3>Tipologie</h3>
        @foreach ($typologies as $typology)
            <div class="item">
                
                <span>{{$typology->name}}</span>
                <form action="/typology/{{$typology->id}}/destroy" method="post">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Sei sicuro di voler eliminare questa tipologia?')">
                        <img src="/icons/delete.svg" alt="delete">
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>


    
@endsection