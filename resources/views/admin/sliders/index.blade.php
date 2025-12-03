@extends('admin.layout')

@section('title', 'Slider Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Slider Management</h1>
            <p class="text-gray-400 mt-1">Manage website homepage sliders</p>
        </div>
        <a href="{{ route('admin.sliders.create') }}" class="bg-[#f59e0b] hover:bg-[#d97706] text-white px-6 py-3 rounded-lg transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Slider
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-500/20 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Sliders Grid -->
    @if($sliders->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($sliders as $slider)
        <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden hover:border-[#f59e0b]/50 transition-colors">
            <!-- Slider Image -->
            <div class="relative h-48 bg-gray-900 overflow-hidden">
                @if($slider->image_path)
                    @php
                        $imageUrl = asset('storage/' . $slider->image_path);
                        $fileExists = Storage::disk('public')->exists($slider->image_path);
                    @endphp
                    @if($fileExists)
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $slider->title ?? 'Slider' }}" 
                             class="w-full h-full object-cover"
                             loading="lazy"
                             onerror="console.error('Image failed to load: {{ $imageUrl }}'); this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gray-800\'><div class=\'text-center\'><svg class=\'w-12 h-12 text-gray-600 mx-auto mb-2\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'/></svg><p class=\'text-xs text-red-400\'>Failed to load</p><p class=\'text-xs text-gray-500 mt-1\'>{{ $imageUrl }}</p></div></div>';">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-800">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-xs text-red-400">File Not Found</p>
                                <p class="text-xs text-gray-500 mt-1">Path: {{ $slider->image_path }}</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-xs text-gray-500">No Image Path</p>
                        </div>
                    </div>
                @endif
                @if(!$slider->is_active)
                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded">
                    Inactive
                </div>
                @endif
            </div>
            
            <!-- Slider Info -->
            <div class="p-4">
                <h3 class="text-lg font-semibold text-white mb-2">
                    {{ $slider->title ?? 'Untitled Slider' }}
                </h3>
                @if($slider->description)
                <p class="text-sm text-gray-400 mb-3 line-clamp-2">{{ $slider->description }}</p>
                @endif
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span>Order: {{ $slider->order }}</span>
                    @if($slider->link_url)
                    <a href="{{ $slider->link_url }}" target="_blank" class="text-[#f59e0b] hover:text-[#d97706]">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @endif
                </div>
                
                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('admin.sliders.edit', $slider) }}" 
                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                        Edit
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this slider?');"
                          class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $sliders->links() }}
    </div>
    @else
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-12 text-center">
        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <h3 class="text-xl font-semibold text-white mb-2">No Sliders Found</h3>
        <p class="text-gray-400 mb-6">Get started by creating your first slider</p>
        <a href="{{ route('admin.sliders.create') }}" class="inline-block bg-[#f59e0b] hover:bg-[#d97706] text-white px-6 py-3 rounded-lg transition-colors">
            Add New Slider
        </a>
    </div>
    @endif
</div>
@endsection

