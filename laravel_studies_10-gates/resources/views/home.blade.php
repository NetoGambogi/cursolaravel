<x-layout.main-layout>

    <div class="container">
        <div class="row">
            <div class="col">
                
                
                <ul class="display-6">
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @else

                        @can('user_is_admin')
                            <li><a href="{{ route('only_admin')}}">Somente adm</a></li>
                        @endcan
                        
                        @can('user_is_user')
                            <li><a href="{{ route('only_user')}}">Somente user</a></li>
                        @endcan
                        
                    @endguest
                </ul>
                
                

            </div>
        </div>

        <div class="row">
            <div class="col">

                @can('user_is_admin')
                    <p>admin</p>
                @else
                    <p>nao admin</p>
                @endcan

                @cannot('user_is_admin') 
                    <p>usuario</p>
                @endcannot

                @canany(['user_is_admin', 'user_is_user'])
                    <p>Oi, todos usuarios</p>
                @endcanany

                {{-- <hr>

                @can('user_can_insert')
                    <p>Usuário pode inserir</p>
                @endcan

                @can('user_can_delete')
                    <p>Usuário pode deletar</p>
                @endcan --}}

                <hr>

                @can('user_can', 'insert')
                    <p>Usuário pode inserir</p>
                @endcan

                @can('user_can', 'delete')
                    <p>Usuário pode deletar</p>
                @endcan
                
                

            </div>
        </div>
    </div>

</x-layout.main-layout>