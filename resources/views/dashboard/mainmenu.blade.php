@auth
@extends('layouts.main')
@section('content')
<!-- Content -->
<!-- Page Heading -->
<header class="my-10">
  <div class="rounded-2xl bg-[#DCD6F7] p-4 relative sm:bg-transparent md:bg-transparent md:bg-[#d1d0f5]">
    <div class="m-8">
      <p class="text-3xl font-extrabold text-defblack">Halo, {{ auth()->user()->username }}</p>
      <h1 class="block text-base font-semibold text-defblack sm:text-md">Selamat Datang Kembali</h1>
    </div>
    <img src="/../images/header-pic.png" alt="" class="absolute -top-16 right-10 w-[260px] h-auto z-10 mt-[-1.5rem] hidden md:block">
  </div>
</header>


<!-- End Page Heading -->
<section>
  <h1 class="block text-xl font-semibold text-defblack sm:text-lg mb-4">Overview</h1>
  <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-12">
    <div class="flex justify-start items-center w-50 h-20 bg-[#424874] rounded-lg">
      <svg class="mx-6" fill="#ffffff" width="30px" height="30px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <g>
          <path d="M2,9H9V2H2Zm9-7V9h7V2ZM2,18H9V11H2Zm9,0h7V11H11Z" />
        </g>
      </svg>
      <div class="mx-6 text-defwhite">
        <h1 class="text-3xl font-semibold">{{ $projectCount }}</h1>
        <span class="text-sm">Proyek</span>
      </div>
    </div>
    <div class="flex justify-start items-center w-50 h-20 bg-[#535C91] rounded-lg">
      <svg class="mx-6" width="30px" height="30px" viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <style type="text/css">
          .st0 {
            fill: #ffffff;
          }

          .st1 {
            fill: none;
            stroke: #000000;
            stroke-width: 32;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-miterlimit: 10;
          }
        </style>
        <g id="Layer_1" />
        <g id="Layer_2">
          <g>
            <path class="st0" d="M256,43.5C138.64,43.5,43.5,138.64,43.5,256S138.64,468.5,256,468.5S468.5,373.36,468.5,256    S373.36,43.5,256,43.5z M378.81,222.92L249.88,351.86c-7.95,7.95-18.52,12.33-29.76,12.33s-21.81-4.38-29.76-12.33l-57.17-57.17    c-8.3-8.3-12.87-19.35-12.87-31.11s4.57-22.81,12.87-31.11c8.31-8.31,19.36-12.89,31.11-12.89s22.8,4.58,31.11,12.89l24.71,24.7    l96.47-96.47c8.31-8.31,19.36-12.89,31.11-12.89c11.75,0,22.8,4.58,31.11,12.89c8.3,8.3,12.87,19.35,12.87,31.11    S387.11,214.62,378.81,222.92z" />
          </g>
        </g>
      </svg>
      <div class="mx-6 text-defwhite">
        <h1 class="text-3xl font-semibold">{{ $projectComplete }}</h1>
        <span class="text-sm">Proyek Selesai</span>
      </div>
    </div>
    <div class="flex justify-start items-center w-50 h-20 bg-[#9290C3] rounded-lg">
      <svg fill="#ffffff" class="mx-6" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 47 47" xml:space="preserve">
        <g>
          <g id="Layer_1_22_">
            <g>
              <path d="M6.12,38.52V5.136h26.962v28.037l5.137-4.243V2.568C38.219,1.15,37.07,0,35.652,0h-32.1C2.134,0,0.985,1.15,0.985,2.568
				v38.519c0,1.418,1.149,2.568,2.567,2.568h22.408L22.33,38.52H6.12z" />
              <path d="M45.613,27.609c-0.473-0.446-1.2-0.467-1.698-0.057l-11.778,9.734l-7.849-4.709c-0.521-0.312-1.188-0.219-1.603,0.229
				c-0.412,0.444-0.457,1.117-0.106,1.613l8.506,12.037c0.238,0.337,0.625,0.539,1.037,0.543c0.004,0,0.008,0,0.012,0
				c0.408,0,0.793-0.193,1.035-0.525l12.6-17.173C46.149,28.78,46.084,28.055,45.613,27.609z" />
              <path d="M27.306,8.988H11.897c-1.418,0-2.567,1.15-2.567,2.568s1.149,2.568,2.567,2.568h15.408c1.418,0,2.566-1.15,2.566-2.568
				S28.724,8.988,27.306,8.988z" />
              <path d="M27.306,16.691H11.897c-1.418,0-2.567,1.15-2.567,2.568s1.149,2.568,2.567,2.568h15.408c1.418,0,2.566-1.149,2.566-2.568
				C29.874,17.841,28.724,16.691,27.306,16.691z" />
              <path d="M27.306,24.395H11.897c-1.418,0-2.567,1.15-2.567,2.568s1.149,2.568,2.567,2.568h15.408c1.418,0,2.566-1.15,2.566-2.568
				C29.874,25.545,28.724,24.395,27.306,24.395z" />
            </g>
          </g>
        </g>
      </svg>
      <div class="mx-6 text-defwhite">
        <h1 class="text-3xl font-semibold">{{ $taskComplete }}</h1>
        <span class="text-sm">Tugas Selesai</span>
      </div>
    </div>
  </div>
