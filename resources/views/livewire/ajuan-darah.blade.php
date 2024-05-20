@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Form Ajuan Permintaan Darah</p>
    <p class="text-xs text-[#172B4D] mt-2">Pastikan terlebih dahulu darah memang tidak ada di
        <a class="text-[#3793D5]" style="text-decoration: underline;" href="/stok-darah">stok</a>
        dan isi form dengan lengkap
    </p>

    <div class="flex flex-col text-[12px] gap-6 mt-10">
        <div class="flex">
            <p class="font-bold mt-2">Nama Lengkap</p>
            <input type="text" id="inputNama" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[80px] p-2 rounded-lg"
                placeholder="Nama Lengkap">
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Nomor Handphone</p>
            <input type="text" id="NomorHandphone" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[56px] p-2 rounded-lg"
                placeholder="Nomor Handphone">
        </div>

        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <p class="font-bold ">Provinsi</p>
                <select id="inputProvinsi" class="bg-[#E2E8F0] w-full p-2 rounded-lg md:mt-2">
                    <option value="" disabled selected>Pilih Provinsi</option>
                    <!-- <option value="jawa-timur">Jawa Timur</option>
                    <option value="jawa-tengah">Jawa Tengah</option>
                    <option value="bali">Bali</option> -->
                </select>
            </div>

            <div class="w-full md:w-1/2 md:mt-0 md:ml-4">
                <p class="font-bold ">Kota/Kabupaten</p>
                <select id="inputKabupaten" class="bg-[#E2E8F0] w-full p-2 rounded-lg mt-2 ">

                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <p class="font-bold ">Kecamatan</p>
                <select id="inputKecamatan" class="bg-[#E2E8F0] w-full p-2 rounded-lg md:mt-2">
                    <option value="" disabled selected>Pilih Kecamatan</option>
                </select>
            </div>

            <div class="w-full md:w-1/2 mt-4 md:mt-0 md:ml-4">
                <p class="font-bold ">Kelurahan</p>
                <select id="inputKelurahan" wire:change="handleKelurahanChange"
                    class="bg-[#E2E8F0] w-full p-2 rounded-lg mt-2">
                    <option value="" disabled selected>Pilih Kelurahan</option>
                </select>
            </div>
        </div>

        <div class="flex">
            <p class="font-bold mt-4">Alamat Lengkap</p>
            <input type="text" id="inputAlamat" class="bg-[#E2E8F0] flex-grow ml-3 mt-2 md:ml-[74px] p-2 rounded-lg"
                placeholder="Alamat Lengkap">
        </div>

        <div class="flex flex-col justify-center items-center ">
            <div id="map" class="flex w-full md:w-4/5 h-[200px]"></div>
            <div class="preview-coordinates" id="coordinates">
                <p id="latitude"></p>
                <p id="longitude"></p>
            </div>
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Golongan Darah</p>
            <select id="inputGolonganDarah"
                class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[90px] p-2 rounded-lg mt-2 md:mt-0">
                <option value="" disabled selected>Pilih Golongan Darah</option>
            </select>
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Produk Darah</p>
            <select id="inputProdukDarah" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[104px] p-2 rounded-lg mt-2 md:mt-0">
                <option value="" disabled selected>Pilih Produk Darah</option>
            </select>
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Jumlah</p>
            <input type="text" id="inputJumlah" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[145px] p-2 rounded-lg"
                placeholder="Jumlah">
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Surat Ajuan</p>
            <input type="file" id="inputUploadFile" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[117px] p-2 rounded-lg"
                accept="image/*,.pdf">
        </div>
        <div class="flex">
            <p class="font-bold mt-2">Kepentingan</p>
            <input type="text" id="inputKepentingan" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[112px] p-2 rounded-lg"
                placeholder="Kepentingan">
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Deskripsi</p>
            <input type="text" id="inputDeskripsi" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[132px] p-2 rounded-lg"
                placeholder="Deskripsi">
        </div>

        <button id="submitButton"
            class="justify-center self-end px-8 py-1 mt-4 text-md font-bold tracking-tight leading-8 text-center text-white whitespace-nowrap bg-[#BA1D1D] rounded-xl shadow-md max-md:px-5 max-md:mr-2.5 hover:bg-[#a11f1f]">
            KIRIM
        </button>
    </div>
</div>

<script>
// Membuat peta
var map = L.map('map').setView([-2.5489, 118.0149], 5); // Koordinat tengah Indonesia dan tingkat zoom awal

// Menambahkan layer OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Menambahkan marker yang bisa digeser
var marker = L.marker([-2.5489, 118.0149], {
    draggable: true
}).addTo(map);

// Elemen untuk menampilkan preview koordinat
var coordinatesDisplay = document.getElementById('coordinates');

// Menangani perpindahan marker
marker.on('dragend', function(e) {
    var newPosition = e.target.getLatLng(); // Mendapatkan posisi baru marker
    var latitude = newPosition.lat;
    var longitude = newPosition.lng;
    document.getElementById('latitude').textContent = 'Latitude: ' + latitude.toFixed(6);
    document.getElementById('longitude').textContent = 'Longitude: ' + longitude.toFixed(6);

    console.log("New position - Latitude:", latitude, "Longitude:", longitude);

    // Anda dapat menambahkan logika tambahan di sini, seperti menyimpan koordinat baru ke database, dll.
});

