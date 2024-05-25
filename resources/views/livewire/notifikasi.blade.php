@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">

    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Notifikasi</p>
    <p class="text-sm mt-2">Tekan notifikasi untuk melihat detail informasi dan menjadi pendonor darurat</p>

    <div class="mt-10 p-1 flex flex-col gap-4">
        <div id="openGeneralModal"
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <div class="text-gray-700 text-lg font-semibold">Ajuan Bukti Donor telah diterima!</div>
                    <div class="flex gap-2">
                        <div class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div class="bg-[#14C465] w-20 text-center text-white text-sm p-1 shadow rounded-3xl font-bold">
                            Umum</div>
                    </div>
                </div>
                <div class="my-auto text-gray-700 "><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>

        <div id="openImportantModal"
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <div class="text-gray-700 text-lg font-semibold">Ajuanmu telah diterima!</div>
                    <div class="flex gap-2">
                        <div class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div class="bg-[#e9d525] w-20 text-center text-white text-sm p-1 shadow rounded-3xl font-bold">
                            Penting</div>
                    </div>
                </div>
                <div class="my-auto text-gray-700 "><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>

        <div id="openUrgentModal"
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
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
        </div>
    </div>

    <div id="GeneralModalBackdrop"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden">
        <div class="absolute top-0 w-2/3 flex justify-center">
            <div id="GeneralModalContent"
                class="relative bg-white rounded-lg p-8 mt-8 transform -translate-y-full  transition-transform duration-500">
                <button id="closeGeneralModal"
                    class="absolute top-4 right-4 mt-3 text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
                <div>
                    <h2 class="text-xl font-bold mb-1 mr-6">Ajuan Bukti Donor Anda telah diterima</h2>
                    <div class="flex gap-2">
                        <div class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div class="bg-[#14C465] w-20 text-center text-white text-sm p-1 shadow rounded-3xl font-bold">
                            Umum</div>
                    </div>
                    <div class="text-sm text-gray-500 mt-4">
                        Mohon maaf, kami tidak dapat melanjutkan proses untuk ajuan pbukti donor yang kamu kirimkan.
                        Hal ini dikarenakan testtttttttt. Silahkan ajukan kembali dengan memperhatikan data-data yang
                        kamu kirimkan. Salam Tim Donora</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Notifikasi Penting -->
    <div id="ImportantModalBackdrop"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden">
        <div class="absolute top-0 w-2/3 flex justify-center">
            <div id="ImportantModalContent"
                class="relative bg-white rounded-lg p-8 mt-8 transform -translate-y-full transition-transform duration-500">
                <button id="closeImportantModal"
                    class="absolute top-4 right-4 mt-3 text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
                <div>
                    <h2 class="text-xl font-bold mb-1 mr-6">Ajuan Bukti Donor Anda telah diterima</h2>
                    <div class="flex gap-2">
                        <div class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div class="bg-[#e9d525] w-20 text-center text-white text-sm p-1 shadow rounded-3xl font-bold">
                            Penting</div>
                    </div>
                    <div class="text-sm text-gray-500 mt-4">
                        Mohon maaf, kami tidak dapat melanjutkan proses untuk ajuan pbukti donor yang kamu kirimkan.
                        Hal ini dikarenakan testtttttttt. Silahkan ajukan kembali dengan memperhatikan data-data yang
                        kamu kirimkan. Salam Tim Donora</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Notifikasi Urgent -->
    <div id="UrgentModalBackdrop"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 overflow-y-auto hidden">
        <div class="absolute top-0 flex w-2/3 justify-center">
            <div id="UrgentModalContent"
                class="relative bg-white rounded-lg p-8 mt-8 transform -translate-y-full transition-transform duration-500">
                <button id="closeUrgentModal"
                    class="absolute top-4 right-4 mt-3 text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
                <div>
                    <h2 class="text-xl font-bold mb-1 mr-6">Dibutuhkan Segera + A Anti Hemophilic Factor di Surabaya</h2>
                    <div class="flex gap-2">
                        <div class="text-sm text-gray-500 mt-1">2024-24-16</div>
                        <div class="bg-[#BA1D1D] w-20 text-center text-white font-bold text-sm p-1 shadow rounded-3xl">
                            Darurat</div>
                    </div>
                    <div class="text-sm text-gray-500 mt-4">
                        Mohon maaf, kami tidak dapat melanjutkan proses untuk ajuan pbukti donor yang kamu kirimkan.
                        Hal ini dikarenakan testtttttttt. Silahkan ajukan kembali dengan memperhatikan data-data yang
                        kamu kirimkan. Salam Tim Donora</div>
                    <button id="" type="submit"
                        class="bg-[#d42c2c] mt-2 text-sm text-white px-4 py-2 rounded-xl mt-4 hover:bg-[#a11f1f] focus:outline-none">
                        Daftar Sebagai Pendonor
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const openGeneralModalButton = document.getElementById("openGeneralModal");
    const openImportantModalButton = document.getElementById("openImportantModal");
    const openUrgentModalButton = document.getElementById("openUrgentModal");
    const closeImportantModalButton = document.getElementById("closeImportantModal");
    const closeGeneralModalButton = document.getElementById("closeGeneralModal");
    const closeUrgentModalButton = document.getElementById("closeUrgentModal");
    const GeneralModalBackdrop = document.getElementById("GeneralModalBackdrop");
    const ImportantModalBackdrop = document.getElementById("ImportantModalBackdrop");
    const UrgentModalBackdrop = document.getElementById("UrgentModalBackdrop");
    const GeneralModalContent = document.getElementById("GeneralModalContent");
    const ImportantModalContent = document.getElementById("ImportantModalContent");
    const UrgentModalContent = document.getElementById("UrgentModalContent");

    // Function to open the general modal with slide from top animation
    function openGeneralModal() {
        GeneralModalBackdrop.classList.remove("hidden");
        setTimeout(() => {
            GeneralModalContent.style.transform = "translateY(0)";
        }, 10);
    }

    // Function to close the general modal with slide up animation
    function closeGeneralModal() {
        GeneralModalContent.style.transform = "translateY(-100%)";
        setTimeout(() => {
            GeneralModalBackdrop.classList.add("hidden");
        }, 500); // Match this duration with the transition duration
    }

    // Function to open the important modal with slide from top animation
    function openImportantModal() {
        ImportantModalBackdrop.classList.remove("hidden");
        setTimeout(() => {
            ImportantModalContent.style.transform = "translateY(0)";
        }, 10);
    }

    // Function to close the important modal with slide up animation
    function closeImportantModal() {
        ImportantModalContent.style.transform = "translateY(-100%)";
        setTimeout(() => {
            ImportantModalBackdrop.classList.add("hidden");
        }, 500); // Match this duration with the transition duration
    }

    // Function to open the urgent modal with slide from top animation
    function openUrgentModal() {
        UrgentModalBackdrop.classList.remove("hidden");
        setTimeout(() => {
            UrgentModalContent.style.transform = "translateY(0)";
        }, 10);
    }

    // Function to close the urgent modal with slide up animation
    function closeUrgentModal() {
        UrgentModalContent.style.transform = "translateY(-100%)";
        setTimeout(() => {
            UrgentModalBackdrop.classList.add("hidden");
        }, 500); // Match this duration with the transition duration
    }

    // Event listener for open general modal button
    openGeneralModalButton.addEventListener("click", openGeneralModal);

    // Event listener for close general modal button
    closeGeneralModalButton.addEventListener("click", closeGeneralModal);

    // Event listener for open important modal button
    openImportantModalButton.addEventListener("click", openImportantModal);

    // Event listener for close important modal button
    closeImportantModalButton.addEventListener("click", closeImportantModal);

    // Event listener for open urgent modal button
    openUrgentModalButton.addEventListener("click", openUrgentModal);

    // Event listener for close urgent modal button
    closeUrgentModalButton.addEventListener("click", closeUrgentModal);
});
</script>
@endsection