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
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('kolaborator')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="selectedKolaborators">
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
                        <div class="mt-2 flex flex-col items-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div id="file-list" class="text-left w-full mb-4">
                            </div>
                            <div class="text-center">
                                <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                                    <label for="file_name" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Unggah File Pendukung</span>
                                        <input id="file_name" name="file_name[]" type="file" class="sr-only" onchange="displaySelectedFiles()" multiple>
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600 mt-2">:pdf,doc,docx,xls,xlsx,ppt,pptx hingga 10MB</p>
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
            <a href="/main-menu/proyek"><button type="button" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</button></a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
        </div>
    </form>

</section>

<script>
    function displaySelectedFiles() {
        var fileInput = document.getElementById('file_name');
        var fileList = Array.from(fileInput.files);
        var existingFiles = Array.from(document.querySelectorAll('#file-list .file-item')).map(el => el.getAttribute('data-file-name'));

        var newFileListHTML = ''; // Inisialisasi variabel daftar nama file + HTML
        fileList.forEach((file, index) => {
            if (!existingFiles.includes(file.name)) {
                newFileListHTML += `
                    <div class="flex items-center gap-2 mt-2 file-item" data-file-name="${file.name}">
                       <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 512.035 512.035" xml:space="preserve">
<g transform="translate(1 1)">
	<polygon style="fill:#E2E3E5;" points="464.084,127.035 344.617,7.568 250.751,7.568 250.751,502.501 464.084,502.501 	"/>
	<polygon style="fill:#CCCCCC;" points="438.484,127.035 319.017,7.568 225.151,7.568 225.151,502.501 438.484,502.501 	"/>
	<polygon style="fill:#FFFFFF;" points="267.817,127.035 148.351,7.568 54.484,7.568 54.484,502.501 267.817,502.501 	"/>
	<polygon style="fill:#E2E3E5;" points="412.884,127.035 310.484,7.568 80.084,7.568 80.084,502.501 412.884,502.501 	"/>
	<polygon style="fill:#F0F0F0;" points="319.017,7.568 319.017,127.035 438.484,127.035 	"/>
	<g>
		<path style="fill:#B6B6B6;" d="M353.151,203.835H139.817c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533C361.684,200.421,358.271,203.835,353.151,203.835z"/>
		<path style="fill:#B6B6B6;" d="M225.151,135.568h-85.333c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h85.333
			c5.12,0,8.533,3.413,8.533,8.533S230.271,135.568,225.151,135.568z"/>
		<path style="fill:#B6B6B6;" d="M353.151,272.101H139.817c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533C361.684,268.688,358.271,272.101,353.151,272.101z"/>
		<path style="fill:#B6B6B6;" d="M353.151,340.368H139.817c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533S358.271,340.368,353.151,340.368z"/>
		<path style="fill:#B6B6B6;" d="M353.151,408.635H139.817c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533S358.271,408.635,353.151,408.635z"/>
		<path style="fill:#B6B6B6;" d="M438.484,511.035h-384c-5.12,0-8.533-3.413-8.533-8.533V7.568c0-5.12,3.413-8.533,8.533-8.533
			h264.533c2.56,0,4.267,0.853,5.973,2.56l119.467,119.467c1.707,1.707,2.56,3.413,2.56,5.973v375.467
			C447.017,507.621,443.604,511.035,438.484,511.035z M63.017,493.968h366.933v-363.52L315.604,16.101H63.017V493.968z"/>
		<path style="fill:#B6B6B6;" d="M438.484,135.568H319.017c-5.12,0-8.533-3.413-8.533-8.533V7.568c0-3.413,1.707-6.827,5.12-7.68
			c3.413-1.707,6.827-0.853,9.387,1.707l119.467,119.467c2.56,2.56,3.413,5.973,1.707,9.387
			C445.311,133.861,441.897,135.568,438.484,135.568z M327.551,118.501h90.453l-90.453-90.453V118.501z"/>
	</g>
</g>
</svg>
                        <span class="w-40">${file.name}</span>
                         <button type="button" class="text-red-500 font-bold ml-2" onclick="removeFile('${file.name}')">
            <svg height="16px" width="16px" fill="#e60a0a" viewBox="0 0 512 512">
                <g id="SVGRepo_iconCarrier">
                    <polygon id="Close" points="328.96 30.2933333 298.666667 1.42108547e-14 164.48 134.4 30.2933333 1.42108547e-14 1.42108547e-14 30.2933333 134.4 164.48 1.42108547e-14 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48"></polygon>
                </g>
            </svg>
        </button>
                    </div>`;
            }
        });

        document.getElementById('file-list').innerHTML += newFileListHTML;

        updateFileInput(fileInput, fileList.concat(existingFiles.map(fileName => new File([""], fileName))));
    }

    function removeFile(fileName) {
        var fileInput = document.getElementById('file_name');
        var fileList = Array.from(fileInput.files).filter(file => file.name !== fileName);

        updateFileInput(fileInput, fileList);

        var fileElement = document.querySelector(`#file-list .file-item[data-file-name="${fileName}"]`);
        if (fileElement) {
            fileElement.remove();
        }
    }

    function updateFileInput(fileInput, fileList) {
        var dataTransfer = new DataTransfer();
        fileList.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }
</script>
<script>
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
    $(document).ready(function() {
        $('#kolaborator').select2({
            placeholder: 'Pilih kolaborator',
            allowClear: true // Hapus seluruh pilihan
        });

        $('#kolaborator').on('change', function() {
            displaySelectedKolaborator();
        });

        function displaySelectedKolaborator() {
            var selectedKolaborators = $('#kolaborator').val();
            var selectedKolaboratorHTML = '';

            if (selectedKolaborators && selectedKolaborators.length > 0) {
                selectedKolaborators.forEach(function(id, index) {
                    var username = $('#kolaborator option[value="' + id + '"]').text();
                    var previousRole = $('#kolaborator_' + id + ' select[name="kolaborator[' + id + '][role_id]"]').val() || '';

                    selectedKolaboratorHTML += '<div id="kolaborator_' + id + '" class="flex items-center gap-3 mt-2">';
                    selectedKolaboratorHTML += '<input type="hidden" name="kolaborator[' + id + '][id]" value="' + id + '">';
                    selectedKolaboratorHTML += '<label class="w-40 truncate block">' + username + '</label>';
                    selectedKolaboratorHTML += '<select name="kolaborator[' + id + '][role_id]" class="block w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">';

                    @foreach($roles as $role)
                    selectedKolaboratorHTML += '<option value="{{ $role->id }}" ' + (previousRole == '{{ $role->id }}' ? 'selected' : '') + '>{{ $role->name }}</option>';
                    @endforeach

                    selectedKolaboratorHTML += '</select>';
                    selectedKolaboratorHTML += '</div>';
                });
            }

            $('#selectedKolaborators').html(selectedKolaboratorHTML);
        }

        //hapus salah satu kolaborator
        function removeKolaborator(id) {
            $('#kolaborator option[value="' + id + '"]').prop('selected', false);
            $('#kolaborator').trigger('change');
        }
    });
</script>

@endsection