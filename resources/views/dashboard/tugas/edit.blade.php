@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/proyek/{{ $proyek->slug }}/modul/{{$kartuTugas->slug}}/tugas/{{ $tugasItem->slug }}" enctype="multipart/form-data" class="space-y-12 font-medium" id="tugas-form" name="tugas-form">
        @if(session('error'))
        <div class="text-red-500 text-lg font-bold">{{ session('error') }}</div>
        @endif
        @csrf
        @method('PUT')
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Tugas</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="nama_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Judul Tugas</label>
                        <div class="mt-2">
                        <input type="text" id="nama_tugas_item" name="nama_tugas_item" autocomplete="nama_tugas_item" value="{{ old('nama_tugas_item', $tugasItem->nama_tugas_item) }}" required class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                            @error('nama_tugas_item')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="status_tugas_item" class="block text-sm font-medium leading-6 text-gray-900">Status Proyek</label>
                        <div class="mt-2">
                            <select id="status_tugas_item" name="status_tugas_item" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['dalam proses', 'selesai'] as $status) : ?>
                                    @if (old('status_tugas_item', $tugasItem->status_tugas_item) == $status)
                                    <option selected value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @else
                                    <option value="<?= $status ?>"><?= ucfirst($status) ?></option>
                                    @endif
                                <?php endforeach; ?>
                            </select>
                            @error('status_tugas_item')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="proyek_id" value="{{ $proyek->id }}">

                    @if ($proyek->visibilitas !== 'private')
                    <div class="sm:col-span-4">
                        <label for="penanggungjawab_id" class="block text-sm font-medium leading-6 text-gray-900">Penanggung jawab</label>
                        <div class="mt-2">
                            <select id="penanggungjawab_id" name="penanggungjawab_id[]" multiple required class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @foreach($kolaborator as $user)
                                <option value="{{ $user['id'] }}" {{ in_array($user['id'], old('penanggungjawab_id', $tugasItem->userTugasItems->pluck('penanggungjawab_id')->toArray() ?? [])) ? 'selected' : '' }}>
                                    {{ $user['email'] }}
                                </option>
                                @endforeach
                            </select>
                            @error('penanggungjawab_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @else
                    <div class="sm:col-span-4">
                        <label for="penanggungjawab_id" class="block text-sm font-medium leading-6 text-gray-900">Penanggung Jawab</label>
                        <div class="mt-2">
                            <select id="penanggungjawab_id" name="penanggungjawab_id[]" multiple disabled required class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="{{ old('penanggungjawab_id', $tugasItem->penanggungjawab_id) }}" selected disabled>{{ auth()->user()->email }}</option>
                            </select>
                            @error('penanggungjawab_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="sm:col-span-4 flex space-x-12 justify-between">
                        <div>
                            <label for="tgl_mulai_tugas" required class="block text-sm font-medium leading-6 text-gray-900">Tanggal Mulai Tugas</label>
                            <div class="mt-2 ">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="tgl_mulai_tugas" id="tgl_mulai_tugas" value="{{ old('tgl_mulai_tugas', $tugasItem->tgl_mulai_tugas) }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                                @error('tgl_mulai_tugas')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="tgl_selesai_tugas" required class="block text-sm font-medium leading-6 text-gray-900">Tanggal Selesai Tugas</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="tgl_selesai_tugas" id="tgl_selesai_tugas" value="{{ old('tgl_selesai_tugas', $tugasItem->tgl_selesai_tugas) }}" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 placeholder:pl-2 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
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
                            <textarea id="deskripsi_tugas_item" name="deskripsi_tugas_item" rows="3" value="{{ old('deskripsi_tugas_item', $tugasItem->deskripsi_tugas_item) }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
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
        $('#penanggungjawab_id').select2();

        $('#penanggungjawab_id').on('select2:select', function(e) {
            displaySelectedKolaborator();
        });

        $('#penanggungjawab_id').on('select2:unselect', function(e) {
            displaySelectedKolaborator();
        });

        function displaySelectedKolaborator() {
            var selectedKolaborator = $('#penanggungjawab_id').val();
            var selectedKolaboratorHTML = '';

            if (selectedKolaborator) {
                selectedKolaborator.forEach(function(id, index) {
                    var username = $('#penanggungjawab_id option[value="' + id + '"]').text();
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
            var select = $('#penanggungjawab_id').select2();
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