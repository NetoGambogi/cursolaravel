<?php

namespace App\Livewire;

use Livewire\Component;

class FormComponent extends Component
{
    public $name;
    public $email;

    public function submitForm()
    {
        $this->name;
        $this->email;
    }

    public function render()
    {
        return view('livewire.form-component');
    }
}
