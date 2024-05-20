<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DONORA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body style="background: linear-gradient(to right, rgba(180,0,0,1), rgba(0,0,0,0));">

<div class="flex flex-col justify-center items-center h-screen">
        <img src="{{ asset('images/logo_donora.svg') }}" class="w-1/2 md:w-1/3 lg:w-1/6 drop-shadow-lg text-white" alt="Donora">

        <div
            class="bg-white flex flex-col w-4/5 md:w-1/2 lg:w-1/3 rounded-[45px] shadow-md shadow-gray-500 justify-center mt-4 p-6">
            <p class="font-semibold text-center text-md">
            <p class="font-semibold text-center text-md">
                Daftar dengan
            </p>
            <div class="bg-white mx-auto p-4 rounded-xl shadow shadow-gray-300 border border-gray-100 mt-2">
                <img src="{{ asset('images/google.svg') }}" alt="Google" class="h-4 w-4">
            </div>

            <div class="flex justify-center">
                <div class="w-4/5 md:w-3/4 lg:w-2/3 border border-[#f9f9f9] mt-4 "></div>
            </div>
            <p class="text-[12px] font-bold text-[#8392AB] text-center mt-4 ">atau</p>

            <form>
                <div class="mb-2">
                    <label for="email" class="block text-gray-700 text-[12px] font-bold mb-1">Email</label>
                    <input type="email" id="email"
                        class="form-input w-full border border-gray-300 rounded-xl text-[12px] py-2 px-3"
                        placeholder="Masukkan email anda">
                </div>
                <div class="mb-2">
                    <label for="password" class="block text-gray-700 text-[12px] font-bold mb-1">Kata Sandi</label>
                    <input type="password" id="password"
                        class="form-input w-full border border-gray-300 rounded-xl text-[12px] py-2 px-3 "
                        placeholder="Masukkan kata sandi anda">
                </div>
                <div class="mb-2">
                    <label for="password" class="block text-gray-700 text-[12px] font-bold mb-1">Konfirmasi Kata
                        Sandi</label>
                    <input type="password" id="password"
                        class="form-input w-full border border-gray-300 rounded-xl text-[12px] py-2 px-3 "
                        placeholder="Ulangi kata sandi anda">
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white font-bold text-md w-full p-2 mt-4 rounded-xl shadow-md hover:bg-blue-700">Daftar</button>
            </form>

            <p class="text-[12px] text-center mt-4 text-gray-400">Sudah punya akun? <span
                    class="font-bold text-blue-500" href="">Masuk</span></p>
        </div>
    </div>



</body>

</html>