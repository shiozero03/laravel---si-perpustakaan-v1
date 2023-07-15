<style type="text/css">
    ul.pagination li.menu-links{
        width: 40px;
        height: 40px;
        margin-left: 5px;
        border-radius: 6px;
        background-color: #F4F4F4;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    ul.pagination li.menu-links.active{
        background-color: #3C84AB;
        color: white;
    }
    ul.pagination li.menu-links a{
        color: #000000;
        text-decoration: none;
    }
</style>
@if ($paginator->hasPages())
<div class="d-flex align-items-center">
    <nav class="col-8">
        <ul class="pagination">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled menu-links" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="menu-links active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="menu-links"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
    <div class="text-end col-4">
        @if($paginator->total() < $paginator->perPage() )
            <small>Menampilkan {{ $paginator->currentPage() }} - {{ $paginator->total() }} dari {{ $paginator->total() }} hasil</small>
        @else
                <small>Menampilkan {{ $paginator->perPage() * ($paginator->currentPage() - 1) + 1}} - {{ $paginator->perPage() * $paginator->currentPage()}} dari {{ $paginator->total() }} hasil</small>
        @endif
    </div>
</div>
<small class="mx-2">Jumlah Buku: {{ $paginator->total() }}</small>
@endif
