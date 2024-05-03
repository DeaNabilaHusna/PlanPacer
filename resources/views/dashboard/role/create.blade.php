@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/role">
        @csrf
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Tambah Role</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama Role</label>
                        <div class="mt-2">
                            <input type="text" id="name" name="name" autocomplete="name" autofocus value="{{ old('name') }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="sm:col-span-4">
                        <label for="visibilitas" class="block text-sm font-medium leading-6 text-gray-900">Visibilitas</label>
                        <div class="mt-2">
                            <select id="visibilitas" name="visibilitas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <?php foreach (['private', 'terbatas'] as $visibility) : ?>
                                    @if (old('visibilitas') == $visibility)
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
                    </div> -->

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
           <a href="/main-menu/role"><button type="button" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</button></a> 
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
        </div>
    </form>

</section>


@endsection