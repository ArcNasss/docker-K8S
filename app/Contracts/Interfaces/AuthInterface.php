<?php

namespace App\Contracts\Interfaces;


interface AuthInterface
{
    public function store(array $data): mixed;
    public function login(array $data): mixed;
}
