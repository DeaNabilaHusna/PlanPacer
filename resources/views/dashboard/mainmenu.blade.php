@auth
@extends('layouts.main')
  @section('content')
  <!-- Content -->
    <!-- Page Heading -->
    <header class="mb-4">
      <p class="text-3xl font-extrabold text-defblack">Halo, {{ auth()->user()->username }}</p>
      <h1 class="block text-base font-semibold text-defblack sm:text-md">Selamat Datang Kembali</h1>
    </header>
    <!-- End Page Heading -->
    <section>
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-12">
        <div class="flex justify-center items-center w-52 h-28 bg-defgrey rounded-lg">
          <span>1</span>
        </div>
        <div class="flex justify-center items-center w-52 h-28 bg-defgrey rounded-lg">
          <span>1</span>
        </div>
        <div class="flex justify-center items-center w-52 h-28 bg-defgrey rounded-lg">
          <span>1</span>
        </div>
      </div>
    </section>
    <section class="my-4">
      <div>
        <h1 class="block text-xl font-semibold text-defblack sm:text-lg mb-4">Proyek</h1>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-12">
          <div class="flex justify-center items-center w-56 h-36 bg-defgrey rounded-lg">
            <span>1</span>
          </div>
          <div class="flex justify-center items-center w-56 h-36 bg-defgrey rounded-lg">
            <span>1</span>
          </div>
          <div class="flex justify-center items-center w-56 h-36 bg-defgrey rounded-lg">
            <span>1</span>
          </div>
          <div class="flex justify-center items-center w-56 h-36 bg-defgrey rounded-lg">
            <span>1</span>
          </div>
        </div>
      </div>
      <div>
        <h1 class="block text-xl font-semibold text-defblack sm:text-lg my-4">Tugas Hari Ini</h1>
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
                  Tenggat Waktu
                </th>
                <th scope="col" class="px-6 py-3">
                  Status
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
                  <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Selesai</span>
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
                  <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Selesai</span>
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
                  <span class="bg-yellow text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Dalam Proses</span>
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
                  <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Selesai</span>
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
                  <span class="bg-yellow text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Dalam Proses</span>
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
