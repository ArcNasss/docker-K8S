<?php

namespace App\Services\Auth;

use App\Contracts\Interfaces\AuthInterface;
use App\Contracts\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    protected AuthInterface $authInterface;
    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function handleRegister(array $data): array
    {
        $plainPassword = $data['password'];
        unset($data['password_confirmation']);
        $data['password'] = Hash::make($plainPassword);
        $user = $this->authInterface->store($data);
        $user->assignRole('admin_tenant');

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
            ],
            'token' => $token,
        ];
    }
}
