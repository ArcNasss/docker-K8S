<?php

namespace App\Contracts\Interfaces;

interface VariantInterface
{
    public function get(): mixed;

    public function store(array $data): mixed;

    public function show(mixed $id): mixed;

    public function update(mixed $id, array $data): mixed;

    public function delete(mixed $id): mixed;
}
