<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PageInterface;
use App\Models\Page;

class PageRepository extends BaseRepository implements PageInterface
{
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function get(): mixed
    {
        return $this->model->query()->get();
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
        $model = $this->show($id);

        $model->update($data);

        return $model;
    }

    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
    }
}
