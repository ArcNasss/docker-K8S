<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\VariantRequest;
use App\Http\Resources\VariantResource;
use App\Services\VariantService;

class VariantController extends Controller
{
    protected VariantService $variantService;

    public function __construct(VariantService $variantService)
    {
        $this->variantService = $variantService;
    }

    public function index()
    {
        try {
            $variants = $this->variantService->handleGet();

            return ResponseHelper::success(
                VariantResource::collection($variants),
                'Variants retrieved successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to retrieve variants: ' . $e->getMessage()
            );
        }
    }

    public function store(VariantRequest $request)
    {
        try {
            $data = $request->validated();

            $variant = $this->variantService->handleStore($data);

            return ResponseHelper::success(
                new VariantResource($variant->load(['theme', 'section'])),
                'Variant created successfully',
                201
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to create variant: ' . $e->getMessage()
            );
        }
    }

    public function show(mixed $id)
    {
        try {
            $variant = $this->variantService->handleShow($id);

            return ResponseHelper::success(
                new VariantResource($variant),
                'Variant retrieved successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to retrieve variant: ' . $e->getMessage()
            );
        }
    }

    public function update(VariantRequest $request, mixed $id)
    {
        try {
            $data = $request->validated();

            $variant = $this->variantService->handleUpdate($id, $data);

            return ResponseHelper::success(
                new VariantResource($variant),
                'Variant updated successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to update variant: ' . $e->getMessage()
            );
        }
    }

    public function destroy(mixed $id)
    {
        try {
            $this->variantService->handleDelete($id);

            return ResponseHelper::success(
                null,
                'Variant deleted successfully'
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                'Failed to delete variant: ' . $e->getMessage()
            );
        }
    }
}
