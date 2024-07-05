{{-- <ul class="pagination" style="float: right;">
    <li class='active'><a href='indexa6d2.html?com=danhmuc_tin&amp;id_category=2&amp;page=1'>1</a></li>
    <li><a href='index38f0.html?com=danhmuc_tin&amp;id_category=2&amp;page=2'>2</a></li>
    <li><a href='index5575.html?com=danhmuc_tin&amp;id_category=2&amp;page=3'>3</a></li>
    <li><a href='index2127.html?com=danhmuc_tin&amp;id_category=2&amp;page=4'>4</a></li>
    <li><a href='index23a2.html?com=danhmuc_tin&amp;id_category=2&amp;page=5'>5</a></li> 
    <li><a href='indexbc8b.html?com=danhmuc_tin&amp;id_category=2&amp;page=6'>6</a></li>
    <li><a href='index991c.html?com=danhmuc_tin&amp;id_category=2&amp;page=7'>7</a></li>
    <li><a href='index2f55.html?com=danhmuc_tin&amp;id_category=2&amp;page=8'>8</a></li>
    <li><a href='index5b56.html?com=danhmuc_tin&amp;id_category=2&amp;page=9'>9</a></li>
    <li><a href='indexccb3.html?com=danhmuc_tin&amp;id_category=2&amp;page=10'>10</a></li>
    <li><a href='index9260.html?com=danhmuc_tin&amp;id_category=2&amp;page=11'>11</a></li>
</ul> --}}
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
