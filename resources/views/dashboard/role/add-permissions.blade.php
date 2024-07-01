@extends('layouts.main')
@section('content')

<section class="mb-4">
    @if (session('success'))
    <div class="p-4 text-md text-center text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <form method="post" action="/main-menu/role/{{ $role->id }}/tambah-hak-akses" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-4 flex justify-between">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Role : {{ $role->name }}</h2>
                <a href="/main-menu/role"><button type="button" class=" rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Kembali</button></a>
            </div>
            @error('permission')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
            <label for="">Hak Akses</label>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($permissions as $permission)
                <div class="flex items-center">
                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                    <label class="ml-2">
                        {{ $permission->name }}
                    </label>
                </div>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/main-menu/role"><button type="button" class="rounded-md bg-gray-400 px-3 py-2 shadow-sm hover:bg-gray-700 hover:text-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-sm font-semibold leading-6 text-defblack">Batal</button></a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
        </div>

    </form>

</section>


@endsection