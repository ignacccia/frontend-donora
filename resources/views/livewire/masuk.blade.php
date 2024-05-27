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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @vite('resources/css/app.css')
</head>

<body style="background: linear-gradient(to right, rgba(180,0,0,1), rgba(0,0,0,0));">

    <div class="flex flex-col justify-center items-center h-screen">
        <img src="{{ asset('images/logo_donora.svg') }}" class="w-1/2 md:w-1/3 lg:w-1/6 drop-shadow-lg text-white"
            alt="Donora">

        <div
            class="bg-white flex flex-col w-4/5 md:w-1/2 lg:w-1/3 rounded-[45px] shadow-md shadow-gray-500 justify-center mt-4 p-12">
            <form id="login-form">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-[12px] font-bold mb-2">Email/Username</label>
                    <input id="username"
                        class="form-input w-full border border-gray-300 rounded-xl py-3 px-3 text-[12px]"
                        placeholder="Masukkan email/username anda">
                </div>
                <div class="mb-2">
                    <label for="password" class="block text-gray-700 text-[12px] font-bold mb-2">Kata Sandi</label>
                    <input type="password" id="password"
                        class="form-input w-full border border-gray-300 rounded-xl py-3 px-3 text-[12px]"
                        placeholder="Masukkan kata sandi anda">
                </div>
                <p class="text-[12px] ml-1 mb-4 text-gray-400">Lupa kata sandi? <a class=" text-blue-500 hover:underline" href="/reset-pass">Klik
                        disini</a></p>
                <button type="submit"
                    class="bg-[#BA1D1D] text-white font-bold text-md w-full p-2 mt-4 rounded-xl shadow-md shadow-gray-300 hover:bg-red-900">Masuk</button>
            </form>

            <p class="text-[12px] text-center mt-4 text-gray-400">Belum punya akun? <a class="font-bold text-blue-500 hover:underline"
                    href="/daftar">Daftar</a></p>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
$(document).ready(function() {
    $('#login-form').submit(function(event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        var requestData = {
            username: username,
            password: password
        };

        $.ajax({
            url: 'https://skripsi-kita.my.id/apis/auth/login',
            method: 'POST',
            contentType: 'application/json',

            data: JSON.stringify(requestData),
            success: function(response) {
                if (response.data && response.data.token) {
                    localStorage.setItem('token', response.data
                    .token); //simpan data baerer token
                    window.location.href = '/dashboard';
                } else {
                    toastr.error('Terjadi kesalahan saat masuk');
                }
            },
            error: function(xhr, status, error) {
                // Cek apakah ada respons error dari server
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    // Tampilkan pesan error dari server menggunakan Toastr.js
                    toastr.error(xhr.responseJSON.message);
                } else {
                    // Tampilkan pesan error default
                    toastr.error('Terjadi kesalahan saat menghapus ajuan. Silahkan Ulangi kembali');
                }
            }
        });
    });
});
</script>

</html>