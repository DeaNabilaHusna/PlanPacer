@extends('layouts.main')
@section('content')

<!-- Breadcrumb -->
@php
$segments = Request::segments();
$segmentCount = count($segments);
@endphp

@for ($index = 1; $index < $segmentCount; $index++) <div class="flex flex-row items-center text-sm text-gray-800">
    {{ ucfirst($segments[$index]) }}
    @if ($index < $segmentCount - 1) <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 font-bold" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
        @endif
        </div>
        @endfor


        <section>
            @if (session('success'))
            <div class="p-4 text-md text-center text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-defblack sm:text-lg">Role</h1>
                <div class="flex items-center">
                    <a href="/main-menu/role/create">
                        <button type="button" class="flex justify center items-center text-sm rounded-md bg-navy text-defwhite gap-2 px-3 py-1.5 shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5625 11.1111C6.5625 11.3321 6.66127 11.5441 6.83709 11.7004C7.0129 11.8567 7.25136 11.9445 7.5 11.9445C7.74864 11.9445 7.9871 11.8567 8.16291 11.7004C8.33873 11.5441 8.4375 11.3321 8.4375 11.1111V7.50002H12.5C12.7486 7.50002 12.9871 7.41222 13.1629 7.25594C13.3387 7.09966 13.4375 6.8877 13.4375 6.66669C13.4375 6.44567 13.3387 6.23371 13.1629 6.07743C12.9871 5.92115 12.7486 5.83335 12.5 5.83335H8.4375V2.22225C8.4375 2.00123 8.33873 1.78927 8.16291 1.63299C7.9871 1.47671 7.74864 1.38892 7.5 1.38892C7.25136 1.38892 7.0129 1.47671 6.83709 1.63299C6.66127 1.78927 6.5625 2.00123 6.5625 2.22225V5.83335H2.5C2.25136 5.83335 2.0129 5.92115 1.83709 6.07743C1.66127 6.23371 1.5625 6.44567 1.5625 6.66669C1.5625 6.8877 1.66127 7.09966 1.83709 7.25594C2.0129 7.41222 2.25136 7.50002 2.5 7.50002H6.5625V11.1111Z" fill="#F1F2F3" />
                            </svg>
                            Tambah</button>
                    </a>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 font-raleway">
                    <thead class="text-xs text-gray-700 uppercase bg-defgrey">
                        <tr>
                            <th scope="col" class="px-6 py-3">

                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Role
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Hak Akses
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Aksi
                            </th>

                        </tr>
                    </thead>
                    @foreach ($roles as $role)

                    <tbody>
                        <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                            <td class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $role->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if($role->permissions->isNotEmpty())
                                <div class="flex flex-wrap gap-1">
                                    @foreach($role->permissions as $permission)
                                    <span class="inline-block bg-green-300 text-green-800 text-xs font-semibold py-1 px-2 rounded-full">{{ str_replace('_', ' ', $permission->name) }}</span>
                                    @endforeach
                                </div>
                                @else
                                <span>Belum diberikan hak akses</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex justify-center space-x-2">
                                <!-- <button>
                                    <a href="/main-menu/role/{{ $role->id }}" class="bg-blue-700 hover:bg-navy text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                        Detail
                                    </a>
                                </button> -->
                                <a href="/main-menu/role/{{ $role->id }}/tambah-hak-akses" class="bg-emerald-600 hover:bg-emerald-900 text-white font-bold py-2 px-4 border border-emerald-700 rounded">
                                    Tambah Hak Akses
                                </a>
                                <button>
                                    <a href="/main-menu/role/{{ $role->id }}/edit" class="bg-yellow hover:bg-orange-600 text-white font-bold py-2 px-4 border border-yellow rounded">
                                        Edit
                                    </a>
                                </button>
                                <form action="/main-menu/role/{{ $role->id }}" method="post" class="mb-0">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Apakah anda yakin ingin menghapus role ini?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endsection