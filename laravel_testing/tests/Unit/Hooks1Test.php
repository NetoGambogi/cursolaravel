<?php

beforeEach(function (){
    $this->number1 = 10;
    $this->number2 = 20;
});

describe('tests com hooks', function () {

    it('test 1', function(){
        expect($this->number1)->toBe(10);
    });

    it('test 2', function(){
        expect($this->number2)->toBe(20);
    });

});

afterEach(function (){
    unset($this->number1);
    unset($this->number2);
});