@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/proyek" enctype="multipart/form-data">
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        @csrf
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Tambah Proyek</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="project_name" class="block text-sm font-medium leading-6 text-gray-900">Nama Aplikasi/Proyek</label>
                        <div class="mt-2">
                            <input type="text" id="project_name" name="project_name" autocomplete="project_name" value="{{ old('project_name') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('project_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="project_manager" class="block text-sm font-medium leading-6 text-gray-900">Penanggung Jawab</label>
                        <div class="mt-2">
                            <input type="text" id="project_manager" name="project_manager" autocomplete="project_manager" value="{{ auth()->user()->username }}" readonly disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            @error('project_manager')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="project_url" class="block text-sm font-medium leading-6 text-gray-900">URL Proyek</label>
                        <div class="mt-2 ">
                            <input type="text" id="project_url" name="project_url" value="{{ old('project_url') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('project_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="project_location" class="block text-sm font-medium leading-6 text-gray-900">Lokasi Proyek/Mitra</label>
                        <div class="mt-2 ">
                            <input type="text" id="project_location" name="project_location" value="{{ old('project_location') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('project_location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="contact_person" class="block text-sm font-medium leading-6 text-gray-900">Narahubung</label>
                        <div class="mt-2 ">
                            <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('contact_person')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4 flex justify-between">
                        <div>
                            <label for="project_start_date" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Mulai</label>
                            <div class="mt-2 ">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="project_start_date" id="project_start_date" value="{{ old('project_start_date') }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('project_start_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="project_end_date" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Selesai</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="project_end_date" id="project_end_date" value="{{ old('project_end_date') }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('project_end_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="visibility" class="block text-sm font-medium leading-6 text-gray-900">Visibilitas</label>
                        <div class="mt-2">
                            <select id="visibility" name="visibility" onchange="toggleKolaborator(this)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['private', 'terbatas'] as $visibility) : ?>
                                    @if (old('visibility') == $visibility)
                                    <option selected value="<?= $visibility ?>"><?= ucfirst($visibility) ?></option>
                                    @else
                                    <option value="<?= $visibility ?>"><?= ucfirst($visibility) ?></option>
                                    @endif
                                <?php endforeach; ?>
                            </select>
                            @error('visibility')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4 hidden" id="kolaboratorInput">
                        <label for="kolaborator" class="block text-sm font-medium leading-6 text-gray-900">Kolaborator</label>

                        <div class="mt-2">
                            <select id="kolaborator" name="kolaborator[]" class="block w-full md:w-80 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" multiple>
                                @foreach($users as $user)
                                @if($user->id !== auth()->user()->id)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('kolaborator')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="project_status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                            <select id="project_status" name="project_status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['sedang berjalan', 'selesai'] as $status) : ?>
                                    @if (old('project_status') == $status)
                                    <option selected value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @else
                                    <option value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @endif
                                <?php endforeach; ?>
                            </select>
                            @error('project_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="project_description" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi Proyek</label>
                        <div class="mt-2">
                            <textarea id="project_description" name="project_description" rows="3" value="{{ old('project_description') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="file_name" class="block text-sm font-medium leading-6 text-gray-900">File Pendukung</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div id="file-list" class="text-left"></div>
                            <div class="text-center" id="file-upload-section">
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="file_name" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Unggah File Pendukung</span>
                                        <input id="file_name" name="file_name[]" value="{{ old('file_name') }}" type="file" class="sr-only" onchange="displaySelectedFiles()" multiple>
                                    </label>
                                    <!-- <p class="pl-1">atau tarik dan lepaskan</p> -->

                                    <h5 id="message"></h5>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">:pdf,doc,docx,xls,xlsx,ppt,pptx hingga 10MB</p>
                            </div>
                        </div>
                        @error('file_name')
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
        var fileList = document.getElementById('file_name').files;
        var fileListHTML = ''; // Inisialisasi variabel daftar nama file + HTML

        for (var i = 0; i < fileList.length; i++) {
            fileListHTML += '<div>' + fileList[i].name + '</div>';
        }
        document.getElementById('file-list').innerHTML = fileListHTML;
        document.getElementById('file-upload-section').style.display = 'none';
    }
</script>
<script>
    //Func menampilkan kolom kolabolator
    function toggleKolaborator(selectElement) {
        var kolaboratorInput = document.getElementById('kolaboratorInput');
        if (selectElement.value === 'terbatas') {
            kolaboratorInput.classList.remove('hidden');
        } else {
            kolaboratorInput.classList.add('hidden');
        }
    }
</script>

<script>
    //library select2 untuk add kolabolator
    $(document).ready(function() {
        $('#kolaborator').select2();

        $('#kolaborator').on('select2:select', function(e) {
            displaySelectedKolaborator();
        });

        $('#kolaborator').on('select2:unselect', function(e) {
            displaySelectedKolaborator();
        });

        function displaySelectedKolaborator() {
            var selectedKolaborator = $('#kolaborator').val();
            var selectedKolaboratorHTML = '';

            if (selectedKolaborator) {
                selectedKolaborator.forEach(function(email, index) {
                    selectedKolaboratorHTML += email;
                    if (index < selectedKolaborator.length - 1) {
                        selectedKolaboratorHTML += ', ';
                    }
                    selectedKolaboratorHTML += '<button type="button" class="text-red-500 font-bold" onclick="removeKolaborator(\'' + email + '\')">x</button>';
                });
            }
        }

        function removeKolaborator(email) {
            var select = $('#kolaborator').select2();
            var data = select.select2('data');

            var newData = data.filter(function(obj) {
                return obj.text !== email;
            });

            select.val(null).trigger('change');

            newData.forEach(function(obj) {
                select.append('<option value="' + obj.text + '" selected>' + obj.text + '</option>');
            });

            displaySelectedKolaborator();
        }
    });
</script>

@endsection