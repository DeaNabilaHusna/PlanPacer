@extends('layouts.main')
@section('content')

<!-- Breadcrumb -->
@php
$segments = Request::segments();
$segmentCount = count($segments);
@endphp

<div class="flex flex-row items-center space-x-3 text-sm text-gray-800 font-bold">
    @for ($index = 1; $index < $segmentCount; $index++) <div>
        {{ ucfirst($segments[$index]) }}
        @if ($index < $segmentCount - 1) <svg class="inline-block w-4 h-4 text-gray-400" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 1L10.687 7.161C10.864 7.352 10.864 7.648 10.687 7.839L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            @endif
</div>
@endfor
</div>


<!-- End Breadcrumb -->

<section class="mb-4">
    <div>
        <div class="px-4 sm:px-0">
            <h3 class="my-4 text-base font-semibold leading-7 text-gray-900">Informasi Detail Proyek</h3>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nama Aplikasi/Proyek</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->project_name ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">PenanggungJawab Proyek</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->project_manager ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">URL Proyek</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->project_url ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Lokasi Proyek</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->project_location ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Narahubung</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->contact_person ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Visibilitas</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->visibility ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Kolaborator</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        @if ($kolaborator->isNotEmpty())
                        <ul>
                            @foreach ($kolaborator as $user)
                            <li>{{ $user->username }} <strong>(
                                    @if ($user->pivot->role_id)
                                    {{ App\Models\Role::find($user->pivot->role_id)->name }}
                                    @else
                                    Role tidak ditemukan
                                    @endif
                                    )
                                </strong>
                            </li>
                            @endforeach

                        </ul>
                        @else
                        <span>–</span>
                        @endif
                    </dd>
                </div>



                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Tanggal Mulai</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::parse($proyek->project_start_date)->translatedFormat('l, d F Y') }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Tanggal Selesai</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::parse($proyek->project_end_date)->translatedFormat('l, d F Y') }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Status Proyek</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $proyek->project_status ?? '–' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">File Pendukung</dt>
                    <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                            @foreach ($docs as $doc)
                            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                    </svg> -->
                                    <svg height=20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.035 512.035" xml:space="preserve">
                                        <g transform="translate(1 1)">
                                            <polygon style="fill:#E2E3E5;" points="464.084,127.035 344.617,7.568 250.751,7.568 250.751,502.501 464.084,502.501 	" />
                                            <polygon style="fill:#CCCCCC;" points="438.484,127.035 319.017,7.568 225.151,7.568 225.151,502.501 438.484,502.501 	" />
                                            <polygon style="fill:#FFFFFF;" points="267.817,127.035 148.351,7.568 54.484,7.568 54.484,502.501 267.817,502.501 	" />
                                            <polygon style="fill:#E2E3E5;" points="412.884,127.035 310.484,7.568 80.084,7.568 80.084,502.501 412.884,502.501 	" />
                                            <polygon style="fill:#F0F0F0;" points="319.017,7.568 319.017,127.035 438.484,127.035 	" />
                                            <g>
                                                <path style="fill:#B6B6B6;" d="M353.151,203.835H139.817c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533C361.684,200.421,358.271,203.835,353.151,203.835z" />
                                                <path style="fill:#B6B6B6;" d="M225.151,135.568h-85.333c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h85.333
			c5.12,0,8.533,3.413,8.533,8.533S230.271,135.568,225.151,135.568z" />
                                                <path style="fill:#B6B6B6;" d="M353.151,272.101H139.817c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533C361.684,268.688,358.271,272.101,353.151,272.101z" />
                                                <path style="fill:#B6B6B6;" d="M353.151,340.368H139.817c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533S358.271,340.368,353.151,340.368z" />
                                                <path style="fill:#B6B6B6;" d="M353.151,408.635H139.817c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h213.333
			c5.12,0,8.533,3.413,8.533,8.533S358.271,408.635,353.151,408.635z" />
                                                <path style="fill:#B6B6B6;" d="M438.484,511.035h-384c-5.12,0-8.533-3.413-8.533-8.533V7.568c0-5.12,3.413-8.533,8.533-8.533
			h264.533c2.56,0,4.267,0.853,5.973,2.56l119.467,119.467c1.707,1.707,2.56,3.413,2.56,5.973v375.467
			C447.017,507.621,443.604,511.035,438.484,511.035z M63.017,493.968h366.933v-363.52L315.604,16.101H63.017V493.968z" />
                                                <path style="fill:#B6B6B6;" d="M438.484,135.568H319.017c-5.12,0-8.533-3.413-8.533-8.533V7.568c0-3.413,1.707-6.827,5.12-7.68
			c3.413-1.707,6.827-0.853,9.387,1.707l119.467,119.467c2.56,2.56,3.413,5.973,1.707,9.387
			C445.311,133.861,441.897,135.568,438.484,135.568z M327.551,118.501h90.453l-90.453-90.453V118.501z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                        <span class="truncate font-medium">{{ basename($doc->file_name) ?: '–' }}</span> <!-- Assuming $file->name contains the file name -->
                                    </div>
                                </div>
                               
                            </li>
                            @endforeach
                        </ul>
                        <!-- <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                            <div class="flex w-0 flex-1 items-center">
                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <span class="truncate font-medium">resume_back_end_developer.pdf</span>
                                    <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                            </div>
                        </li>
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                            <div class="flex w-0 flex-1 items-center">
                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <span class="truncate font-medium">coverletter_back_end_developer.pdf</span>
                                    <span class="flex-shrink-0 text-gray-400">4.5mb</span>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                            </div>
                        </li> -->
                    </dd>
                </div>
            </dl>
        </div>
    </div>



</section>

@endsection