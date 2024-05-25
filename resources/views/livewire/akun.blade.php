@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10 h-full text-wrap overflow-hidden">
    <div class="flex justify-between">
        <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Akun dan Profil</p>
        <div class="flex gap-5 text-sm font-bold">
            <div id="openPasswordModal"
                class="bg-[#BA1D1D] text-white p-3 shadow shadow-gray-500 cursor-pointer rounded-xl hover:bg-[#930f0f]">
                <i class="fa-solid fa-lock mr-1"></i> Ubah Kata Sandi
            </div>
            <div id="openModal"
                class="text-[#BA1D1D] bg-[#dbdbdb61] shadow shadow-gray-500 p-3 cursor-pointer rounded-xl hover:bg-[#bababa]">
                <i class="fa-solid fa-user-pen mr-1"></i>
                Edit Profil
            </div>

        </div>
    </div>

    <!-- Modal untuk Edit Profil -->
    <div id="modalBackdrop"
        class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-xl shadow-xl w-3/4 relative max-h-screen overflow-hidden">
            <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold mb-4">Edit Profil</h2>
            <div class="flex flex-col overflow-y-auto max-h-[70vh] pr-4 pl-4 pb-4 pt-2">
                <form id="editProfileForm" class="space-y-4">
                    <div class="flex items-center space-x-6">
                        <label for="image_input" class="relative">
                            <img id="preview_img"
                                class="h-28 w-28 shadow shadow-gray-500 object-cover rounded-full cursor-pointer"
                                src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil" />
                            <input id="image_input" type="file" class="absolute inset-0 opacity-0 cursor-pointer"
                                accept="image/*" onchange="loadFile(event)" />
                            <div id="overlay"
                                class="absolute inset-0 rounded-full bg-black opacity-0 flex items-center justify-center transition duration-300 ease-in-out hover:opacity-50">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        </label>
                        <p class="text-sm font-medium text-gray-700">Tekan untuk mengganti foto profil</p>
                    </div>

                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="fullName" name="fullName"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex gap-2 justify-between">
                        <div>
                            <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Nomor
                                Telepon</label>
                            <input type="text" id="phoneNumber" name="phoneNumber"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-12 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" id="nik" name="nik"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-12 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="donorCode" class="block text-sm font-medium text-gray-700">Kode Donor</label>
                            <input type="text" id="donorCode" name="donorCode"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-12 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="flex gap-2 justify-between">
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <select id="editProvinsi"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Pilih Provinsi</option>
                                <!-- Tambahkan opsi provinsi di sini -->
                            </select>
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                            <select id="editKabupaten"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                                <!-- Tambahkan opsi kota/kabupaten di sini -->
                            </select>
                        </div>
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <select id="editKecamatan"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-6 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                                <!-- Tambahkan opsi kecamatan di sini -->
                            </select>
                        </div>
                        <div>
                            <label for="subdistrict" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                            <select id="editKelurahan"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-6 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Pilih Kelurahan</option>
                                <!-- Tambahkan opsi kelurahan di sini -->
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input id="editAlamat"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <p class="text-[10px] text-gray-500 mb-1">Geser pin koordinat sesuai lokasi alamat anda </p>
                        <div id="map" class="flex w-full" style="height: 200px;"></div>
                        <div class="preview-coordinates" id="coordinates">
                            <p id="latitude"></p>
                            <p id="longitude"></p>
                        </div>
                    </div>
                    <div class="flex gap-2 justify-between">
                        <div>
                            <label for="birthDate" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" id="birthDate" name="birthDate"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-16 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="inputGender" class="block text-sm font-medium text-gray-700">Jenis
                                Kelamin</label>
                            <select id="inputGender" name="inputGender"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-16 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="bloodType" class="block text-sm font-medium text-gray-700">Golongan
                                Darah</label>
                            <select id="bloodType" name="bloodType"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-16 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Pilih Golongan Darah</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <button id="UpdateProfileBtn" type="submit"
                class="bg-[#d42c2c] mt-2 font-sm text-white px-4 py-2 rounded-lg hover:bg-[#a11f1f] focus:outline-none">
                Simpan Perubahan
            </button>
        </div>
    </div>

    <!-- Modal untuk Ubah Kata Sandi -->
    <div id="passwordModalBackdrop"
        class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-xl shadow-xl w-1/3 relative max-h-screen overflow-hidden">
            <button id="closePasswordModal"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold mb-4">Ubah Kata Sandi</h2>
            <form id="changePasswordForm" class="space-y-4">
                <div>
                    <label for="currentPassword" class="block text-sm font-medium text-gray-700">Kata Sandi Saat
                        Ini</label>
                    <input type="password" id="currentPassword" name="currentPassword"
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="newPassword" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                    <input type="password" id="newPassword" name="newPassword"
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi
                        Baru</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button id="UpdatePasswordBtn" type="submit"
                    class="bg-[#d42c2c] mt-2 font-sm text-white px-4 py-2 rounded-lg hover:bg-[#a11f1f] focus:outline-none">
                    Ubah Kata Sandi
                </button>
            </form>
        </div>
    </div>


    <div class="flex mt-8">
        <div class="flex flex-col">
            <div class="flex">
                <img id="profilePictureInfo" src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                    class="w-40 h-40 rounded-full shadow shadow-gray-500 mr-16 ml-10">

                <div class="flex my-auto gap-28">
                    <div class="flex flex-col gap-10">
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Nama Lengkap</p>
                            <p id="fullNameInfo" class="text-sm"></p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Email</p>
                            <p id="emailInfo" class="text-sm"></p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-10">
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Username</p>
                            <p id="usernameInfo" class="text-sm"></p>

                        </div>
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Nomor Telepon</p>
                            <p id="phoneNumberInfo" class="text-sm"></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-10">
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Poin</p>
                            <p id="donorPointsInfo" class="text-sm"></p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Poin Klaim</p>
                            <p id="rewardPointsInfo" class="text-sm"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-12 ml-10">
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Provinsi</p>
                        <p id="provinceInfo" class="text-sm"></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kota/Kabupaten</p>
                        <p id="regencyInfo" class="text-sm"></p>
                    </div>
                </div>
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kecamatan</p>
                        <p id="districtInfo" class="text-sm"></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kelurahan</p>
                        <p id="villageInfo" class="text-sm"></p>
                    </div>
                </div>
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Alamat</p>
                        <p id="addressInfo" class="text-sm"></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">NIK</p>
                        <p id="citizenNumberInfo" class="text-sm"></p>
                    </div>
                </div>
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Golongan Darah</p>
                        <p id="bloodTypeInfo" class="text-sm"></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Tanggal Lahir</p>
                        <p id="birthDateInfo" class="text-sm"></p>
                    </div>
                </div>
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kode Donor</p>
                        <p id="donorCodeInfo" class="text-sm"></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Jenis Kelamin</p>
                        <p id="genderInfo" class="text-sm"></p>
                    </div>
                </div>
            </div>
        </div>

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
        $('#editAlamat').val(addressValue);
        // Change the label text
        $('#labelAlamat').text(addressValue);
    });
}

