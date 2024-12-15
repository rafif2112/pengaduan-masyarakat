<x-layout>
    <x-navbar></x-navbar>
    <x-button></x-button>
    <div class="mx-auto my-6 w-4/5 rounded-lg bg-white p-6 shadow-md">
        @if (session('success'))
            <div id="alert-3"
                class="mb-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div id="alert-2"
                class="mb-4 flex items-center rounded-lg bg-red-50 p-4 text-red-800 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 p-1.5 text-red-500 hover:bg-red-200 focus:ring-2 focus:ring-red-400 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @foreach ($reports as $index => $report)
            <div class="mb-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold">
                    {{ $report->user->email }}
                </h1>
                <a href="{{ route('staff.report.index') }}"
                    class="rounded bg-green-700 px-4 py-2 text-center text-white">
                    Kembali
                </a>
            </div>
            <div class="mb-4 flex items-center justify-between">
                <p class="text-gray-600">
                    @if ($report->response->count() > 0)
                        {{ $report->created_at->diffForHumans() }}
                        <span class="font-bold">
                            Status tanggapan :
                            @foreach ($report->response as $response)
                                @if ($response->response_status == 'on_process')
                                    <span class="rounded bg-blue-500 px-4 py-2 text-white">
                                        ON_PROCCESS
                                    </span>
                                @elseif ($response->response_status == 'done')
                                    <span class="rounded bg-green-500 px-4 py-2 text-white">
                                        DONE
                                    </span>
                                @elseif ($response->response_status == 'reject')
                                    <span class="rounded bg-red-500 px-4 py-2 text-white">
                                        REJECT
                                    </span>
                                @endif
                            @endforeach
                        </span>
                    @endif
                </p>
            </div>
            <div class="flex">
                <div class="w-2/3 pr-4">
                    <div class="mb-4 rounded-lg bg-gray-100 p-4">
                        <h2 class="mb-2 font-bold">
                            <span id="village-{{ $index }}"></span>,
                            <span id="subdistrict-{{ $index }}"></span>,
                            <span id="regency-{{ $index }}"></span>,
                            <span id="province-{{ $index }}"></span>
                        </h2>
                        <p class="mb-4 text-gray-700">
                            {{ $report->description }}
                        </p>
                        <img alt="Aerial view of a construction site with various stages of development"
                            class="w-full rounded" height="200" src="{{ asset('assets/images/' . $report->image) }}"
                            width="300" />
                    </div>
                </div>
                <div class="w-1/3 pl-4">
                    @if ($responseProgres->count() > 0)
                        <div class="mb-4 rounded-lg bg-gray-100 p-4">
                            <ul class="space-y-4">
                                @foreach ($responseProgres as $index => $progres)
                                    <li class="flex items-center">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-500 text-white">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div class="ml-4">
                                            <p data-modal-target="deleteProgres-{{ $index }}"
                                                data-modal-toggle="deleteProgres-{{ $index }}"
                                                class="cursor-pointer text-sm text-gray-500 underline">
                                                {{ \Carbon\Carbon::parse($progres->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            </p>
                                            @php $histories = $progres->histories; @endphp
                                            <p class="text-gray-700">{{ $histories['tanggapan'] }}</p>
                                        </div>
                                    </li>
                                    @if (!$loop->last)
                                        <div class="ml-4 h-8 border-l-2 border-gray-300"></div>
                                    @endif
                                    <!-- Delete Progres Modal -->
                                    <div id="deleteProgres-{{ $index }}" tabindex="-1" aria-hidden="true"
                                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                                        <div class="relative max-h-full w-full max-w-md p-4">
                                            <!-- Modal content -->
                                            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Hapus Progres
                                                    </h3>
                                                    <button type="button"
                                                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="deleteProgres-{{ $index }}">
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
                                                <div class="p-4 md:p-5">
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                                        Apakah Anda yakin ingin menghapus progres ini?
                                                    </p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div
                                                    class="flex items-center justify-end rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
                                                    <button data-modal-hide="deleteProgres" type="button"
                                                        class="rounded-lg bg-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200">
                                                        Batal
                                                    </button>
                                                    <form
                                                        action="{{ route('staff.response.progres.delete', $progres->id) }}"
                                                        method="POST" class="ms-3">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="time"
                                                            value="{{ $progres->created_at }}">
                                                        <button type="submit"
                                                            class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @elseif ($response->response_status == 'reject')
                        <p class="text-gray-600">
                            Laporan ini telah ditolak.
                        </p>
                    @else
                        <p class="text-gray-600">
                            Belum ada riwayat progress perbaikan/penyelesaian apapun
                        </p>
                    @endif
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                @foreach ($report->response as $response)
                    @if ($response->response_status !== 'done' && $response->response_status !== 'reject')
                        <form action="{{ route('staff.response.update', $response->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="mr-2 rounded bg-green-700 px-4 py-2 text-white">
                                Nyatakan Selesai
                            </button>
                        </form>
                        <button data-modal-target="modalInput" data-modal-toggle="modalInput"
                            class="rounded bg-gray-300 px-4 py-2 text-gray-700">
                            Tambah Progres
                        </button>
                    @endif
                @endforeach
            </div>

            <div id="modalInput" tabindex="-1" aria-hidden="true"
                class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                <div class="relative max-h-full w-full max-w-2xl p-4">
                    <!-- Modal content -->
                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Progres Tindak Lanjut
                            </h3>
                            <button type="button"
                                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="modalInput">
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{ route('staff.response.progres.create', $report->id) }}" method="POST">
                            @csrf
                            <div class="space-y-4 p-4 md:p-5">
                                <div class="mb-4">
                                    <label class="m-2" for="tanggapan">Tanggapan</label>
                                    @foreach ($report->response as $response)
                                        <input type="hidden" name="response_id" value="{{ $response->id }}">
                                    @endforeach
                                    <textarea name="tanggapan" id="tanggapan"
                                        class="h-24 w-full rounded-lg border border-gray-200 p-2 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"></textarea>
                                </div>
                                <div class="items </div> <!-- Modal footer --> <div class= flex"flex items-center
                                    rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
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
