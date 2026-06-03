<?php

namespace App\Services;

use App\Contracts\Interfaces\VariantInterface;

class VariantService
{
    protected VariantInterface $variantInterface;

    public function __construct(VariantInterface $variantInterface)
    {
        $this->variantInterface = $variantInterface;
    }

    public function handleGet(): mixed
    {
        return $this->variantInterface->get();
    }

    public function handleShow(mixed $id): mixed
    {
        return $this->variantInterface->show($id);
    }

    public function handleStore(array $data): mixed
    {
        $data['is_active'] = $data['is_active'] ?? true;

        return $this->variantInterface->store($data);
    }

    public function handleUpdate(mixed $id, array $data): mixed
    {
        return $this->variantInterface->update($id, $data);
    }

    public function handleDelete(mixed $id): mixed
    {
        return $this->variantInterface->delete($id);
    }
}
