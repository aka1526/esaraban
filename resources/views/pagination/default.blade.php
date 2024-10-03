@php
$pagesize=isset($link_limit) ? $link_limit : 20;
$link="";
$link.= isset($docyear) && $docyear !='' ? '&docyear='.$docyear:   '';
$link.= isset($docmonth) && $docmonth !='' ? '&docmonth='.$docmonth: '';
$link.= isset($search) && $search !='' ? '&search='. $search  : '' ;

$link.= isset($doc_type) && $doc_type !='' ? '&DOC_TYPE='.$doc_type: '';
$link.= isset($status)&& $status !=''  ? '&STATUS='.$status: '';
$link.= isset($pagesize) && $pagesize !='' ? '&pagesize='.$pagesize: '';

@endphp


@if ($paginator->hasPages())
 <nav aria-label="Page navigation">
  <ul class="pagination">
    @if ($paginator->onFirstPage())
    <li class="page-item "><a class="page-link" disabled>Previous</a></li>
    @else
    <li class="page-item text-primary"><a class="page-link" href="{{ $paginator->previousPageUrl().$link }} ">Previous</a></li>
    @endif

    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
      <li><span class="pagination-ellipsis">&hellip;</span></li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())

          <li class="page-item active"><a class="page-link is-current" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
          @else
            <li class="page-item ">
              <a href="{{ $url.$link }}" class="page-link" aria-label="Goto page {{ $page }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="page-item text-primary"><a class="page-link" href="{{ $paginator->nextPageUrl(). $link}}">Next Page</a></li>
    @else
    <li class="page-item "><a class="page-link" disabled>Next Page</a></li>
    @endif
    {{-- <li class="page-item "><a class="page-link" disabled=""> แสดง/หน้า:</a></li>
    <li class="page-item text-primary ml-1">
        <select onchange="toPageSize(options[selectedIndex].value)" class="page-link" id="pagesize" name="pagesize">
            <option value="10" {{ $link_limit==10 ? 'selected' : ''}}>10</option>
            <option value="20" {{ $link_limit==20 ? 'selected' : ''}}>20</option>
            <option value="30" {{ $link_limit==30 ? 'selected' : ''}}>30</option>
            <option value="40" {{ $link_limit==40 ? 'selected' : ''}}>40</option>
            <option value="50" {{ $link_limit==50 ? 'selected' : ''}}>50</option>
            <option value="100" {{ $link_limit==100 ? 'selected' : ''}}>100</option>
            <option value="150" {{ $link_limit==150 ? 'selected' : ''}}>150</option>
            <option value="200" {{ $link_limit==200 ? 'selected' : ''}}>200</option>

          </select>
        </li>
    <li class="page-item text-primary ml-1"><a class="page-link"  >ทั้งหมด: {{ number_format($paginator->total(),0) }} รายการ</a></li> --}}
  </ul>

</nav>
@php

$link=URL::current()."?";
$link.= isset($docyear) ? '&docyear='.$docyear:  '&docyear='.date('Y');
$link.= isset($docmonth) ? '&docmonth='.$docmonth: '';
$link.= isset($search) ? '&search='. $search  : '' ;
$link.= isset($product_group) ? '&product_group='. $product_group  : '' ;
$link.= isset($job_status) ? '&job_status='.$job_status: '';
$link.= isset($doc_type) ? '&DOC_TYPE='.$doc_type: '';
$link.= isset($status) ? '&STATUS='.$status: '';

@endphp
<script>
    function toPageSize(pagesize){
        var url="{!! $link !!}"+'&pagesize='+pagesize;
        window.location.href =url;
    }
</script>
@endif
