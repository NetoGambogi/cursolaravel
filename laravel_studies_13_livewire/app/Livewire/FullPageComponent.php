<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class FullPageComponent extends Component
{
    // #[Layout('components.layouts.new-layout')]

    #[Title('Full Page Component')]

    public $number1, $number2, $sum_result;

    public function mount($number1, $number2)
    {
        $this->number1 = $number1;
        $this->number2 = $number2;
        $this->sum_result = $number1 + $number2;
    }

    public function render()
    {
        return view('livewire.full-page-component')->layout('components.layouts.new-layout');
    }
}