$(document).ready(function() {
    // load data profile
    $.ajax({
        url: baseUrl + 'profile/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function(response) {
            latitude = response.data.latitude;
            longitude = response.data.longitude;
            var birthDate = response.data.birth_date.split('T')[0];

            $('#fullNameInfo').text(response.data.full_name);
            $('#phoneNumberInfo').text(response.data.phone_number);
            $('#addressInfo').text(response.data.address);
            $('#citizenNumberInfo').text(response.data.citizen_number);
            $('#donorCodeInfo').text(response.data.donor_code);
            $('#donorPointsInfo').text(response.data.donor_points);
            $('#rewardPointsInfo').text(response.data.reward_points);
            $('#birthDateInfo').text(birthDate);
            $('#rewardPointsInfo').text(response.data.reward_points);
            $('#usernameInfo').text(response.data.user.username);
            $('#emailInfo').text(response.data.user.email);

            if (response.data.profile_picture) {
                $('#profilePictureInfo').attr('src', response.data.profile_picture);
                $('#preview_img').attr('src', response.data.profile_picture);
            }
            if (response.data.blood.rhesus_is_positive) {
                $('#bloodTypeInfo').text(response.data.blood.blood_type.toUpperCase() + "+");
            } else {
                $('#bloodTypeInfo').text(response.data.blood.blood_type.toUpperCase() + "-");
            }

            var gender = response.data.gender;
            if (gender == 'female') {
                $('#genderInfo').text('Perempuan');

            } else {
                $('#genderInfo').text('Laki-laki');
            }

            getUserLocationByVillageId(response.data.village_id);

            // auto-fill informasi pada saat pop-up update dibuka
            $('#fullName').val(response.data.full_name);
            $('#phoneNumber').val(response.data.phone_number);
            $('#nik').val(response.data.citizen_number);
            $('#donorCode').val(response.data.donor_code);
            $('#birthDate').val(birthDate);
            $('#editAlamat').val(response.data.address);
            $('#inputGender').val(gender);
            $('#bloodType').val(response.data.blood.id);

        },
        error: function(xhr, status, error) {
            console.error('Failed to load Provinsi data');

        }
    });

    // load dropdown data golongan darah
    $.ajax({
        url: baseUrl + 'blood',
        method: 'GET',
        success: function(response) {
            console.log(response.data);
            if (response.success) {
                var selectGolonganDarah = $('#bloodType');
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

    // load dropdown data province
    $.ajax({
        url: 'https://wilayah.skripsi-kita.my.id/apis/province',
        type: 'GET',
        success: function(response) {
            // Iterate over each Provinsi data and append it to the select element
            response.data.forEach(function(provinsi) {
                $('#editProvinsi').append('<option value="' + provinsi.id + '">' + provinsi
                    .name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to load Provinsi data');

        }
    });

    // Add event listener for province selection change
    $('#editProvinsi').on('change', function() {
        var selectedProvinceId = $(this).val();
        loadRegencies(0, selectedProvinceId);
    });

    // Add event listener for region selection change
    $('#editKabupaten').on('change', function() {
        var selectedRegencyId = $(this).val();
        loadDistricts(0, selectedRegencyId);
    });

    // Add event listener for district selection change
    $('#editKecamatan').on('change', function() {
        var selectedDistrictId = $(this).val();
        loadVillages(0, selectedDistrictId);

    });

    // Add event listener for village selection change
    $('#editKelurahan').on('change', function() {
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
                        $('#editAlamat').val(addressValue);
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

    // submit form update profile
    $('#UpdateProfileBtn').click(function() {
        // Ambil nilai dari elemen form
        var fullName = $('#fullName').val();
        var phoneNumber = $('#phoneNumber').val();
        var nik = $('#nik').val();
        var donorCode = $('#donorCode').val();
        var regency = $('#editKabupaten').val();
        var village = $('#editKelurahan').val();
        var address = $('#editAlamat').val();
        var birthDate = $('#birthDate').val();
        var gender = $('#inputGender').val();
        var bloodType = $('#bloodType').val();
        var profilePicture = $('#image_input')[0].files[0];

        // Buat objek FormData
        var formData = new FormData();
        formData.append('full_name', fullName);
        formData.append('phone_number', phoneNumber);
        formData.append('nik', nik);
        formData.append('donor_code', donorCode);
        formData.append('village_id', village);
        formData.append('regency_id', regency);
        formData.append('address', address);
        formData.append('birth_date', birthDate);
        formData.append('gender', gender);
        formData.append('blood_id', bloodType);
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        if (profilePicture) {
            formData.append('profile_picture', profilePicture);
        }

        // update profile
        $.ajax({
            url: baseUrl + 'profile/user',
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
                    toastr.success('Profil berhasil diperbarui!');
                    // Tutup modal
                    $('#modalBackdrop').addClass('hidden');
                    // Perbarui halaman
                    location.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Cek apakah ada respons error dari server
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    // Tampilkan pesan error dari server menggunakan Toastr.js
                    toastr.error(xhr.responseJSON.message);
                } else {
                    // Tampilkan pesan error default
                    toastr.error('Terjadi kesalahan saat mengirim permintaan');
                }
            }
        });
    });


    // submi form ubah password
    $('#changePasswordForm').submit(function(event) {
        event.preventDefault(); // Mencegah pengiriman form default

        //  Ambil nilai dari elemen form
        console.log("hai");
        var password = $('#currentPassword').val();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();


        var formData = new FormData();
        formData.append('password', password);
        formData.append('new_password', newPassword);
        formData.append('new_password_confirmation', confirmPassword);

        //update password
        $.ajax({
            url: baseUrl + 'auth/change-password',
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
                    toastr.success('Kata sandi berhasil diperbarui!');
                    // Tutup modal
                    $('#passwordModalBackdrop').addClass('hidden');
                    // Perbarui halaman
                    location.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Cek apakah ada respons error dari server
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    // Tampilkan pesan error dari server menggunakan Toastr.js
                    toastr.error(xhr.responseJSON.message);
                } else {
                    // Tampilkan pesan error default
                    toastr.error('Terjadi kesalahan saat mengirim permintaan');
                }
            }
        });
    });
});

var loadFile = function(event) {
    var output = document.getElementById('preview_img');
    var file = event.target.files[0];

    if (file && file.type.startsWith('image/')) {
        output.src = URL.createObjectURL(file);
        output.onload = function() {
            URL.revokeObjectURL(output.src); // free memory
        }
    }
};
document.getElementById('preview_img').addEventListener('click', function() {
    document.getElementById('image_input').click();
});

document.addEventListener("DOMContentLoaded", function() {
    const openModalButton = document.getElementById("openModal");
    const closeModalButton = document.getElementById("closeModal");
    const modalBackdrop = document.getElementById("modalBackdrop");

    const openPasswordModalButton = document.getElementById("openPasswordModal");
    const closePasswordModalButton = document.getElementById("closePasswordModal");
    const passwordModalBackdrop = document.getElementById("passwordModalBackdrop");

    // Function to open the profile edit modal
    function openModal() {
        modalBackdrop.classList.remove("hidden");
    }

    // Function to close the profile edit modal
    function closeModal() {
        modalBackdrop.classList.add("hidden");
    }

    // Function to open the password change modal
    function openPasswordModal() {
        passwordModalBackdrop.classList.remove("hidden");
    }

    // Function to close the password change modal
    function closePasswordModal() {
        passwordModalBackdrop.classList.add("hidden");
    }

    // Event listener for open profile edit modal button
    openModalButton.addEventListener("click", openModal);

    // Event listener for close profile edit modal button
    closeModalButton.addEventListener("click", closeModal);

    // Event listener for open password change modal button
    openPasswordModalButton.addEventListener("click", openPasswordModal);

    // Event listener for close password change modal button
    closePasswordModalButton.addEventListener("click", closePasswordModal);
});
// Event handler for opening the modal
$('#openModal').on('click', function() {
    $('#modalBackdrop').removeClass('hidden');

    // Initialize map if not already initialized
    if (!map) {
        initializeMap();
    }

    // Trigger map resize to render it correctly
    setTimeout(function() {
        map.invalidateSize();
    }, 200);
});

// Event handler for closing the modal
$('#closeModal').on('click', function() {
    $('#modalBackdrop').addClass('hidden');
});

//function untuk mengambil village-province name
function getUserLocationByVillageId(village_id) {
    $.ajax({
        url: 'https://wilayah.skripsi-kita.my.id/apis/village/' + village_id,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // update data
            $('#villageInfo').text(response.data.name);
            $('#districtInfo').text(response.data.district.name);
            $('#regencyInfo').text(response.data.district.regency.name);
            $('#provinceInfo').text(response.data.district.regency.province.name);

            // update value lokasi pada modal
            loadProvinces(response.data.district.regency.province.id);
            loadRegencies(response.data.district.regency.id, response.data.district.regency.province.id);
            loadDistricts(response.data.district.id, response.data.district.regency.id);
            loadVillages(response.data.id, response.data.district.id);

        },
        error: function(xhr, status, error) {
            console.error('Error fetching location:', error);
        }
    });
}

function loadProvinces(provinceId) {
    $.ajax({
        url: 'https://wilayah.skripsi-kita.my.id/apis/province',
        method: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
            var provinceDropdown = $("#editProvinsi");
            provinceDropdown.empty().append('<option value="" disabled selected>Pilih Provinsi</option>');
            $.each(response.data, function(key, value) {
                var option = $("<option></option>")
                    .attr("value", value.id)
                    .text(value.name);
                if (value.id === provinceId) {
                    option.attr("selected", "selected");
                }
                provinceDropdown.append(option);
            });
        },
        error: function(xhr) {
            console.error("Error loading provinces:", xhr.responseText);
        }
    });
}


function loadRegencies(regencyId, provinceId) {
    if (provinceId) {
        $.ajax({
            url: 'https://wilayah.skripsi-kita.my.id/apis/regency',
            method: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "province_id": provinceId
            },
            success: function(response) {
                var regencyDropdown = $("#editKabupaten");
                regencyDropdown.empty().append(
                    '<option value="" disabled selected>Pilih Kota/Kab.</option>');
                $.each(response.data, function(key, value) {
                    var option = $("<option></option>")
                        .attr("value", value.id)
                        .text(value.name);

                    if (value.id === regencyId) {
                        option.attr("selected", "selected");
                    }
                    regencyDropdown.append(option);
                });
            }
        });
    }
}

function loadDistricts(districtId, regencyId) {
    if (regencyId) {
        $.ajax({
            url: 'https://wilayah.skripsi-kita.my.id/apis/district',
            method: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "regency_id": regencyId
            },
            success: function(response) {
                var districtDropdown = $("#editKecamatan");
                districtDropdown.empty().append(
                    '<option value="" disabled selected>Pilih Kecamatan</option>');
                $.each(response.data, function(key, value) {
                    var option = $("<option></option>")
                        .attr("value", value.id)
                        .text(value.name);

                    if (value.id === districtId) {
                        option.attr("selected", "selected");
                    }

                    districtDropdown.append(option);
                });
            }
        });
    }
}