</section>
<section class="my-6">
  <div>
    <h1 class="block text-xl font-semibold text-defblack sm:text-lg mb-4">Proyek</h1>
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-12">
      @foreach ($projects as $project )
      <div class="max-w-sm h-min p-6 bg-defwhite border border-gray-200 rounded-lg shadow ">
        <div class="flex items-center justify-between">
          @php
          $bgColor = '';
          $textColor = '';
          if ($project->project_status == 'sedang berjalan') {
          $bgColor = 'bg-orange-300';
          $textColor = 'text-orange-800';
          } elseif ($project->project_status == 'selesai') {
          $bgColor = 'bg-green-300';
          $textColor = 'text-green-800';
          }
          @endphp
          <span class="{{ $bgColor }} {{ $textColor }} text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $project->project_status }}</span>
        </div>
        @php
        $lockIcon = '<svg fill="#000000" width="12px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <path d="M25 12h-1v-3.816c0-4.589-3.32-8.184-8.037-8.184-4.736 0-7.963 3.671-7.963 8.184v3.816h-1c-2.206 0-4 1.794-4 4v12c0 2.206 1.794 4 4 4h18c2.206 0 4-1.794 4-4v-12c0-2.206-1.794-4-4-4zM10 8.184c0-3.409 2.33-6.184 5.963-6.184 3.596 0 6.037 2.716 6.037 6.184v3.816h-12v-3.816zM27 28c0 1.102-0.898 2-2 2h-18c-1.103 0-2-0.898-2-2v-12c0-1.102 0.897-2 2-2h18c1.102 0 2 0.898 2 2v12zM16 18c-1.104 0-2 0.895-2 2 0 0.738 0.405 1.376 1 1.723v3.277c0 0.552 0.448 1 1 1s1-0.448 1-1v-3.277c0.595-0.346 1-0.985 1-1.723 0-1.105-0.895-2-2-2z"></path>
        </svg>';
        @endphp
        <a href="/main-menu/proyek/{{ $project->slug }}/modul">
          <h5 class="flex items-center gap-2 pt-2 text-xl font-bold tracking-tight text-defblack">
            <span class="inline-block truncate" title="{{ $project->project_name }}">
              {{ Str::limit($project->project_name, 15) }}
            </span>
            @if ($project->visibility == 'private')
            {!! $lockIcon !!}
            @endif
          </h5>
        </a>
        <p class="py-1font-normal text-gray-700">{{ $project->users_count }} Kontributor</p>
        <div class="flex justify-between mb-1">
          <span class="text-base font-sm text-defblack">Progress</span>
          <span class="text-sm font-sm text-defblack font-semibold">45%</span>
        </div>
        <div class="w-full bg-[#e7e2f9] rounded-full h-2.5">
          <div class="bg-[#424874] h-2.5 rounded-full" style="width: 45%"></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div>
    <h1 class="block text-xl font-semibold text-defblack sm:text-lg my-4">Tugas Hari Ini</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 font-raleway">
        <thead class="text-xs text-defwhite uppercase bg-[#9290C3]">
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
              Tenggat Waktu
            </th>
            <th scope="col" class="px-6 py-3">
              Status
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b hover:bg-defgrey text-defblack ">
            @foreach ($tasks as $task)
            <td class="px-6 py-4 font-medium whitespace-nowrap">
              {{ $loop->iteration }}
            </td>
            <td class="px-6 py-4">
              {{ $task->task_name }}
            </td>
            <td class="px-6 py-4">
              {{ $task->project_name }}
            </td>
            <td class="px-6 py-4">
            {{ \Carbon\Carbon::parse($task->task_end_date)->translatedFormat('l, d F Y') }}
            </td>
            <td class="px-6 py-4">
              @if ($task->task_status == 'selesai')
              <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $task->task_status }}</span>
              @elseif ($task->task_status == 'dalam proses')
              <span class="bg-orange-300 text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $task->task_status }}</span>
              @endif
            </td>
            @endforeach

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- End Content -->
@endsection
@endauth

<!-- ========== END MAIN CONTENT ========== -->