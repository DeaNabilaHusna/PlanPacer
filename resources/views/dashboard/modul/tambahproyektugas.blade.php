@extends('layouts.main')
@section('content')
<section class="mb-4">

    <form method="post" action="/main-menu/proyek/{{ $proyek->slug }}/modul">
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @csrf
        <!-- Breadcrumb -->
        <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">    <li class="flex items-center text-sm text-gray-800">
                {{ $proyek->nama_proyek }}
                <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </li>
            <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
                Buat Modul
            </li>
        </ol>
        <br>
        <!-- End Breadcrumb -->
        <div class="max-w-screen-xl mx-auto bg-white p-8 rounded-md shadow-md w-1113 h-830">
            <div class="mb-4">
                <label for="nama_kartu" class="block font-semibold mb-2">Nama Modul</label>
                <input type="text" id="nama_kartu" name="nama_kartu" class="w-full border rounded-md p-2" value="{{ old('nama_kartu') }}" required>
                @error('nama_kartu')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="proyek_id" value="{{ session('proyek_id') }}"> <!-- Pastikan proyek_id ada -->
            <div class="mt-6 flex items-center justify-end gap-x-6">
                {{-- <a href="/main-menu/proyek/{{ $proyek->slug }}/tugas"
                class="bg-gray-400 text-white py-2 px-4 rounded-md">Kembali</a> --}}
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Batal</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>

            </div>
        </div>
    </form>
</section>
@endsection