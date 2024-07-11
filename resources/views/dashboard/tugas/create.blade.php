@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/proyek/{{ $proyek->slug }}/modul/{{ $kartuTugas->slug }}/tugas" enctype="multipart/form-data" class="font-medium" id="tugas-form" name="tugas-form">
        @if(session('error'))
        <div class="text-red-500 text-lg font-bold">{{ session('error') }}</div>
        @endif
        @csrf
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Tambah Tugas</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="task_name" class="block text-sm font-medium leading-6 text-gray-900">Judul Tugas</label>
                        <div class="mt-2">
                            <input type="text" id="task_name" name="task_name" autocomplete="task_name" value="{{ old('task_name') }}" required class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('task_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="task_status" class="block text-sm font-medium leading-6 text-gray-900">Status Tugas</label>
                        <div class="mt-2">
                            <select id="task_status" name="task_status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['dalam proses', 'selesai'] as $status) : ?>
                                    @if (old('task_status') == $status)
                                    <option selected value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @else
                                    <option value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @endif
                                <?php endforeach; ?>
                            </select>
                            @error('task_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $proyek->id }}">
                    <input type="hidden" name="modul_id" value="{{ $kartuTugas->id }}">


                    @if ($proyek->visibility !== 'private')
                    <div class="sm:col-span-4">
                        <label for="project_manager_id" class="block text-sm font-medium leading-6 text-gray-900">Penanggung jawab</label>
                        <div class="mt-2">
                            <select id="project_manager_id" name="project_manager_id[]" multiple required class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @foreach($kolaborator as $kolab)
                                <option value="{{ $kolab['id'] }}" {{ in_array($kolab['id'], old('project_manager_id', [])) ? 'selected' : '' }}>{{ $kolab['email'] }}</option>
                                @endforeach
                            </select>
                            @error('project_manager_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @else
                    <div class="sm:col-span-4">
                        <label for="project_manager_id" class="block text-sm font-medium leading-6 text-gray-900">Penanggung Jawab</label>
                        <div class="mt-2">
                            <select id="project_manager_id" name="project_manager_id[]" multiple disabled required class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="{{ auth()->user()->id }}" selected disabled>{{ auth()->user()->email }}</option>
                            </select>
                            @error('project_manager_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="sm:col-span-4 flex space-x-12 justify-between">
                        <div>
                            <label for="task_start_date" required class="block text-sm font-medium leading-6 text-gray-900">Tanggal Mulai Tugas</label>
                            <div class="mt-2 ">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="task_start_date" id="task_start_date" value="{{ old('task_start_date') }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('task_start_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="task_end_date" required class="block text-sm font-medium leading-6 text-gray-900">Tenggat Waktu Tugas</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="task_end_date" id="task_end_date" value="{{ old('task_end_date') }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('task_end_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-span-full">
                        <label for="task_description" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi Tugas</label>
                        <div class="mt-2">
                            <textarea id="task_description" name="task_description" rows="3" value="{{ old('task_description') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/main-menu/proyek/{{ $proyek->slug }}/modul"><button type="button" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</button></a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
        </div>
    </form>
</section>
<script>
    $(document).ready(function() {
        $('#project_manager_id').select2();

        $('#project_manager_id').on('select2:select', function(e) {
            displaySelectedKolaborator();
        });

        $('#project_manager_id').on('select2:unselect', function(e) {
            displaySelectedKolaborator();
        });

        function displaySelectedKolaborator() {
            var selectedKolaborator = $('#project_manager_id').val();
            var selectedKolaboratorHTML = '';

            if (selectedKolaborator) {
                selectedKolaborator.forEach(function(id, index) {
                    var username = $('#project_manager_id option[value="' + id + '"]').text();
                    selectedKolaboratorHTML += username;
                    if (index < selectedKolaborator.length - 1) {
                        selectedKolaboratorHTML += ', ';
                    }
                    selectedKolaboratorHTML += '<button type="button" class="text-red-500 font-bold" onclick="removeKolaborator(\'' + id + '\')">x</button>';
                });
            }

            $('#selected-kolaborator').html(selectedKolaboratorHTML);
        }

        function removeKolaborator(id) {
            var select = $('#project_manager_id').select2();
            var data = select.select2('data');

            var newData = data.filter(function(obj) {
                return obj.id !== id;
            });

            select.val(null).trigger('change');

            newData.forEach(function(obj) {
                select.append('<option value="' + obj.id + '" selected>' + obj.text + '</option>');
            });

            displaySelectedKolaborator();
        }
    });
</script>


@endsection