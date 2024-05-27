@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-md z-10 h-full">
    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Leaderboard Poin</p>
    <p class="text-[12px] mt-2">Kumpulkan poin sebanyak mungkin dengan melakukan donor lalu <a
            class="text-[#3793D5] cursor-pointer hover:underline" href="/bukti-donor">unggah bukti</a> dan
        <a class="text-[#3793D5] cursor-pointer hover:underline" href="/klaim-hadiah">tukarkan</a>
        dengan hadiah menarik!
    </p>
    <div id="leaderboard" class="mt-10 flex flex-col gap-8">
        <!-- Cards will be dynamically inserted here by the AJAX call -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const baseUrl = 'https://skripsi-kita.my.id/apis/';
var token = localStorage.getItem('token');

$(document).ready(function() {
    let currentUserID;

    // Get the current user's profile
    $.ajax({
        url: baseUrl + 'profile/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function(response) {
            if (response.success) {
                currentUserID = response.data.id;
                loadLeaderboard(currentUserID);
            }
        },
        error: function(error) {
            console.error('Kesalahan saat mengambil profil pengguna:', error);
        }
    });

    function determineLevel(points) {
        if (points >= 0 && points <= 20) return 'Relawan Darah';
        if (points >= 21 && points <= 40) return 'Ksatria Darah';
        if (points >= 41 && points <= 60) return 'Kapten Darah';
        if (points >= 61 && points <= 80) return 'Jenderal Darah';
        if (points >= 81 && points <= 100) return 'Raja Darah';
        if (points >= 101 && points <= 120) return 'Dewa Darah';
        return 'Tidak Diketahui'; // Fallback for unexpected points
    }

    function loadLeaderboard(currentUserID) {
        $.ajax({
            url: baseUrl + 'profile/user/get-all-by-donor-points',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                if (response.success) {
                    const users = response.data.sort((a, b) => b.donor_points - a.donor_points);
                    const leaderboardContainer = $('#leaderboard');

                    // Clear existing leaderboard content
                    leaderboardContainer.empty();

                    // Loop through sorted users and create leaderboard cards
                    users.forEach((user, index) => {
                        const profilePicture = user.profile_picture || "{{ asset('images/avatar_example.svg') }}";
                        const position = index + 1;
                        const isCurrentUser = user.id === currentUserID;
                        const cardBackground = isCurrentUser ? 'bg-[#b71c1c]' : 'bg-[#d42c2c]';
                        const level = determineLevel(user.donor_points);

                        let card = '';
                        if (position <= 5) {
                            // Top 5 cards
                            card = `
                                <div class="card-leader-board ${cardBackground} shadow-md shadow-gray-400 rounded-full cursor-pointer w-full transition-transform duration-500 ${isCurrentUser ? 'focused-card' : ''}" id="user-${user.id}">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center font-bold ${position === 1 ? 'text-[40px]' : position === 2 ? 'text-[35px]' : position === 3 ? 'text-[30px]' : position === 4 ? 'text-[25px]' : 'text-[20px]'} bg-white text-[#d42c2c] rounded-full px-${position === 1 ? '5' : position === 2 ? '4' : position === 3 ? '3' : '2.5'}">${position}</div>
                                            <div class="flex ml-${position === 1 ? '4' : position === 2 ? '7' : position === 3 ? '10' : position === 4 ? '[45px]' : '[52px]'} items-center gap-2">
                                                <div class="w-[${position === 1 ? '40' : position === 2 ? '35' : position === 3 ? '30' : position === 4 ? '25' : '20'}px] h-[${position === 1 ? '40' : position === 2 ? '35' : position === 3 ? '30' : position === 4 ? '25' : '20'}px] rounded-full overflow-hidden shadow">
                                                    <img src="${profilePicture}" alt="Foto Profil" class="object-cover w-full h-full">
                                                </div>
                                                <div class="text-white ${position === 1 ? 'text-xl' : position === 2 ? 'text-lg' : position === 3 ? 'text-md' : position === 4 ? 'text-sm' : 'text-[12px]'}">${user.username}</div>
                                                <div class="text-white text-sm">(${level})</div>
                                            </div>
                                        </div>
                                        <div class="text-white ${position === 1 ? 'text-2xl' : position === 2 ? 'text-xl' : position === 3 ? 'text-lg' : position === 4 ? 'text-md' : 'text-[12px]'} font-bold mr-6 my-auto">${user.donor_points ?? 0} Poin</div>
                                    </div>
                                </div>
                            `;
                        } else {
                            // Cards for positions 6 and below, same as position 5
                            card = `
                                <div class="card-leader-board ${cardBackground} shadow-md shadow-gray-400 rounded-full cursor-pointer w-full transition-transform duration-500 ${isCurrentUser ? 'focused-card' : ''}" id="user-${user.id}">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center font-bold text-[20px] bg-white text-[#d42c2c] rounded-full px-2.5">${position}</div>
                                            <div class="flex ml-[52px] items-center gap-2">
                                                <div class="w-[20px] h-[20px] rounded-full overflow-hidden shadow">
                                                    <img src="${profilePicture}" alt="Foto Profil" class="object-cover w-full h-full">
                                                </div>
                                                <div class="text-white text-[12px]">${user.username}</div>
                                                <div class="text-white text-sm">(${level})</div>
                                            </div>
                                        </div>
                                        <div class="text-white text-[12px] font-bold mr-6 my-auto">${user.donor_points ?? 0} Poin</div>
                                    </div>
                                </div>
                            `;
                        }

                        // Append card to leaderboard container
                        leaderboardContainer.append(card);
                    });

                    // Add animation class to all cards
                    $('.card-leader-board').each(function(index) {
                        $(this).css('opacity', '0');
                        $(this).delay(200 * index).animate({ opacity: 1 }, 500);
                    });

                    // Scroll to current user's card if it's the current user
                    if ($('.focused-card').length) {
                        const offsetTop = $('.focused-card').offset().top;
                        const padding = $(window).height() / 2 - $('.focused-card').height() / 2;
                        $('html, body').animate({
                            scrollTop: offsetTop - padding
                        }, 1000, function() {
                            // Add zoom animation to current user's card
                            $('.focused-card').addClass('transform scale-110').delay(2000).queue(function() {
                                $(this).removeClass('transform scale-110').dequeue();
                            });
                        });
                    }
                }
            },
            error: function(error) {
                console.error('Kesalahan saat menampilkan leaderboard:', error);
            }
        });
    }
});
</script>
@endsection
