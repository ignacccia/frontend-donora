@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10 h-full text-wrap overflow-hidden">
    <div class="flex justify-between">
        <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Akun dan Profil</p>
        <div class="flex gap-5 text-sm font-bold">
            <div
                class="bg-[#BA1D1D] text-white p-3 shadow shadow-gray-500 cursor-pointer rounded-xl hover:bg-[#930f0f]">
                <i class="fa-solid fa-lock mr-1"></i> Ubah Password
            </div>
            <div id="openModal"
                class="text-[#BA1D1D] bg-[#dbdbdb61] shadow shadow-gray-500 p-3 cursor-pointer rounded-xl hover:bg-[#bababa]">
                <i class="fa-solid fa-user-pen mr-1"></i>
                Edit Profil
            </div>

        </div>
    </div>

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
            <div class="overflow-y-auto max-h-[70vh] pr-4 pl-4 pb-4 pt-2">
                <form id="editProfileForm" class="space-y-4">
                    <div class="flex items-center space-x-6">
                        <label for="image_input" class="relative">
                            <img id="preview_img"
                                class="h-28 w-28 shadow shadow-gray-500 object-cover rounded-full cursor-pointer"
                                src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil" />
                            <input id="image_input" type="file" class="absolute inset-0 opacity-0 cursor-pointer"
                                onchange="loadFile(event)" />
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
                    <div>
                        <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" id="phoneNumber" name="phoneNumber"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="nik" name="nik"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="donorCode" class="block text-sm font-medium text-gray-700">Kode Donor</label>
                        <input type="text" id="donorCode" name="donorCode"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <select id="province" name="province"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            <!-- Tambahkan opsi provinsi di sini -->
                        </select>
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                        <select id="city" name="city"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                            <!-- Tambahkan opsi kota/kabupaten di sini -->
                        </select>
                    </div>
                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <select id="district" name="district"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Pilih Kecamatan</option>
                            <!-- Tambahkan opsi kecamatan di sini -->
                        </select>
                    </div>
                    <div>
                        <label for="subdistrict" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                        <select id="subdistrict" name="subdistrict"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Pilih Kelurahan</option>
                            <!-- Tambahkan opsi kelurahan di sini -->
                        </select>
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                        <input type="number" step="any" id="longitude" name="longitude"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                        <input type="number" step="any" id="latitude" name="latitude"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="birthDate" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="birthDate" name="birthDate"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="bloodType" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                        <select id="bloodType" name="bloodType"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </form>
            </div> <button id="UpdateProfileBtn" type="submit"
                class="bg-[#d42c2c] mt-2 font-sm text-white px-4 py-2 rounded-lg hover:bg-[#a11f1f] focus:outline-none">
                Simpan Perubahan
            </button>
        </div>
    </div>

    <script>
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
    }); =
    </script>

    <div class="flex mt-8">
        <div class="flex flex-col">
            <div class="flex">
                <img src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                    class="w-40 h-40 rounded-full shadow shadow-gray-500 mr-20" id="fotoProfil">



                <div class="flex my-auto gap-28">
                    <div class="flex flex-col gap-10">
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Nama Lengkap</p>
                            <p class="text-sm">Yasmin Shalsaaa</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Email</p>
                            <p class="text-sm">syafira13yasmin@gmail.com</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-10">
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Username</p>
                            <p class="text-sm">yasmini13</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Nomor Telepon</p>
                            <p class="text-sm">0085736441237</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-10">
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Poin Donor</p>
                            <p class="text-sm">90</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-[11px] text-gray-500 mb-1">Poin HAdiah</p>
                            <p class="text-sm">28</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-between mt-5">
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Provinsi</p>
                        <p class="text-sm">Jawa Timur</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kota/Kabupaten</p>
                        <p class="text-sm">Surabaya</p>
                    </div>
                </div>

                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kecamatan</p>
                        <p class="text-sm">Sukolilo</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kelurahan</p>
                        <p class="text-sm">Nginden</p>
                    </div>
                </div>

                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Alamat</p>
                        <p class="text-sm">Nginden Kota II/73</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">NIK</p>
                        <p class="text-sm">3515085301020004</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-10 mb-5">
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Golongan Darah</p>
                        <p class="text-sm">-</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Tanggal Lahir</p>
                        <p class="text-sm">13 Jan 2002</p>
                    </div>
                </div>

                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Kode Donor</p>
                        <p class="text-sm">-</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Jenis Kelamin</p>
                        <p class="text-sm">-</p>
                    </div>
                </div>

                <div class="flex flex-col gap-10">
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Longitude</p>
                        <p class="text-sm">-</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[11px] text-gray-500 mb-1">Latitude</p>
                        <p class="text-sm">-</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const openModalButton = document.getElementById("openModal");
    const closeModalButton = document.getElementById("closeModal");
    const modalBackdrop = document.getElementById("modalBackdrop");

    // Function to open the modal
    function openModal() {
        modalBackdrop.classList.remove("hidden");
    }

    // Function to close the modal
    function closeModal() {
        modalBackdrop.classList.add("hidden");
    }

    // Event listener for open modal button
    openModalButton.addEventListener("click", openModal);

    // Event listener for close modal button
    closeModalButton.addEventListener("click", closeModal);
});
</script>
@endsection