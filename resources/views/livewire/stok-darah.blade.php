@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">

    <div class="flex flex-col">
        <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Stok Darah Terkini Di <span id="selectedUtdPMI">Seluruh Indonesia</span> Per Mei/2024</p>
    </div>

    <div class="flex mt-6 mb-2">
        <select id="utd-select" class="bg-[#BA1D1D] shadow-sm text-white text-sm px-3 py-1 rounded-lg md:mt-2">
        </select>
    </div>

    <canvas id="bloodStockChart" width="20" height="9"></canvas>

    <button id="backButton" style="display: none;">X</button>

</div>
<div class="bg-white rounded-2xl p-6 mt-2 flex flex-col shadow-lg z-10">

    <div class="flex flex-col">
        <p class="font-semibold text-2xl text-[#172B4D]">Detail Stok Darah</p>
        <div>
            <div class="mt-6 text-[11px] text-center">
                {{-- <table id="myTable" class="table-auto min-w-full">
                    <thead>
                        <tr>
                            <th>Produk Darah</th>
                            <th>A+</th>
                            <th>A-</th>
                            <th>B+</th>
                            <th>B-</th>
                            <th>AB+</th>
                            <th>AB-</th>
                            <th>O+</th>
                            <th>O-</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Anti Hemophilic Factor</td>
                            <td>1</td>
                            <td>2</td>
                            <td>45</td>
                            <td>0</td>
                            <td>4</td>
                            <td>4</td>
                            <td>4</td>
                            <td>5</td>
                            <td>1</td>
                        </tr>
                        <!-- Tambahkan baris berikut sesuai kebutuhan -->
                    </tbody>
                </table> --}}
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-left">Nama</th>
                            <th>A+</th>
                            <th>A-</th>
                            <th>B+</th>
                            <th>B-</th>
                            <th>AB+</th>
                            <th>AB-</th>
                            <th>O+</th>
                            <th>O-</th>
                            <th>Total Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan dimuat oleh JavaScript -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {        
        var selectedUtdId = 0;
        var baseUrl = 'https://skripsi-kita.my.id/apis/';
        var token = localStorage.getItem('token');
        var chart;

        loadChartWithUtdProfileId(selectedUtdId);
        loadDatatables();
        // Function to handle dropdown change event
        $('#utd-select').change(function() {
            selectedUtdId = $(this).val(); // Remove var declaration to update global variable
            selectedUtdName = $(this).find('option:selected').text(); // Mengambil teks dari opsi yang dipilih
            $("#selectedUtdPMI").text(selectedUtdName);
            console.log("selectedUtdId", selectedUtdId);
            if (selectedUtdId) {
                loadChartWithUtdProfileId(selectedUtdId);
            }
            loadDatatables();
        });

        // Function to create chart
        function createChart(data) {
            var ctx = document.getElementById('bloodStockChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                            label: 'Jumlah Kantong Darah',
                            data: Object.values(data),
                            backgroundColor: 'rgba(186, 29, 29, 0.9)',
                            borderRadius:4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Blood Type Distribution'
                        }
                    }
                }
            });
        }

        // Function to update chart
        function updateChart(data) {
            if (chart) {
                chart.destroy();
            }
            createChart(data);
        }

        // Function to load dropdown data
        function loadDropdownData() {
            $.ajax({
                url: baseUrl + 'profile/utd-pmi',
                method: 'GET',
                success: function(response) {
                    console.log(response.data);
                    if (response.success) {
                        var select = $('#utd-select');
                        select.empty(); // Clear existing options before appending new ones
                        select.append(new Option('Seluruh Indonesia', '0'));
                        response.data.forEach(function(item) {
                            select.append(new Option(item.name, item.id));
                        });
                    } else {
                        alert('Failed to load data');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while loading data');
                }
            });
        }

        // Function to load chart with UTD profile ID
        function loadChartWithUtdProfileId(utdProfileId) {
            $.ajax({
                url: baseUrl + 'blood-chart',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    utd_profile_id: utdProfileId,
                }),
                success: function(response) {
                    console.log("response", response);
                    updateChart(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while fetching chart data');
                }
            });
        }
        // Call loadDropdownData function to load dropdown data initially
        loadDropdownData();

        function loadDatatables() {
            if ($.fn.DataTable.isDataTable('#example')) {
                // Hapus DataTable sebelumnya jika sudah diinisialisasi sebelumnya
                $('#example').DataTable().destroy();
            }
            if (selectedUtdId == 0) {
                $.ajax({
                    url: baseUrl + 'blood/stock/get-all-by-mapping-all-stock',
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Buat tabel dari data
                            $('#example').DataTable({
                                data: response.data,
                                columns: [
                                    { data: 'id' },
                                    { data: 'name', className: 'text-left' },
                                    { data: 'stock_a_positive' },
                                    { data: 'stock_a_negative' },
                                    { data: 'stock_b_positive' },
                                    { data: 'stock_b_negative' },
                                    { data: 'stock_ab_positive' },
                                    { data: 'stock_ab_negative' },
                                    { data: 'stock_o_positive' },
                                    { data: 'stock_o_negative' },
                                    { data: 'total_stock' }
                                ]
                            });
                        } else {
                            console.error('Failed to load data:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                $.ajax({
                    url: baseUrl + 'blood/stock/get-all-by-mapping-all-stock/detail',
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    data: {
                        "utd_profile_id":selectedUtdId
                    },
                    success: function(response) {
                        if (response.success) {
                            // Buat tabel dari data
                            $('#example').DataTable({
                                data: response.data,
                                columns: [
                                    { data: 'blood_product_id' },
                                    { data: 'blood_product_name', className: 'text-left'},
                                    { data: 'stock_a_positive' },
                                    { data: 'stock_a_negative' },
                                    { data: 'stock_b_positive' },
                                    { data: 'stock_b_negative' },
                                    { data: 'stock_ab_positive' },
                                    { data: 'stock_ab_negative' },
                                    { data: 'stock_o_positive' },
                                    { data: 'stock_o_negative' },
                                    { data: 'total_stock' }
                                ]
                            });
                        } else {
                            console.error('Failed to load data:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        }


    });
</script>

@endsection
