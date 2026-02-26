<div>
    
    <form wire:submit="submitForm">

        <input wire:model="name" type="text" placeholder="Name">
        <input wire:model="email" type="email" placeholder="Email">
        <button>Submit</button>


    </form>

    <hr>

    <p>Name: {{$name}}</p>
    <p>Email: {{$email}}</p>

</div>