function loadVillages(villageId, districtId) {
    console.log("villageId, districtId", villageId, districtId)
    if (districtId) {
        $.ajax({
            url: 'https://wilayah.skripsi-kita.my.id/apis/village',
            method: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "district_id": districtId
            },
            success: function(response) {
                console.log("respnse", response);
                var villageDropdown = $("#editKelurahan");
                villageDropdown.empty().append(
                    '<option value="" disabled selected>Pilih Kelurahan</option>');

                $.each(response.data, function(key, value) {
                    var option = $("<option></option>")
                        .attr("value", value.id)
                        .text(value.name);

                    if (value.id === villageId) {
                        option.attr("selected", "selected");
                    }
                    villageDropdown.append(option);
                });

                if (villageId) {
                    $.ajax({
                        url: `https://wilayah.skripsi-kita.my.id/apis/village/${villageId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var response = data.data;
                            var address = response.name + ' ' + response.district.name + ' ' +
                                response
                                .district.regency.name + ' ' + response.district.regency
                                .province.name;
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
                                    const addressValue = response[lastIndex]
                                        .display_name;
                                    // // Update the input field value
                                    // $('#editAlamat').val(addressValue);
                                    // // Change the label text
                                    // $('#labelAlamat').text('Updated Address Label');

                                    if (response.length > 0) {
                                        latitude = response[0].lat;
                                        longitude = response[0].lon;
                                        console.log('Latitude:', latitude);
                                        console.log('Longitude:', longitude);
                                        // Use latitude and longitude to set map here                    
                                        var villageCoordinates = [latitude,
                                            longitude
                                        ];
                                        console.log(villageCoordinates);
                                        // Mengarahkan peta ke koordinat desa yang dipilih
                                        map.setView(villageCoordinates, 14);

                                        // Memindahkan marker ke lokasi desa yang dipilih
                                        marker.setLatLng(villageCoordinates);

                                        // Memperbarui tampilan koordinat
                                        coordinatesDisplay.textContent =
                                            'Latitude: ' +
                                            villageCoordinates[0]
                                            .toFixed(6) +
                                            ', Longitude: ' + villageCoordinates[1]
                                            .toFixed(
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
                }
            },
            error: function(xhr) {
                console.error("Error loading villages:", xhr.responseText);
            }
        });
    }
}
</script>
@endsection