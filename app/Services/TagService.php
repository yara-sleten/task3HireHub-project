<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getAll()
    {
        return Tag::with('projects:id,title')->get();
    }

    public function getById($id)
    {
        return Tag::with('projects:id,title')
            ->findOrFail($id);
    }

    public function store($data)
    {
        return Tag::create($data);
    }

    public function update($tag, $data)
    {
        $tag->update($data);

        return $tag;
    }

    public function delete($tag)
    {
        return $tag->delete();
    }
}