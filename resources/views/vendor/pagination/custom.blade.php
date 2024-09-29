<!-- Previous Page Link -->
@if ($prestasi->onFirstPage())
    <span class="px-3 py-2 bg-gray-300 text-gray-500 rounded">«</span>
@else
    <a href="#" class="pagination-link px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" data-page="{{ $prestasi->currentPage() - 1 }}">«</a>
@endif

<!-- Pagination Elements -->
@php
    $totalPages = $prestasi->lastPage();
    $currentPage = $prestasi->currentPage();
    $startPage = max(1, $currentPage - 1); // Start from 1 before current page
    $endPage = min($totalPages, $startPage + 2); // Show only 3 pages max
@endphp

<!-- Pagination Numbers -->
@for ($i = $startPage; $i <= $endPage; $i++)
    @if ($i == $currentPage)
        <span class="px-3 py-2 bg-purple-600 text-white rounded">{{ $i }}</span>
    @else
        <a href="#" class="pagination-link px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" data-page="{{ $i }}">{{ $i }}</a>
    @endif
@endfor

<!-- Next Page Link (Show if more pages exist) -->
@if ($endPage < $totalPages)
    <a href="#" class="pagination-link px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" data-page="{{ $currentPage + 1 }}">»</a>
@endif
