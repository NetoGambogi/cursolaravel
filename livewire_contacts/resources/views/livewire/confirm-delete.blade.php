<div>
    <div class="text-center">
        <p>
            Você realmente deseja deletar esse contato?
        </p>
        <p>Nome: <br><strong class="text-white">{{ $contact->name }}</strong></p>
        <p>Email: <br><strong class="text-white">{{ $contact->email }}</strong></p>
        <p>Telefone: <br><strong class="text-white">{{ $contact->phone }}</strong></p>

        <button wire:click="cancel" class="btn btn-primary px-5">Não</button>
        <button wire:click="delete" class="btn btn-danger px-5">Sim</button>

    </div>
</div>
