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
                <h1 class="text-xl font-semibold text-defblack sm:text-lg">Kolabolator</h1>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 font-raleway">
                    <thead class="text-xs text-gray-700 uppercase bg-defgrey">
                        <tr>
                            <th scope="col" class="px-6 py-3">

                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email Kolabolator
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Proyek
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Aksi
                            </th>

                        </tr>
                    </thead>
                    @foreach ($kolaborators as $kolaborator)
                    <tbody>
                        <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                            <td class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kolaborator->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kolaborator->nama_proyek }}
                            </td>
                            <td class="px-6 py-4">
                                @if (!empty($kolaborator->roles))
                                @foreach ($kolaborator->roles as $rolename)
                                {{ $rolename }}
                                @endforeach
                                @else
                                <p class="text-red-500">Belum ditetapkan</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex justify-center space-x-2">
                                <button>
                                    <a href="/main-menu/kolaborator/{{ $kolaborator->id }}/detail" class="bg-blue-700 hover:bg-navy text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                        Detail
                                    </a>
                                </button>
                                <a href="/main-menu/kolaborator/{{ $kolaborator->id }}/edit" class="bg-yellow hover:bg-orange-600 text-white font-bold py-2 px-4 border border-yellow rounded">
                                    Atur Role
                                </a>
                                <button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </section>
        @endsection