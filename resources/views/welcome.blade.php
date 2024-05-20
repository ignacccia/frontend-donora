<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DONORA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')


</head>

<body class="flex">

    <div class="fixed top-0 left-0 w-full h-full bg-gradient-to-b from-red-700 via-red-50 to-transparent"></div>
    <aside
        class="min-w-[250px] flex flex-col bg-white rounded-[12px]  ml-3 mb-auto shadow-lg text-[12px] sticky top-[15px]">
        <div class="flex justify-center">
            <img class="max-w-[150px] max-h-[30px] mt-4" src="{{ asset('images/logo_donora.svg') }}" alt="Donora">
        </div>

        <div class="flex justify-center">
            <div class="w-4/5 border border-gray-100 mt-4 "></div>
        </div>

        <div class="flex flex-col ml-5 mt-5 mb-5 mr-5 gap-2">
            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-5 ml-2 mr-2" wire:click="navigateToDashboard">
                    <i class="fa-solid fa-house text-[#D80032] mt-0.5"></i>
                    <p>Dashboard</p>
                </div>
            </div>

            <div class="font-roboto text-[#8591A4] mt-4 ml-2 ">
                <b>MENU</b>
            </div>

            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-6 ml-2 mr-2" wire:click="navigateToProfile">
                    <i class="fas fa-user text-[#D80032] mt-1"></i>
                    <p>Akun</p>
                </div>
            </div>

            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-6 ml-2 mr-2" wire:click="navigateToBloodStock">
                    <i class="fa-solid fa-droplet text-[#D80032] mt-1"></i>
                    <p>Stok Darah</p>
                </div>
            </div>

            <div class="text-black font-bold bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px]">
                <div class="flex gap-5 ml-2 mr-2" wire:click="navigateToBloodRequest">
                    <i class="fa-solid fa-hand-holding-droplet text-[#D80032] mt-1"></i>
                    <p>Ajuan Permintaan Darah</p>
                </div>
            </div>

            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-6 ml-2 mr-2" wire:click="navigateToDonorSchedule">
                    <i class="fa-solid fa-calendar-days text-[#D80032] mt-1"></i>
                    <p>Jadwal Donor</p>
                </div>
            </div>

            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-5 ml-2 mr-2" wire:click="navigateToDonorHistory">
                    <i class="fa-solid fa-clock-rotate-left text-[#D80032] mt-1"></i>
                    <p>Riwayat Donor</p>
                </div>
            </div>


            <div class="font-roboto text-[#8591A4] mt-4 ml-2 ">
                <b>POIN</b>
            </div>

            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-5 ml-2 mr-2" wire:click="navigateToLeaderboard">
                    <i class="fa-solid fa-trophy text-[#D80032] mt-1"></i>
                    <p>Leaderboard Poin</p>
                </div>
            </div>

            <div class="hover:bg-slate-100 pt-2 pb-2 pl-1 pr-1 rounded-[8px] transition-all">
                <div class="flex gap-6 ml-2 mr-2" wire:click="navigateToClaimPrize">
                    <i class="fa-solid fa-droplet text-[#D80032] mt-1"></i>
                    <p>Klaim Hadiah</p>
                </div>
            </div>

        </div>

        <button class="bg-[#d42c2c] text-white ml-4 mr-4 p-3 mb-4 rounded-[12px] drop-shadow-2xl hover:bg-[#a11f1f]"
            wire:click="logout">
            <i class="fa-solid fa-right-from-bracket text-white mr-1"></i>
            <b class="">Keluar</b>
        </button>
    </aside>


    <div class="flex flex-col mt-4 ml-6 ">
        <div class="flex flex-row justify-between ">
            <div class="flex flex-col drop-shadow-lg ">
                <div class="flex">
                    <p class="text-[11px] text-[#B8B8B8]">Menu / </p>
                    <p class="text-[11px] text-white">&nbsp;Ajuan Permintaan Darah</p>
                </div>
                <p class="text-[14px] text-white drop-shadow-lg"><b>Ajuan Permintaan Darah</b></p>
            </div>
            <!-- <div class="flex">
                Ajuan
            </div> -->
        </div>

        <div class="bg-white rounded-[12px] pl-6 pt-4 pr-6 pb-8 mt-6 flex flex-col shadow-lg w-[950px] mb-10 z-10">
            <p class="font-semibold text-[20px] text-[#172B4D]">Form Ajuan Permintaan Darah</p>
            <p class="text-xs text-[#172B4D]">Pastikan terlebih dahulu darah memang tidak ada di
                <span class="text-[#3793D5]" style="text-decoration: underline;" href="">stok</span>
                dan isi form dengan lengkap
            </p>

            <div class="flex flex-col text-[12px] gap-6 mt-10">
                <div class="flex">
                    <p class="font-bold mt-2">Nama Lengkap</p>
                    <input type="text" class="bg-[#E2E8F0] flex-grow ml-[80px] p-2 rounded-[8px]"
                        placeholder="Nama Lengkap">
                </div>
                <div class="flex">
                    <p class="font-bold mt-2">Nomor Handphone</p>
                    <input type="text" class="bg-[#E2E8F0] flex-grow ml-[56px] p-2 rounded-[8px]"
                        placeholder="Nomor Handphone">
                </div>
                <div class="flex">
                    <div class="flex flex-grow">
                        <p class="font-bold mt-2">Provinsi</p>
                        <select class="bg-[#E2E8F0] flex-grow p-2 rounded-[8px] ml-[123px]">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            <option value="jawa-timur">Jawa Timur</option>
                            <option value="jawa-tengah">Jawa Tengah</option>
                            <option value="bali">Bali</option>
                        </select>
                    </div>

                    <div class="flex flex-grow ">
                        <p class="font-bold mt-2 ml-6 mr-6 ">Kota/Kabupaten</p>
                        <select class="bg-[#E2E8F0] flex-grow p-2 rounded-[8px]">
                            <option value="" disabled selected>Pilih Kabupaten</option>
                        </select>
                    </div>
                </div>
                <div class="flex">
                    <p class="font-bold mt-2">Alamat Lengkap</p>
                    <input type="text" class="bg-[#E2E8F0] flex-grow ml-[74px] p-2 rounded-[8px]"
                        placeholder="Alamat Lengkap">
                </div>

                <div class="flex">
                    <div class="flex flex-grow">
                        <p class="font-bold mt-2">Golongan Darah</p>
                        <select class="bg-[#E2E8F0] flex-grow p-2 rounded-[8px] ml-[76px]">
                            <option value="" disabled selected>Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    <div class="flex flex-grow ">
                        <p class="font-bold mt-2 ml-6 mr-6 ">Produk Darah</p>
                        <select class="bg-[#E2E8F0] flex-grow p-2  rounded-[8px]">
                            <option value="" disabled selected>Pilih Produk Darah</option>
                            <option value="Whole Blood">Whole Blood</option>
                            <option value="Packed Red Cells">Packed Red Cells</option>
                            <option value="Platelets">Platelets</option>
                            <option value="Fresh Frozen Plasma">Fresh Frozen Plasma</option>
                        </select>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex flex-grow">
                        <p class="font-bold mt-2">Kepentingan</p>
                        <input type="text" class="bg-[#E2E8F0] ml-24 flex-grow p-2 rounded-[8px]"
                            placeholder="Kepentingan">
                    </div>
                </div>

                <div class="flex">
                    <div class="flex flex-grow">
                        <p class="font-bold mt-2">Deskripsi</p>
                        <input type="text" class="bg-[#E2E8F0] ml-[117px] flex-grow p-2 rounded-[8px]"
                            placeholder="Deskripsi">
                    </div>
                </div>
                <button
                    class="justify-center self-end px-8 py-1 mt-4 text-md font-bold tracking-tight leading-8 text-center text-white whitespace-nowrap bg-[#BA1D1D] rounded-[8px] drop-shadow-lg max-md:px-5 max-md:mr-2.5">
                    KIRIM
                </button>
            </div>
        </div>
    </div>

</body>

</html>