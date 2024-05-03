@extends('layouts.main')
@section('content')

<section class="mb-4">
    @if (session('success'))
    <div class="p-4 text-md text-center text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <form method="post" action="/main-menu/role/{{ $role->id }}/addPermissionsToRole" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="space-y-12 font-medium">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Role : {{ $role->name }}</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Hak Akses</label>
                        @foreach ($permissions as $permission)

                        <div class="mt-2">
                            <label for="">
                                <input type="checkbox" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="permissions[]" autocomplete="" autofocus value="{{$permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : ''}} >
                                {{ $permission->name }}
                                @error('permission')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                        @endforeach
                    </div>

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