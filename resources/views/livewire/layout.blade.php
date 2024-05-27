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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-search/dist/leaflet.control.search.min.css" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-search"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Script Plugin Chart.js Datalabels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!-- Memuat DataTables CSS dari CDN -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
    #loader {
        position: fixed;
        z-index: 9999;
        background-color: #be2929;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 1s;
    }

    /* Animasi untuk putaran */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        0% {
            transform: rotate(360deg);
        }
    }

    /* Tambahkan gaya untuk gambar loader */
    #loader img {
        width: 70px;
        /* Sesuaikan lebar gambar */
        height: auto;
        /* Sesuaikan tinggi gambar */
        animation: spin 1s linear infinite;
        /* Animasi putaran */
    }

    #map {
        height: 300px;
        margin-bottom: 10px;
    }

    .preview-coordinates {
        font-family: 'Open Sans', sans-serif;
        font-size: 10px;
        color: #666;
    }

    /* Gaya untuk modal konfirmasi logout */
    #logoutModal {
        /* Sesuaikan dengan preferensi Anda */
        width: 400px;
        max-width: 90%;
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 100;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Gaya untuk tombol close modal */
    #btnCloseModal {
        cursor: pointer;
    }

    /* Gaya untuk overlay latar belakang */
    #overlay {
        /* Atur opacity dan warna latar belakang */
    }
    </style>
</head>

<body class="flex mb-6">
    <!-- Modal Konfirmasi Logout -->
    <div id="logoutModal"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 rounded-2xl shadow-md z-50 hidden">
        <div class="flex justify-between mb-4">
            <h1 class="text-lg font-semibold">Konfirmasi Logout</h1>
            <button id="btnCloseModal" class="text-gray-500 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <p>Anda yakin ingin keluar dari akun?</p>
        <div class="flex justify-end mt-6">
            <button id="logoutConfirm"
                class="bg-[#d42c2c] text-white px-6 py-2 text-sm font-bold rounded-xl mr-4 hover:bg-[#a11f1f]">Ya</button>
            <button id="logoutCancel"
                class="bg-gray-200 text-gray-800 px-6 py-2 text-sm font-bold rounded-xl hover:bg-gray-300">Batal</button>
        </div>
    </div>

    <!-- Overlay untuk latar belakang modal -->
    <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-gray-800 opacity-50 z-50 hidden"></div>


    <div id="loader">
        <img src="{{ asset('images/donora.svg') }}" alt="Loading...">
    </div>

    <div class="fixed top-0 left-0 w-full h-full bg-gradient-to-b from-red-700 via-red-50 to-transparent"></div>

    <aside
        class="min-w-[250px] flex flex-col bg-white rounded-2xl ml-3 mt-3 h-full shadow-md text-[12px] sticky top-[15px]">
        <div class="flex justify-center">
            <img class="max-w-[150px] max-h-[30px] mt-5 drop-shadow" src="{{ asset('images/logo_donora.svg') }}"
                alt="Donora">
        </div>

        <div class="flex justify-center">
            <div class="w-4/5 border border-gray-100 mt-5 "></div>
        </div>

        <div class="flex flex-col ml-4 mt-3 mb-4 mr-4 gap-2 cursor-pointer">
            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'dashboard' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/dashboard">
                    <div class="flex gap-5 ml-2 mr-2">
                        <i class="fa-solid fa-house text-[#D80032] mt-0.5"></i>
                        <p>Dashboard</p>
                    </div>
                </a>
            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'akun' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/akun">
                    <div class="flex gap-6 ml-2 mr-2">
                        <i class="fas fa-user text-[#D80032] mt-1"></i>
                        <p>Akun</p>
                    </div>
                </a>
            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'stok-darah' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/stok-darah">
                    <div class="flex gap-6 ml-2 mr-2">
                        <i class="fa-solid fa-droplet text-[#D80032] mt-1"></i>
                        <p>Stok Darah</p>
                    </div>
                </a>
            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'ajuan-darah' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/ajuan-darah">
                    <div class="flex gap-5 ml-2 mr-2">
                        <i class="fa-solid fa-hand-holding-droplet text-[#D80032] mt-1"></i>
                        <p>Ajuan Permintaan Darah</p>
                    </div>
                </a>

            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'riwayat-ajuan' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/riwayat-ajuan">
                    <div class="flex gap-5 ml-2 mr-2">
                        <i class="fa-solid fa-clock-rotate-left text-[#D80032] mt-1"></i>
                        <p>Riwayat Ajuan</p>
                    </div>
                </a>

            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'jadwal-donor' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/jadwal-donor">
                    <div class="flex gap-6 ml-2 mr-2">
                        <i class="fa-solid fa-calendar-days text-[#D80032] mt-1"></i>
                        <p>Jadwal Donor</p>
                    </div>
                </a>
            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'bukti-donor' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/bukti-donor">
                    <div class="flex gap-5 ml-2 mr-2">
                        <i class="fa-solid fa-receipt text-[#D80032] mt-1"></i>
                        <p class="pl-1">Bukti Donor</p>
                    </div>
                </a>
            </div>
            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'notifikasi' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/notifikasi">
                    <div class="flex gap-6 ml-2 mr-2">
                        <i class="fa-solid fa-bell text-[#D80032] mt-1"></i>
                        <p>Notifikasi</p>
                    </div>
                </a>

            </div>

            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'klaim-hadiah' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/klaim-hadiah">
                    <div class="flex gap-6 ml-2 mr-2">
                        <i class="fa-solid fa-gift text-[#D80032] mt-1"></i>
                        <p>Klaim Hadiah</p>
                    </div>
                </a>
            </div>
            <div
                class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all sidebar-item {{ $currentPage == 'poin' ? 'font-bold bg-slate-100' : '' }}">
                <a href="/poin">
                    <div class="flex gap-5 ml-2 mr-2">
                        <i class="fa-solid fa-trophy text-[#D80032] mt-1"></i>
                        <p>Leaderboard Poin</p>
                    </div>
                </a>
            </div>

        </div>

        <button id="logout-button"
            class="bg-[#d42c2c] text-white ml-4 mr-4 p-3 mb-2 rounded-[12px] shadow-md hover:bg-[#a11f1f]">
            <i class="fa-solid fa-right-from-bracket text-white mr-1"></i>
            <b class="">Keluar</b>
        </button>

    </aside>

    <div class="flex flex-col mt-5 mx-auto w-full px-10">
        <div class="flex gap-6 text-white text-[12px] z-10 justify-end">
            <a href="/akun">
                <div class="flex gap-2 text-sm cursor-pointer">
                    <img src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil" class="w-6 h-6 rounded-full"
                        id="profile-picture">
                    <p class="mt-0.5" id="username"></p>
                </div>
            </a>

        </div>

        @yield('content')

    </div>

    <!-- Footer -->
    <!-- <footer class="">
            <div class="z-10 flex flex-col mt-8 ml-8 mb-2 text-[#8392AB] text-sm">
