@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10 h-full text-wrap">
    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Jadwal Donor</p>
    <p class="text-sm mt-2">Tekan jadwal donor untuk melihat detail lokasi donor darah dan UTD PMI</p>


    <div class="mt-10 p-1 flex flex-col gap-4">
        {{-- card jadwal donor --}}
    </div>

    <div>
        <!-- Modal Detail Donor -->
        <div id="mapModal"
            class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden">
            <div class="relative bg-white rounded-lg p-8 max-w-2xl mx-auto my-8">
                <button id="closeModalButton" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 text-2xl"
                    onclick="$('#mapModal').hide()">&times;</button>
                <div>
                    <h2 id="donorTitle" class="text-2xl font-bold mb-2">Judul Donor</h2>
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
                        <div id="donorDescription" class="pt-2">Donor Darah Rutin Juni 2024 dilaksanakan oleh UTD PMI
                            SURABAYA periode Juni 2024. Silahkan lihat lokasinya</div>
                    </div>
                    <div class="mt-4">
                        <div id="map" class="w-full h-64"></div>
                    </div>
                    <div class="mt-4">
                        <a id="googleMapsLink" href="#" target="_blank"
                            class="bg-blue-600 text-white text-[14px] px-2 py-2 rounded-lg hover:bg-blue-800">Buka di
                            Google Maps</a>
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
                <button id="closeUtdModalButton"
                    class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 text-2xl"
                    onclick="$('#utdModal').hide()">&times;</button>
                <div>
                    <h2 class="text-2xl font-bold">Informasi UTD PMI</h2>
                    <p class="text-[12px] text-gray-600 mb-4">Berikut detail dari UTD PMI terkait</p>

                    <p id="utdName" class="text-sm mb-3 font-bold">UTD PMI</p>

                    <p class="text-[12px] text-gray-600 mb-1">Email</p>
                    <p id="utdEmail" class="text-sm mb-3"></p>

                    <p class="text-[12px] text-gray-600 mb-1">Nomor Telepon</p>
                    <p id="utdPhone" class="text-sm mb-3"></p>

                    <p class="text-[12px] text-gray-600 mb-1">Alamat</p>
                    <p id="utdAddress" class="text-sm mb-3"></p>
                    <button id="backToMapButton"
                        class="bg-blue-600 text-white text-[14px] px-2 py-2 rounded-lg hover:bg-blue-800">Kembali
                        ke Jadwal Donor</button>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
$(document).ready(function() {
    const baseUrl = 'https://skripsi-kita.my.id/apis/';
    var token = localStorage.getItem('token');
    var map; // Declare map variable in a higher scope so it can be accessed globally

    // init map lokasi donor
    function initMap(latitude, longitude) {
        if (map) {
            map.remove(); // Remove the existing map instance if it exists
        }

        // Create a new map instance
        map = L.map('map').setView([latitude, longitude], 13);

        // Add tile layer to the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add marker to the map
        var marker = L.marker([latitude, longitude]).addTo(map)
            .openPopup();

        // Adding event listener to prevent popup closure
        marker.on('popupclose', function() {
            marker.openPopup();
        });

        // Update Google Maps link
        $('#googleMapsLink').attr('href', 'https://www.google.com/maps?q=' + latitude + ',' + longitude);
        document.getElementById('map').style.height = '200px';
        
        // Call invalidateSize after a slight delay to ensure map is properly displayed
        setTimeout(function() {
            map.invalidateSize();
        }, 100);
    }

    // load all data schedule
    $.ajax({
        url: baseUrl + 'donor-schedule',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                var schedules = response.data;
                var container = $(".mt-10.p-1.flex.flex-col.gap-4");

                schedules.forEach(function(schedule) {
                    let profilePicture = schedule.utd_profile.profile_picture ||
                        "{{ asset('images/logo_pmi.png') }}";
                    var startDate = new Date(schedule.date_start);
                    var endDate = new Date(schedule.date_end);
                    var options = {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    };
                    var formattedStartDate = startDate.toLocaleDateString('id-ID', options);
                    var formattedEndDate = endDate.toLocaleDateString('id-ID', options);

                    var dateDisplay = formattedStartDate;
                    if (startDate.getTime() !== endDate.getTime()) {
                        dateDisplay = formattedStartDate + ' - ' + formattedEndDate;
                    }


                    var timeStart = schedule.time_start.substring(0, 5);
                    var timeEnd = schedule.time_end.substring(0, 5);
                    var slug = schedule.slug; // Ambil slug dari data schedule

                    var card = `
                        <div class="card-jadwal-donor bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]" data-slug="${slug}">
                            <div class="flex justify-between">
                                <div class="flex">
                                    <img src="${profilePicture}" alt="UTD PMI" class="w-20 h-20 mr-6 my-auto">
                                    <div class="flex flex-col">
                                        <div class="text-gray-700 text-lg font-semibold">${schedule.title}</div>
                                        <div class="text-sm text-gray-500">${schedule.utd_profile.name}</div>
                                        <div class="text-sm text-gray-500">${dateDisplay}</div>
                                        <div class="text-sm text-gray-500">${timeStart} - ${timeEnd}</div>
                                    </div>
                                </div>
                                <div class="my-auto text-gray-700"><i class="fa-solid fa-chevron-right"></i></div>
                            </div>
                        </div>
                    `;
                    container.append(card);
                });

                // Add click event to open modal and initialize map
                $('.card-jadwal-donor').click(function() {
                    var slug = $(this).data('slug');
                    $.ajax({
                        url: baseUrl + 'donor-schedule/' + slug,
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                var data = response.data;
                                // set display date
                                var options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };

                                var startDate = new Date(data.date_start);
                                var endDate = new Date(data.date_end);

                                var formattedStartDate = startDate
                                    .toLocaleDateString('id-ID', options);
                                var formattedEndDate = endDate
                                    .toLocaleDateString('id-ID', options);

                                // handle display tanggal jika dilaksanakan pada haru yang sama (satu hari saja)
                                var dateDisplay = formattedStartDate;
                                if (startDate.getTime() !== endDate.getTime()) {
                                    dateDisplay = formattedStartDate + ' - ' +
                                        formattedEndDate;
                                }

                                // Update modal content with response data
                                $('#mapModal h2').text(data.title);
                                $('#donorDate').text(dateDisplay);
                                $('#donorTime').text(data.time_start + ' - ' +
                                    data.time_end);
                                $('#donorAddress').text(data.address);

                                // update data detail utdpmi
                                $('#utdName').text(data.utd_profile.name);
                                $('#utdEmail').text(data.utd_profile.user
                                    .email);
                                $('#utdPhone').text(data.utd_profile
                                    .phone_number);
                                $('#utdAddress').text(data.utd_profile.address);

                                // Initialize map with coordinates from response
                                initMap(data.latitude, data.longitude);

                                // Show modal
                                $('#mapModal').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Gagal memuat data');
                        }
                    });
                });
            } else {
                console.error('Gagal memuat data');
            }
        },
        error: function(xhr, status, error) {
            console.error('Gagal memuat data');
        }
    });

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
</script>
@endsection