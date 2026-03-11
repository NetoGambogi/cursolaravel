<?php

// Vou usar uma instância do MainController
use App\Http\Controllers\MainController;

// Vou indicar que quero fazer um teste no método index
test('Teste index main controller', function (){
    
    // Vou criar uma instância do main controoler
    $mainController = new MainController();

    // Chamar o método index
    $result = $mainController->index();

    // verificar se o resultado é uma string
    expect($result)->toBeString();

    expect($result)->toEqual("hello world");

});
