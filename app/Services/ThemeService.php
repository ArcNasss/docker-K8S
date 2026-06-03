<?php

namespace App\Services;

use App\Contracts\Interfaces\ThemeInterface;

class ThemeService
{
    protected ThemeInterface $themeInterface;

    public function __construct(ThemeInterface $themeInterface)
    {
        $this->themeInterface = $themeInterface;
    }

    public function handleGet(): mixed
    {
        return $this->themeInterface->get();
    }

    public function handleStore(array $data): mixed
    {
        $data['is_active'] = $data['is_active'] ?? true;

        return $this->themeInterface->store($data);
    }

    public function handleShow(mixed $id): mixed
    {
        return $this->themeInterface->show($id);
    }

    public function handleUpdate(mixed $id, array $data): mixed
    {
        return $this->themeInterface->update($id, $data);
    }

    public function handleDelete(mixed $id): mixed
    {
        return $this->themeInterface->delete($id);
    }
}
