<?php

use App\Services\MainOperations;

describe('MainOperations - Testar o método mathOperation', function(){

    it('testa a adição', function(){
        $a = 10;
        $b = 5;
        $operation = "add";

        $result = MainOperations::mathOperation($a, $b, $operation);
        expect($result)->toBe(15);
    });

    it('testa a subtração', function(){
        $a = 10;
        $b = 5;
        $operation = "subtract";

        $result = MainOperations::mathOperation($a, $b, $operation);
        expect($result)->toBe(5);
    });

    it('testa a multiplicação', function(){
        $a = 10;
        $b = 5;
        $operation = "multiply";

        $result = MainOperations::mathOperation($a, $b, $operation);
        expect($result)->toBe(50);
    });

    it('testa a divisão', function(){
        $a = 10;
        $b = 5;
        $operation = "divide";

        $result = MainOperations::mathOperation($a, $b, $operation);
        expect($result)->toBe(2);
    });

});