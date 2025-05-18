<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aladin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/style.css') }}">


    <style>
        .bg1 {
            background-image: url('images/bg.png');
        }

        .bg2 {
            background-color: #FCE05B;
        }

        .bg3 {
            background-color: #75C394;
        }

        .btn2:hover {
            background-color: rgb(196, 201, 168);
        }
    </style>
</head>

<body class="bg">
    <!-- Landing Page -->
    <section id="beranda" class="page w-screen mx-auto">
        <div class="flex flex-wrap">
            <div class="relative bg1">
                <img src="images/logo-apk.png" alt="logo" class="absolute top-0 left-0 p-3">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-4/12 md:mt-20 lg:ml-20 m-10 lg:mt-40">
                        <h1 class="aladin-regular text-black w-full px-4 mt-10 py-5 text-5xl  text-left">Pembayaran dan
                            Distribusi Zakat Fitrah</h1>
                        <p class="adamina-regular px-4 text-justify">Tunaikan zakat fitrah dengan praktis,
                            amanah, dan transparan, buat Ramadan kamu makin berkah.</p>
                        <a href="{{ url('zakat') }}">
                            <button class="adamina-regular bg2 btn2 shadow-md m-5 px-5 py-1 text-black rounded-full">Bayar Sekarang</button>
                        </a>

                    </div>
                    <div class="w-full py-10 md:w-4/12 lg:mx-20 mx-10 px-4 lg:mt-20 md:mt-20 lg:mb-20">
                        <img src="images/gambar1-landingPage.png" class="max-w-full" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="bg">
        <div class="grid grid-cols-2 md:grid-cols-4 bg md:py-8 md:px-8 mx-auto sm:mx-10 font-content font-bold">
            <div class="max-w-sm">
                <img src="images/get-cash.png" alt="" class="mx-auto">
                <p class="adamina-regular font-bold text-center">Apa itu zakat fitrah?</p>
            </div>
            <div>
                <img src="images/people.png" alt="" class="mx-auto">
                <p class="adamina-regular font-bold text-center">Siapa yang wajib membayarnya?</p>
            </div>
            <div>
                <img src="images/coins.png" alt="" class="mx-auto">
                <p class="adamina-regular font-bold text-center">Bentuk zakat </p>
            </div>
            <div>
                <img src="images/Stopwatch.png" alt="" class="mx-auto">
                <p class="adamina-regular font-bold text-center">kapan waktu membayarnya?</p>
            </div>
        </div>
    </div>

    <!-- Pengertian Zakat Fitrah -->
    <div class="flex flex-wrap bg2">
        <div class="w-full md:w-4/12 lg:mx-20 sm:mx-10 ml-40 lg:my-20">
            <img src="images/pengertianZakat.png" class="max-w-full" alt="">
        </div>
        <div class="w-full md:w-4/12 md:mt-20 lg:ml-20 m-10 lg:my-40">
            <h1 class="w-full text-black aladin-regular text-5xl text-left">Pengertian Zakat Fitrah</h1>
            <p class="adamina-regular text-justify">Zakat fitrah adalah zakat yang wajib
                dikeluarkan oleh setiap muslim pada bulan Ramadan sebelum salat Idul Fitri.
                Zakat ini berfungsi untuk membersihkan diri dari kesalahan-kesalahan kecil
                selama menjalankan ibadah puasa dan juga untuk membantu fakir miskin. </p>
        </div>
    </div>

    <!-- Siapa saja yang berzakat -->
    <div class="flex flex-wrap bg3">
        <div class="w-full m-10 md:w-4/12 lg:py-20  lg:my-20 lg:mx-20">
            <h1 class="w-full aladin-regular text-black text-5xl text-left">Siapa yang Wajib Membayarnya?</h1>
            <p class="adamina-regular text-justify">Zakat fitrah wajib ditunaikan oleh setiap Muslim yang hidup
                hingga akhir Ramadan, mampu secara finansial, dan memiliki kelebihan makanan pokok. Kewajiban ini juga mencakup
                orang-orang yang menjadi tanggungannya, dan harus dibayarkan sebelum salat Idulfitri sebagai bentuk penyucian jiwa
                dan kepedulian sosial.</p>
        </div>
        <div class="w-full md:w-4/12 lg:mx-20 m-10 lg:my-20">
            <img src="images/membayarZakat.png" class="max-w-full" alt="">
        </div>
    </div>

    <!-- Bentuk Zakat -->
    <div class="flex flex-wrap bg2">
        <div class="w-full md:w-4/12 md:my-10 lg:m-20 sm:mx-10 px-10 mt-10">
            <img src="images/bentukZakat.png" class="max-w-full" alt="">
        </div>
        <div class="w-full md:w-4/12 md:my-10 lg:ml-20 m-10 lg:my-40">
            <h1 class="w-full aladin-regular text-black text-5xl text-left">Apa Saja Bentuk Zakat Fitrah?</h1>
            <p class="adamina-regular text-justify">Zakat fitrah bisa diberikan dalam bentuk 
                makanan pokok, seperti beras, jagung, atau gandum, sebanyak satu sha' (sekitar 2,5 kg atau 3,5 liter).
                Namun, sebagian ulama juga memperbolehkan pembayaran dalam bentuk uang, dengan nilai yang setara dengan
                harga bahan makanan pokok yang biasa dikonsumsi.</p>
        </div>
    </div>

    <!-- Kapan Berzakat -->
    <div class="flex flex-wrap bg3">
        <div class="w-full md:w-4/12 m-10 lg:my-20 lg:ml-20">
            <h1 class="w-full aladin-regular text-black text-5xl text-left">Kapan Zakat Fitrah Dibayarkan?</h1>
            <p class="adamina-regular text-justify">
                Zakat fitrah dapat dibayarkan di waktu berikut:
            <ul class="list-disc pl-5 leading-relaxed">
                <li>
                    Waktu utama: Sejak awal Ramadan hingga sebelum pelaksanaan salat Idul Fitri.
                </li>
                <li>
                    Waktu terbaik: Malam hingga pagi sebelum salat Id.
                    Jika dibayar setelah salat Idul Fitri, zakat tersebut dianggap sebagai sedekah biasa (bukan zakat fitrah).
                </li>
            </ul>
            </p>
        </div>
        <div class="w-full md:w-4/12 lg:mx-20 mx-10 mt-10 lg:my-20">
            <img src="images/kapanZakat.png" class="max-w-full" alt="">
        </div>
    </div>

    <!-- Footer -->
    <div class="">
        <div class="max-w-md lg:max-w-xl md:max-w-xl mx-auto">
            <div class="flex justify-between p-6">
                <!-- Media Sosial -->
                <div>
                    <h2 class="aladin-regular mb-4 text-xl">Media Sosial</h2>
                    <ul class="space-y-2">
                        <li onclick="window.location='#'"
                            style="cursor:pointer" class="flex items-center">
                            <img src="https://img.icons8.com/ios-filled/50/null/instagram-new--v1.png" alt="Instagram"
                                class="w-6 h-6 mr-2">
                            <span class="font-content">@_zakatnurulhuda</span>
                        </li>
                        <li onclick="window.location='#'"
                            style="cursor:pointer" class="flex items-center">
                            <img src="https://img.icons8.com/ios-filled/50/null/tiktok.png" alt="TikTok" class="w-6 h-6 mr-2">
                            <span class="font-content">@zakatnurulhuda</span>
                        </li>
                        <li onclick="window.location='#'"
                            style="cursor:pointer" class="flex items-center">
                            <img src="https://img.icons8.com/ios-filled/50/null/twitter.png" alt="Twitter" class="w-6 h-6 mr-2">
                            <span class="font-content">@nurulhudazakat</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h2 class="aladin-regular mb-4 text-xl">Contact</h2>
                    <ul class="space-y-2">
                        <li onclick="window.location='#'; return false;" style="cursor:pointer"
                            class="flex items-center">
                            <img src="https://img.icons8.com/ios-filled/50/null/whatsapp.png" alt="WhatsApp" class="w-6 h-6 mr-2">
                            <span class="font-content">+6281347481234</span>
                        </li>
                        <li onclick="window.location='#'; return false;" style="cursor:pointer"
                            class="flex items-center">
                            <img src="https://img.icons8.com/ios-filled/50/null/gmail.png" alt="Gmail" class="w-6 h-6 mr-2">
                            <span class="font-content">zakatfitrah@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-gray-100 py-4 border-t">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">

            <p class="mb-2 md:mb-0">
                &copy; 2025 <a href="#" class="text-blue-600 hover:underline">Zakat Nurul Huda</a>. All rights reserved.
            </p>

            <ul class="flex space-x-4">
                <li>
                    <a href="#" class="hover:underline">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Terms & Conditions</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">FAQ</a>
                </li>
            </ul>

        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>