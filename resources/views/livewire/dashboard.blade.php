<!-- resources/views/livewire/ajuan-darah.blade.php -->
@extends('livewire.layout')

@section('content')
<div class="flex flex-col z-10 my-auto">
    <div class="flex gap-16 justify-between">
        <div class="bg-[#be2929] w-1/2 p-8 rounded-3xl shadow-md shadow-gray-400 text-white" href="">
            <div class="flex">
                <lord-icon src="https://cdn.lordicon.com/ulnswmkk.json" trigger="loop" delay="2000"
                    colors="primary:#ffffff" style="width:80px;height:80px">
                </lord-icon>
                <div class="ml-3 mt-3">
                    <p class="font-bold text-2xl">Stok Darah</p>
                    <p class="">Di <span class="regency_name"></span> Per
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM YYYY') }}</p>
                </div>
            </div>
            <p class="font-bold text-4xl ml-3 mt-2 drop-shadow-lg"> <span id="blood_stocks"></span> Kantong</p>
        </div>

        <div class="bg-white w-1/2 p-10 rounded-3xl drop-shadow-xl shadom-md text-[#be2929]" href="">
            <div class="flex">
                <lord-icon src="https://cdn.lordicon.com/wmlleaaf.json" trigger="loop" colors="primary:#be2929"
                    style="width:80px;height:80px" delay="2000">
                </lord-icon>
                <div class="ml-3 mt-3">
                    <p class="font-bold  text-2xl">Jadwal Donor</p>
                    <p class="">Di <span class="regency_name"></span> Per
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM YYYY') }}</p>
                </div>
            </div>
            <p class="font-bold text-[#be2929] text-4xl ml-3 mt-2"><span id="donor_schedules"></span> Agenda</p>
        </div>
    </div>

    <div class="flex gap-16 justify-between mt-10">
        <div class="bg-white w-1/2 p-10 rounded-3xl drop-shadow-xl shadom-md text-[#be2929]" href="">
            <div class="flex">
                <lord-icon src="https://cdn.lordicon.com/iazmohzf.json" trigger="loop" delay="2000"
                    colors="primary:#be2929" style="width:80px;height:80px">
                </lord-icon>
                <div class="ml-3 mt-3">
                    <p class="font-bold text-2xl">Ajuan Anda</p>
                    <p class="text-[12px]">Status Terkini Ajuan Permintaan Darah anda </p>
                </div>
            </div>

            <div class="mt-4 flex flex-col text-md items-center gap-2">
                <div class="flex">
                    <p class="pr-2">Pending: <span id="blood_request_pending" class="font-bold"></span></p>
                    <p class="pl-2 pr-2">Disetujui: <span id="blood_request_accepted" class="font-bold"></span></p>
                    <p class="pl-2 pr-2">Ditolak: <span id="blood_request_rejected" class="font-bold"></span></p>
                </div>
                <div class="flex">
                    <p class="pr-2">Dalam Proses: <span id="blood_request_in_process" class="font-bold"></span></p>
                    <p class="pr-2">Selesai: <span id="blood_request_finish" class="font-bold"></span></p>
                </div>
            </div>
        </div>

        <div class="bg-[#be2929] w-1/2 p-8 rounded-3xl shadow-md shadow-gray-400 text-white" href="">
            <div class="flex">
                <lord-icon src="https://cdn.lordicon.com/ncitidvz.json" trigger="loop" delay="2000"
                    colors="primary:#ffffff" style="width:130px;height:80px">
                </lord-icon>
                <div class="ml-3 mt-2">
                    <p class= "text-2xl font-bold">Poin Anda</p>
                    <p class="text-[10px]">Kumpulkan Poin Lebih Banyak dengan Mengunggah Bukti Donor lalu Klaim
                        Hadiahnya!</p>
                </div>
            </div>

            <div class="flex ml-3 drop-shadow-lg mt-3 font-bold">
                <p class="mr-2 font-sm pr-6"><span id="donor_points" class="text-3xl"></span> <br/>Poin Donor</p>
                <p class="pl-6 border-l-2 font-sm"><span id="reward_points" class="text-3xl"></span> <br/>Poin Reward</p>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $('#blood_stocks').text(response.data.blood_stocks || 0);
            $('#donor_schedules').text(response.data.donor_schedules || 0);
            $('#blood_request_accepted').text(response.data.blood_request_accepted || 0);
            $('#blood_request_pending').text(response.data.blood_request_pending || 0);
            $('#blood_request_rejected').text(response.data.blood_request_rejected || 0);
            $('#blood_request_in_process').text(response.data.blood_request_in_process || 0);
            $('#blood_request_finish').text(response.data.blood_request_finish || 0);
            $('#reward_points').text(response.data.user_profile.reward_points || 0);
            $('#donor_points').text(response.data.user_profile.donor_points || 0);
            $('.regency_name').text(response.data.regency_name || 0);
            console.log(response.data);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while loading data');
        }
    });
});
</script>
@endsection