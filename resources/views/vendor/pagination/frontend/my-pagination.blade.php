@if ($paginator->hasPages())


            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

                <li class="page-item disabled">
                            <span class="page-link">
                                &lsaquo;&lsaquo;
                            </span>
                </li>

                <li class="page-item disabled">
                            <span class="page-link">
                                &lsaquo;
                            </span>
                </li>

            @else


                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">
                        &lsaquo;&lsaquo;
                    </a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        &lsaquo;
                    </a>
                </li>


            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!--  Aktiv Link  -->
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        &rsaquo;
                    </a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($page) }}">
                        &rsaquo;&rsaquo;
                    </a>
                </li>

            @else

                <li class="page-item disabled">
                            <span class="page-link">
                          &rsaquo;
                            </span>
                </li>

                <li class="page-item disabled">
                            <span class="page-link">
                              &rsaquo;&rsaquo;
                            </span>
                </li>

            @endif

@endif
