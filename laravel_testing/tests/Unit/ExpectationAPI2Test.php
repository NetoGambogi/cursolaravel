<?php

describe('Teste Funções da api Expectation', function () {

    it('tests o and() modifier', function () {
        $name = "neto";
        $surname = "gambogi";

        expect($name)->toBe("neto")->and($surname)->toBe("gambogi");
    });

    it('tests se o valor é um ou outro', function () {
        $value = 10;

        expect($value)->toBeIn([10, 20]);
    });

    it('tests o not() modifier', function () {
        $value = 10;

        expect($value)->not()->toBe(20);
    });

    it('tests uma sequence() modifier', function () {
        $values = [1, 3, 5];

        expect($values)->sequence(
            fn($value) => $value->toBeInt()->toBe(1),
            fn($value) => $value->toBeInt()->toBe(3),
            fn($value) => $value->toBeInt()->toBe(5),
        );
    });
});
