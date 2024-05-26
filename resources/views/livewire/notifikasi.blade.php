@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">

    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Notifikasi</p>
    <p class="text-sm mt-2">Tekan notifikasi untuk melihat detail informasi dan menjadi pendonor darurat</p>

    <div id="cards-container" class="mt-10 p-1 flex flex-col gap-4">
        {{-- <div class="card-notifikasi bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <div class="text-gray-700 text-lg font-semibold">Dibutuhkan Segera + B Platelet Concentrate di
                        Surabaya</div>
                    <div class="flex gap-2">
                        <div class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div class="bg-[#BA1D1D] w-20 text-center text-white font-bold text-sm p-1 shadow rounded-3xl">
                            Darurat</div>
                    </div>
                </div>
                <div class="my-auto text-gray-700 "><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div> --}}
    </div>

    <!-- Modal untuk Detail Notifikasi -->
    <div id="detailModalBackdrop" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden">
        <div class="absolute top-0 flex w-2/3 justify-center">
            <div id="modalContent" class="relative bg-white rounded-lg p-8 mt-8 transform -translate-y-full transition-transform duration-500">
                <button id="closeModal" class="absolute top-4 right-4 mt-3 text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
                <div>
                    <h2 id="notificationTitle" class="text-xl font-bold mb-1 mr-6">Dibutuhkan Segera + A Anti Hemophilic Factor di Surabaya</h2>
                    <div class="flex gap-2">
                        <div id="notificationDate" class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div id="notificationLevel" class="bg-[#BA1D1D] w-20 text-center text-white font-bold text-sm p-1 shadow rounded-3xl">Darurat</div>
                    </div>
                    <div id="notificationDescription" class="text-sm text-gray-500 mt-4"></div>
                    <div class="utd-info">
                        <div class="caption-utd text-sm text-gray-500 mt-4">Jika bersedia membatu, kamu dapat mendonor di :</div>
                        <div id="utd-name" class="text-sm text-gray-700 mt-1 font-bold">UTD PMI Surabaya</div>
                        <div class=" text-sm text-gray-500"><i class="fa-solid fa-map-pin"></i><span id="utd-address"> Jl. jl jalannnnnnn</span></div>
                    </div>
                    <button id="registerDonorButton" class="bg-[#d42c2c] mt-2 text-sm text-white px-4 py-2 rounded-xl mt-4 hover:bg-[#a11f1f] focus:outline-none">
                        Daftar Sebagai Pendonor
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    const baseUrl = 'https://skripsi-kita.my.id/apis/';
    var token = localStorage.getItem('token');
    $(document).ready(function() {
        // load data notifikasi
        $.ajax({
            url: baseUrl + 'user-notification',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                if (response.success) {
                    $('#cards-container').empty();
                    response.data.forEach(function(item) {
                        var notification = item.notification;
                        var createdAt = new Date(item.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        var levelClass = '';
                        var levelText = '';
                        switch(notification.level) {
                            case 'urgent':
                                levelClass = 'bg-[#BA1D1D] text-white';
                                levelText = 'Darurat';
                                break;
                            case 'important':
                                levelClass = 'bg-[#e9d525] text-white';
                                levelText = 'Penting';
                                break;
                            case 'general':
                            default:
                                levelClass = 'bg-[#797979] text-white';
                                levelText = 'Umum';
                                break;
                        }

                        var cardHtml = `
                            <div class="card-notifikasi bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]" data-slug="${item.slug}">
                                <div class="flex justify-between">
                                    <div class="flex flex-col gap-2">
                                        <div class="text-gray-700 text-lg font-semibold">${notification.title}</div>
                                        <div class="flex gap-2">
                                            <div class="text-sm text-gray-500 mt-1">${createdAt}</div>
                                            <div class="${levelClass} w-20 text-center font-bold text-sm p-1 shadow rounded-3xl">
                                                ${levelText}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-auto text-gray-700"><i class="fa-solid fa-chevron-right"></i></div>
                                </div>
                            </div>
                        `;

                        $('#cards-container').append(cardHtml);
                    });
                } else {
                    console.error('Gagal memuat notifikasi');
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal memuat notifikasi');
            }
        });

        // load detail data notifikasi
        function getNotificationDetails(slug) {
            $.ajax({
                url: baseUrl + 'user-notification/' + slug,
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        var notification = response.data[0].notification;
                        var createdAt = new Date(notification.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        $('#notificationTitle').text(notification.title);
                        $('#notificationDate').text(createdAt);
                        $('#notificationDescription').text(notification.description);
                        if(notification.utd_profile){
                            $('#utd-name').text(" " + notification.utd_profile.name);
                            $('#utd-address').text(" " +notification.utd_profile.address);
                                // Set data-slug pada registerDonorButton
                            $('#registerDonorButton').data('slug', response.data[0].slug);
                        }

                        if (response.data[0].is_approve) {
                            $('#registerDonorButton').text('Sudah Setuju Mendonor')
                                .attr('disabled', true)
                                .attr('class', 'bg-[#797979] mt-2 text-sm text-white px-4 py-2 rounded-xl mt-4  focus:outline-none');
                                
                        }


                        var notificationLevelClass = '';
                        var notificationLevelText = '';

                        switch (notification.level) {
                            case 'urgent':
                                notificationLevelClass = 'bg-[#BA1D1D]';
                                notificationLevelText = 'Darurat';
                                $('.utd-info').show();
                                $('#registerDonorButton').show();
                                break;
                            case 'important':
                                notificationLevelClass = 'bg-[#e9d525]';
                                notificationLevelText = 'Penting';
                                $('.utd-info').hide();
                                $('#registerDonorButton').hide();
                                break;
                            case 'general':
                                notificationLevelClass = 'bg-[#797979]';
                                notificationLevelText = 'Umum';
                                $('.utd-info').hide();
                                $('#registerDonorButton').hide();
                                break;
                            default:
                                notificationLevelClass = 'bg-[#797979]';
                                notificationLevelText = 'Umum';
                                $('.utd-info').hide();
                                $('#registerDonorButton').hide();
                                break;
                        }

                        $('#notificationLevel').attr('class', notificationLevelClass + ' w-20 text-center text-white font-bold text-sm p-1 shadow rounded-3xl').text(notificationLevelText);

                        $('#detailModalBackdrop').removeClass('hidden').addClass('flex');

                        // Hide the modal with animation
                        setTimeout(function() {
                            $('#modalContent').removeClass('-translate-y-full').addClass('translate-y-0');
                        }, 100);
                    } else {
                        console.error('Gagal memuat detail notifikasi');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gagal memuat detail notifikasi');
                }
            });
        }

        // Event listener untuk tombol registerDonorButton
        $('#registerDonorButton').on('click', function() {
            var slug = $('#registerDonorButton').data('slug');
            console.log(slug);

            $.ajax({
                url: baseUrl + 'user-notification/approve',
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    user_notification_slug: slug
                }),
                success: function(response) {
                    if (response.success) {
                        $('#detailModalBackdrop').removeClass('flex').addClass('hidden');
                        toastr.success("Berhasi mendonor sebagai pendonor darurat");
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Cek apakah ada respons error dari server
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // Tampilkan pesan error dari server menggunakan Toastr.js
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        // Tampilkan pesan error default
                        toastr.error('Terjadi kesalahan saat mendaftar. Silahkan Ulangi kembali');
                    }
                }
            });
        });


        // handle klik pada kartu notifikasi
        $('#cards-container').on('click', '.card-notifikasi', function() { 
            var slug = $(this).data('slug');
            getNotificationDetails(slug);
        });

        // handle klik pada tombol close pada modal
        $('#closeModal').on('click', function() {
            $('#detailModalBackdrop').removeClass('flex').addClass('hidden');
            $('#modalContent').removeClass('translate-y-0').addClass('-translate-y-full');
        });

    })
</script>
@endsection