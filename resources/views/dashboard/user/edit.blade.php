@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/kolaborator/{{ $userProyek->id }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Atur Role</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Kolaborator</label>
                        <div class="mt-2 ">
                            <input type="text" id="email" name="email" value="{{ old('email', $userProyek->email) }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="nama_proyek" class="block text-sm font-medium leading-6 text-gray-900">Nama Proyek</label>
                        <div class="mt-2 ">
                            <input type="text" id="nama_proyek" name="nama_proyek" value="{{ old('nama_proyek', $userProyek->nama_proyek) }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('nama_proyek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="roles" class="block text-sm font-medium leading-6 text-gray-900">Pilih Role</label>
                        <div class="mt-2">
                            <select id="roles" name="roles[]" multiple class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($roles as $roleId => $roleName)
                                    <option value="{{ $roleId }}" {{ optional($userProyek)->roles && in_array($roleId, $userProyek->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $roleName }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="/main-menu/kolaborator"><button type="button" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</button></a> 
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
        </div>
    </form>

</section>

@endsection