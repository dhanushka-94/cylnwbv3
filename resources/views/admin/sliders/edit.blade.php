@extends('admin.layout')

@section('title', 'Edit Slider')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Edit Slider</h1>
            <p class="text-gray-400 mt-1">Update slider information</p>
        </div>
        <a href="{{ route('admin.sliders.index') }}" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Current Image -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Current Image
                </label>
                <div class="mt-1">
                    @if($slider->image_path && Storage::disk('public')->exists($slider->image_path))
                        <img src="{{ asset('storage/' . $slider->image_path) }}" 
                             alt="{{ $slider->title ?? 'Slider' }}" 
                             class="max-w-full max-h-64 rounded-lg border border-gray-600"
                             loading="lazy"
                             onerror="console.error('Image failed to load'); this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23374151\' width=\'400\' height=\'300\'/%3E%3Ctext fill=\'%239CA3AF\' font-family=\'sans-serif\' font-size=\'18\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EImage Not Found%3C/text%3E%3C/svg%3E';">
                    @else
                        <div class="max-w-full max-h-64 rounded-lg border border-gray-600 bg-gray-800 flex items-center justify-center p-8">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-500">Image not found or missing</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- New Image Upload -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Replace Image (Optional)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg hover:border-[#f59e0b] transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-400">
                            <label for="image" class="relative cursor-pointer bg-gray-700 rounded-md font-medium text-[#f59e0b] hover:text-[#d97706] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#f59e0b]">
                                <span>Upload new image</span>
                                <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 5MB</p>
                    </div>
                </div>
                <div id="imagePreview" class="mt-4 hidden">
                    <img id="previewImg" src="" alt="Preview" class="max-w-full max-h-64 rounded-lg border border-gray-600">
                </div>
                @error('image')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                    Title (Optional)
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $slider->title) }}"
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-[#f59e0b]"
                       placeholder="Enter slider title">
                @error('title')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                    Description (Optional)
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-[#f59e0b]"
                          placeholder="Enter slider description">{{ old('description', $slider->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Link URL -->
            <div class="mb-6">
                <label for="link_url" class="block text-sm font-medium text-gray-300 mb-2">
                    Link URL (Optional)
                </label>
                <input type="url" 
                       id="link_url" 
                       name="link_url" 
                       value="{{ old('link_url', $slider->link_url) }}"
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-[#f59e0b]"
                       placeholder="https://example.com">
                <p class="mt-1 text-xs text-gray-500">URL to redirect when slider is clicked</p>
                @error('link_url')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-300 mb-2">
                    Display Order
                </label>
                <input type="number" 
                       id="order" 
                       name="order" 
                       value="{{ old('order', $slider->order) }}"
                       min="0"
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-[#f59e0b]"
                       placeholder="0">
                <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                @error('order')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Active -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', $slider->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-[#f59e0b] bg-gray-700 border-gray-600 rounded focus:ring-[#f59e0b] focus:ring-2">
                    <span class="ml-2 text-sm text-gray-300">Active (Show on homepage)</span>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex space-x-4">
                <button type="submit" 
                        class="bg-[#f59e0b] hover:bg-[#d97706] text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Update Slider
                </button>
                <a href="{{ route('admin.sliders.index') }}" 
                   class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection

