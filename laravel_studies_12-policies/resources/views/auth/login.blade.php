@extends('layouts.main_layout')
@section('content')

    <div class="d-flex justify-content-center gap-5 mt-5">
        <a href="{{ route('login_user', ['id' => 1])}}" class="btn btn-lg btn-outline-primary px-5">Login Admin</a>
        <a href="{{ route('login_user', ['id' => 2])}}" class="btn btn-lg btn-outline-primary px-5">Login User</a>
        <a href="{{ route('login_user', ['id' => 3])}}" class="btn btn-lg btn-outline-primary px-5">Login Visitante</a>
    </div>

@endsection