<p>&copy; {{ date('Y') }}, PT Otak Kanan. All rights reserved.</p>
            </div>

        </footer> -->

    <script>
    $(document).ready(function() {
        $('#loader').show();

        // cek apakah token available (jika tidak redirect ke login)
        var token = localStorage.getItem('token');
        var baseUrl = 'https://skripsi-kita.my.id/apis/';
        if (!token) {
            // Tampilkan loader saat proses redirect
            window.location.href = '/masuk';
        }

        // ambil data username untuk navbar
        $.ajax({
            url: baseUrl + 'profile/user',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            success: function(response) {
                $('#username').text(response.data.user.username);

                // Tambahkan foto profil jika tersedia
                if (response.data.profile_picture) {
                    $('#profile-picture').attr('src', response.data.profile_picture);
                } else {
                    // Jika tidak ada foto profil, tampilkan gambar default atau pesan pengguna tidak memiliki foto profil
                    $('#profile-picture').attr('src', 'avatar_example.svg');
                    // Atau tampilkan pesan bahwa pengguna tidak memiliki foto profil
                    // $('#profile-picture').attr('alt', 'Foto Profil Tidak Tersedia');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Gagal mengambil data');
            },

        });

        // Modal Logout
        $('#logout-button').click(function() {
            openLogoutModal();
        });

        function openLogoutModal() {
            $('#logoutModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        }

        // Tambahkan fungsi untuk menutup modal konfirmasi logout
        $('#btnCloseModal').click(function() {
            closeModal();
        });

        // Tambahkan fungsi untuk menutup modal konfirmasi logout
        $('#logoutCancel').click(function() {
            closeModal();
        });

        // Fungsi untuk menutup modal konfirmasi logout
        function closeModal() {
            $('#logoutModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        }

        // Fungsi untuk logout ketika tombol "Keluar" di dalam modal diklik
        $('#logoutConfirm').click(function() {
            $.ajax({
                url: baseUrl + 'auth/logout',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    console.log(response.message);
                    localStorage.removeItem('token');
                    window.location.href = '/masuk';
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi Kesalahan:', error);
                    alert('Terjadi Kesalahan');
                }
            });
        });

        // Sembunyikan loader setelah halaman sepenuhnya dimuat
        $(window).on('load', function() {
            $('#loader').fadeOut('slow');
        });
    });
    </script>


</body>


</html>