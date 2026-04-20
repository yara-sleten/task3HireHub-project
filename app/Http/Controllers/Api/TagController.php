<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    public function __construct(
        private TagService $service
    ) {}

    public function index()
    {
        return response()->json(
            $this->service->getAll()
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->service->getById($id)
        );
    }

    public function store(StoreTagRequest $request)
    {
        $tag = $this->service->store($request->validated());

        return response()->json($tag, 201);
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $this->service->getById($id);

        return response()->json(
            $this->service->update($tag, $request->validated())
        );
    }

    public function destroy($id)
    {
        $tag = $this->service->getById($id);

        $this->service->delete($tag);

        return response()->json([
            'message' => 'Tag deleted successfully'
        ]);
    }
}