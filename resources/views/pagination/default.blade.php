@if ($paginator->lastPage() > 1)
@if ($paginator->currentPage() != 1)
<a href="{{ $paginator->url($paginator->currentPage()-1) }}">
  <span aria-hidden="true">&lt;</span>
  {{-- Previous --}}
</a>
@endif
@for ($i = 1; $i <= $paginator->lastPage(); $i++)
  @if ($paginator->currentPage() === $i)
  <div class="active-page-link">{{ $i }}</div>
  @else
  <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
  @endif
  @endfor
  @if ($paginator->currentPage() != $paginator->lastPage())
  <a href="{{ $paginator->url($paginator->currentPage()+1) }}">
    <span aria-hidden="true">&gt;</span>
    {{-- Next --}}
  </a>
  @endif
  @endif