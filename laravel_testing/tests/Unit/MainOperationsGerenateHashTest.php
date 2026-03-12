<?php

use App\Services\MainOperations;


test('testar se uma hash gerada com número de caracteres esperados.', function(){

    expect(strlen(MainOperations::generateHash()))->toBe(32);
    expect(strlen(MainOperations::generateHash(64)))->toBe(64);
    expect(strlen(MainOperations::generateHash(16)))->toBe(16);
    expect(strlen(MainOperations::generateHash(32)))->toBe(32);

});