@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">

    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Notifikasi</p>
    <p class="text-sm mt-2">Tekan notifikasi untuk melihat detail informasi dan menjadi pendonor darurat</p>

    <div class="mt-10 p-1 flex flex-col gap-4">
        <div
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <div class="text-gray-700 text-lg font-semibold">Ajuanmu telah diterima!</div>
                    <div class="text-sm text-gray-500">2024-24-16</div>
                    <div class="bg-[#14C465] w-20 text-center text-white text-sm p-1 shadow rounded-3xl font-bold">
                        General</div>
                </div>
                <div class="my-auto text-gray-700 "><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>

        <div
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <div class="text-gray-700 text-lg font-semibold">Ajuanmu telah diterima!</div>
                    <div class="text-sm text-gray-500">2024-24-16</div>
                    <div class="bg-[#e9d525] w-20 text-center text-white text-sm p-1 shadow rounded-3xl font-bold">
                        Penting</div>
                </div>
                <div class="my-auto text-gray-700 "><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>

        <div
            class="bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <div class="text-gray-700 text-lg font-semibold">Dibutuhkan Segera + B Platelet Concentrate di Surabaya</div>
                    <div class="text-sm text-gray-500">2024-24-16</div>
                    <div class="bg-[#BA1D1D] w-20 text-center text-white font-bold text-sm p-1 shadow rounded-3xl">
                        Darurat</div>
                </div>
                <div class="my-auto text-gray-700 "><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>
        
    </div>
</div>
@endsection