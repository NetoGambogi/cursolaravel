<?php

it('testa se um usuário admin consegue ver um usuário do RH', function (){

    //cria o admin
    addAdminUser();

    //login com o admin
    auth()->loginUsingId(1);
    
    //verifica se consegue acessar com sucesso a pagina rh users
    expect($this->get('/rh-users')->status())->toBe(200);

});

it('testar se não é possível acessar o home sem um usuário logado', function (){

    // verifica se é possível acessar a pagina home
    expect($this->get('/home')->status())->toBe(302);

    // ou 
    expect($this->get('/home')->status())->not()->toBe(200);

});

it('testar se um usuário logado consegue acessar a página de login', function (){

    //cria o admin
    addAdminUser();

    //login com o admin
    auth()->loginUsingId(1);

    // verifica se é possível acessar a pagina login
    expect($this->get('/login')->status())->toBe(302);


});

it('testar se um usuário logado consegue acessar a página de recuperação de senha', function (){

    //cria o admin
    addAdminUser();

    //login com o admin
    auth()->loginUsingId(1);

    // verifica se é possível acessar a pagina recuperar senha
    expect($this->get('/forgot-password')->status())->toBe(302);


});