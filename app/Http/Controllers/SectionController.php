<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Services\SectionService;

class SectionController extends Controller
{
    protected SectionService $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        try {
            $sections = $this->sectionService->handleGet();

            return ResponseHelper::success(
                SectionResource::collection($sections),
                'Sections retrieved successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to retrieve sections: ' . $e->getMessage()
            );
        }
    }

    public function store(SectionRequest $request)
    {
        try {
            $data = $request->validated();

            $section = $this->sectionService->handleStore($data);

            return ResponseHelper::success(
                new SectionResource($section),
                'Section created successfully',
                201
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to create section: ' . $e->getMessage()
            );
        }
    }

    public function show(mixed $id)
    {
        try {
            $section = $this->sectionService->handleShow($id);

            return ResponseHelper::success(
                new SectionResource($section),
                'Section retrieved successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to retrieve section: ' . $e->getMessage()
            );
        }
    }

    public function update(SectionRequest $request, mixed $id)
    {
        try {
            $data = $request->validated();

            $section = $this->sectionService->handleUpdate($id, $data);

            return ResponseHelper::success(
                new SectionResource($section),
                'Section updated successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to update section: ' . $e->getMessage()
            );
        }
    }

    public function destroy(mixed $id)
    {
        try {
            $this->sectionService->handleDelete($id);

            return ResponseHelper::success(
                null,
                'Section deleted successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to delete section: ' . $e->getMessage()
            );
        }
    }
}