$(document).ready(function() {
    $.ajax({
        url: 'https://wilayah.skripsi-kita.my.id/apis/province',
        type: 'GET',
        success: function(response) {
            // Iterate over each Provinsi data and append it to the select element
            response.data.forEach(function(provinsi) {
                $('#inputProvinsi').append('<option value="' + provinsi.id + '">' + provinsi
                    .name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to load Provinsi data');

        }
    });
    $('#submitButton').click(function() {
        var inputNama = $('#inputNama').val();
        var inputNama = $('#inputNama').val();
        var nomorHandphone = $('#NomorHandphone').val();
        var inputProvinsi = $('#inputProvinsi').val();
        var inputKota = $('#inputKota').val();
        var inputKecamatan = $('#inputKecamatan').val();
        var inputKelurahan = $('#inputKelurahan').val();
        var inputAlamat = $('#inputAlamat').val();
        var inputGolonganDarah = $('#inputGolonganDarah').val();
        var inputProdukDarah = $('#inputProdukDarah').val();
        var inputJumlah = $('#inputJumlah').val();
        var inputUploadFile = $('#inputUploadFile').val();
        var inputKepentingan = $('#inputKepentingan').val();
        var inputDeskripsi = $('#var inputDeskripsi').val();

        $.post('http://example.com/your-endpoint', {
            inputNama: inputNama,

        }, function(response) {
            console.log(response);
        });
    });

    // Add event listener for province selection change
    $('#inputProvinsi').on('change', function() {
        var selectedProvinceId = $(this).val();

        // Make AJAX request to fetch regencies based on selected province ID
        $.ajax({
            url: 'https://wilayah.skripsi-kita.my.id/apis/regency',
            method: 'GET',
            data: {
                province_id: selectedProvinceId
            },
            dataType: 'json',
            success: function(data) {
                var selectRegency = $('#inputKabupaten');
                selectRegency.empty(); // Clear existing options

                // Append default option
                selectRegency.append(
                    '<option value="" disabled selected>Pilih Kota/Kabupaten</option>');

                // Append options for each regency
                $.each(data.data, function(index, regency) {
                    selectRegency.append('<option value="' + regency.id + '">' +
                        regency.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching regencies:', error);
            }
        });
    });

    $('#inputKabupaten').on('change', function() {
        var selectedRegencyId = $(this).val();

        $.ajax({
            url: 'https://wilayah.skripsi-kita.my.id/apis/district',
            method: 'GET',
            data: {
                regency_id: selectedRegencyId
            },
            dataType: 'json',
            success: function(data) {
                var selectDistrict = $('#inputKecamatan');
                selectDistrict.empty(); // Clear existing options

                // Append default option
                selectDistrict.append(
                    '<option value="" disabled selected>Pilih Kecamatan</option>');

                // Append options for each district
                $.each(data.data, function(index, district) {
                    selectDistrict.append('<option value="' + district.id + '">' +
                        district.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching districts:', error);
            }
        });
    });

    $('#inputKecamatan').on('change', function() {
        var selectedDistrictId = $(this).val();

        $.ajax({
            url: 'https://wilayah.skripsi-kita.my.id/apis/village',
            method: 'GET',
            data: {
                district_id: selectedDistrictId
            },
            dataType: 'json',
            success: function(data) {
                var selectVillage = $('#inputKelurahan');
                selectVillage.empty(); // Clear existing options

                // Append default option
                selectVillage.append(
                    '<option value="" disabled selected>Pilih Kelurahan</option>');

                // Append options for each village
                $.each(data.data, function(index, village) {
                    selectVillage.append('<option value="' + village.id + '">' +
                        village.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching villages:', error);
            }
        });
    });

    $('#inputKelurahan').on('change', function() {
        var selectedVillageId = $(this).val();

        // Melakukan permintaan ke endpoint API untuk mendapatkan koordinat desa berdasarkan ID desa
        $.ajax({
            url: `https://wilayah.skripsi-kita.my.id/apis/village/${selectedVillageId}`,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var response = data.data;
                var address = response.name + ' ' + response.district.name + ' ' + response
                    .district.regency.name + ' ' + response.district.regency.province.name;
                $.ajax({
                    url: 'https://nominatim.openstreetmap.org/search.php',
                    type: 'GET',
                    data: {
                        q: address, // Replace 'example address' with the actual address you want to get coordinates for
                        format: 'jsonv2',
                        polygon_geojson: 1
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            var latitude = response[0].lat;
                            var longitude = response[0].lon;
                            console.log(response);
                            console.log('Latitude:', latitude);
                            console.log('Longitude:', longitude);
                            // Use latitude and longitude to set map here                    
                            var villageCoordinates = [latitude, longitude];
                            console.log(villageCoordinates);
                            // Mengarahkan peta ke koordinat desa yang dipilih
                            map.setView(villageCoordinates, 14);

                            // Memindahkan marker ke lokasi desa yang dipilih
                            marker.setLatLng(villageCoordinates);

                            // Memperbarui tampilan koordinat
                            coordinatesDisplay.textContent = 'Latitude: ' +
                                villageCoordinates[0]
                                .toFixed(6) +
                                ', Longitude: ' + villageCoordinates[1].toFixed(
                                    6);

                        } else {
                            console.error('No results found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Handle error response here
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching village coordinates:', error);
            }
        });

    });


});
</script>
@endsection