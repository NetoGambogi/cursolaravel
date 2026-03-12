<?php

describe('Testes com datasets', function(){

    // coleção de dados
    $clients = [
        ['Neto', 20],
        ['Laysa', 18],
        ['Ana', 30],
        ['Joao', 18],
    ];

    //tests
    it('verifica se todos os clientes tem um nome', function($name, $age){

        expect($name)->toBeString();

    })->with($clients);

    it('verifica se todos os clientes tem a idade igual ou maior a 18 (adultos)', function($name, $age){

        expect($age)->toBeGreaterThanOrEqual(18);

    })->with($clients);

});