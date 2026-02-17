<x-layout-app page-title="Novo departamento">

    <div class="w-25 p-4">

        <h3>Novo departamento</h3>

        <hr>

        <form action="{{ route('departments.create-department') }}" method="post">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome do departamento</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <a href="{{route('departments')}}" class="btn btn-outline-danger me-3">Cancelar</a>
                <button type="submit" class="btn btn-primary">Criar departamento</button>
            </div>

        </form>

    </div>

</x-layout-app>