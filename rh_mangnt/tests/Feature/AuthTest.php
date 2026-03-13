<?php

use App\Models\User;

it('mostra a página de login, quando alguém não está logado', function () {

    // verifica no fortify, se ao entrar na página inicial, será redirecionado para a página de login
    $result = $this->get('/')->assertRedirect('/login');

    // verificar se o resultado é status code 302
    expect($result->status())->toBe(302);

    // verificar se a rota de login é acessível com o status 200
    expect($this->get('/login')->status())->toBe(200);

    // verifica se a página de login contém o texto: 'Esqueceu a sua senha?'
    expect($this->get('/login')->content())->toContain("Esqueceu a sua senha?");
});

it('mostra a tela de recuperação de senha corretamente', function () {
    expect($this->get('/forgot-password')->status())->toBe(200);
    expect($this->get('/forgot-password')->content())->toContain("Já sei a minha senha?");
});

it('testar se um usuário admin consegue fazer login com sucesso', function () {

    // criar um admin
    addAdminUser();

    //login com o amdin criado
    $result = $this->post('/login', [
        'email' => 'admin@rhmangnt.com',
        'password' => 'Aa123456'
    ]);


    // verifica se o login foi feito corretamente
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));
});

it('testar se um usuário rh consegue fazer login com sucesso', function () {

    //criar o usuario rh
    addRhUser();

    //login com o rh
    $result = $this->post('/login', [
        'email' => 'rh1@rhmangnt.com',
        'password' => 'Aa123456'
    ]);

    // verifica se o login foi feito corretamente
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o user rh consegue acesso a página exclusiva
    expect($this->get('/rh-users/management/home')->status())->toBe(200);
});

it('testar se um usuário colaborador consegue fazer login com sucesso', function () {

    //criar o usuario colaborador
    addColaboratorUser();

    //login com o colaborador
    $result = $this->post('/login', [
        'email' => 'worker1@rhmangnt.com',
        'password' => 'Aa123456'
    ]);

    // verifica se o login foi feito corretamente
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o colaborador NÃO consegue chegar a rotas exclusivas dos admins
    expect($this->get('/departments')->status())->not()->toBe(200);
});

function addAdminUser()
{
    User::insert([
        'department_id' => 1,   // Administração
        'name' => 'Administrador',
        'email' => 'admin@rhmangnt.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'admin',
        'permissions' => '["admin"]',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

function addRhUser()
{
    User::insert([
        'department_id' => 2,   // RH
        'name' => ' ColaboradorRh',
        'email' => 'rh1@rhmangnt.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'rh',
        'permissions' => '["rh"]',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

function addColaboratorUser()
{
    User::insert([
        'department_id' => 3,   // COLABORADORES
        'name' => ' Colaborador de armazém',
        'email' => 'worker1@rhmangnt.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'colaborator',
        'permissions' => '["colaborator"]',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

