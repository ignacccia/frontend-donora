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

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>
</head>

<body style="background: linear-gradient(to right, rgba(180,0,0,1), rgba(0,0,0,0));">
    <div class="flex flex-col justify-center items-center h-screen">
        <img src="{{ asset('images/logo_donora.svg') }}" class="w-1/2 md:w-1/3 lg:w-1/6 drop-shadow-lg text-white"
            alt="Donora">

        <div
            class="bg-white flex flex-col w-4/5 md:w-1/2 lg:w-1/3 rounded-[45px] shadow-md shadow-gray-500 justify-center mt-4 p-6">
            <p class="font-semibold text-center text-md">Daftar dengan</p>
            <div id="g_id_onload"
                data-client_id="664460318815-je4svlftrbcsu1lcs611q1uepfjmum5b.apps.googleusercontent.com"
                data-callback="handleCredentialResponse">
            </div>
            <div class="g_id_signin" data-type="standard"></div>

            <div class="flex justify-center">
                <div class="w-4/5 md:w-3/4 lg:w-2/3 border border-[#f9f9f9] mt-4 "></div>
            </div>
            <p class="text-[12px] font-bold text-[#8392AB] text-center mt-4 ">atau</p>

            <form id="registrationForm">
                <div class="mb-2">
                    <label for="username" class="block text-gray-700 text-[12px] font-bold mb-1">Username</label>
                    <input type="username" id="username"
                        class="form-input w-full border border-gray-300 rounded-xl text-[12px] py-2 px-3"
                        placeholder="Masukkan username anda">
                </div>
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
                    <label for="confirmPassword" class="block text-gray-700 text-[12px] font-bold mb-1">Konfirmasi Kata
                        Sandi</label>
                    <input type="password" id="confirmPassword"
                        class="form-input w-full border border-gray-300 rounded-xl text-[12px] py-2 px-3 "
                        placeholder="Ulangi kata sandi anda">
                </div>
                <button id="submitButton"
                    class="bg-blue-500 text-white font-bold text-md w-full p-2 mt-4 rounded-xl shadow-md hover:bg-blue-700">Daftar</button>
            </form>

            <p class="text-[12px] text-center mt-4 text-gray-400">Sudah punya akun? <span
                    class="font-bold text-blue-500" href="">Masuk</span></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    function handleCredentialResponse(response) {
        const data = jwt_decode(response.credential);
        console.log("ID: " + data.sub);
        console.log('Full Name: ' + data.name);
        console.log('Given Name: ' + data.given_name);
        console.log('Family Name: ' + data.family_name);
        console.log("Image URL: " + data.picture);
        console.log("Email: " + data.email);

        // Send the token to your backend for verification and user session creation
        $.ajax({
            url: 'https://skripsi-kita.my.id/apis/auth/google-login',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                token: response.credential
            }),
            success: function(response) {
                if (response.success) {
                    console.log("User Data:", response.data);
                    toastr.success('Login dengan Google berhasil');
                    setTimeout(function() {
                        window.location.href = '/dashboard';
                    }, 2500);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error('Terjadi kesalahan saat mengirim permintaan');
                }
            }
        });
    }

    $(document).ready(function() {
        const baseUrl = 'https://skripsi-kita.my.id/apis/';

        $('#registrationForm').submit(function(event) {
            event.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();
            var username = $('#username').val();
            var confirmPassword = $('#confirmPassword').val();

            var formData = new FormData();
            formData.append('email', email);
            formData.append('username', username);
            formData.append('password', password);
            formData.append('password_confirmation', confirmPassword);

            $.ajax({
                url: baseUrl + 'auth/register',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success('Registrasi akun baru berhasil');
                        setTimeout(function() {
                            window.location.href = '/masuk';
                        }, 2500);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('Terjadi kesalahan saat mengirim permintaan');
                    }
                }
            });
        });
    });
    </script>
</body>

</html>