<x-main-layout>

    <div class="container">
        <p class="display-6 mt-5">Arquivos para download</p>

        <hr>

        <div class="row">

            @foreach ($files as $file)
                <div class="col-12 card p-2">
                    <ul>
                        <li>Nome: <strong>{{ $file['name'] }}</strong></li>
                        <li>Tamanho: <strong>{{ $file['size'] }}</strong></li>
                        <li>Download: <a href="{{ route('download', ['file' => $file['file']]) }}">Download</a></li>
                    </ul>
                </div>
            @endforeach

        </div>

    </div>

</x-main-layout>