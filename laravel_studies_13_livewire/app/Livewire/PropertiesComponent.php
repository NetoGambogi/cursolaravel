<?php

namespace App\Livewire;

use Livewire\Component;

class PropertiesComponent extends Component
{
    public string $value1 = "Propriedade com valor definido";

    public string $value3, $value4;

    public function mount($value3, $value4)
    {
        $this->value3 = $value3;
        $this->value4 = $value4;
    }
    
    public function render()
    {
        
        $value2 = "Propriedade do render";

        return view('livewire.properties-component')->with('value2', $value2);
    }
}
