@extends('layouts.main')
@section('content')

<section class="mb-4">
    <form method="post" action="/main-menu/kolaborator/{{ $kolaborator->id }}" enctype="multipart/form-data">


        @method('put')
        @csrf
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Atur Role</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Kolaborator</label>
                        <div class="mt-2 ">
                            <input type="text" id="email" name="email" value="{{ old('email', $kolaborator->email) }}" readonly disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="nama_proyek" class="block text-sm font-medium leading-6 text-gray-900">Nama Proyek</label>
                        <div class="mt-2 ">
                            <input type="text" id="nama_proyek" name="nama_proyek" value="{{ old('nama_proyek', $kolaborator->nama_proyek) }}" readonly disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            @error('nama_proyek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="roles" class="block text-sm font-medium leading-6 text-gray-900">Pilih Role</label>
                        <div class="mt-2">
                            @foreach($roles as $roleId => $roleName)
                            @if($roleName !== 'pic')
                            <div class="flex items-center mb-2">
                                <input id="role-{{ $roleId }}" name="roles" type="radio" value="{{ $roleId }}" class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out" {{ optional($kolaborator)->roles && in_array($roleId, $kolaborator->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="role-{{ $roleId }}" class="ml-2 block text-sm leading-5 text-gray-900">{{ $roleName }}</label>
                            </div>
                            @endif
                            @endforeach
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