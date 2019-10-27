@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif

{{--<nav class="flexbox mt-30">--}}
{{--@if ($paginator->hasPages())--}}
    {{--@if ($paginator->onFirstPage())--}}
        {{--<a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>--}}
    {{--@else--}}
        {{--<a class="btn btn-white" href="{{ $paginator->previousPageUrl() }}"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>--}}
     {{--@endif--}}
        {{--@if ($paginator->hasMorePages())--}}
            {{--<a class="btn btn-white" href="href="{{ $paginator->nextPageUrl() }}"">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>--}}
        {{--@else--}}
            {{--<a class="btn btn-white disabled" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>--}}
        {{--@endif--}}

{{--@endif--}}
{{--</nav>--}}

