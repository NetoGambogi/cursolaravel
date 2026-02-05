@extends('layouts.main_layout')
@section('content')

    @if($posts->count() == 0)

        <div class="my-5 opacity-50">
            Não foi encontrado posts.
        </div>
    
    @else 

        <div class="container">
            <div class="row">
                <div class="col">

                    @foreach ($posts as $post)
                       
                        @can('view', $post)
                            <x-post-component :post="$post" />
                        @endcan

                    @endforeach

                </div>
            </div>
        </div>

    @endif

@endsection