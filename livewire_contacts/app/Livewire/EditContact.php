<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditContact extends Component
{
    #[Validate('required|min:3|max:50')]
    public $name;
    #[Validate('required|email|min:5|max:50')]
    public $email;
    #[Validate('required|min:5|max:20')]
    public $phone;

    public Contact $contact;

    public function mount($id)
    {
        $this->contact = Contact::find($id);
        $this->name = $this->contact->name;
        $this->email = $this->contact->email;
        $this->phone = $this->contact->phone;
    }

    public function updateContact()
    {
        $this->validate();

        $contact = Contact::where('name', $this->name)
            ->where('email', $this->email)
            ->where('id', '!=', $this->contact->id)
            ->first();

        if ($contact) {
            session()->flash('error', 'Esse contato já existe.');
            return;
        }

        $this->contact->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        return redirect()->route('home');
    }

    #[Title('Editar contato')]
    public function render()
    {
        return view('livewire.edit-contact');
    }
}
