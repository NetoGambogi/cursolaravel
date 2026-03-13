<?php

use App\Models\User;
use App\Models\Department;

it('testa se o admin consegue inserir um novo rh user', function () {

    // criar um admin
    addAdminUser();

    // criar os departamentos
    addDepartment('Administração');
    addDepartment('Recursos Humanos');

    //login com o amdin criado
    $result = $this->post('/login', [
        'email' => 'admin@rhmangnt.com',
        'password' => 'Aa123456'
    ]);

    // verifica se o login foi feito corretamente
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o admin consegue adicionar o user RH
    $result = $this->post('/rh-users/create-colaborator', [
        'name' => 'RH user 1',
        'email' => 'rhuser@gmail.com',
        'select_department' => 2,
        'address' => 'Rua 1',
        'zip_code' => '123456546',
        'city' => 'city 1',
        'phone' => '123456789',
        'salary' => '1000.00',
        'admission_date' => '2021-01-10',
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);

    // verifica se o user RH foi adicionado com sucesso.
    $this->assertDatabaseHas('users', [
        'name' => 'RH user 1',
        'email' => 'rhuser@gmail.com',
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);
});

function addDepartment($name)
{
    Department::insert([
        'name' => $name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
