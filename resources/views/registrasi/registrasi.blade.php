<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Registrasi</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<body class="flex min-h-screen justify-center items-center font-raleway bg-navy">
    <div class="hidden lg:block w-1/2 bg-defwhite h-full relative">
        <img class="object-cover h-full w-full" src="images/loginpic.png" alt="">
    </div>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 md:mx-auto md:w-full md:max-w-sm">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-defwhite">
            <h1 class="text-xl text-center"><span class="font-bold">Welcome to </span><span class="font-paytone">Plan<span class="text-yellow">Pacer</span></span></h1>
            <p class="text-base text-center font-bold">Bergabung Untuk Melanjutkan</p>
            <form class="space-y-6 mt-2" action="/registrasi" method="POST">
                @csrf
                <!-- Input Nama Pengguna -->
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-defwhite">Nama Pengguna</label>
                    <div class="mt-1">
                        <input id="username" name="username" type="text" placeholder="Nama Pengguna" autocomplete="username" required autofocus value="{{ old('username') }}" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500">
                        @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-defwhite">Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" placeholder="nama@email.com" autocomplete="email" required value="{{ old('email') }}" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-defwhite">Kata Sandi</label>
                    </div>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" placeholder="••••••••" autocomplete="current-password" required class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Input No Telp -->
                <div>
                    <label for="phone" class="block text-sm font-medium leading-6 text-defwhite">No. Telp</label>
                    <div class="mt-1">
                        <input id="phone" name="phone" type="text" placeholder="08xxxxxxxxxxx" autocomplete="phone" value="{{ old('phone') }}" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500">
                        @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="w-28 rounded-md bg-yellow px-3 py-1.5 text-sm font-semibold leading-6 text-defwhite shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat Akun</button>
                </div>

                <p class="text-center text-base">Atau lanjutkan dengan</p>
                <button class="flex justify-center items-center w-full h-9 bg-defwhite rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-slate-400 hover:text-defwhite hover:font-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><img src="images/google.png" alt=""><span class="px-3 text-base font-medium">Google</span></button>
                <div class="flex text-center">
                    <p class="mr-2">Sudah punya akun?</p>
                    <a href="/login" class="hover:text-yellow">Masuk ke akun</a>
                </div>
            </form>
        </div>
    </div>
</body>


</html>