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
        <div id="card-1" class="card bg-[#d42c2c] shadow-md shadow-gray-400 rounded-full cursor-pointer w-full">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="font-bold shadow-lg text-[40px] bg-white text-[#d42c2c] rounded-full px-5">1</div>
                    <div class="flex ml-4 items-center gap-2">
                        <img id="profilePictureInfo-1" src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                            class="w-[40px] h-[40px] rounded-full shadow">
                        <div id="username-1" class="text-white text-xl">Username</div>
                    </div>
                </div>
                <div id="points-1" class="text-white text-2xl font-bold mr-6 my-auto">90 Poin</div>
            </div>
        </div>
        <div id="card-2" class="card bg-[#d42c2c] shadow-md shadow-gray-400 rounded-full cursor-pointer w-full">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="font-bold shadow-lg text-[35px] bg-white text-[#d42c2c] rounded-full px-4">2</div>
                    <div class="flex ml-7 items-center gap-2">
                        <img id="profilePictureInfo-2" src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                            class="w-[35px] h-[35px] rounded-full shadow">
                        <div id="username-2" class="text-white text-lg">Username</div>
                    </div>
                </div>
                <div id="points-2" class="text-white text-xl font-bold mr-6 my-auto">90 Poin</div>
            </div>
        </div>
        <div id="card-3" class="card bg-[#d42c2c] shadow-md shadow-gray-400 rounded-full cursor-pointer w-full">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="font-bold shadow-lg text-[30px] bg-white text-[#d42c2c] rounded-full px-3">3</div>
                    <div class="flex ml-10 items-center gap-2">
                        <img id="profilePictureInfo-3" src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                            class="w-[30px] h-[30px] rounded-full shadow">
                        <div id="username-3" class="text-white text-md">Username</div>
                    </div>
                </div>
                <div id="points-3" class="text-white text-lg font-bold mr-6 my-auto">90 Poin</div>
            </div>
        </div>
        <div id="card-4" class="card bg-[#d42c2c] shadow-md shadow-gray-400 rounded-full cursor-pointer w-full">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="font-bold shadow-lg text-[25px] bg-white text-[#d42c2c] rounded-full px-3">4</div>
                    <div class="flex ml-[45px] items-center gap-2">
                        <img id="profilePictureInfo-4" src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                            class="w-[25px] h-[25px] rounded-full shadow">
                        <div id="username-4" class="text-white text-sm">Username</div>
                    </div>
                </div>
                <div id="points-4" class="text-white text-md font-bold mr-6 my-auto">90 Poin</div>
            </div>
        </div>
        <div id="card-5" class="card bg-[#d42c2c] shadow-md shadow-gray-400 rounded-full cursor-pointer w-full">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="font-bold shadow-lg text-[20px] bg-white text-[#d42c2c] rounded-full px-2.5">5</div>
                    <div class="flex ml-[52px] items-center gap-2">
                        <img id="profilePictureInfo-5" src="{{ asset('images/avatar_example.svg') }}" alt="Foto Profil"
                            class="w-[20px] h-[20px] rounded-full shadow">
                        <div id="username-5" class="text-white text-[12px]">Username</div>
                    </div>
                </div>
                <div id="points-5" class="text-white text-[12px] font-bold mr-6 my-auto">90 Poin</div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 3s ease, transform 3s ease;
}

.card.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const baseUrl = 'https://skripsi-kita.my.id/apis/';
var token = localStorage.getItem('token');

$(document).ready(function() {
    $.ajax({
        url: baseUrl + 'profile/user/get-all-by-donor-points',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function(response) {
            if (response.success) {
                // Sort data based on donor_points in descending order
                const users = response.data.sort((a, b) => b.donor_points - a.donor_points);

                // Update card content for the top 5 users
                users.slice(0, 5).forEach((user, index) => {
                    setTimeout(() => {
                        $(`#username-${index + 1}`).text(user.username);
                        $(`#points-${index + 1}`).text(`${user.donor_points} Poin`);
                        $(`#profilePictureInfo-${index + 1}`).attr('src', user.profile_picture ? user.profile_picture : '{{ asset('images/avatar_example.svg') }}');
                        $(`#card-${index + 1}`).addClass('show');
                    }, 500 * index); // Delay each card appearance by 500 milliseconds
                });
            }
        },
        error: function(error) {
            console.error('Kesalahan saat menampilkan leaderboard:', error);
        }
    });
});
</script>

@endsection
