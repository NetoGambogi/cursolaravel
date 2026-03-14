<?php

namespace App\Services;

class GeneralServices
{
    public static function checkIfSalaryIsGreaterThan($salary, $amount)
    {
        return $salary > $amount;
    }

    public static function createPhraseWithNameAndSalary($name, $salary)
    {
        return "O salário do $name é R$ $salary";
    }

    public static function getSalaryWithBonus($salary, $bonus)
    {
        return $salary + $bonus;
    }

    public static function fakeDataInJson()
    {
        // cria 10 clientes com dados falsos
        $clients = [];

        for($i=0; $i <10; $i++){
            $clients[] = [
                'name' => \Faker\Factory::create()->name(),
                'email' => \Faker\Factory::create()->email(),
                'phone' => \Faker\Factory::create()->phoneNumber(),
                'address' => \Faker\Factory::create()->address(),
            ];
        }

        return json_encode($clients, JSON_PRETTY_PRINT);
    }
}