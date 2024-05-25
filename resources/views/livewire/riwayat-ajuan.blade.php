@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <div class="flex justify-between">
        <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Riwayat Ajuan Permintaan Darah</p>
        <div class="my-auto">
            <a href="/ajuan-darah">
                <button class="flex bg-[#d42c2c] text-white text-sm px-2 py-2 rounded-lg hover:bg-[#a11f1f]"> <i
                        class="fa-solid fa-pen-nib mt-1 mr-2"></i>
                    <p>Tambah Ajuan</p>
                </button>
            </a>
        </div>
    </div>

    <div class="mt-10 p-1 flex flex-col gap-4">
        <div id=""
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <div class="text-gray-700 text-xl font-bold">Nama Pasien 1</div>
                    <div class="text-sm text-gray-500 mt-1">Kepentingan Illness</div>
                    <div class="text-sm text-gray-500">2024-24-16</div>
                    <div class="text-sm text-gray-500">Deskripsi ajuan donor darah darurat</div>
                </div>
                <div class="my-auto">
                    <button class="bg-[#14C465] w-20 py-2 text-center text-white text-sm shadow rounded-3xl font-bold">
                        Diterima</button>
                </div>
            </div>
        </div>

        <div id=""
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <div class="text-gray-700 text-xl font-bold">Nama Pasien 1</div>
                    <div class="text-sm text-gray-500 mt-1">Kepentingan Illness</div>
                    <div class="text-sm text-gray-500">2024-24-16</div>
                    <div class="text-sm text-gray-500">Deskripsi ajuan donor darah darurat</div>
                </div>
                <div class="my-auto">
                    <button class="bg-[#e9d525] w-20 py-2 text-center text-white text-sm shadow rounded-3xl font-bold">
                        Diproses</button>
                </div>
            </div>
        </div>

        <div id=""
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <div class="text-gray-700 text-xl font-bold">Nama Pasien 1</div>
                    <div class="text-sm text-gray-500 mt-1">Kepentingan Illness</div>
                    <div class="text-sm text-gray-500">2024-24-16</div>
                    <div class="text-sm text-gray-500">Deskripsi ajuan donor darah darurat</div>
                </div>
                <div class="my-auto">
                    <button class="bg-[#BA1D1D] w-20 py-2 text-center text-white text-sm shadow rounded-3xl font-bold">
                        Ditolak</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection