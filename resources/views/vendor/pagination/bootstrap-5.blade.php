<nav>
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li>
                <a aria-disabled="true">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li><a aria-disabled="true">{{ $element }}</a></li>
                {{-- <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li> --}}
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><a aria-disabled="true">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </li>
        @else
            <li>
                <a aria-disabled="true">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
