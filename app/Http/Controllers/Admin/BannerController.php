<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banners\StoreBannerRequest;
use App\Http\Requests\Admin\Banners\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $validatedData = $request->validated();

        $imageFileName = fileNameToHash($validatedData['image']->getClientOriginalName());
        $validatedData['image']->move(public_path('\images\banners'), $imageFileName);

        Banner::create([
            'image' => $imageFileName,
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
            'priority' => $validatedData['priority'],
            'is_active' => $validatedData['is_active'],
            'type' => $validatedData['type'],
            'button_text' => $validatedData['button_text'],
            'button_link' => $validatedData['button_link'],
            'button_icon' => $validatedData['button_icon'],
        ]);

        return back()->with('success', 'بنر مورد نظر ایجاد شد');
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $validatedData = $request->validated();

        if ($request->has('image')) {
            $imageFileName = fileNameToHash($validatedData['image']->getClientOriginalName());
            $validatedData['image']->move(public_path('\images\banners'), $imageFileName);
            $banner->update([
                'image' => $imageFileName,
            ]);
        }

        $banner->update([
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
            'priority' => $validatedData['priority'],
            'is_active' => $validatedData['is_active'],
            'type' => $validatedData['type'],
            'button_text' => $validatedData['button_text'],
            'button_link' => $validatedData['button_link'],
            'button_icon' => $validatedData['button_icon'],
        ]);

        return back()->with('success', 'بنر مورد نظر ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
}
