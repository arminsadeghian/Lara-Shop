<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tags\StoreTagRequest;
use App\Http\Requests\Admin\Tags\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(20);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $validatedData = $request->validated();

        Tag::create([
            'name' => $validatedData['name']
        ]);

        return back()->with('success', 'تگ مورد نظر ایجاد شد');
    }

    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $validatedData = $request->validated();

        $tag->update([
            'name' => $validatedData['name']
        ]);

        return back()->with('success', 'تگ مورد نظر ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
}
