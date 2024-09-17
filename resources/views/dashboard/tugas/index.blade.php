@extends('layouts.main')
@section('content')
<section>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-defblack sm:text-lg">Modul</h1>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-700 font-raleway">
            <thead class="text-xs text-gray-700 uppercase bg-defgrey">
                <tr>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modul
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
                </tr>
            </thead>
            <tbody>
                @foreach($moduls as $modul)
                <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
                    <td class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $modul->modul_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $modul->project_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($modul->modul_start_date)->translatedFormat('l, d F Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($modul->modul_end_date)->translatedFormat('l, d F Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($modul->modul_status == 'selesai')
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $modul->modul_status }}</span>
                        @elseif ($modul->modul_status == 'dalam proses')
                        <span class="bg-orange-300 text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $modul->modul_status }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="my-4">
        {{ $moduls->links() }}
    </div>
</section>
@endsection