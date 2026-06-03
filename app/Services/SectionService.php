<?php

namespace App\Services;

use App\Contracts\Interfaces\SectionInterface;
use Illuminate\Support\Str;

class SectionService
{
    protected SectionInterface $sectionInterface;

    public function __construct(SectionInterface $sectionInterface)
    {
        $this->sectionInterface = $sectionInterface;
    }

    public function handleGet(): mixed
    {
        return $this->sectionInterface->get();
    }

    public function handleShow(mixed $id): mixed
    {
        return $this->sectionInterface->show($id);
    }

    public function handleStore(array $data): mixed
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $data['is_active'] ?? true;

        return $this->sectionInterface->store($data);
    }

    public function handleUpdate(mixed $id, array $data): mixed
    {
        if (isset($data['name']) && ! isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->sectionInterface->update($id, $data);
    }

    public function handleDelete(mixed $id): mixed
    {
        return $this->sectionInterface->delete($id);
    }
}
