@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <div class="flex flex-col sm:flex-row md:flex-row lg:flex-row justify-between">
        <div class="sm:mb-2">
            <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Klaim Hadiah</p>
            <p class="text-[12px] mt-2">Kumpulkan poin sebanyak mungkin dengan melakukan donor lalu <a
                    class="text-[#3793D5] cursor-pointer hover:underline" href="/bukti-donor">unggah bukti</a> dan
                tukarkan
                dengan hadiah menarik!</p>
        </div>
        <div class="mt-2 sm:mt-0 sm:flex sm:items-center">
            <button
                class="claim-reward-btn justify-center self-end px-6 font-bold py-1 text-sm tracking-tight leading-8 text-center text-white mb-5 whitespace-nowrap bg-[#BA1D1D] rounded-xl shadow-gray-500 sm:ml-2.5 sm:mr-0 hover:bg-[#a11f1f]">
                <i class="fa-solid fa-gift mr-1"></i> Hadiah Saya
            </button>
        </div>
    </div>
    <p class="text-md font-bold text-[#172B4D]"><span class="reward-points"></span> poin reward</p>

    <div class="fixed w-full h-full items-center justify-center bg-gray-800 bg-opacity-50 z-40 hidden" id="overlay">
    </div>

    <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50 hidden" id="myReward">
        <div class="bg-white rounded-2xl p-8 shadow-md" style="width: 80vw; max-width: 800px;">
            <div class="flex justify-between mb-4">
                <!-- Konten Modal -->
                <h1 class="text-lg font-semibold">Hadiah yang Telah Saya Klaim</h1>
                <button class="close-modal-btn text-gray-500 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="overflow-y-auto min-h-full flex gap-5" id="myRewardsContainer">
                <!-- Dynamic content will be appended here -->
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10" id="allRewardsContainer">
        <!-- Dynamic content will be appended here -->
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

    // Load dashboard data
    function loadDashboardData() {
        $.ajax({
            url: baseUrl + 'profile/user/dashboard',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            success: function(response) {
                $('.reward-points').text(response.data.user_profile.reward_points || 0);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while loading data');
            }
        });
    }

    loadDashboardData();

    // Function to load rewards claimed by the user
    function loadUserRewards(callback) {
        $.ajax({
            url: baseUrl + 'reward/my',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    var claimedRewards = response.data.map(function(reward) {
                        return reward.reward.id;
                    });
                    callback(claimedRewards);
                } else {
                    console.error('Failed to load user rewards');
                    callback([]);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load user rewards');
                callback([]);
            }
        });
    }

    // Load all rewards
    function loadAllRewards(claimedRewards) {
        $.ajax({
            url: baseUrl + 'reward',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    $('#allRewardsContainer').empty();
                    response.data.forEach(function(reward) {
                        var bannerSrc = reward.banner ? reward.banner :
                            "{{ asset('images/defaultBanner.jpg') }}";
                        var isClaimed = claimedRewards.includes(reward.id);
                        if (!isClaimed) {
                            var rewardHtml = `
                                <div class="bg-[#fbfbfb] flex flex-col justify-between shadow shadow-gray-400 p-4 rounded-lg">
                                    <div>
                                        <img src="${bannerSrc}" alt="${reward.name}" class="w-full h-32 rounded shadow shadow-gray-300 mb-4">
                                        <p class="text-gray-500 text-lg font-semibold mt-2">${reward.name}</p>
                                        <p class="text-[12px] text-gray-500 mb-2">${reward.description}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-md font-bold text-gray-500">${reward.points} poin</p>
                                        <button class="claim-btn bg-[#14C465] text-white px-6 py-2 text-sm font-bold rounded-xl hover:bg-[#10a254]" data-reward-id="${reward.slug}">Klaim</button>
                                    </div>
                                </div>
                            `;
                            $('#allRewardsContainer').append(rewardHtml);
                        }
                    });
                } else {
                    console.error('Failed to load rewards');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load rewards');
            }
        });
    }

    // Load user rewards and then load all rewards
    loadUserRewards(function(claimedRewards) {
        loadAllRewards(claimedRewards);
    });

    // Claim Reward
    $(document).on('click', '.claim-btn', function() {
        var rewardSlug = $(this).data('reward-id');
        $.ajax({
            url: baseUrl + 'reward/claim',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                slug: rewardSlug
            }),
            success: function(response) {
                if (response.success) {
                    toastr.success('Hadiah berhasil diklaim!');
                    // Refresh data after successful claim
                    loadDashboardData();
                    loadUserRewards(function(claimedRewards) {
                        loadAllRewards(claimedRewards);
                        loadMyRewards(); // Load my rewards after claiming
                    });
                } else {
                    toastr.error('Gagal mengklaim hadiah: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error(
                        'Terjadi kesalahan saat menghapus ajuan. Silahkan Ulangi kembali'
                    );
                }
            }
        });
    });

    // Load my rewards
    function loadMyRewards() {
        $.ajax({
            url: baseUrl + 'reward/my',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            success: function(response) {
                $('#myRewardsContainer').empty();
                if (response.success && response.data.length > 0) {
                    response.data.forEach(function(myReward) {
                        var rewardHtml = `
                        <div class="bg-[#fbfbfb] flex flex-col justify-between shadow shadow-gray-400 p-4 rounded-lg mb-4 w-1/3">
                            <div>
                                <img src="${myReward.reward.banner}" alt="${myReward.reward.name}" class="w-full h-32 rounded shadow shadow-gray-300 mb-4">
                                <p class="text-gray-500 text-lg font-semibold mt-2">${myReward.reward.name}</p>
                                <p class="text-[12px] text-gray-500 mb-2">${myReward.reward.description}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-md font-bold text-gray-500">${myReward.reward.points} poin</p>
                                <div class="claim-btn bg-gray-400 text-white px-4 py-1 text-[12px] font-bold rounded-lg cursor-default">Telah Diklaim</div>
                            </div>
                        </div>
                    `;
                        $('#myRewardsContainer').append(rewardHtml);
                    });
                } else {
                    $('#myRewardsContainer').html('<p>Tidak ada hadiah yang diklaim.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load my rewards:', error);
                $('#myRewardsContainer').html('<p>Gagal memuat hadiah yang diklaim.</p>');
            }
        });
    }

    // Open Modal
    $('.claim-reward-btn').click(function() {
        $('#myReward').removeClass('hidden');
        $('#overlay').removeClass('hidden');
        loadMyRewards(); // Load my rewards when modal opens
    });

    // Close Modal
    $(document).on('click', '#overlay', function() {
        $('#myReward').addClass('hidden');
        $('#overlay').addClass('hidden');
    });

    $(document).on('click', '.close-modal-btn', function() {
        $('#myReward').addClass('hidden');
        $('#overlay').addClass('hidden');
    });
});
</script>

@endsection