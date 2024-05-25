@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <div class="flex justify-between">
        <div class="flex flex-col">
            <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Bukti Donor</p>
            <p class="text-[12px] mt-2">Kumpulkan poin sebanyak mungkin dengan melakukan donor lalu unggah bukti dan
                <a class="text-[#3793D5] cursor-pointer hover:underline" href="/klaim-hadiah">tukarkan
                    dengan hadiah menarik!</a>
            </p>
        </div>
        <div class="my-auto">
            <a href="/ajuan-darah">
                <button class="flex bg-[#d42c2c] text-white text-sm px-2 py-2 rounded-lg hover:bg-[#a11f1f]"> <i
                        class="fa-solid fa-arrow-up-from-bracket mt-1 mr-2"></i>
                    <p>Unggah Bukti</p>
                </button>
            </a>
        </div>
    </div>

</div>
@endsection