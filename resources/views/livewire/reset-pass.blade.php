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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body style="background: linear-gradient(to right, rgba(180,0,0,1), rgba(0,0,0,0));">
    <div class="flex flex-col justify-center items-center h-screen">
        <img src="{{ asset('images/logo_donora.svg') }}" class="w-1/2 md:w-1/3 lg:w-1/6 drop-shadow-lg text-white"
            alt="Donora">
        <div
            class="bg-white flex flex-col w-1/2 md:w-1/2 lg:w-1/4 rounded-[45px] shadow-md shadow-gray-500 justify-center mt-6 p-6">
            <p class="font-semibold text-center text-md">Atur Ulang Kata Sandi</p>
            <div class="flex justify-center">
                <div class="w-4/5 md:w-3/4 lg:w-2/3 border border-[#f6f6f6] mt-4 mb-6 "></div>
            </div>
            <form id="reset-password-form">
                <div class="mb-2">
                    <label for="email" class="block text-gray-700 text-[12px] font-bold mb-2">Email</label>
                    <input class="form-input w-full border border-gray-300 rounded-xl py-3 px-3 text-sm"
                        placeholder="Masukkan email terdaftar anda" name="email" id="email" required>
                </div>
                <button type="submit" id="submit-button"
                    class="bg-[#BA1D1D] text-white font-bold text-md w-full p-2 mt-4 rounded-xl shadow-md shadow-gray-300 hover:bg-red-900">Kirim
                    OTP</button>
            </form>
            <div id="message" class="mt-4"></div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#reset-password-form').submit(function(event) {
        event.preventDefault();

        var email = $('#email').val();
        var requestData = {
            email: email
        };

        $.ajax({
            url: 'https://skripsi-kita.my.id/apis/auth/forget-password',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(requestData),
            success: function(response) {
                console.log('Success:', response);
                window.location.href = '/otp?email=' + encodeURIComponent(
                    email); // Redirect to the /otp page with email parameter
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText + ' - ' + xhr
                    .responseText;
                $('#message').text('Error: ' + errorMessage).css('color', 'red');
                console.error('Error:', xhr.responseText);
            }
        });
    });
});
</script>

</html>