<?php

namespace App\Livewire;

use Livewire\Component;

class ClientComponent extends Component
{
    public $client;

    public function mount($client)
    {
        $this->client = $client;
    }
    
    public function render()
    {
        return view('livewire.client-component');
    }
}
