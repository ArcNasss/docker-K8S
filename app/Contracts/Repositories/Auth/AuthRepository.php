<?php

namespace App\Contracts\Repositories\Auth;

//use App\Contracts\Interfaces\Auth\registerInterface;

use App\Contracts\Interfaces\AuthInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\User;

class AuthRepository extends BaseRepository implements AuthInterface
{
    public function __construct(User $register)
    {
        $this->model = $register;
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    public function login(array $data): mixed
    {
        return $this->model->query()->where('email', $data['email'])->first();
    }
}
