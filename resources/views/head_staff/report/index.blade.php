<x-layout>
    <x-navbar></x-navbar>
    <x-button></x-button>
    <div class="mx-auto max-w-6xl p-6">
        <div class="mx-auto w-full max-w-4xl rounded-lg bg-white p-8 shadow-lg">
            <h1 class="mb-6 text-center text-3xl font-bold">Jumlah Pengaduan dan Tanggapan terhadap
                Pengaduan<br><span id="province"></span></h1>
            <div class="relative">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let countReports = @json($countReports);
        let countResponses = @json($countResponses);

        let ctx = document.getElementById('myChart').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pengaduan', 'Tanggapan'],
                datasets: [{
                    label: 'Jumlah',
                    data: [countReports, countResponses], // Replace with your actual data
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            let provinces = @json($userProvince);
            
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                type: 'GET',
                success: function(data) {
                    data.forEach(province => {
                        let provinceNames = data.filter(province => provinces.includes(province.id)).map(province => province.name);
                        $('#province').html(provinceNames);
                    });
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>
</x-layout>
