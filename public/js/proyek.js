
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
    function toggleKolaborator(selectElement) {
        var kolaboratorInput = document.getElementById('kolaboratorInput');
        if (selectElement.value === 'terbatas') {
            kolaboratorInput.classList.remove('hidden');
        } else {
            kolaboratorInput.classList.add('hidden');
        }
    }
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

    // File Upload Script
    function handleFileUpload(event) {
        const fileList = event.target.files;
        const fileContainer = document.getElementById('file-list');

        Array.from(fileList).forEach(file => {
            const fileItem = createFileItem(file);
            fileContainer.appendChild(fileItem);
        });
    }

    function createFileItem(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('flex', 'items-center', 'gap-2', 'mt-2', 'file-item');
        fileItem.setAttribute('data-file-name', file.name);

        fileItem.innerHTML = `
            <svg height="50px" width="50px" viewBox="0 0 512.035 512.035">
                <g transform="translate(1 1)">
                    <polygon style="fill:#E2E3E5;" points="464.084,127.035 344.617,7.568 250.751,7.568 250.751,502.501 464.084,502.501"/>
                    <polygon style="fill:#CCCCCC;" points="438.484,127.035 319.017,7.568 225.151,7.568 225.151,502.501 438.484,502.501"/>
                    <polygon style="fill:#FFFFFF;" points="267.817,127.035 148.351,7.568 54.484,7.568 54.484,502.501 267.817,502.501"/>
                    <polygon style="fill:#E2E3E5;" points="412.884,127.035 310.484,7.568 80.084,7.568 80.084,502.501 412.884,502.501"/>
                    <polygon style="fill:#F0F0F0;" points="319.017,7.568 319.017,127.035 438.484,127.035"/>
                    <g>
                        <path style="fill:#B6B6B6;" d="M353.151,203.835H139.817c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h213.333c5.12,0,8.533,3.413,8.533,8.533C361.684,200.421,358.271,203.835,353.151,203.835z"/>
                        <path style="fill:#B6B6B6;" d="M225.151,135.568h-85.333c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h85.333c5.12,0,8.533,3.413,8.533,8.533S230.271,135.568,225.151,135.568z"/>
                        <path style="fill:#B6B6B6;" d="M353.151,272.101H139.817c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h213.333c5.12,0,8.533,3.413,8.533,8.533C361.684,268.688,358.271,272.101,353.151,272.101z"/>
                        <path style="fill:#B6B6B6;" d="M353.151,340.368H139.817c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h213.333c5.12,0,8.533,3.413,8.533,8.533S358.271,340.368,353.151,340.368z"/>
                        <path style="fill:#B6B6B6;" d="M353.151,408.635H139.817c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h213.333c5.12,0,8.533,3.413,8.533,8.533S358.271,408.635,353.151,408.635z"/>
                        <path style="fill:#B6B6B6;" d="M438.484,511.035h-384c-5.12,0-8.533-3.413-8.533-8.533V7.568c0-5.12,3.413-8.533,8.533-8.533h264.533c2.56,0,4.267,0.853,5.973,2.56l119.467,119.467c1.707,1.707,2.56,3.413,2.56,5.973v375.467C447.017,507.621,443.604,511.035,438.484,511.035z M63.017,493.968h366.933v-363.52L315.604,16.101H63.017V493.968z"/>
                        <path style="fill:#B6B6B6;" d="M438.484,135.568H319.017c-5.12,0-8.533-3.413-8.533-8.533V7.568c0-3.413,1.707-6.827,5.12-7.68c3.413-1.707,6.827-0.853,9.387,1.707l119.467,119.467c2.56,2.56,3.413,5.973,1.707,9.387C445.311,133.861,441.897,135.568,438.484,135.568z M327.551,118.501h90.453l-90.453-90.453V118.501z"/>
                    </g>
                </g>
            </svg>
            <span class="w-40">${file.name}</span>
            <button type="button" class="text-red-500 font-bold ml-2" onclick="removeFile('${file.name}')">
                <svg height="16px" width="16px" fill="#e60a0a" viewBox="0 0 512 512">
                    <g id="SVGRepo_iconCarrier">
                        <polygon id="Close" points="328.96 30.2933333 298.666667 1.42108547e-14 164.48 134.4 30.2933333 1.42108547e-14 1.42108547e-14 30.2933333 134.4 164.48 1.42108547e-14 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48"/>
                    </g>
                </svg>
            </button>
        `;

        return fileItem;
    }

    function removeFile(fileName) {
        if (confirm('Anda yakin ingin menghapus file ini?')) {
            $('.file-item[data-file-name="' + fileName + '"]').remove();
            markFileAsRemoved(fileName);
        }
    }

    function markFileAsRemoved(fileName) {
        const removedFilesInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'removed_files[]')
            .val(fileName);
        $('form').append(removedFilesInput);
    }
    // Collaborator Selection Script
    $(document).ready(function() {
        initializeSelect2();
        $('#kolaborator').on('change', displaySelectedKolaborator);
        attachRemoveKolaboratorEvent();

        function initializeSelect2() {
            $('#kolaborator').select2({
                placeholder: 'Pilih kolaborator',
                allowClear: true
            });
        }

        function displaySelectedKolaborator() {
            const selectedKolaborators = $('#kolaborator').val();
            let selectedKolaboratorHTML = '';

            if (selectedKolaborators && selectedKolaborators.length > 0) {
                selectedKolaborators.forEach(function(id) {
                    const username = $('#kolaborator option[value="' + id + '"]').text();
                    const previousRole = $('#kolaborator_' + id + ' select[name="kolaborator[' + id + '][role_id]"]').val() || '';

                    if ($('#kolaborator_' + id).length === 0) {
                        selectedKolaboratorHTML += createKolaboratorHTML(id, username, previousRole);
                        $('#kolaborator option[value="' + id + '"]').remove();
                    }
                });
            }

            $('#selectedKolaborators').append(selectedKolaboratorHTML);
            attachRemoveKolaboratorEvent();
        }

        function createKolaboratorHTML(id, username, previousRole) {
            let html = `
                <div id="kolaborator_${id}" class="flex items-center gap-3 mt-2">
                    <input type="hidden" name="kolaborator[${id}][id]" value="${id}">
                    <label class="w-40 truncate block">${username}</label>
                    <select name="kolaborator[${id}][role_id]" class="block w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            `;

            @foreach($roles as $role)
            html += `<option value="{{ $role->id }}" ${previousRole == '{{ $role->id }}' ? 'selected' : ''}>{{ $role->name }}</option>`;
            @endforeach

            html += `
                    </select>
                    <button type="button" class="ml-2 text-red-600 remove-kolaborator" data-id="${id}">Hapus</button>
                </div>
            `;
            return html;
        }

        function attachRemoveKolaboratorEvent() {
            document.querySelectorAll('.remove-kolaborator').forEach(button => {
                button.addEventListener('click', function() {
                    const kolaboratorId = this.getAttribute('data-id');
                    const kolaboratorElement = document.getElementById(`kolaborator_${kolaboratorId}`);

                    removeKolaborator(kolaboratorElement, kolaboratorId);
                });
            });
        }

        function removeKolaborator(kolaboratorElement, kolaboratorId) {
            kolaboratorElement.remove();
            markKolaboratorAsRemoved(kolaboratorId);
            $('#kolaborator option[value="' + kolaboratorId + '"]').remove();

            const username = kolaboratorElement.querySelector('label').textContent;
            $('#kolaborator').append(new Option(username, kolaboratorId));
        }

        function markKolaboratorAsRemoved(kolaboratorId) {
            const removedKolaboratorsInput = document.getElementById('removed_kolaborators');
            let removedKolaborators = removedKolaboratorsInput.value ? JSON.parse(removedKolaboratorsInput.value) : [];
            removedKolaborators.push(kolaboratorId);
            removedKolaboratorsInput.value = JSON.stringify(removedKolaborators);
        }
    });