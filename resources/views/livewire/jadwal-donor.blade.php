@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10 h-full text-wrap">
    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Jadwal Donor</p>
    <p class="text-sm mt-2">Tekan jadwal donor untuk melihat detail lokasi donor darah dan UTD PMI</p>


    <div class="mt-10 p-1 flex flex-col gap-4">
        <div class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]"
            id="donorEvent">
            <div class="flex justify-between">
                <div class="flex">
                    <img src="{{ asset('images/logo_pmi.png') }}" alt="UTD PMI" class="w-20 h-20 mr-6 my-auto">
                    <div class="flex flex-col">
                        <div class="text-gray-700 text-lg font-semibold">Judul Donor Darah</div>
                        <div class="text-sm text-gray-500">UTD PMI Surabaya</div>
                        <div class="text-sm text-gray-500">1 Juni 2024 - 29 Juni 2024</div>
                        <div class="text-sm text-gray-500">09.00-10.00</div>
                        <div
                            class="bg-[#14C465] w-20 text-center text-white text-sm p-1 mt-2 shadow rounded-3xl font-bold">
                            Aktif</div>
                    </div>
                </div>
                <div class="my-auto text-gray-700"><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

    <div>
        <!-- Modal Detail Donor -->
        <div id="mapModal"
            class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden ">
            <div class="relative bg-white rounded-lg p-8 max-w-2xl mx-auto my-8">
                <button id="closeModalButton" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 text-2xl"
                    onclick="$('#mapModal').hide()">&times;</button>
                <div>
                    <h2 class="text-2xl font-bold mb-2">Judul Donor</h2>
                    <div class="flex flex-col text-[12px] text-gray-600">
                        <div class="flex">
                            <div class="flex flex-col gap-2">
                                <i class="fa-regular fa-calendar-days mt-0.5 mr-1"></i>
                                <i class="fa-regular fa-clock mt-0.5 mr-1"></i>
                                <i class="fa-solid fa-location-dot mt-0.5 mr-1"></i>
                            </div>
                            <div class="flex flex-col gap-1 ml-1">
                                <p id="donorDate">1 Juni 2024 - 29 Juni 2024</p>
                                <p id="donorTime">09.00 - 10.00</p>
                                <p id="donorAddress">Jl. Contoh No. 123, Surabaya</p>
                            </div>
                        </div>
                        <div>Donor Darah Rutin Juni 2024 dilaksanakan oleh UTD PMI SURABAYA periode Juni 2024. Silahkan
                            lihat lokasinya</div>
                    </div>
                    <div class="mt-4">
                        <div id="map" class="w-full h-64"></div>
                    </div>
                    <div class="mt-4">
                        <a id="googleMapsLink" href="#" target="_blank"
                            class="bg-blue-600 text-white text-[14px] px-2 py-2 rounded-lg hover:bg-blue-800">Buka di
                            Google Maps</a>
                        <!-- Tombol untuk toggle ke modal UTD PMI -->
                        <button id="toggleUTDButton"
                            class="bg-[#BA1D1D] text-white text-[14px] px-2 py-2 rounded-lg hover:bg-[#930f0f] ml-2">Lihat
                            Detail UTD PMI</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail UTD PMI -->
        <div id="utdModal"
            class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden">
            <div class="relative bg-white rounded-lg p-8 max-w-2xl mx-auto my-8">
                <div>
                    <h2 class="text-2xl font-bold">Informasi UTD PMI</h2>
                    <p class="text-[12px] text-gray-600 mb-4">Berikut detail dari UTD PMI terkait</p>

                    <p class="text-sm mb-3 font-bold">UTD PMI</p>

                    <p class="text-[12px] text-gray-600 mb-1">Email</p>
                    <p class="text-sm mb-3">Email</p>

                    <p class="text-[12px] text-gray-600 mb-1">Nomor Telepon</p>
                    <p class="text-sm mb-3">08754376777</p>

                    <p class="text-[12px] text-gray-600 mb-1">Alamat</p>
                    <p class="text-sm mb-3">Pasar Pecindilan, Jalan Pecindilan II, RW 02, Kapasari, Genteng, Surabaya,
                        East Java, Java, 60273, Indonesia
                    </p>
                    <button id="backToMapButton"
                        class="bg-blue-600 text-white text-[14px] px-2 py-2 rounded-lg hover:bg-blue-800 ">Kembali
                        ke Jadwal Donor</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    // Ketika tombol toggle di modal Detail Donor diklik
    $('#toggleUTDButton').on('click', function() {
        // Menampilkan modal Detail UTD PMI dan menyembunyikan modal Detail Donor
        $('#mapModal').hide();
        $('#utdModal').show();
    });

    // Ketika tombol close di modal Detail UTD PMI diklik
    $('#closeUTDModalButton').on('click', function() {
        // Menampilkan kembali modal Detail Donor dan menyembunyikan modal Detail UTD PMI
        $('#mapModal').show();
        $('#utdModal').hide();
    });

    // Ketika tombol kembali di modal UTD PMI diklik
    $('#backToMapButton').on('click', function() {
        // Menampilkan kembali modal peta dan menyembunyikan modal UTD PMI
        $('#mapModal').show();
        $('#utdModal').hide();
    });

    // Ketika tombol close di modal Detail Donor diklik
    $('#closeModalButton').on('click', function() {
        // Menyembunyikan modal Detail Donor
        $('#mapModal').hide();
    });

    // Ketika tombol toggle di modal Donor Event diklik
    $('#donorEvent').on('click', function() {
        $('#mapModal').show();
        initMap(); // Memanggil fungsi untuk menginisialisasi peta
    });

    // Ketika tombol close di modal Donor Event diklik
    $('#closeModalButton').on('click', function() {
        $('#mapModal').hide();
    });
});

function initMap() {
    // Buat peta dan atur pusat serta tingkat zoom
    var map = L.map('map').setView([-7.2575, 112.7521], 13);

    // Tambahkan lapisan peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker ke peta
    var marker = L.marker([-7.2575, 112.7521]).addTo(map)
        .bindPopup('Lokasi Donor Darah', {
            closeButton: false,
            closeOnClick: false
        })
        .openPopup();

    // Menambahkan event listener untuk mencegah penutupan popup
    marker.on('popupclose', function() {
        marker.openPopup();
    });

    // Update Google Maps link
    $('#googleMapsLink').attr('href', 'https://www.google.com/maps?q=-7.2575,112.7521');
    document.getElementById('map').style.height = '250px';
}
</script>

@endsection