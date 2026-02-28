<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormContact extends Component
{

    #[Validate('required|min:3|max:50')]
    public $name;
    #[Validate('required|email|min:5|max:50')]
    public $email;
    #[Validate('required|min:5|max:20')]
    public $phone;

    public function newContact()
    {
        // validação
        // $this->validate([
        //     'name' => 'required|min:3|max:50',
        //     'email' => 'required|email|min:5|max:50',
        //     'phone' => 'required|min:5|max:20',
        // ]);

        //outra forma de validacao
        $this->validate();

        // salvar contatos no banco de dados
        $result = Contact::firstOrCreate(
            [
                'name' => $this->name,
                'email' => $this->email,
            ],
            [
                'phone' => $this->phone,
            ]
        );

        //limpar formulario
        // $this->name = '';
        // $this->email = '';
        // $this->phone = '';

        //checar se houve sucesso ou erro
        if ($result->wasRecentlyCreated) {
            //outra opcao de limpar form
            $this->reset();

            //criar um evento
            $this->dispatch('contactAdded');

            //mensagem de sucesso
            $this->dispatch('notification', type: 'success', title: 'Contato criado com sucesso.', position: 'center');

        } else {
            //mensagem de erro
            $this->dispatch('notification', type: 'error', title: 'O contato já existe.', position: 'center');

        }
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
