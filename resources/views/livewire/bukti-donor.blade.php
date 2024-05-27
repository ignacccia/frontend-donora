@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <div class="flex justify-between">
        <div class="flex flex-col">
            <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Bukti Donor</p>
            <p class="text-[12px] mt-2">Kumpulkan poin sebanyak mungkin dengan melakukan donor lalu unggah bukti dan
                <a class="text-[#3793D5] cursor-pointer hover:underline" href="/klaim-hadiah">tukarkan
                </a>dengan hadiah menarik!
            </p>
        </div>
        <div class="my-auto">
            <button id="openModal" class="flex bg-[#d42c2c] text-white text-sm px-2 py-2 rounded-lg hover:bg-[#a11f1f]">
                <i class="fa-solid fa-arrow-up-from-bracket mt-1 mr-2"></i>
                <p>Unggah Bukti</p>
            </button>
        </div>
    </div>

    <div id="cards-container" class="mt-10 p-1 flex flex-col gap-4">
        <div>Total ajuan : <span id="total-riwayat-ajuan"></span></div>
        {{-- card ajuan riwayat donor --}}
    </div>

    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md relative overflow-hidden transform transition-all duration-300 ease-in-out">
            <button id="closeModal"
                class="absolute mt-6 mr-2 top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold mb-4 text-gray-800">Unggah Bukti Donor</h2>
            <form id="form-ajuan-bukti-donor" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="tanggal_donor" class="block text-sm font-medium text-gray-700">Tanggal Donor:</label>
                    <input type="date" name="tanggal_donor" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#d42c2c] focus:border-[#d42c2c]">
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Keterangan:</label>
                    <input type="text" name="deskripsi" required placeholder="input deskripsi"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#d42c2c] focus:border-[#d42c2c]">
                </div>
                <div class="mb-4">
                    <label for="bukti_donor" class="block text-sm font-medium text-gray-700">Bukti Donor:</label>
                    <input type="file" name="bukti_donor" accept="image/*,.pdf" required onchange="previewImage(event)"
                        class="mt-1 block w-full text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#d42c2c] focus:border-[#d42c2c]">
                    {{-- <div class="mt-4">
                        <img id="imagePreview" src="#" alt="Pratinjau Gambar"
                            class="hidden w-20 h-20 rounded-md shadow-md">
                    </div> --}}
                </div>
                <button type="submit"
                    class="bg-[#d42c2c] mt-4 font-sm text-white px-4 py-2 rounded-lg hover:bg-[#a11f1f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d42c2c] transition-colors duration-200">
                    Unggah
                </button>
            </form>
        </div>
    </div>

</div>

