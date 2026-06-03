<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ThemeRequest;
use App\Http\Resources\ThemeResource;
use App\Services\ThemeService;

class ThemeController extends Controller
{
    protected ThemeService $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    public function index()
    {
        try {
            $themes = $this->themeService->handleGet();

            return ResponseHelper::success(
                ThemeResource::collection($themes),
                'Themes retrieved successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to retrieve themes: ' . $e->getMessage()
            );
        }
    }

    public function store(ThemeRequest $request)
    {
        try {
            $data = $request->validated();

            $theme = $this->themeService->handleStore($data);

            return ResponseHelper::success(
                new ThemeResource($theme),
                'Theme created successfully',
                201
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to create theme: ' . $e->getMessage()
            );
        }
    }

    public function show(mixed $id)
    {
        try {
            $theme = $this->themeService->handleShow($id);

            return ResponseHelper::success(
                new ThemeResource($theme),
                'Theme retrieved successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to retrieve theme: ' . $e->getMessage()
            );
        }
    }

    public function update(ThemeRequest $request, mixed $id)
    {
        try {
            $data = $request->validated();

            $theme = $this->themeService->handleUpdate($id, $data);

            return ResponseHelper::success(
                new ThemeResource($theme),
                'Theme updated successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to update theme: ' . $e->getMessage()
            );
        }
    }

    public function destroy(mixed $id)
    {
        try {
            $this->themeService->handleDelete($id);

            return ResponseHelper::success(
                null,
                'Theme deleted successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to delete theme: ' . $e->getMessage()
            );
        }
    }
}
