<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::ordered()->paginate(20);
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:5120', // 5MB max
            'link_url' => 'nullable|url|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $uploadPath = 'sliders/' . date('Y/m');
                if (!Storage::disk('public')->exists($uploadPath)) {
                    Storage::disk('public')->makeDirectory($uploadPath);
                }
                
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs($uploadPath, $filename, 'public');
            }

            Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'link_url' => $request->link_url,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()->route('admin.sliders.index')
                ->with('success', 'Slider created successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create slider: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120', // 5MB max
            'link_url' => 'nullable|url|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'link_url' => $request->link_url,
                'order' => $request->order ?? $slider->order,
                'is_active' => $request->has('is_active') ? true : false,
            ];

            // Handle image upload if new image is provided
            if ($request->hasFile('image')) {
                // Delete old image
                if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
                    Storage::disk('public')->delete($slider->image_path);
                }

                // Upload new image
                $uploadPath = 'sliders/' . date('Y/m');
                if (!Storage::disk('public')->exists($uploadPath)) {
                    Storage::disk('public')->makeDirectory($uploadPath);
                }
                
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $data['image_path'] = $image->storeAs($uploadPath, $filename, 'public');
            }

            $slider->update($data);

            return redirect()->route('admin.sliders.index')
                ->with('success', 'Slider updated successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update slider: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        try {
            // Delete image file
            if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
                Storage::disk('public')->delete($slider->image_path);
            }

            $slider->delete();

            return redirect()->route('admin.sliders.index')
                ->with('success', 'Slider deleted successfully!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.sliders.index')
                ->with('error', 'Failed to delete slider: ' . $e->getMessage());
        }
    }
}
