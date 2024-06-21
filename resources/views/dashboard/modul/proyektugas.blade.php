@extends('layouts.main')
@section('content')
<section>
    @if (session('success'))
    <div class="p-4 text-md text-center text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <!-- Breadcrumb -->
    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
        <li class="flex items-center text-sm text-gray-800">
            <a href="/main-menu/proyek" class="text-sm font-semibold text-gray-800 truncate">Proyek</a>
            <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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
        <h1 class="text-xl font-semibold text-defblack sm:text-lg">Modul</h1>

        <div class="flex items-center">

            @foreach ($proyek as $item)

            <a href="/main-menu/proyek/{{ $item->slug }}/modul/create">
                <button type="button" class="flex justify center items-center text-sm rounded-md bg-navy text-defwhite gap-2 px-3 py-1.5 shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
        <div class="bg-blue-700 p-4 text-white rounded-lg shadow-lg h-min">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg truncate">{{ $tugasItem->nama_kartu }}</h2>
                @foreach ($proyek as $item)
                <div class="flex items-center gap-0">
                    <a href="/main-menu/proyek/{{ $item->slug }}/modul/{{ $tugasItem->id }}/edit" class="py-2 px-2 text-white hover:bg-white hover:text-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center"><svg class="" width="20" height="20" viewBox="0 0 761 761" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M602.36 634.063H158.516C150.108 634.063 142.044 637.403 136.098 643.349C130.153 649.294 126.813 657.358 126.813 665.766C126.813 674.175 130.153 682.238 136.098 688.184C142.044 694.129 150.108 697.47 158.516 697.47H602.36C610.768 697.47 618.832 694.129 624.778 688.184C630.723 682.238 634.063 674.175 634.063 665.766C634.063 657.358 630.723 649.294 624.778 643.349C618.832 637.403 610.768 634.063 602.36 634.063Z" fill="currentColor" />
                            <path d="M158.518 570.656H161.371L293.573 558.609C308.055 557.166 321.6 550.786 331.934 540.538L617.262 255.21C628.337 243.51 634.322 227.898 633.906 211.793C633.49 195.689 626.707 180.406 615.043 169.294L528.176 82.4276C516.839 71.7783 501.983 65.668 486.434 65.2588C470.885 64.8496 455.728 70.1702 443.846 80.2083L158.518 365.537C148.27 375.871 141.889 389.416 140.447 403.898L126.814 536.1C126.387 540.743 126.99 545.424 128.579 549.808C130.168 554.192 132.705 558.171 136.008 561.462C138.971 564.401 142.484 566.725 146.346 568.303C150.209 569.881 154.345 570.68 158.518 570.656ZM484.109 126.812L570.659 213.362L507.252 275.183L422.288 190.218L484.109 126.812Z" fill="currentColor" />
                        </svg>
                    </a>
                    <form action="/main-menu/proyek/{{ $item->slug }}/modul/{{ $tugasItem->slug }}" method="post" class="mb-0">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Apakah anda yakin ingin menghapus proyek ini?')" class="py-2 px-2 text-white hover:bg-white hover:text-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center"><svg class="" width="20" height="20" viewBox="0 0 761 979" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32.609 108.696H728.27C752.281 108.696 760.876 206.523 760.876 206.523H0C0 206.523 8.59779 108.696 32.609 108.696ZM315.221 0H445.657C457.663 0 489.135 31.4721 489.135 43.4778C489.135 55.4834 457.663 86.9583 445.657 86.9583H315.221C303.216 86.9583 271.741 55.4834 271.741 43.4778C271.741 31.4721 303.216 0 315.221 0ZM97.827 239.132H663.049C687.063 239.132 706.529 258.598 706.529 282.612L663.049 934.793C663.049 958.804 643.585 978.27 619.571 978.27H141.308C117.294 978.27 97.827 958.804 97.827 934.793L54.3493 282.612C54.3493 258.598 73.8158 239.132 97.827 239.132ZM163.045 326.09L173.917 891.312H250.003L239.135 326.09H163.045ZM336.962 326.09V891.312H423.917V326.09H336.962ZM521.744 326.09L510.875 891.312H586.962L597.834 326.09H521.744Z" fill="currentColor" />
                            </svg>
                        </button>

                    </form>
                </div>

                @endforeach
            </div>

            @foreach ($tugasItem->tugasItems as $item)
            <div class="bg-white p-2 rounded-lg mt-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-semibold">{{ $item->nama_tugas_item }}</span>
                </div>
            </div>
            @endforeach

            @foreach ($proyek as $item)
            @foreach ($tugas as $tugasItem)
            <div class="bg-[#788bca] border-dashed border-2 border-defwhite p-3 rounded-lg mt-4">
                <div class="flex justify-center items-center">
                    <a href="/main-menu/proyek/{{ $item->slug }}/modul/{{ $tugasItem->slug }}/create" class="flex flex-col items-center space-y-1">
                        <svg width="15" height="15" viewBox="0 0 761 761" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M706.528 298.916H461.96V54.3483C461.96 24.3378 437.623 0 407.612 0H353.264C323.253 0 298.916 24.3378 298.916 54.3483V298.916H54.3483C24.3378 298.916 0 323.253 0 353.264V407.612C0 437.623 24.3378 461.96 54.3483 461.96H298.916V706.528C298.916 736.538 323.253 760.876 353.264 760.876H407.612C437.623 760.876 461.96 736.538 461.96 706.528V461.96H706.528C736.538 461.96 760.876 437.623 760.876 407.612V353.264C760.876 323.253 736.538 298.916 706.528 298.916Z" fill="white" />
                        </svg>
                        <p class="text-sm font-bold text-defwhite">Tambah Tugas</p>
                    </a>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
        @endforeach
    </div>

</section>
@endsection