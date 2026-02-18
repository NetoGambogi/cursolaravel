<x-layout-app page-title="Recursos Humanos">

<div class="w-100 p-4">

    <h3>Colaboradores Recursos Humanos</h3>

    <hr>
    
    @if($colaborators->count() === 0)

        <div class="text-center my-5">
            <p>Nenhum colaborador encontrado.</p>
            <a href="{{ route('colaborators.rh.new-colaborator') }}" class="btn btn-primary">Criar novo colaborador</a>
        </div>

    @else

        <div class="mb-3">
            <a href="{{ route('colaborators.rh.new-colaborator') }}" class="btn btn-primary">Criar novo colaborador</a>
        </div>

        <table class="table" id="table">
            <thead class="table-dark">
                <th>Nome</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Salário</th>
                <th>Data de admissão</th>
                <th>Cidade</th>
                <th></th>
            </thead>
            <tbody>

                @foreach($colaborators as $colaborator)
                    <tr>
                        <td>{{ $colaborator->name }}</td>
                        <td>{{ $colaborator->email }}</td>
                        <td>{{ $colaborator->role }}</td>
                        <td>R$ {{ $colaborator->detail->salary }}</td>
                        <td>{{ $colaborator->detail->admission_date }}</td>
                        <td>{{ $colaborator->detail->city }}</td>

                        <td>
                            <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('colaborators.rh.edit-colaborator', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    <a href="{{ route('colaborators.rh.delete-colaborator', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    @endif

</div>

</x-layout-app>