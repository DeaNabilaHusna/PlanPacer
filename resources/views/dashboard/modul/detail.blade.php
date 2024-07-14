@extends('layouts.main')
@section('content')

<!-- Breadcrumb -->
@php
$segments = Request::segments();
$segmentCount = count($segments);
@endphp

<div class="flex flex-row items-center space-x-3 text-sm text-gray-800">
    @for ($index = 1; $index < $segmentCount; $index++) <div>
        {{ ucfirst($segments[$index]) }}
        @if ($index < $segmentCount - 1) <svg class="inline-block w-4 h-4 text-gray-400" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 1L10.687 7.161C10.864 7.352 10.864 7.648 10.687 7.839L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            @endif
</div>
@endfor
</div>


<!-- End Breadcrumb -->

<section class="mb-4">
    <div>
        <div class="px-4 sm:px-0">
            <h3 class="my-4 text-base font-semibold leading-7 text-gray-900">Informasi Modul</h3>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nama Modul</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $modul->modul_name ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Eksekutor Modul</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        @if ($kolaborator->isNotEmpty())
                        <ul>
                            @foreach ($kolaborator as $user)
                            <li>{{ $user->username }} 
                            </li>
                            @endforeach

                        </ul>
                        @else
                        <span>–</span>
                        @endif
                    </dd>
                </div>



                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Tanggal Mulai</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::parse($modul->modul_start_date)->translatedFormat('l, d F Y') }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Tanggal Selesai</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::parse($modul->modul_end_date)->translatedFormat('l, d F Y') }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Status Modul</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $modul->modul_status ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Deskripsi Modul</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $modul->modul_description ?? '–' }}</dd>
                </div>
            </dl>
        </div>
    </div>



</section>

@endsection