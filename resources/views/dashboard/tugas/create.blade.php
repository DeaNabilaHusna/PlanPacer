@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/proyek/{{ $proyek->slug }}/modul/{{$kartuTugas->slug}}" enctype="multipart/form-data" class="space-y-12 font-medium" id="tugas-form" name="tugas-form">
        @csrf
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Tambah Tugas Item</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="nama_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Judul Tugas</label>
                        <div class="mt-2">
                            <input type="text" id="nama_tugas_item" name="nama_tugas_item" autocomplete="nama_tugas_item" value="{{ old('nama_tugas_item') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('nama_tugas_item')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="status_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2 ">
                            <input type="text" id="status_tugas_item" name="status_tugas_item" value="{{ old('status_tugas_item') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('status_tugas_item')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4 flex space-x-12 justify-between">
                        <div>
                            <label for="tgl_mulai_tugas" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Mulai Tugas</label>
                            <div class="mt-2 ">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="tgl_mulai_tugas" id="tgl_mulai_tugas" value="{{ old('tgl_mulai_tugas') }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('tgl_mulai_tugas')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="tgl_selesai_tugas" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Selesai Tugas</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="tgl_selesai_tugas" id="tgl_selesai_tugas" value="{{ old('tgl_selesai_tugas') }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('tgl_selesai_tugas')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-span-full">
                        <label for="deskripsi_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi Tugas</label>
                        <div class="mt-2">
                            <textarea id="deskripsi_tugas_item" name="deskripsi_tugas_item" rows="3" value="{{ old('deskripsi_tugas_item') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                   
                    <!-- <div class="sm:col-span-2">
                        <label for="status_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Status Tugas</label>
                        <div class="mt-2">
                            <select id="status_tugas_item" name="status_tugas_item" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-600 focus:ring-opacity-50 sm:text-sm">
                                <option value="pending" {{ old('status_tugas_item') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="ongoing" {{ old('status_tugas_item') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ old('status_tugas_item') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status_tugas_item')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div> -->
                    
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/main-menu/proyek/{{ $proyek->slug }}/modul"><button type="button" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</button></a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
        </div>
    </form>
</section>

@endsection