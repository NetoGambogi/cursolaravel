<x-layouts.main-layout>
    
    <div class="display-6 text-center">Livewire</div>
    <hr>

    {{-- @livewire('counter')

    <hr>

    <p>Inline component</p>

    @php
        $php_value = "valor em php"
    @endphp

    <livewire:inline-component value="Valor direto" :php_value="$php_value" /> --}}

    {{-- <livewire:properties-component value3="valor literal" :value4="$value4" /> --}}

    @livewire('form-component')

</x-layouts.main-layout>