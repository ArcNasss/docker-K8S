<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\SectionInterface;
use App\Models\Section;

class SectionRepository extends BaseRepository implements SectionInterface
{
    public function __construct(Section $section)
    {
        $this->model = $section;
    }

    public function get(): mixed
    {
        return $this->model->query()
            ->latest()
            ->get();
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }

    public function update(mixed $id, array $data): mixed
    {
        $section = $this->show($id);

        $section->update($data);

        return $section;
    }

    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
    }
}
