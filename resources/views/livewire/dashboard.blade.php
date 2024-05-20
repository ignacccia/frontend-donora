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
                    <p class="">Di Surabaya Per Mei 2024</p>
                </div>
            </div>
            <p class="font-bold text-4xl ml-3 mt-2 drop-shadow-lg">2190 Kantong</p>
        </div>

        <div class="bg-white w-1/2 p-10 rounded-3xl drop-shadow-xl shadom-md text-[#be2929]" href="">
            <div class="flex">
                <lord-icon src="https://cdn.lordicon.com/wmlleaaf.json" trigger="loop" colors="primary:#be2929"
                    style="width:80px;height:80px" delay="2000">
                </lord-icon>
                <div class="ml-3 mt-3">
                    <p class="font-bold  text-2xl">Jadwal Donor</p>
                    <p class="">Di Surabaya Per Mei 2024</p>
                </div>
            </div>
            <p class="font-bold text-[#be2929] text-4xl ml-3 mt-2">11 Agenda</p>
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

            <div class="mt-3 flex font-bold">
                <p class="pr-2 border-r-2 border-[#be2929]">Dalam Proses: 1</p>
                <p class="pl-2 pr-2 border-r-2 border-[#be2929]">Disetujui: 0</p>
                <p class="pl-2">Ditolak: 1</p>
            </div>
        </div>

        <div class="bg-[#be2929] w-1/2 p-8 rounded-3xl shadow-md shadow-gray-400 text-white" href="">
            <div class="flex">
                <lord-icon src="https://cdn.lordicon.com/ncitidvz.json" trigger="loop" delay="2000"
                    colors="primary:#ffffff" style="width:130px;height:80px">
                </lord-icon>
                <div class="ml-3 mt-2">
                    <p class="font-bold text-2xl">Poin Anda</p>
                    <p class="text-[10px]">Kumpulkan Poin Lebih Banyak dengan Mengunggah Bukti Donor lalu Klaim
                        Hadiahnya!</p>
                </div>
            </div>

            <div class="flex ml-3 drop-shadow-lg mt-3 font-bold text-2xl">
                <p class="mr-2">90 Poin</p>
                <p class="pl-2 border-l-2">10 Reward Poin</p>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
            return;
        }
    });
</script>
@endsection