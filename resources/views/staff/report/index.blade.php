<x-layout>
    <x-navbar></x-navbar>
    <x-button></x-button>
    <div class="container mx-auto p-6">
        <div class="mb-6 rounded-lg bg-white p-6 shadow-lg">
            <div class="mb-6 flex items-center justify-end">
                <button id="exportDropdownButton" data-dropdown-toggle="exportDropdown"
                    class="flex items-center rounded-lg bg-green-600 px-4 py-2 text-white transition hover:bg-green-700">
                    <span>Export (.xlsx)</span>
                    <i class="fas fa-caret-down ml-2"></i>
                </button>

                <!-- Dropdown menu -->
                <div id="exportDropdown"
                    class="divide z-10 hidden w-44 divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="exportDropdownButton">
                        <li>
                            <form action="{{route('staff.report.export')}}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua
                                    Data
                                </button>
                            </form>
                        </li>
                        <li>
                            <a data-modal-target="modalExport" data-modal-toggle="modalExport"
                                class="block cursor-pointer px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Berdasarkan
                                Tanggal
                            </a>
                        </li>
                    </ul>
                </div>

                <div id="modalExport" tabindex="-1" aria-hidden="true"
                    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                    <div class="relative max-h-full w-full max-w-2xl p-4">
                        <!-- Modal content -->
                        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Export (.xlsx)
                                </h3>
                                <button type="button"
                                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="modalExport">
                                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="space-y-4 p-4 md:p-5">
                                <form action="{{ route('staff.report.export') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="date" class="block text-sm font-medium text-gray-700">Pilih
                                            Tanggal</label>
                                        <input type="date" name="date" id="date"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div
                                        class="flex items-center justify-end rounded-b border-t border-gray-200 py-4 dark:border-gray-600 md:py-5">
                                        <button type="submit" data-modal-hide="default-modal" type="button"
                                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Export</button>

                                        <button data-modal-hide="default-modal" type="button"
                                            class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="overflow-x-auto rounded-lg border">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                Gambar & Pengirim
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                Lokasi & Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                Deskripsi
                            </th>
                            <a href="#">
                                <th class="cursor-pointer px-6 py-4 text-left text-sm font-medium text-gray-700">
                                    Jumlah Vote
                                    <i class="fas fa-caret-up ml-1 text-green-600"></i>
                                    <i class="fas fa-caret-down ml-1 text-green-600"></i>
                                </th>
                            </a>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($reports as $index => $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img data-modal-target="default-modal" data-modal-toggle="default-modal"
                                            class="h-10 w-10 cursor-pointer rounded-full object-cover"
                                            src="{{ asset('assets/images/' . $report->image) }}"
                                            alt="Profile picture" />
                                        <a href="mailto:flmpt@gmail.com"
                                            class="ml-3 text-sm font-medium text-blue-600 hover:text-blue-800">
                                            {{ $report->user->email }}
                                        </a>
                                    </div>
                                </td>

                                <div id="default-modal" tabindex="-1" aria-hidden="true"
                                    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                                    <div class="relative max-h-full w-full max-w-2xl p-4">
                                        <!-- Modal content -->
                                        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Terms of Service
                                                </h3>
                                                <button type="button"
                                                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="default-modal">
                                                    <svg class="h-3 w-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="space-y-4 p-4 md:p-5">
                                                <img class="h-96 w-full rounded-lg object-cover"
                                                    src="{{ asset('assets/images/' . $report->image) }}"
                                                    alt="Profile picture" />
                                                <div class="items </div> <!-- Modal footer --> <div class= flex"flex
                                                    items-center rounded-b border-t border-gray-200 p-4
                                                    dark:border-gray-600 md:p-5">
                                                    <button data-modal-hide="default-modal" type="button"
                                                        class="ms-3 rounded-lg border border-gray-200 bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <td class="px-6 py-4">
                                    <a class="cursor-pointer" href="{{ route('staff.response.view', $report->id) }}">
                                        <div class="text-sm text-gray-900">
                                            <span id="village-{{ $index }}"></span>,
                                            <span id="subdistrict-{{ $index }}"></span>,
                                            <span id="regency-{{ $index }}"></span>,
                                            <span id="province-{{ $index }}"></span>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $report->created_at->diffForHumans() }}
                                        </div>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ Str::limit($report->description, 50) }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm font-medium">
                                    <span class="rounded-full bg-gray-100 px-3 py-1">
                                        {{ $report->voting ? count($report->voting) : 0 }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <button id="dropdownDefaultButton-{{ $index }}"
                                        data-dropdown-toggle="dropdown-{{ $index }}"
                                        class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">Aksi <svg class="ms-3 h-2.5 w-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="dropdown-{{ $index }}" style="z-index: 9999"
                                        class="divide hidden w-44 divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownDefaultButton-{{ $index }}">
                                            <li>
                                                @if ($responses->contains('report_id', $report->id))
                                                    <a href="{{ route('staff.response.view', $report->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lihat</a>
                                                @else
                                                    <button data-modal-target="modalInput-{{ $index }}"
                                                        data-modal-toggle="modalInput-{{ $index }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tindak
                                                        Lanjut</button>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <div id="modalInput-{{ $index }}" tabindex="-1" aria-hidden="true"
                                class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                                <div class="relative max-h-full w-full max-w-2xl p-4">
                                    <!-- Modal content -->
                                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Tindak Lanjut
                                            </h3>
                                            <button type="button"
                                                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="modalInput-{{ $index }}">
                                                <svg class="h-3 w-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="{{ route('staff.response.store', $report->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="space-y-4 p-4 md:p-5">
                                                <div class="mb-4">
                                                    <label for="report_statement"
                                                        class="block text-sm font-medium text-gray-700">Tanggapan</label>
                                                    <select id="report_statement" name="report_statement"
                                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                        <option value="0">Tolak</option>
                                                        <option value="1">Proses Penyelesaian/Perbaikan
                                                        </option>
                                                    </select>
                                                </div>
                                                <div
                                                    class="flex items-center rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
                                                    <button data-modal-hide="default-modal" type="button"
                                                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Tutup</button>
                                                    <button data-modal-hide="default-modal" type="submit"
                                                        class="ms-3 rounded-lg border border-gray-200 bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">Buat</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            @foreach ($reports as $index => $report)
            // function IIFE (Immediately Invoked Function Expression) adalah function yang langsung dijalankan tanpa perlu dipanggil
            (function(index) {
                // parameter index berasal dari variabel $index yang di ambil dari foreach
                let provinsiId = "{{ $report->province }}";
                let kotaId = "{{ $report->regency }}";
                let kecamatanId = "{{ $report->subdistrict }}";
                let kelurahanId = "{{ $report->village }}";

                $.when(
                    $.get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'),
                    $.get(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`),
                    $.get(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`),
                    $.get(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                ).done(function(provinces, regencies, districts, villages) {
                let province = provinces[0].find(data => data.id == provinsiId);
                let regency = regencies[0].find(data => data.id == kotaId);
                let district = districts[0].find(data => data.id == kecamatanId);
                let village = villages[0].find(data => data.id == kelurahanId);

                if (province) {
                    $('#province-' + index).html(province.name);
                }
                if (regency) {
                    $('#regency-' + index).html(regency.name);
                }
                if (district) {
                    $('#subdistrict-' + index).html(district.name);
                }
                if (village) {
                    $('#village-' + index).html(village.name);
                }
                }).fail(function(error) {
                console.error('Error fetching location data:', error);
                });
            })({{ $index }});
            @endforeach
        });
    </script>
</x-layout>
