<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Htttp\Livewire\AjuanDarah;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('livewire.test');
});
Route::get('/daftar', function () {
    return view('livewire.daftar');
});
Route::get('/masuk', function () {
    return view('livewire.masuk');
})->name('login');
Route::get('/stok-darah', function () {
    $currentPage = 'stok-darah';
    return view('livewire.stok-darah', compact('currentPage'));
});
Route::get('/ajuan-darah', function () {
    $currentPage = 'ajuan-darah';
    return view('livewire.ajuan-darah', compact('currentPage'));
});
Route::get('/dashboard', function () {
    $currentPage = 'dashboard';
    return view('livewire.dashboard', compact('currentPage'));
});
Route::get('/klaim-hadiah', function () {
    $currentPage = 'klaim-hadiah';
    return view('livewire.klaim-hadiah', compact('currentPage'));
});
Route::get('/reset-pass', function (Request $request) {
    $email = $request->query('email');
    return view('livewire.reset-pass', compact('email'));
});

Route::get('/otp', function (Request $request) {
    $email = $request->query('email');
    $otp = $request->query('otp');
    if (!$email) {
        return redirect('/reset-pass');
    }
    return view('livewire.otp', compact('email'));
});
Route::get('/konfirm-pass', function (Request $request) {
    $email = $request->query('email');
    $otp = $request->query('otp');
    if (!$email || !$otp) {
        return redirect('/reset-pass');
    }
    return view('livewire.konfirm-pass', compact('email', 'otp'));
});
Route::get('/notifikasi', function () {
    $currentPage = 'notifikasi';
    return view('livewire.notifikasi', compact('currentPage'));
});
Route::get('/jadwal-donor', function () {
    $currentPage = 'jadwal-donor';
    return view('livewire.jadwal-donor', compact('currentPage'));
});
Route::get('/akun', function () {
    $currentPage = 'akun';
    return view('livewire.akun', compact('currentPage'));
});

Route::get('/poin', function () {
    $currentPage = 'poin';
    return view('livewire.poin', compact('currentPage'));
});
Route::get('/bukti-donor', function () {
    $currentPage = 'bukti-donor';
    return view('livewire.bukti-donor', compact('currentPage'));
});
Route::get('/riwayat-ajuan', function () {
    $currentPage = 'riwayat-ajuan';
    return view('livewire.riwayat-ajuan', compact('currentPage'));
});