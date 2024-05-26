@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10 h-full">
    <div class="flex flex-col sm:flex-row md:flex-row lg:flex-row justify-between">
        <div class="sm:mb-2">
            <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Klaim Hadiah</p>
            <p class="text-[12px] mt-2">Kumpulkan poin sebanyak mungkin dengan melakukan donor lalu <a
                    class="text-[#3793D5] cursor-pointer hover:underline" href="/bukti-donor">unggah bukti</a> dan
                tukarkan
                dengan hadiah menarik!</p>
        </div>
        <div class="mt-2 sm:mt-0 sm:flex sm:items-center">
            <button id="btnOpenModal"
                class="justify-center self-end px-6 font-bold py-1 text-sm tracking-tight leading-8 text-center text-white mb-5 whitespace-nowrap bg-[#BA1D1D] rounded-xl shadow-gray-500 sm:ml-2.5 sm:mr-0 hover:bg-[#a11f1f]">
                <i class="fa-solid fa-gift mr-1"></i> Hadiah Saya
            </button>
        </div>
    </div>
    <p class="text-md font-bold text-[#172B4D]"><span id="reward_points"></span> poin reward</p>

    <!-- Overlay Background Modal -->
    <div class="fixed top-0 left-0 w-full h-full bg-gray-800 opacity-50 z-50 hidden" id="overlay"></div>

    <!-- Modal -->
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 rounded-2xl shadow-md z-50 hidden"
        id="myReward">
        <div class="flex justify-between mb-4">
            <!-- Konten Modal -->
            <h1 class="text-lg font-semibold">Hadiah yang Telah Saya Klaim </h1>
            <button id="btnCloseModal" class="text-gray-500 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto max-h-80">

            <div class="flex flex-col md:flex-row lg:flex-row bg-[#fbfbfb] w-full shadow shadow-gray-400 p-4 rounded-lg mb-4"
                id="reward">
                <div class="flex flex-col md:flex-row lg:flex-row">
                    <img src="{{ asset('images/rewardBanner.jpg') }}" alt="Reward"
                        class="w-full md:w-[280px] h-[120px] md:h-auto lg:h-auto rounded shadow shadow-gray-300 mb-4 md:mb-0"
                        id="bannerReward">
                    <div class="flex flex-col w-full md:w-auto lg:w-auto justify-between">
                        <p class="text-gray-500 text-lg font-semibold mt-2" id="namaReward">Promo Voucher Makan dan
                            Transport By
                            Grab</p>
                        <p class="text-[12px] text-gray-500" id="deskripsiReward">Commodi magnam ab sunt ipsam. Qui
                            possimus quibusdam autem officiis molestias ullam modi. Dolorum voluptate iure repellat
                            labore
                            eligendi.</p>
                        <div class="flex flex-row md:flex-row lg:flex-row justify-between mt-2">
                            <p class="text-md font-bold mt-1 text-gray-500" id="poinReward">70 poin</p>
                            <button
                                class="bg-[#818181] self-end ml-12 mb-1 text-white px-6 py-2 text-sm font-bold rounded-xl"
                                disabled>
                                Telah Diklaim
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="flex mt-10 gap-6 flex-wrap">

        <div class="flex flex-col md:flex-row lg:flex-row bg-[#fbfbfb] w-full shadow shadow-gray-400 p-4 rounded-lg"
            id="reward">
            <div class="flex flex-col md:flex-row lg:flex-row">
                <img src="{{ asset('images/rewardBanner.jpg') }}" alt="Reward"
                    class="w-full md:w-[280px] h-[120px] md:h-auto lg:h-auto rounded shadow shadow-gray-300 mb-4 md:mb-0"
                    id="bannerReward">
                <div class="flex flex-col w-full md:w-auto lg:w-auto justify-between">
                    <p class="text-gray-500 text-lg font-semibold mt-2" id="namaReward">Promo Voucher Makan dan
                        Transport By
                        Grab</p>
                    <p class="text-[12px] text-gray-500" id="deskripsiReward">Commodi magnam ab sunt ipsam. Qui
                        possimus quibusdam autem officiis molestias ullam modi. Dolorum voluptate iure repellat labore
                        eligendi.</p>
                    <div class="flex flex-row md:flex-row lg:flex-row justify-between mt-2">
                        <p class="text-md font-bold mt-1 text-gray-500" id="poinReward">70 poin</p>
                        <button
                            class="bg-[#14C465] self-end md:mt-0 lg:mt-0 text-white px-6 py-2 text-sm font-bold rounded-xl hover:bg-[#10a254]">Klaim</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
    $(document).ready(function() {
        var token = localStorage.getItem('token');
        var baseUrl = 'https://skripsi-kita.my.id/apis/';
        if (!token) {
            window.location.href = '/login';
            return;
        }

        // load dashboard data
        $.ajax({
            url: baseUrl + 'profile/user/dashboard',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            success: function(response) {
                $('#reward_points').text(response.data.user_profile.reward_points || 0);
                console.log(response.data);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while loading data');
            }
        });
    });
    const btnOpenModal = document.getElementById('btnOpenModal');
    const modal = document.getElementById('myReward');
    const overlay = document.getElementById('overlay');
    const btnCloseModal = document.getElementById('btnCloseModal');

    function openModal() {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    }
    btnOpenModal.addEventListener('click', openModal);
    btnCloseModal.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
    </script>

    <style>
    @media screen and (min-width: 768px) and (max-height: 1024px) {
        #reward .flex.flex-col.md\:flex-row.lg\:flex-row {
            flex-direction: column;
        }

        #reward .flex.flex-col.w-full.md\:w-auto.lg\:w-auto.md\:ml-4.lg\:ml-4 {
            margin-top: 10px;
        }

        #reward .flex.flex-col.md\:flex-row.lg\:flex-row.justify-between.mt-1 {
            margin-top: 0;
        }
    }
    </style>
</div>
@endsection