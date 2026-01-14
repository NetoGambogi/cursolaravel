@extends('layouts.main_layout')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col">

            <p class="display-6 text-info">Essa página é acessível pra todos os usuários, (Logados ou não logados).</p>

            <hr>

            @auth
                <p class="display-6 text-success">Esse texto só é visível a usuários logados.</p>
            @endauth

            @guest
                <p class="display-6 text-warning">Esse texto só é visível a visitantes..</p>
            @endguest

            {{-- Também funciona como um if e else. Dessa maneira: --}}

            {{-- 
            
            @auth
                <p class="display-6 text-success">Esse texto só é visível a usuários logados.</p>
            @else
                <p class="display-6 text-warning">Esse texto só é visível a visitantes..</p>
            @endauth 
            
            --}}
        </div>
    </div>

</div>

@endsection