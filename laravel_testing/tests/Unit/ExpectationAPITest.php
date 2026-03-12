<?php

describe('Teste Funções da api Expectation', function () {

    it('tests a função toBe()', function () {
        $value = 10;

        //valida se o valor é 10
        expect($value)->toBe(10);

        //valida se o valor é inteiro e é igual a 10
        expect($value)
            ->toBeInt()
            ->toBe(10);
    });

    it('tests toBeTrue() e toBeFalse()', function (){

        $value1 = true;
        $value2 = false;

        //valida se o valor é true
        expect($value1)->toBeTrue();
        
        //valida se o valor é false
        expect($value2)->toBeFalse();

    });

    it('tests toBeNull()', function (){

        $value = null;

        //valida se o valor é null
        expect($value)->toBeNull();
    });

    it('tests toBeEmpty()', function (){

        $value = '';

        //valida se o valor é vazio
        expect($value)->toBeEmpty();
    });

    it('tests toBeArray()', function (){

        $value = [];

        //valida se o valor é array
        expect($value)->toBeArray();
    });

    it('tests toBeIn()', function (){

        $value = 10;
        $values = [10, 20, 30];

        //valida se o valor está no array
        expect($value)->toBeIn($values);
    });

    it('tests toBeJson()', function (){

        $value = '{"name":"neto"}';

        //valida se o valor é json
        expect($value)->toBeJson($value);
    });

    it('tests toMatch()', function (){

        $value = 'Ola mundo';

        //valida se o valor bate com a expressão regular
        expect($value)->toMatch('/Ola/');
    });

    it('tests toBeUppercase()', function (){

        $value = 'MUNDO'; // não pode ter espaço

        //valida se o valor ta em maiusculo
        expect($value)->toBeUppercase();
    });
});
