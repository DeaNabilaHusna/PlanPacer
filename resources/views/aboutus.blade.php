<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>PlanPacer</title>
</head>

<body class="bg-defwhite">
<header class="fixed top-0 left-0 w-full z-50">
        <nav class=" bg-navy border-gray-200 px-4 lg:px-6 py-2.5">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="" class="flex items-center">
                    <h1 class="text-2xl text-center"><span class="font-paytone text-bold text-defwhite">Plan<span class="text-yellow">Pacer</span></span></h1>
                </a>
                <div class="flex items-center lg:order-2">
                    <div class="flex justify-center">
                        <a href="/login"><button type="submit" class="w-28 rounded-md bg-yellow px-3 py-1.5 text-sm font-semibold leading-6 text-defwhite shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Gabung</button></a>
                    </div>
                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1 ml-auto mr-7" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="" class="block py-2 pr-4 pl-3 text-defwhite p-0 hover:text-yellow focus:text-yellow">Home</a>
                        </li>
                        <li>
                            <a href="#fitur" class="block py-2 pr-4 pl-3 text-defwhite p-0 hover:text-yellow focus:text-yellow">Fitur</a>
                        </li>
                        <li>
                            <a href="#panduan" class="block py-2 pr-4 pl-3 text-defwhite p-0 hover:text-yellow focus:text-yellow">Panduan</a>
                        </li>
                        <li>
                            <a href="#about" class="block py-2 pr-4 pl-3 text-defwhite p-0 hover:text-yellow focus:text-yellow">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    {{-- Hero Section Start  --}}
    <section>

        <div id="" class="slide">
        <div class="relative min-h-screen bg-gray-800">
    <img class="absolute inset-0 w-full h-full object-cover z-0" src="images/home.png" alt="Image">
    <div class="absolute top-1/2 left-0 transform -translate-y-1/2 text-defwhite p-4 z-10 w-full md:w-auto">
        <div class="container mx-auto md:ml-4">
            <h1 class="text-2xl sm:text-4xl mb-4 font-raleway text-left">
                Atur Rencana Proyek, dengan <br> 
                <span class="font-paytone font-black text-defwhite">
                    Plan<span class="text-yellow">Pacer</span>.
                </span>
            </h1>
            <p class="text-xs sm:text-sm text-left">
                Solusi manajemen proyek yang inovatif <br> dirancang untuk membantu tim dan
                individu mengatur, melacak, <br> dan mengeksekusi proyek mereka dengan efisiensi dan
                keberhasilan yang maksimal.
            </p>
        </div>
    </div>
