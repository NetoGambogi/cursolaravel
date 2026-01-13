@extends('layouts.main_layout')

@section('content')
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 card p-5">
                <form action="{{ route('password.email') }}" method="post" novalidate>
                    @csrf

                    <p class="display-6 text-center">Recuperar sua senha</p>
                    <div class="mb-3">
                        <label for="email">Escreva seu email:</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('login') }}">Eu sei a minha senha</a>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-secondary px-5">Recuperar senha</button>
                        </div>
                    </div>
                </form>

                {{-- email sent --}}
                @if(session('status') || $errors->any()) 
                    <div class="text-center mt-5">
                        <p>um email foi enviado com instrucoes para recuperar a sua senha.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary px-5">voltar</a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>

@endsection