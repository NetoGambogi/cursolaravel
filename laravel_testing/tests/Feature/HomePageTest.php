<?php

test('Verificar se a home page está disponível', function () {
    $response = $this->get('/');

    // $response->assertStatus(200);

    expect($response->status())->toBe(200);
});
