@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/proyek/{{ $proyek->nama_proyek }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Proyek</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="nama_proyek" class="block text-sm font-medium leading-6 text-gray-900">Nama Proyek</label>
                        <div class="mt-2">
                            <input type="text" id="nama_proyek" name="nama_proyek" autocomplete="nama_proyek" value="{{ old('nama_proyek', $proyek->nama_proyek) }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('nama_proyek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="url_proyek" class="block text-sm font-medium leading-6 text-gray-900">URL Proyek</label>
                        <div class="mt-2 ">
                            <input type="text" id="url_proyek" name="url_proyek" value="{{ old('url_proyek', $proyek->url_proyek) }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('url_proyek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4 flex justify-between">
                        <div>
                            <label for="tgl_mulai_proyek" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Mulai Proyek</label>
                            <div class="mt-2 ">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="tgl_mulai_proyek" id="tgl_mulai_proyek" value="{{ old('tgl_mulai_proyek', $proyek->tgl_mulai_proyek) }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('tgl_mulai_proyek')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="tgl_selesai_proyek" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Selesai Proyek</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="tgl_selesai_proyek" id="tgl_selesai_proyek" value="{{ old('tgl_selesai_proyek', $proyek->tgl_selesai_proyek) }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('tgl_selesai_proyek')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="visibilitas" class="block text-sm font-medium leading-6 text-gray-900">Visibilitas</label>
                        <div class="mt-2">
                            <select id="visibilitas" name="visibilitas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['private', 'terbatas'] as $visibility) : ?>
                                    @if (old('visibilitas', $proyek->visibilitas) == $visibility)
                                    <option selected value="<?= $visibility ?>"><?= ucfirst($visibility) ?></option>
                                    @else
                                    <option value="<?= $visibility ?>"><?= ucfirst($visibility) ?></option>
                                    @endif
                                <?php endforeach; ?>
                            </select>
                            @error('visibilitas')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="status_proyek" class="block text-sm font-medium leading-6 text-gray-900">Status Proyek</label>
                        <div class="mt-2">
                            <select id="status_proyek" name="status_proyek" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['sedang berjalan', 'selesai'] as $status) : ?>
                                    @if (old('status_proyek', $proyek->status_proyek) == $status)
                                    <option selected value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @else
                                    <option value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @endif
                                <?php endforeach; ?>
                            </select>
                            @error('status_proyek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="deskripsi_proyek" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi Proyek</label>
                        <div class="mt-2">
                            <textarea id="deskripsi_proyek" name="deskripsi_proyek" rows="3" value="{{ old('deskripsi_proyek', $proyek->deskripsi_proyek) }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="nama_file" class="block text-sm font-medium leading-6 text-gray-900">File Pendukung</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div id="file-list" class="text-left"></div>
                            <div class="text-center" id="file-upload-section">
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="nama_file" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Unggah File Pendukung</span>
                                        <input id="nama_file" name="nama_file[]" value="{{ old('nama_file', $proyek->nama_file) }}" type="file" class="sr-only" onchange="displaySelectedFiles()" multiple>
                                    </label>
                                    <!-- <p class="pl-1">atau tarik dan lepaskan</p> -->
                                </div>
                                <p class="text-xs leading-5 text-gray-600">:pdf,doc,docx,xls,xlsx,ppt,pptx hingga 10MB</p>
                            </div>
                        </div>
                        @error('nama_file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Batal</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
        </div>
    </form>

</section>
<script>
    // menampilkan nama file yang dipilih
    function displaySelectedFiles() {
        var fileList = document.getElementById('nama_file').files;
        var fileListHTML = ''; // Inisialisasi variabel daftar nama file + HTML

        for (var i = 0; i < fileList.length; i++) {
            fileListHTML += '<div>' + fileList[i].name + '</div>';
        }
        document.getElementById('file-list').innerHTML = fileListHTML;
        document.getElementById('file-upload-section').style.display = 'none';
    }
</script>


@endsection