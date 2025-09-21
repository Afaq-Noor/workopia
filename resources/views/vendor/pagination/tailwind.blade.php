@if ($paginator->hasPages())
    <nav class="flex justify-center space-x-1" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-l-lg">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-l-lg">
               Previous
            </a>
        @endif

        {{-- Page Numbers --}}
@foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
        <span class="px-4 py-2 text-gray-500">{{ $element }}</span>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                {{-- Active Page --}}
                <span class="px-4 py-2 bg-blue-600 text-white rounded">{{ $page }}</span>
            @else
                {{-- Inactive Page --}}
                <a href="{{ $url }}" 
                   class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">
                   {{ $page }}
                </a>
            @endif
        @endforeach
    @endif
@endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-r-lg">
               Next
            </a>
        @else
            <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-r-lg">Next</span>
        @endif
    </nav>

    
@endif
