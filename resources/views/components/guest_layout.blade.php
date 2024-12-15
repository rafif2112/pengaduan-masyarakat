<div class="flex min-h-screen flex-col md:flex-row">
    <!-- Left Section -->
    <div class="flex w-full flex-col justify-start bg-orange-500 p-10 md:w-3/5">
        {{$slot}}
    </div>

    <!-- Right Section -->
    <div class="relative px-10 flex items-center bg-gray-100 h-64 w-full bg-cover bg-center md:h-auto md:w-2/5">
        <x-button></x-button>
        <div class="bg-white p-4 rounded shadow mt-4">
            <h2 class="font-bold flex items-center gap-4 pb-2 text-lg mb-2 border-b">
                <i class="fas fa-info-circle text-3xl text-yellow-500"></i>
                Informasi Pembuatan Pengaduan
            </h2>
            <ol class="list-decimal list-inside text-gray-700">
                <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya,</li>
                <li>Keseluruhan data pada pengaduan bernilai <strong>BENAR dan DAPAT DIPERTANGGUNG JAWABKAN</strong>,</li>
                <li>Seluruh bagian data perlu diisi</li>
                <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam,</li>
                <li>Periksa tanggapan Kami, pada <strong>Dashboard</strong> setelah Anda <strong>Login</strong>,</li>
                <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a class="text-blue-500" href="{{route('report.create')}}">Ikuti Tautan</a></li>
            </ol>
        </div>
    </div>
</div>
