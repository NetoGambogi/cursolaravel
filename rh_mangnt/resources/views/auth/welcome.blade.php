<x-layout-guest page-title="Bem vindo">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                {{-- logo --}}
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>

                {{-- mensagem de boas vindas --}}

                <div class="card p-5 text-center">
                    <p>Bem vindo, <strong>{{ $user->name }}</strong>!</p>
                    <p>Sua conta foi criada com sucesso!</p>
                    <p>Você já pode <a href="{{route('login')}}">entrar</a> na sua conta.</p>
                </div>

            </div>
        </div>
    </div>


</x-layout-guest>