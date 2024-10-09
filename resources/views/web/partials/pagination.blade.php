@if ($paginator->hasPages())
    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            {{-- Hiển thị các trang đầu tiên: trang 1, 2, 3 --}}
            @if ($paginator->lastPage() > 5)
                @for ($i = 1; $i <= 3; $i++)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Hiển thị dấu ... nếu trang hiện tại > 4 --}}
                @if ($paginator->currentPage() > 4)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif

                {{-- Hiển thị trang hiện tại và trang kề cận --}}
                @for ($i = max(4, $paginator->currentPage() - 1); $i <= min($paginator->lastPage() - 2, $paginator->currentPage() + 1); $i++)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Hiển thị dấu ... nếu trang hiện tại cách xa trang cuối --}}
                @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif

                {{-- Hiển thị 2 trang cuối cùng --}}
                @for ($i = $paginator->lastPage() - 1; $i <= $paginator->lastPage(); $i++)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
            @else
                {{-- Trường hợp số trang nhỏ hơn 5, hiển thị toàn bộ các trang --}}
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
