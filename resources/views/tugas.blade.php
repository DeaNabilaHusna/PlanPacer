@extends('layouts.main')
@section('content')
    <section>
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold text-defblack sm:text-lg">Tugas</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 font-raleway">
                <thead class="text-xs text-gray-700 uppercase bg-defgrey">
                    <tr>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tugas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Proyek
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Mulai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Selesai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            1
                        </td>
                        <td class="px-6 py-4">
                            Tugas 1
                        </td>
                        <td class="px-6 py-4">
                            Proyek 1
                        </td>
                        <td class="px-6 py-4">
                            01-01-2024
                        </td>
                        <td class="px-6 py-4">
                            01-07-2024
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/detailtugas"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            2
                        </td>
                        <td class="px-6 py-4">
                            Tugas 1
                        </td>
                        <td class="px-6 py-4">
                            Proyek 1
                        </td>
                        <td class="px-6 py-4">
                            01-01-2024
                        </td>
                        <td class="px-6 py-4">
                            01-07-2024
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/detailtugas"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            3
                        </td>
                        <td class="px-6 py-4">
                            Tugas 1
                        </td>
                        <td class="px-6 py-4">
                            Proyek 1
                        </td>
                        <td class="px-6 py-4">
                            01-01-2024
                        </td>
                        <td class="px-6 py-4">
                            01-07-2024
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Dalam
                                Proses</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/detailtugas"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            4
                        </td>
                        <td class="px-6 py-4">
                            Tugas 1
                        </td>
                        <td class="px-6 py-4">
                            Proyek 1
                        </td>
                        <td class="px-6 py-4">
                            01-01-2024
                        </td>
                        <td class="px-6 py-4">
                            01-07-2024
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/detailtugas"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            5
                        </td>
                        <td class="px-6 py-4">
                            Tugas 1
                        </td>
                        <td class="px-6 py-4">
                            Proyek 1
                        </td>
                        <td class="px-6 py-4">
                            01-01-2024
                        </td>
                        <td class="px-6 py-4">
                            01-07-2024
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Dalam
                                Proses</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/detailtugas"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
