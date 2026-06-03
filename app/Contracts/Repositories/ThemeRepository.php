<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ThemeInterface;
use App\Models\Theme;

class ThemeRepository extends BaseRepository implements ThemeInterface
{
    public function __construct(Theme $theme)
    {
        $this->model = $theme;
    }

    public function get(): mixed
    {
        return $this->model->query()->latest()->get();
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
        $theme = $this->show($id);

        $theme->update($data);

        return $theme;
    }

    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
    }
}
