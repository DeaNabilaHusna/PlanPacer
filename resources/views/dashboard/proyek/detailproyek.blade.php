@extends('layouts.main')
@section('content')

<!-- Breadcrumb -->
@php
    $segments = Request::segments();
    $segmentCount = count($segments);
@endphp

@for ($index = 1; $index < $segmentCount; $index++)
    <div class="flex flex-row items-center text-sm text-gray-800">
        {{ ucfirst($segments[$index]) }}
        @if ($index < $segmentCount - 1)
            <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 font-bold" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        @endif
    </div>
@endfor
<!-- End Breadcrumb -->

<section class="mb-4">
   
   

</section>

@endsection