@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <div class="flex justify-between">
        <div class="flex flex-col">
            <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Formulir Ajuan Permintaan Darah</p>
            <p class="text-xs text-[#172B4D] mt-2">Pastikan terlebih dahulu darah memang tidak ada di
                <a class="text-[#3793D5]" style="text-decoration: underline;" href="/stok-darah">stok</a>
                dan isi form dengan lengkap
            </p>
        </div>
        <div class="my-auto">
            <a href="/riwayat-ajuan">
                <button class="flex bg-[#d42c2c] text-white text-sm px-2 py-2 rounded-lg hover:bg-[#a11f1f]"> <i
                        class="fa-solid fa-clock-rotate-left mt-1 mr-2"></i>
                    <p>Lihat Ajuan Anda</p>
                </button>
            </a>
        </div>
    </div>


    <div class="flex flex-col text-[12px] gap-6 mt-10">
        <div class="flex">
            <p class="font-bold mt-2">Nama Pasien</p>
            <input type="text" id="inputNama" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[80px] p-2 rounded-lg"
                placeholder="Nama Pasien">
        </div>

        {{-- <div class="flex">
            <p class="font-bold mt-2">Nomor Handphone</p>
            <input type="text" id="NomorHandphone" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[56px] p-2 rounded-lg"
                placeholder="Nomor Handphone">
        </div> --}}

        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <p class="font-bold ">Provinsi</p>
                <select id="inputProvinsi" class="bg-[#E2E8F0] w-full p-2 rounded-lg md:mt-2">
                    <option value="" disabled selected>Pilih Provinsi</option>
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
            <p class="font-bold mt-4">Alamat</p>
            <input type="text" id="inputAlamat" class="bg-[#E2E8F0] flex-grow ml-3 mt-2 md:ml-[74px] p-2 rounded-lg"
                placeholder="Alamat">
        </div>

        <div class="flex flex-col justify-center items-center z-20">
            <p class="text-[10px] text-gray-500 mb-1">Geser pin koordinat sesuai lokasi alamat anda </p>
            <div id="map" class="flex w-full md:w-full" style="height: 200px;"></div>
            <div class="preview-coordinates" id="coordinates">
                <p id="latitude"></p>
                <p id="longitude"></p>
            </div>
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Golongan Darah</p>
            <select id="selectGolonganDarah"
                class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[90px] p-2 rounded-lg mt-2 md:mt-0">
                <option value="" disabled selected>Pilih Golongan Darah</option>
            </select>
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Produk Darah</p>
            <select id="selectProdukDarah"
                class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[104px] p-2 rounded-lg mt-2 md:mt-0">
                <option value="" disabled selected>Pilih Produk Darah</option>
            </select>
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Jumlah(mL)</p>
            <input type="text" id="inputJumlah" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[118px] p-2 rounded-lg"
                placeholder="Jumlah">
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Surat Ajuan</p>
            <input type="file" id="inputUploadFile" class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[117px] p-2 rounded-lg"
                accept="image/*,.pdf">
        </div>

        <div class="flex">
            <p class="font-bold mt-2">Kepentingan</p>
            <select id="selectKepentingan"
                class="bg-[#E2E8F0] flex-grow ml-3 md:ml-[110px] p-2 rounded-lg mt-2 md:mt-0">
                <option value="" disabled selected>Pilih Kepentingan</option>
                <option value="accident">Kecelakaan</option>
                <option value="chronic condition">Kritis</option>
                <option value="illness">Sakit</option>
                <option value="surgery">Operasi</option>
                <option value="other">Lainnya</option>
            </select>
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
const baseUrl = 'https://skripsi-kita.my.id/apis/';
var token = localStorage.getItem('token');
var latitude = 0;
var longitude = 0;

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
    latitude = newPosition.lat;
    longitude = newPosition.lng;
    document.getElementById('latitude').textContent = 'Latitude: ' + latitude.toFixed(6);
    document.getElementById('longitude').textContent = 'Longitude: ' + longitude.toFixed(6);

    console.log("New position - Latitude:", latitude, "Longitude:", longitude);
    // Memanggil fungsi untuk mendapatkan alamat berdasarkan koordinat
    getAddressByCoordinate(latitude, longitude);
});

function getAddressByCoordinate(lat, lon) {
    var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;
    $.getJSON(url, function(data) {
        var addressValue = data.display_name;
        // Update the input field value
        $('#inputAlamat').val(addressValue);
        // Change the label text
        $('#labelAlamat').text(addressValue);
    });
}

$(document).ready(function() {
    // load dropdown data golongan darah
    $.ajax({
        url: baseUrl + 'blood',
        method: 'GET',
        success: function(response) {
            console.log(response.data);
            if (response.success) {
                var selectGolonganDarah = $('#selectGolonganDarah');
                // selectGolonganDarah.empty(); // Clear existing options before appending new ones

                response.data.forEach(function(item) {
                    const bloodType = item.blood_type.toUpperCase();
                    if (item.rhesus_is_positive) {
                        selectGolonganDarah.append(new Option(bloodType + "+", item.id));
                    } else {
                        selectGolonganDarah.append(new Option(bloodType + "-", item.id));

                    }
                });
            } else {
                alert('Failed to load blood type data');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while loading data');
        }
    });

    // load dropdown data produk darah
    $.ajax({
        url: baseUrl + 'blood/product',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                var selectProdukDarah = $('#selectProdukDarah');
                response.data.forEach(function(item) {
                    selectProdukDarah.append(new Option(item.name, item.id));
                });
            } else {
                alert('Failed to load blood type data');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while loading data');
        }
    });

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
        var inputKelurahan = $('#inputKelurahan').val();
        var inputAlamat = $('#inputAlamat').val();
        var selectGolonganDarah = $('#selectGolonganDarah').val();
        var selectProdukDarah = $('#selectProdukDarah').val();
        var inputJumlah = $('#inputJumlah').val();
        var inputUploadFile = $('#inputUploadFile')[0].files[0];
        var selectKepentingan = $('#selectKepentingan').val();
        var inputDeskripsi = $('#inputDeskripsi').val();

        var formData = new FormData();
        formData.append('patient_name', inputNama);
        formData.append('village_id', inputKelurahan);
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        formData.append('blood_id', selectGolonganDarah);
        formData.append('blood_product_id', selectProdukDarah);
        formData.append('qty', inputJumlah);
        formData.append('blood_request_letter', inputUploadFile);
        formData.append('necessity', selectKepentingan);
        formData.append('description', inputDeskripsi);
        formData.append('address', inputAlamat);

        $.ajax({
            url: baseUrl + 'blood-request',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response)
                if (response.success) {
                    console.log("success");
                    toastr.success('Ajuan berhasil dikirim!');
                    window.location.href = baseUrl + 'riwayat-donor';
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Cek apakah ada respons error dari server
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    // Tampilkan pesan error dari server menggunakan Toastr.js
                    toastr.error('Isi formulir dengan lengkap');
                } else {
                    // Tampilkan pesan error default
                    toastr.error('Terjadi kesalahan saat mengirim permintaan');
                }
            }
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
                        // Mengambil village_name dari index terakhir
                        const lastIndex = response.length - 1;
                        const addressValue = response[lastIndex].display_name;
                        // Update the input field value
                        $('#inputAlamat').val(addressValue);
                        // Change the label text
                        $('#labelAlamat').text('Updated Address Label');

                        if (response.length > 0) {
                            latitude = response[0].lat;
                            longitude = response[0].lon;
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