</div>

        </div>
    </section>
    {{-- Hero Section End  --}}
    {{-- Content Start  --}}
    <section>
        <div class="container mx-auto py-12 px-4 bg-defwhite font-raleway">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <img class="w-full h-auto rounded-lg shadow-md" src="images/cerita.png" alt="Story Image">
                </div>
                <div>
                    <h2 class="text-3xl font-bold mb-4">Cerita Kami</h2>
                    <p class="text-defblack">Bermula dari kebutuhan akan alat manajemen proyek yang menginspirasi dan
                        mudah digunakan. PlanPacer lahir dari semangat untuk menyediakan solusi yang efektif bagi
                        individu dan tim dalam mengelola proyek mereka dengan lebih efisien dan terorganisir. Kami
                        percaya bahwa setiap proyek memiliki potensi uniknya sendiri, dan kami hadir untuk membantu Anda
                        mengekspresikan visi dan mencapai tujuan Anda dengan lebih mudah. Dengan PlanPacer, kami
                        membangun cerita keberhasilan bersama Anda, satu langkah pada satu waktu.</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-200 py-12">
            <div class="container mx-auto font-raleway">
                <h2 class="text-3xl text-defblack font-bold mb-8 text-center">Tim Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-32">
                    <div class="flex justify-center lg:justify-end">
                        <div class="flex items-center">
                            <div class="bg-defwhite rounded-lg shadow-md overflow-hidden w-64">
                                <img class="w-full h-96 object-cover" src="images/cowok.png" alt="Male Image">
                                <div class="bg-blue-800 text-defwhite py-3 text-center">
                                    <h4 class="font-semibold">Unknown</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center lg:justify-start">
                        <div class="flex items-center">
                            <div class="bg-defwhite rounded-lg shadow-md overflow-hidden w-64">
                                <img class="w-full h-96 object-cover" src="images/cewek.png" alt="Female Image">
                                <div class="bg-blue-800 text-defwhite py-3 text-center">
                                    <h4 class="font-semibold">Unknown</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- Content End  --}}
    {{-- Footer Start  --}}
    <footer class="bg-navy">
        <div class="mx-auto max-w-7xl py-14 px-24 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center order-1" aria-label="Footer">
                <a href="" class="flex items-center">
                    <h1 class="text-2xl text-center"><span class="font-paytone text-bold text-defwhite">Plan<span
                                class="text-yellow">Pacer</span></span></h1>
                </a>
            </nav>
            <div class="mt-8 md:order-1 text-defwhite md:mt-0 font-raleway text-defwhite">
                <p class="text-center text-medium text-lg">
                    Solusi manajemen proyek yang membantu Anda menyelaraskan,
                </p>
                <p class="text-center text-medium text-lg">merancang strategi, dan mencapai kesuksesan dengan mudah.
                </p>
            </div>
            <div class="mt-8 md:mb-8 flex justify-center space-x-6 md:order-3  ">
                <a href="#" class="text-white hover:text-gray-200">
                    <span class="sr-only">Facebook</span>
                    <svg width="25" height="25" viewBox="0 0 35 35" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35 17.6064C35 7.88325 27.1644 0 17.5 0C7.83562 0 0 7.88325 0 17.6064C0 26.3949 6.39917 33.6781 14.7656 34.9985V22.6961H10.3221V17.6049H14.7656V13.7286C14.7656 9.31671 17.379 6.87822 21.3762 6.87822C23.2896 6.87822 25.2933 7.22301 25.2933 7.22301V11.5556H23.0854C20.911 11.5556 20.2329 12.9128 20.2329 14.3052V17.6064H25.0862L24.3104 22.6975H20.2329V35C28.6008 33.6781 35 26.3934 35 17.6064Z"
                            fill="#FFA33C" />
                    </svg>

                </a>

                <a href="#" class="text-white hover:text-gray-200">
                    <span class="sr-only">Instagram</span>
                    <svg width="25" height="25" viewBox="0 0 35 35" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.9688 17.5C22.9688 18.9504 22.3926 20.3414 21.367 21.367C20.3414 22.3926 18.9504 22.9688 17.5 22.9688C16.0496 22.9688 14.6586 22.3926 13.633 21.367C12.6074 20.3414 12.0312 18.9504 12.0312 17.5C12.0312 17.1883 12.0641 16.8839 12.1206 16.5885H10.2083V23.8747C10.2083 24.3815 10.6185 24.7917 11.1253 24.7917H23.8766C24.1194 24.7912 24.3522 24.6944 24.5237 24.5225C24.6953 24.3506 24.7917 24.1176 24.7917 23.8747V16.5885H22.8794C22.9359 16.8839 22.9688 17.1883 22.9688 17.5V17.5ZM17.5 21.1458C17.9789 21.1457 18.4531 21.0513 18.8955 20.8679C19.3379 20.6845 19.7398 20.4158 20.0784 20.0771C20.4169 19.7384 20.6854 19.3363 20.8686 18.8938C21.0517 18.4513 21.146 17.9771 21.1458 17.4982C21.1457 17.0193 21.0513 16.5451 20.8679 16.1027C20.6845 15.6603 20.4158 15.2584 20.0771 14.9198C19.7384 14.5813 19.3363 14.3127 18.8938 14.1296C18.4513 13.9464 17.9771 13.8522 17.4982 13.8523C16.531 13.8526 15.6035 14.237 14.9198 14.9211C14.2361 15.6052 13.8521 16.5328 13.8523 17.5C13.8526 18.4672 14.237 19.3946 14.9211 20.0784C15.6052 20.7621 16.5328 21.1461 17.5 21.1458V21.1458ZM21.875 13.6719H24.0607C24.2059 13.6719 24.3452 13.6143 24.448 13.5118C24.5509 13.4093 24.6089 13.2702 24.6094 13.125V10.9393C24.6094 10.7938 24.5516 10.6542 24.4487 10.5513C24.3458 10.4484 24.2062 10.3906 24.0607 10.3906H21.875C21.7295 10.3906 21.5899 10.4484 21.487 10.5513C21.3841 10.6542 21.3263 10.7938 21.3263 10.9393V13.125C21.3281 13.4258 21.5742 13.6719 21.875 13.6719V13.6719ZM17.5 0C12.8587 0 8.40752 1.84374 5.12563 5.12563C1.84374 8.40752 0 12.8587 0 17.5C0 22.1413 1.84374 26.5925 5.12563 29.8744C8.40752 33.1563 12.8587 35 17.5 35C19.7981 35 22.0738 34.5473 24.197 33.6679C26.3202 32.7884 28.2493 31.4994 29.8744 29.8744C31.4994 28.2493 32.7884 26.3202 33.6679 24.197C34.5473 22.0738 35 19.7981 35 17.5C35 15.2019 34.5473 12.9262 33.6679 10.803C32.7884 8.67984 31.4994 6.75066 29.8744 5.12563C28.2493 3.50061 26.3202 2.21157 24.197 1.33211C22.0738 0.452651 19.7981 0 17.5 0V0ZM26.6146 24.5893C26.6146 25.7031 25.7031 26.6146 24.5893 26.6146H10.4107C9.29687 26.6146 8.38542 25.7031 8.38542 24.5893V10.4107C8.38542 9.29687 9.29687 8.38542 10.4107 8.38542H24.5893C25.7031 8.38542 26.6146 9.29687 26.6146 10.4107V24.5893V24.5893Z"
                            fill="#FFA33C" />
                    </svg>

                </a>

                <a href="#" class="text-white hover:text-gray-200">
                    <span class="sr-only">Whatsapp</span>
                    <svg width="25" height="25" viewBox="0 0 35 35" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.00702341 35L2.37302 26.306C0.814014 23.6335 -0.0050586 20.594 2.35064e-05 17.5C2.35064e-05 7.83474 7.83477 0 17.5 0C27.1653 0 35 7.83474 35 17.5C35 27.1652 27.1653 35 17.5 35C14.4074 35.005 11.3692 34.1865 8.69752 32.6287L0.00702341 35ZM11.1843 9.28899C10.9583 9.30303 10.7374 9.36255 10.535 9.46399C10.3452 9.5715 10.1719 9.70589 10.0205 9.86299C9.81052 10.0607 9.69152 10.2322 9.56377 10.3985C8.91699 11.2402 8.56909 12.2735 8.57502 13.335C8.57852 14.1925 8.80252 15.0272 9.15252 15.8077C9.86827 17.3862 11.046 19.0575 12.6018 20.6062C12.9763 20.979 13.342 21.3535 13.7358 21.7017C15.6667 23.4018 17.9677 24.6278 20.4558 25.2822L21.4515 25.4345C21.7753 25.452 22.099 25.4275 22.4245 25.4117C22.9342 25.3854 23.4318 25.2474 23.8823 25.0075C24.1114 24.8894 24.3351 24.761 24.5525 24.6225C24.5525 24.6225 24.6278 24.5735 24.7713 24.465C25.0075 24.29 25.1528 24.1657 25.3488 23.961C25.494 23.8105 25.62 23.6337 25.7163 23.4325C25.8528 23.1472 25.9893 22.603 26.0453 22.1497C26.0873 21.8032 26.075 21.6142 26.0698 21.497C26.0628 21.3097 25.907 21.1155 25.7373 21.0332L24.7188 20.5765C24.7188 20.5765 23.1963 19.9132 22.267 19.4897C22.169 19.447 22.064 19.4227 21.9573 19.418C21.8375 19.4057 21.7165 19.4192 21.6024 19.4575C21.4883 19.4958 21.3838 19.5581 21.2958 19.6402V19.6367C21.287 19.6367 21.1698 19.7365 19.9045 21.2695C19.8319 21.3671 19.7319 21.4408 19.6172 21.4813C19.5025 21.5219 19.3783 21.5273 19.2605 21.497C19.1465 21.4665 19.0348 21.4279 18.9263 21.3815C18.7093 21.2905 18.634 21.2555 18.4853 21.1907L18.4765 21.1872C17.4754 20.7501 16.5484 20.1597 15.729 19.4372C15.5085 19.2447 15.3038 19.0347 15.0938 18.8317C14.4053 18.1724 13.8053 17.4265 13.3088 16.6127L13.2055 16.4465C13.1314 16.3348 13.0714 16.2143 13.027 16.0877C12.9605 15.8305 13.1338 15.624 13.1338 15.624C13.1338 15.624 13.559 15.1585 13.7568 14.9065C13.9214 14.6971 14.075 14.4792 14.217 14.2537C14.4235 13.9212 14.4883 13.58 14.3798 13.3157C13.8898 12.1187 13.3823 10.927 12.8608 9.74399C12.7575 9.50949 12.4513 9.34149 12.173 9.30824C12.0785 9.29774 11.984 9.28724 11.8895 9.28024C11.6545 9.26857 11.419 9.27091 11.1843 9.28724V9.28899Z"
                            fill="#FFA33C" />
                    </svg>

                </a>
            </div>
        </div>
        <div class="h-12 bg-yellow">
    </footer>
    {{-- Footer End  --}}
</body>

</html>
