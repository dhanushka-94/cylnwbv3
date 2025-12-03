@extends('admin.layout')

@section('title', 'Create Slider')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Create New Slider</h1>
            <p class="text-gray-400 mt-1">Add a new slider to the homepage</p>
        </div>
        <a href="{{ route('admin.sliders.index') }}" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Image Upload -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Slider Image <span class="text-red-400">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg hover:border-[#f59e0b] transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-400">
                            <label for="image" class="relative cursor-pointer bg-gray-700 rounded-md font-medium text-[#f59e0b] hover:text-[#d97706] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#f59e0b]">
                                <span>Upload an image</span>
                                <input id="image" name="image" type="file" accept="image/*" class="sr-only" required onchange="previewImage(this)">
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
                       value="{{ old('title') }}"
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
                          placeholder="Enter slider description">{{ old('description') }}</textarea>
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
                       value="{{ old('link_url') }}"
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
                       value="{{ old('order', 0) }}"
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
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-[#f59e0b] bg-gray-700 border-gray-600 rounded focus:ring-[#f59e0b] focus:ring-2">
                    <span class="ml-2 text-sm text-gray-300">Active (Show on homepage)</span>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex space-x-4">
                <button type="submit" 
                        class="bg-[#f59e0b] hover:bg-[#d97706] text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Create Slider
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

