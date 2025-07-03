<div class="align-items-center mt-2 row g-3 text-center text-sm-start">
    <div class="col-sm">
        <div class="text-muted">
            Showing <span class="fw-semibold">{{ $paginator->firstItem() }}</span> to
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span> of
            <span class="fw-semibold">{{ $paginator->total() }}</span> Results
        </div>
    </div>
    <div class="col-sm-auto">
        <ul class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">←</span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link">←</a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link">→</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">→</span>
                </li>
            @endif
        </ul>
    </div>
</div>
