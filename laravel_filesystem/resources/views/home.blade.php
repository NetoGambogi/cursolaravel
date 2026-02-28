<x-main-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <p class="text-center display-3">Laboratório de FileSystem</p>
                <hr>
                <div class="d-flex gap-5 mb-5">
                    <a href="{{ route('storage.local.create') }}" class="btn btn-primary">Criar arquivo no storage local</a>
                    <a href="{{ route('storage.local.append') }}" class="btn btn-primary">Adicionar conteúdo no storage local</a>
                    <a href="{{ route('storage.local.read') }}" class="btn btn-primary">Ler conteúdo no storage local</a>
                    <a href="{{ route('storage.local.read.multi') }}" class="btn btn-primary">Ler arquivo com multiplas linhas no storage local</a>
                </div>

                <div class="d-flex gap-5">
                    <a href="{{ route('storage.local.check.file') }}" class="btn btn-primary">Verificar a existencia de arquivo</a>
                    <a href="{{ route('storage.local.store.json') }}" class="btn btn-primary">Salvar Json</a>
                    <a href="{{ route('storage.local.read.json') }}" class="btn btn-primary">Ler Json</a>
                    <a href="{{ route('storage.local.list') }}" class="btn btn-primary">Listar Arquivos</a>
                </div>
            </div>
        </div>
    </div>

</x-main-layout>