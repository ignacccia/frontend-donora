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

    <div id="cards-container" class="mt-10 p-1 flex flex-col gap-4">
        <div>Total ajuan : <span id="total-riwayat-ajuan"></span> </div>
       {{-- card ajuan darah darurat --}}
    </div>
</div>


<script>
    const baseUrl = 'https://skripsi-kita.my.id/apis/';
    var token = localStorage.getItem('token');

    $(document).ready(function() {
        // load riwayat ajuan darah darurat
         $.ajax({
            url: baseUrl + 'blood-request',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                if (response.success) {
                    $('#total-riwayat-ajuan').text(response.data.length);

                    response.data.sort(function(a, b) {
                        return new Date(b.created_at) - new Date(a.created_at);
                    });

                    response.data.forEach(function(item) {
                        var statusButtonClass = '';
                        var statusText = '';
                        switch(item.request_status) {
                            case 'accepted':
                                statusButtonClass = 'bg-[#14C465]';
                                statusText = 'Diterima';
                                break;
                            case 'in process':
                                statusButtonClass = 'bg-[#e9d525]';
                                statusText = 'Diproses';
                                break;
                            case 'rejected':
                                statusButtonClass = 'bg-[#BA1D1D]';
                                statusText = 'Ditolak';
                                break;
                            case 'finish':
                                statusButtonClass = 'bg-[#BA1D1D]';
                                statusText = 'Selesai';
                                break;
                            default:
                                 statusButtonClass = 'bg-[#797979]';
                                statusText = 'Pending';
                        }
                        
                        var cardHtml = `
                            <div class="card-ajuan-riwayat bg-[#fbfbfb] shadow-sm shadow-gray-400 pt-4 pb-4 pl-6 pr-6 rounded-2xl cursor-pointer w-full hover:bg-[#f1f1f1]">
                                <div class="flex justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-gray-700 text-xl font-bold">${item.patient_name}</div>
                                        <div class="text-sm text-gray-500 mt-1">${item.necessity}</div>
                                        <div class="text-sm text-gray-500">${new Date(item.created_at).toLocaleDateString()}</div>
                                        <div class="text-sm text-gray-500">${item.description}</div>
                                    </div>
                                    <div class="my-auto flex gap-3">
                                        <button class="${statusButtonClass} w-20 py-2 text-center text-white text-sm shadow rounded-3xl font-bold">
                                            ${statusText}
                                        </button>
                                        <button class="text-gray-700 delete-button" data-slug="${item.slug}"><i class="fa-solid fa-trash"></i></button>                                    </div>
                                </div>
                            </div>
                        `;                        
                        $('#cards-container').append(cardHtml);
                    });
                    // Attach click event handler to the delete buttons
                        $('.delete-button').on('click', function(event) {
                            event.stopPropagation(); // Prevent the click event from bubbling up to the card
                            var slug = $(this).data('slug');
                            $.ajax({
                                url: baseUrl + 'blood-request/' + slug,
                                method: 'DELETE',
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // hapus card ajuan dari ui
                                        $(event.target).closest('.card-ajuan-riwayat').remove(); 
                                        // display ulang total ajuan - 1
                                        var totalCount = parseInt($('#total-riwayat-ajuan').text(), 10);
                                        $('#total-riwayat-ajuan').text(totalCount - 1);
                                        toastr.success('Ajuan darah berhasil dihapus!');
                                        
                                        // location.reload();
                                    } else {
                                        toastr.error(response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Cek apakah ada respons error dari server
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        // Tampilkan pesan error dari server menggunakan Toastr.js
                                        toastr.error(xhr.responseJSON.message);
                                    } else {
                                        // Tampilkan pesan error default
                                        toastr.error('Terjadi kesalahan saat menghapus ajuan. Silahkan Ulangi kembali');
                                    }
                                }
                            });
                        });
                } else {
                    console.error('Gagal memuat ajuan darah');
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal memuat ajuan darah');
            }
        });

        
    });
   
</script>
@endsection