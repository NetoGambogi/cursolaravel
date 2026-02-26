<x-layouts.main-layout>

    <div class="display-6 text-center">
        Clientes
    </div>

    <hr>

    <p>Lista de clientes</p>

    @foreach ($clients as $client)
        {{-- <livewire:client-component :$client :key="$client['id']"/> --}}

        @livewire('client-component', ['client' => $client], key($client['id']))
    @endforeach


</x-layouts.main-layout>
