<x-layout>
    <x-button></x-button>
    <div class="flex min-h-screen flex-col overflow-hidden md:flex-row">
        <div class="flex w-full flex-col justify-center overflow-y-auto bg-orange-500 p-10 md:w-3/5">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="provinsi">
                        Provinsi*
                    </label>
                    <select name="province" class="w-full rounded border border-gray-300 p-2" id="provinsi">
                        <option value="" disabled>pilih</option>
                    </select>
                    @error('province')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="kota">
                        Kota/Kabupaten*
                    </label>
                    <select name="regency" class="w-full rounded border border-gray-300 p-2" id="kota" disabled>
                        <option value="" disabled>pilih</option>
                    </select>
                    @error('regency')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="kecamatan">
                        Kecamatan*
                    </label>    
                    <select name="subdistrict" class="w-full rounded border border-gray-300 p-2" id="kecamatan" disabled>
                        <option value="" disabled>pilih</option>
                    </select>
                    @error('subdistrict')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="kelurahan">
                        Kelurahan*
                    </label>
                    <select name="village" class="w-full rounded border border-gray-300 p-2" id="kelurahan" disabled>
                        <option value="" disabled>pilih</option>
                    </select>
                    @error('village')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="type">
                        Type*
                    </label>
                    <select name="type" class="w-full rounded border border-gray-300 p-2" id="type">
                        <option value="" disabled>pilih</option>
                        <option value="kejahatan">Kejahatan</option>
                        <option value="pembangunan">Pembangunan</option>
                        <option value="sosial">Sosial</option>
                    </select>
                    @error('type')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="detail">
                        Detail Keluhan*
                    </label>
                    <textarea name="description" class="w-full rounded border border-gray-300 p-2" id="detail" rows="4"></textarea>
                    @error('description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="mb-2 block text-white" for="image">
                        Gambar Pendukung*
                    </label>
                    <input type="file" name="image" accept=".jpeg,.jpg,.png" class="w-full rounded border border-gray-300 bg-white p-2" id="image"/>
                    @error('image')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input id="check" name="agreement" class="form-checkbox" type="checkbox" />
                        <span class="ml-2 text-white">
                            Laporan yang disampaikan sesuai dengan kebenaran.
                        </span>
                    </label>
                    @error('agreement')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button id="submitForm" class="rounded px-4 bg-blue-600 py-2 text-white" type="submit">
                    Kirim
                </button>
            </form>
        </div>

        <!-- Right Section -->
        <div class="relative bg-white h-64 w-full bg-cover bg-center md:h-auto md:w-2/5"
            style="" role="img"
            aria-label="Background image description">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                type: 'GET',
                success: function(data) {
                    $('#provinsi').empty();
                    $('#provinsi').append(`<option value="" disabled selected>pilih</option>`);
                    data.forEach(function(provinsi) {
                        $('#provinsi').append(
                            `<option value="${provinsi.id}">${provinsi.name}</option>`);
                    });
                },
            });

            $('#provinsi').change(function() {
                var idProvinsi = $(this).val();
                $('#kota').removeAttr('disabled');
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${idProvinsi}.json`,
                    type: 'GET',
                    success: function(data) {
                        $('#kota').empty();
                        $('#kota').append(`<option value="" disabled selected>pilih</option>`);
                        data.forEach(function(kota) {
                            $('#kota').append(
                                `<option value="${kota.id}">${kota.name}</option>`);
                        });
                    },
                });
            });

            $('#kota').change(function() {
                var idKota = $(this).val();
                $('#kecamatan').removeAttr('disabled');
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${idKota}.json`,
                    type: 'GET',
                    success: function(data) {
                        $('#kecamatan').empty();
                        $('#kecamatan').append(`<option value="" disabled selected>pilih</option>`);
                        data.forEach(function(kecamatan) {
                            $('#kecamatan').append(
                                `<option value="${kecamatan.id}">${kecamatan.name}</option>`
                            );
                        });
                    },
                });
            });

            $('#kecamatan').change(function() {
                var idKecamatan = $(this).val();
                $('#kelurahan').removeAttr('disabled');
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${idKecamatan}.json`,
                    type: 'GET',
                    success: function(data) {
                        $('#kelurahan').empty();
                        $('#kelurahan').append(`<option value="" disabled selected>pilih</option>`);
                        data.forEach(function(kelurahan) {
                            $('#kelurahan').append(
                                `<option value="${kelurahan.id}">${kelurahan.name}</option>`
                            );
                        });
                    },
                });
            });

        });
    </script>
</x-layout>
