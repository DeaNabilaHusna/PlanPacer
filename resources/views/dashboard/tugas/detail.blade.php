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
    <div class="space-y-12 font-medium">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base mt-4 font-semibold leading-7 text-gray-900">Detail Tugas</h2>
            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="nama_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Judul Tugas</label>
                    <div class="mt-2">
                        <input type="text" id="nama_tugas_item" name="nama_tugas_item" autocomplete="nama_tugas_item" value="{{ old('nama_tugas_item', $tugasItem->nama_tugas_item) }}" disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="status_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Judul Tugas</label>
                    <div class="mt-2">
                        <input type="text" id="status_tugas_item" name="status_tugas_item" autocomplete="status_tugas_item" value="{{ old('status_tugas_item', $tugasItem->status_tugas_item) }}" disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="penanggungjawab_id" class="block text-sm font-medium leading-6 text-gray-900">Penanggung Jawab</label>
                    <div class="mt-2">
                        <input type="text" id="penanggungjawab_id" name="penanggungjawab_id" autocomplete="penanggungjawab_id" value="{{ old('penanggungjawab_id', $tugasItem->penanggungjawab_id) }}" disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-4 grid grid-cols-2 gap-x-6">
                    <div>
                        <label for="tgl_mulai_tugas" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Mulai Tugas</label>
                        <div class="mt-2">
                            <input type="text" id="tgl_mulai_tugas" name="tgl_mulai_tugas" autocomplete="tgl_mulai_tugas" value="{{ old('tgl_mulai_tugas', \Carbon\Carbon::parse($tugasItem->tgl_mulai_tugas)->translatedFormat('l, j-F-Y')) }}" disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="tgl_selesai_tugas" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Selesai Tugas</label>
                        <div class="mt-2">
                            <input type="text" id="tgl_selesai_tugas" name="tgl_selesai_tugas" autocomplete="tgl_selesai_tugas" value="{{ old('tgl_selesai_tugas', \Carbon\Carbon::parse($tugasItem->tgl_selesai_tugas)->translatedFormat('l, j-F-Y')) }}" disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="deskripsi_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi Tugas</label>
                    <div class="mt-2 block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        {{ old('deskripsi_tugas_item', $tugasItem->deskripsi_tugas_item) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="/main-menu/proyek/{{ $proyek->slug }}/modul" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</a>
        <a href="/main-menu/proyek/{{ $proyek->slug }}/modul/{{ $modul->slug }}/tugas/{{ $tugasItem->slug }}/edit" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Edit</a>

    </div>
</section>


@endsection