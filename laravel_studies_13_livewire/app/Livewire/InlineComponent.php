<?php

namespace App\Livewire;

use Livewire\Component;

class InlineComponent extends Component
{
    public string $name = "Valor da propriedade";

    public string $value, $php_value;

    public function mount($value, $php_value)
    {
        $this->value = $value;
        $this->php_value = $php_value;
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            
            <p class="display-6 text-center text-info">Conteudo de um componente inline</p>

            <p class="display-6 text-center text-info">O valor da propriedade é: <strong class="text-warning">{{ $name }}</strong></p>

            <p class="display-6 text-center text-info">O valor passado para o component é: <strong class="text-warning">{{ $value }}</strong></p>

            <p class="display-6 text-center text-info">O valor passado para o component é (php): <strong class="text-warning">{{ $php_value }}</strong></p>

        </div>
        HTML;
    }
}