<script>
const baseUrl = 'https://skripsi-kita.my.id/apis/';
var token = localStorage.getItem('token');
$(document).ready(function() {
    // load data donor history
    $.ajax({
        url: baseUrl + 'donor-history',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function(response) {
            if (response.success) {
                // Menampilkan total ajuan
                $('#total-riwayat-ajuan').text(response.data.length);

                // sorting data terbaru
                response.data.sort(function(a, b) {
                    return new Date(b.created_at) - new Date(a.created_at);
                });

                // Loop melalui setiap item dalam data
                response.data.forEach(function(item) {
                    var statusButtonClass = '';
                    var statusText = '';
                    switch (item.status_claim) {
                        case 'accepted':
                            statusButtonClass = 'bg-[#14C465]';
                            statusText = 'Diterima';
                            break;
                        case 'pending':
                            statusButtonClass = 'bg-[#797979]';
                            statusText = 'Pending';
                            break;
                        case 'rejected':
                            statusButtonClass = 'bg-[#BA1D1D]';
                            statusText = 'Ditolak';
                            break;
                        default:
                            statusButtonClass = 'bg-[#797979]';
                            statusText = 'Diproses';
                    }

                    var receiptLink = item.receipt ?
                        `<i class="fa-solid fa-link"></i><a href="${item.receipt}" target="_blank" rel="noopener noreferrer">  ${item.slug}</a>` :
                        '';

                    var cardHtml = `
                            <div class="card-ajuan-riwayat-donor bg-[#fbfbfb] shadow-sm shadow-gray-400 p-6 rounded-2xl w-full">
                                <div class="flex justify-between">
                                    <div class="flex gap-4 items-center">
                                        <div class="flex flex-col gap-1">
                                            <div class="text-lg font-semibold pt-1 text-gray-700 ">${formatDate(item.donor_date)}</div>
                                            <div class="text-sm text-red-500 hover:underline hover:text-red-700">${receiptLink}</div>
                                            <div class="text-sm text-gray-500">${item.description || 'Deskripsi tidak tersedia'}</div>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <button class="${statusButtonClass} w-20 py-2 text-center text-white text-sm shadow rounded-3xl font-bold">
                                            ${statusText}
                                        </button>
                                        <button class="text-gray-700 delete-button" data-slug="${item.slug}"><i class="fa-solid fa-trash"></i></button>   
                                    </div>
                                </div>
                            </div>
                        `;

                    $('#cards-container').append(cardHtml);
                });

                // Attach click event handler to the delete buttons
                $('.delete-button').on('click', function(event) {
                    event
                .stopPropagation(); // Prevent the click event from bubbling up to the card
                    var slug = $(this).data('slug');
                    $.ajax({
                        url: baseUrl + 'donor-history/' + slug,
                        method: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        success: function(response) {
                            if (response.success) {
                                // hapus card ajuan dari ui
                                $(event.target).closest(
                                    '.card-ajuan-riwayat-donor').remove();
                                // display ulang total ajuan - 1
                                var totalCount = parseInt($(
                                    '#total-riwayat-ajuan').text(), 10);
                                $('#total-riwayat-ajuan').text(totalCount - 1);
                                toastr.success('Berhasil dihapus!');

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
                                toastr.error(
                                    'Terjadi kesalahan saat menghapus ajuan. Silahkan Ulangi kembali'
                                    );
                            }
                        }
                    });
                });

            } else {
                console.error('Failed to load donor history data');
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to load donor history data');
        }
    });

    // Function to handle form submission for uploading donor proof
    $('#form-ajuan-bukti-donor').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        var donorDate = $('input[name="tanggal_donor"]').val();
        var description = $('input[name="deskripsi"]').val();
        var receiptFile = $('input[name="bukti_donor"]')[0].files[0];

        // Create a FormData object and append the file
        var formData = new FormData();
        formData.append('donor_date', donorDate);
        formData.append('description', description);
        formData.append('receipt', receiptFile);

        // Make AJAX request to upload donor proof
        $.ajax({
            url: baseUrl + 'donor-history',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: formData,
            contentType: false, // Set contentType to false, as we're sending FormData
            processData: false, // Set processData to false, as we're sending FormData
            success: function(response) {
                if (response.success) {
                    toastr.success('Berhasil diunggah!');
                    // Close the modal after successful upload
                    $('#modalBackdrop').addClass('hidden');
                    // Reload page
                    location.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Check if there is an error response from the server
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    // Display the error message from the server using Toastr.js
                    toastr.error(xhr.responseJSON.message);
                } else {
                    // Display default error message
                    toastr.error(
                        'An error occurred while uploading donor proof. Please try again.'
                        );
                }
            }
        });
    });


})

function formatDate(dateString) {
    const months = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    const date = new Date(dateString);
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();
    return `${day} ${month} ${
        year}`;
}
document.addEventListener("DOMContentLoaded", function() {
    const openModalButton = document.getElementById("openModal");
    const closeModalButton = document.getElementById("closeModal");
    const modalBackdrop = document.getElementById("modalBackdrop");

    // Function to open the profile edit modal
    function openModal() {
        modalBackdrop.classList.remove("hidden");
    }

    // Function to close the profile edit moda-l
    function closeModal() {
        modalBackdrop.classList.add("hidden");
    }

    // Event listener for open profile edit modal button
    openModalButton.addEventListener("click", openModal);

    // Event listener for close profile edit modal button
    closeModalButton.addEventListener("click", closeModal);

    // Function to preview image
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
        }
    }

    // Add event listener to the file input for image preview
    document.querySelector('input[type="file"][name="bukti_donor"]').addEventListener('change', previewImage);
});
</script>
@endsection