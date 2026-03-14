<?php

use App\Services\GeneralServices;

it('testa se o salário é maior que o valor especificado', function() {

    $salary = 1000;
    $amount = 500;

    $result = GeneralServices::checkIfSalaryIsGreaterThan($salary, $amount);

    expect($result)->toBeTrue();

});

it('testa se o salário NÃO é maior que o valor especificado', function() {

    $salary = 1000;
    $amount = 1500;

    $result = GeneralServices::checkIfSalaryIsGreaterThan($salary, $amount);

    expect($result)->toBeFalse();

});

it('testa se a frase foi criada corretamente', function (){

    $name = "Neto Gambogi";
    $salary = 1000;

    $result = GeneralServices::createPhraseWithNameAndSalary($name, $salary);

    expect($result)->toBe("O salário do Neto Gambogi é R$ 1000");

});

it('testa se o salário com o bonus foi calculado corretamente', function (){

    $salary = 1000;
    $bonus = 200;

    $result = GeneralServices::getSalaryWithBonus($salary, $bonus);

    expect($result)->toBe(1200);

});

it('testa se os dados falsos do json foram criados corretamente.', function(){

    $results = GeneralServices::fakeDataInJson();

    $clients = json_decode($results, true);

    expect(count($clients))->toBeGreaterThanOrEqual(1);
    expect($clients[0])->toHaveKeys(['name','email','phone','address']);

});