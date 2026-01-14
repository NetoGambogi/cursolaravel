<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make(
            $input,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ],
            // errors messages
            [
                'name.required' => 'o campo nome é obrigatório',
                'name.string' => 'o nome deve ser um texto',
                'name.max' => 'o nome deve ter no maximo :max caracteres',
                'email.required' => 'o email é obrigatório',
                'email.email' => 'o email deve ser válido',
                'email.unique' => 'esse email já está cadastrado',
                'password.required' => 'a senha é obrigatoria',
                'password.min' => 'a senha deve ter no minimo :min caracteres.',
                'password.confirmed' => 'as senhas não são iguais.',
            ]
        )->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
