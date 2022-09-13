@extends('layout')


@section('content')

<div class="section-box">
    <div class="new-item">
        <h3>Registra un nuovo reparto</h3>
        <form action="/department/create" method="POST">

            @csrf

            
            <input type="text" name="name" placeholder="Nome" value="{{old('name')}}" required>
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror

            <input type="submit" value="Registra">

        </form>
    </div>
    <div class="items-list">
        <h3>Reparti</h3>
        @foreach ($departments as $department)
            <div class="item">
                <span>{{$department->name}}</span>
                <form action="/department/{{$department->id}}/destroy" method="post">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Sei sicuro di voler eliminare questo reparto?')">
                        <img src="/icons/delete.svg" alt="delete">
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>


    
@endsection