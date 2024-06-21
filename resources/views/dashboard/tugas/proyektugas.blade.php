@extends('layouts.main')
@section('content')
    <section>

        <!-- Breadcrumb -->
        <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
            <li class="flex items-center text-sm text-gray-800">
                <a href="/main-menu/proyek" class="text-sm font-semibold text-gray-800 truncate">Proyek</a>
                <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16"
                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" />
            </svg>
        </li>
        @foreach ($proyek as $item)
            <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
                <p class="text-sm font-semibold text-gray-800 truncate">{{ $item->nama_proyek }}</p>
            </li>
            @endforeach
        </ol>
        <br>
        <!-- End Breadcrumb -->
        <div class="flex justify-between items-center my-4">
            <h1 class="text-xl font-semibold text-defblack sm:text-lg">Tugas</h1>

            <div class="flex items-center">
               
                @foreach ($proyek as $item)

                    <a href="/main-menu/proyek/{{ $item->slug }}/tugas/create">
                        <button type="button" class="flex justify center items-center text-sm rounded-md bg-navy text-defwhite gap-2 px-3 py-1.5 shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5625 11.1111C6.5625 11.3321 6.66127 11.5441 6.83709 11.7004C7.0129 11.8567 7.25136 11.9445 7.5 11.9445C7.74864 11.9445 7.9871 11.8567 8.16291 11.7004C8.33873 11.5441 8.4375 11.3321 8.4375 11.1111V7.50002H12.5C12.7486 7.50002 12.9871 7.41222 13.1629 7.25594C13.3387 7.09966 13.4375 6.8877 13.4375 6.66669C13.4375 6.44567 13.3387 6.23371 13.1629 6.07743C12.9871 5.92115 12.7486 5.83335 12.5 5.83335H8.4375V2.22225C8.4375 2.00123 8.33873 1.78927 8.16291 1.63299C7.9871 1.47671 7.74864 1.38892 7.5 1.38892C7.25136 1.38892 7.0129 1.47671 6.83709 1.63299C6.66127 1.78927 6.5625 2.00123 6.5625 2.22225V5.83335H2.5C2.25136 5.83335 2.0129 5.92115 1.83709 6.07743C1.66127 6.23371 1.5625 6.44567 1.5625 6.66669C1.5625 6.8877 1.66127 7.09966 1.83709 7.25594C2.0129 7.41222 2.25136 7.50002 2.5 7.50002H6.5625V11.1111Z" fill="#F1F2F3" />
                            </svg>
                            Tambah</button>
                    </a>
                    @endforeach
                </div>
            </div>
            
         
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-4">
        @foreach ($tugas as $tugasItem)
                <div class="bg-blue-800 p-4 text-white rounded-lg shadow-lg h-min">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-lg">{{ $tugasItem->nama_kartu }}</h2>
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-1 px-2 border border-gray-400 rounded shadow">
                            Hapus
                        </button>
                    </div>

                    @foreach ($tugasItem->tugasItems as $item)
                        <div class="bg-white p-3 rounded-lg mt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold">{{ $item->nama_tugas_item }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">3 kontributor</span>
                            </div>
                            <div class="flex justify-between mb-1">
                                <span class="text-base font-sm text-defblack">Progress</span>
                                <span class="text-sm font-sm text-defblack font-semibold">45%</span>
                            </div>
                            <div class="w-full bg-gray-400 rounded-full h-2.5">
                                <div class="bg-blue-700 h-2.5 rounded-full" style="width: 67%"></div>
                            </div>
                        </div>
                @endforeach


            </div>
            @endforeach
        </div>

    </section>
@endsection
