@extends('layouts.main')
@section('content')
<section>

<!-- Breadcrumb -->
<ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
    <li class="flex items-center text-sm text-gray-800">
        Proyek 1
        <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
    </li>
    <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
        Tugas 1
    </li>
</ol>
<br>
<!-- End Breadcrumb -->
<div class="max-w-screen-xl mx-auto bg-white p-8 rounded-md shadow-md w-1113 h-830">
    <div class="mb-4">
        <label for="nama_proyek" class="block font-semibold mb-2">Nama Tugas</label>
        <input type="text" id="nama_proyek" name="nama_proyek" class="w-full border rounded-md p-2" value="Tugas 1">
    </div>
    <div class="mb-4">
        <label for="tanggal_mulai" class="block font-semibold mb-2">Tanggal Mulai</label>
        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="w-full border rounded-md p-2">
    </div>
    <div class="mb-4">
        <label for="tanggal_selesai" class="block font-semibold mb-2">Tenggat Selesai</label>
        <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="w-full border rounded-md p-2">
    </div>
    <div class="mb-4">
        <label for="penanggung_jawab" class="block font-semibold mb-2">Penanggung Jawab</label>
        <input type="text" id="penanggung_jawab" name="penanggung_jawab" class="w-full border rounded-md p-2" value="Patricia">
    </div>
    <div class="mb-4">
        <label for="status" class="block font-semibold mb-2">Status</label>
        <select id="status" name="status" class="w-full border rounded-md p-2">
            <option value="pending">Dalam Proses</option>
            <option value="completed">Selesai</option>
        </select>
    </div>
    <div class="mb-4">
        <label for="deskripsi" class="block font-semibold mb-2">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="w-full border rounded-md p-2 h-24"></textarea>
    </div>
    <div class="flex justify-between">
        <button class="bg-gray-400 text-white py-2 px-4 rounded-md">Kembali</button>

        <a href="{{ url('/proyektugas') }}">
            <button class="bg-blue-500 text-white py-2 px-4 rounded-md">Edit</button>
        </a>
    </div>
</div>


</section>
@endsection



