<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\VariantInterface;
use App\Models\Variant;

class VariantRepository extends BaseRepository implements VariantInterface
{
    public function __construct(Variant $variant)
    {
        $this->model = $variant;
    }

    public function get(): mixed
    {
        return $this->model->query()
            ->with(['theme', 'section'])
            ->latest()
            ->get();
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->with(['theme', 'section'])
            ->findOrFail($id);
    }

    public function update(mixed $id, array $data): mixed
    {
        $variant = $this->show($id);

        $variant->update($data);

        return $variant->fresh(['theme', 'section']);
    }

    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
    }
}
